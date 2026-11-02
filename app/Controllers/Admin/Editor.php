<?php

namespace App\Controllers\Admin;

use App\Libraries\PageEditor;
use App\Models\PageBlockModel;
use App\Models\PageRevisionModel;

/**
 * 홈페이지 화면 편집기.
 *
 * 홈페이지를 그대로 띄워 놓고 글자·사진·링크를 그 자리에서 고친다.
 * 고친 내용은 먼저 '임시 저장'되고, '홈페이지에 게시'를 눌러야 방문자에게 보인다.
 */
class Editor extends AdminController
{
    protected string $menu_key = 'editor';

    private const UPLOAD_DIR = 'uploads/editor';
    private const MAX_KB     = 8192;

    public function index()
    {
        $page = (string) $this->request->getGet('page');
        if (! isset(PageEditor::PAGES[$page])) {
            $page = 'index';
        }

        return view('admin/editor', [
            'title'        => '홈페이지 편집',
            'page'         => $page,
            'pages'        => PageEditor::PAGES,
            'draft_count'  => (new PageBlockModel())->countDrafts(),
            'unread_count' => 0,
        ]);
    }

    // ------------------------------------------------------------------
    // 저장
    // ------------------------------------------------------------------

    /** 편집기에서 고친 영역을 임시 저장 */
    public function save()
    {
        $in     = $this->request->getJSON(true) ?? [];
        $page   = (string) ($in['page'] ?? '');
        $blocks = is_array($in['blocks'] ?? null) ? $in['blocks'] : [];
        $meta   = is_array($in['meta'] ?? null) ? $in['meta'] : [];
        $model  = new PageBlockModel();
        $by     = (string) session('admin_name');
        $known  = PageEditor::blockFiles();

        $saved = 0;
        foreach ($blocks as $key => $html) {
            $key = (string) $key;
            if (! isset($known[$key]) || ! is_string($html)) {
                continue; // 화면에 없는 영역 이름은 받지 않는다
            }
            $html = PageEditor::clean($html);
            if ($html === '' || mb_strlen($html) > 4_000_000) {
                continue;
            }
            // 원래 화면과 똑같아졌으면 저장본을 지운다
            if ($html === PageEditor::originalBlock($key)) {
                $html = '';
            }
            $model->saveDraft($key, $html, $by);
            $saved++;
        }

        if (isset(PageEditor::PAGES[$page])) {
            foreach (['title', 'desc'] as $f) {
                if (! array_key_exists($f, $meta)) {
                    continue;
                }
                $value    = trim(strip_tags((string) $meta[$f]));
                $original = trim((string) ($meta['original_' . $f] ?? ''));
                $model->saveDraft($page . '/__' . $f, ($value === $original) ? '' : mb_substr($value, 0, 300), $by);
                $saved++;
            }
        }

        return $this->json(['ok' => true, 'saved' => $saved, 'drafts' => $model->countDrafts()]);
    }

    /** 편집기에서 사진 올리기 — 검사 3중(확장자·크기·실제 이미지) 후 큰 사진은 줄인다 */
    public function upload()
    {
        $file = $this->request->getFile('image');

        if ($file === null || ! $file->isValid() || $file->hasMoved()) {
            return $this->json(['ok' => false, 'message' => '사진을 받지 못했습니다.'], 400);
        }
        $ext = strtolower($file->getClientExtension());
        if (! in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'], true)) {
            return $this->json(['ok' => false, 'message' => 'jpg, png, webp, gif, svg 파일만 올릴 수 있습니다.'], 400);
        }
        if ($file->getSizeByUnit('kb') > self::MAX_KB) {
            return $this->json(['ok' => false, 'message' => '8MB 보다 작은 사진을 올려 주세요.'], 400);
        }
        if ($ext === 'svg') {
            $svg = (string) file_get_contents($file->getTempName());
            if (stripos($svg, '<svg') === false || preg_match('~<script|\son[a-z]+\s*=|javascript:~i', $svg)) {
                return $this->json(['ok' => false, 'message' => '쓸 수 없는 SVG 파일입니다.'], 400);
            }
        } elseif (@getimagesize($file->getTempName()) === false) {
            return $this->json(['ok' => false, 'message' => '이미지 파일이 아닙니다.'], 400);
        }

        $dir = FCPATH . self::UPLOAD_DIR;
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        $name = $file->getRandomName();
        $file->move($dir, $name);

        if (! in_array($ext, ['svg', 'gif'], true)) {
            $this->shrink($dir . '/' . $name, 2000);
        }

        return $this->json([
            'ok'  => true,
            'url' => base_url(self::UPLOAD_DIR . '/' . $name),
        ]);
    }

    /** 영역(또는 화면 전체)을 원래 화면으로 되돌리기 — 임시 저장 */
    public function reset()
    {
        $in    = $this->request->getJSON(true) ?? [];
        $model = new PageBlockModel();
        $by    = (string) session('admin_name');
        $keys  = [];

        if (! empty($in['key'])) {
            $keys[] = (string) $in['key'];
        } elseif (! empty($in['page']) && isset(PageEditor::PAGES[$in['page']])) {
            foreach (array_keys(PageEditor::blockFiles()) as $k) {
                if (PageEditor::pageOf($k) === $in['page']) {
                    $keys[] = $k;
                }
            }
            $keys[] = $in['page'] . '/__title';
            $keys[] = $in['page'] . '/__desc';
        }

        foreach ($keys as $k) {
            $model->saveDraft($k, '', $by);
        }

        return $this->json(['ok' => true, 'drafts' => $model->countDrafts()]);
    }

    // ------------------------------------------------------------------
    // 게시 · 버리기 · 이력
    // ------------------------------------------------------------------

    public function publish()
    {
        $model = new PageBlockModel();
        $n     = $model->publish();

        if ($n > 0) {
            $note = trim((string) ($this->request->getJSON(true)['note'] ?? ''));
            (new PageRevisionModel())->record($model->publishedMap(), $note !== '' ? $note : $n . '개 영역 게시', (string) session('admin_name'));
        }

        return $this->json(['ok' => true, 'published' => $n, 'drafts' => 0]);
    }

    public function discard()
    {
        (new PageBlockModel())->discard();

        return $this->json(['ok' => true, 'drafts' => 0]);
    }

    /** 게시 대기 목록 + 게시 이력 */
    public function status()
    {
        $model = new PageBlockModel();
        $rows  = (new PageRevisionModel())->select('id, note, admin_name, created_at')->orderBy('id', 'DESC')->findAll(PageRevisionModel::KEEP);

        return $this->json([
            'ok'      => true,
            'drafts'  => array_map(fn ($k) => ['key' => $k, 'label' => $this->label($k)], $model->draftKeys()),
            'history' => $rows,
        ]);
    }

    /** 이력의 상태를 임시 저장본으로 불러온다 (확인 후 게시) */
    public function restore($id)
    {
        $rev = (new PageRevisionModel())->find((int) $id);
        if ($rev === null) {
            return $this->json(['ok' => false, 'message' => '이력을 찾지 못했습니다.'], 404);
        }
        $model = new PageBlockModel();
        $model->stageSnapshot(json_decode($rev['snapshot'], true) ?: [], (string) session('admin_name'));

        return $this->json(['ok' => true, 'drafts' => $model->countDrafts()]);
    }

    // ------------------------------------------------------------------
    // 문구 일괄 바꾸기 — 상호·메뉴 이름처럼 여러 화면에 걸친 글자를 한 번에
    // ------------------------------------------------------------------

    public function replace()
    {
        return $this->render('admin/editor_replace', [
            'title'    => '문구 일괄 바꾸기',
            'current'  => 'replace',
            'subtitle' => '상호·메뉴 이름처럼 여러 화면에 나오는 글자를 한 번에 바꿉니다. 바꾼 내용은 임시 저장되며, 게시해야 홈페이지에 나갑니다.',
            'result'   => null,
            'find'     => '',
            'repl'     => '',
            'scope'    => 'all',
        ]);
    }

    public function doReplace()
    {
        $find  = (string) $this->request->getPost('find');
        $repl  = (string) $this->request->getPost('repl');
        $scope = (string) $this->request->getPost('scope');
        $apply = $this->request->getPost('apply') === '1';

        if (trim($find) === '') {
            return redirect()->to('/admin/editor/replace')->with('error', '찾을 글자를 입력해 주세요.');
        }

        $model  = new PageBlockModel();
        $blocks = $model->map(true);
        $by     = (string) session('admin_name');
        $result = [];
        $total  = 0;

        $inScope = static function (string $key) use ($scope) {
            $isEn = str_starts_with($key, 'en/') || str_starts_with($key, '@en');

            return $scope === 'all' || ($scope === 'en' ? $isEn : ! $isEn);
        };

        // 화면 영역
        foreach (array_keys(PageEditor::blockFiles()) as $key) {
            if (! $inScope($key)) {
                continue;
            }
            $html = PageEditor::currentBlock($key, $blocks);
            if ($html === null) {
                continue;
            }
            $n   = 0;
            $new = PageEditor::replaceText($html, $find, $repl, $n);
            if ($n > 0) {
                $result[] = ['key' => $key, 'label' => $this->label($key), 'count' => $n];
                $total += $n;
                if ($apply) {
                    $model->saveDraft($key, $new === PageEditor::originalBlock($key) ? '' : $new, $by);
                }
            }
        }

        // 화면 제목·설명
        foreach (PageEditor::PAGES as $page => [$label, $url]) {
            if (! $inScope($page)) {
                continue;
            }
            $orig = $this->originalMeta($page);
            foreach (['title' => '제목', 'desc' => '설명'] as $f => $fl) {
                $cur = $blocks[$page . '/__' . $f] ?? $orig[$f];
                $n   = substr_count($cur, $find);
                if ($n > 0) {
                    $result[] = ['key' => $page . '/__' . $f, 'label' => $label . ' · 검색 ' . $fl, 'count' => $n];
                    $total += $n;
                    if ($apply) {
                        $new = str_replace($find, $repl, $cur);
                        $model->saveDraft($page . '/__' . $f, $new === $orig[$f] ? '' : $new, $by);
                    }
                }
            }
        }

        if ($apply) {
            return redirect()->to('/admin/editor/replace')->with('message',
                $total > 0 ? "'{$find}' → '{$repl}' {$total}곳을 바꿨습니다. 편집기에서 확인한 뒤 '홈페이지에 게시'를 눌러 주세요." : '바꿀 곳이 없었습니다.');
        }

        return $this->render('admin/editor_replace', [
            'title'    => '문구 일괄 바꾸기',
            'current'  => 'replace',
            'subtitle' => '상호·메뉴 이름처럼 여러 화면에 나오는 글자를 한 번에 바꿉니다. 바꾼 내용은 임시 저장되며, 게시해야 홈페이지에 나갑니다.',
            'result'   => $result,
            'total'    => $total,
            'find'     => $find,
            'repl'     => $repl,
            'scope'    => $scope,
        ]);
    }

    // ------------------------------------------------------------------
    // 내보내기 · 가져오기 — 로컬에서 고친 내용을 카페24 서버로 옮길 때
    // ------------------------------------------------------------------

    public function export()
    {
        $model = new PageBlockModel();
        $map   = $model->map(true); // 임시 저장본 포함 '편집기에 보이는 그대로'
        $files = [];
        $all   = implode("\n", $map);

        if (preg_match_all('~' . preg_quote(self::UPLOAD_DIR, '~') . '/([\w.-]+)~', $all, $mm)) {
            foreach (array_unique($mm[1]) as $f) {
                $path = FCPATH . self::UPLOAD_DIR . '/' . $f;
                if (is_file($path)) {
                    $files[$f] = base64_encode((string) file_get_contents($path));
                }
            }
        }

        $json = json_encode([
            'type'        => 'k1-page-editor',
            'version'     => 1,
            'exported_at' => date('c'),
            'blocks'      => $map,
            'files'       => $files,
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        return $this->response->download('homepage-edits-' . date('Ymd-His') . '.json', $json);
    }

    public function import()
    {
        $file = $this->request->getFile('package');
        if ($file === null || ! $file->isValid()) {
            return redirect()->to('/admin/editor/replace')->with('error', '파일을 받지 못했습니다.');
        }
        $data = json_decode((string) file_get_contents($file->getTempName()), true);
        if (! is_array($data) || ($data['type'] ?? '') !== 'k1-page-editor' || ! is_array($data['blocks'] ?? null)) {
            return redirect()->to('/admin/editor/replace')->with('error', '편집기에서 내보낸 파일이 아닙니다.');
        }

        $dir = FCPATH . self::UPLOAD_DIR;
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        foreach (($data['files'] ?? []) as $name => $b64) {
            if (! preg_match('~^[\w-]+\.(jpe?g|png|webp|gif|svg)$~i', (string) $name)) {
                continue;
            }
            file_put_contents($dir . '/' . $name, base64_decode((string) $b64));
        }

        $known  = PageEditor::blockFiles();
        $blocks = [];
        foreach ($data['blocks'] as $key => $html) {
            $page = PageEditor::pageOf((string) $key);
            if (isset($known[$key]) || isset(PageEditor::PAGES[$page])) {
                $blocks[$key] = str_ends_with((string) $key, '/__title') || str_ends_with((string) $key, '/__desc')
                    ? trim(strip_tags((string) $html))
                    : PageEditor::clean((string) $html);
            }
        }
        (new PageBlockModel())->stageSnapshot($blocks, (string) session('admin_name'));

        return redirect()->to('/admin/editor/replace')->with('message', count($blocks) . '개 영역을 가져왔습니다. 편집기에서 확인한 뒤 \'홈페이지에 게시\'를 눌러 주세요.');
    }

    // ------------------------------------------------------------------

    private function json(array $data, int $status = 200)
    {
        // CSRF 토큰은 요청마다 새로 발급되므로 다음 요청에 쓸 값을 실어 보낸다
        $data['csrf'] = csrf_hash();

        return $this->response->setStatusCode($status)->setJSON($data);
    }

    /** 영역 이름을 사람이 읽을 이름으로 */
    private function label(string $key): string
    {
        $page = PageEditor::pageOf($key);
        $name = substr($key, strlen($page) + 1);
        $common = ['@ko' => '국문 공통', '@en' => '영문 공통'];
        $parts  = ['head' => '상단 메뉴', 'drawer' => '모바일 메뉴', 'foot' => '바닥글', '__title' => '검색 제목', '__desc' => '검색 설명',
                   'subhero' => '상단 제목', 'pagenav' => '화면 안 메뉴', 'hero' => '첫 화면'];

        $pl = $common[$page] ?? (PageEditor::PAGES[$page][0] ?? $page);

        if (! isset($parts[$name])) {
            // 영역의 첫 제목을 이름으로 쓴다 (예: 'ceo' → '현장은 언제나 예측하지…')
            $html = PageEditor::originalBlock($key) ?? '';
            if (preg_match('~<h[123][^>]*>(.*?)</h[123]>~s', $html, $m)) {
                $t = trim(preg_replace('~\s+~u', ' ', html_entity_decode(strip_tags(str_replace('<br>', ' ', $m[1])), ENT_QUOTES, 'UTF-8')));
                if ($t !== '') {
                    return $pl . ' · ' . (mb_strlen($t) > 22 ? mb_substr($t, 0, 22) . '…' : $t);
                }
            }
        }

        return $pl . ' · ' . ($parts[$name] ?? $name);
    }

    private function originalMeta(string $page): array
    {
        $rel  = str_starts_with($page, 'en/') ? 'pages/' . $page : (in_array($page, ['news', 'recruit'], true) ? $page : 'pages/' . $page);
        $path = APPPATH . 'Views/site/' . $rel . '.php';

        return PageEditor::readMeta(is_file($path) ? (string) file_get_contents($path) : '');
    }

    private function shrink(string $full, int $width): void
    {
        [$w] = @getimagesize($full) ?: [0];
        if ($w <= $width) {
            return;
        }
        try {
            service('image')->withFile($full)->resize($width, $width * 10, true, 'width')->save($full, 85);
        } catch (\Throwable $e) {
            log_message('warning', '편집기 사진 축소 실패: ' . $e->getMessage());
        }
    }
}
