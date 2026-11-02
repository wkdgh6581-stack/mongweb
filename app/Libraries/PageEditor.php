<?php

namespace App\Libraries;

use App\Models\PageBlockModel;

/**
 * 홈페이지 화면 편집기 — 화면을 그대로 보면서 고친 내용을 실제 화면에 입혀 내보낸다.
 *
 * 동작 방식
 * ----------
 * 1. 화면 파일(app/Views/site/...)에서 고칠 수 있는 영역은 아래처럼 표시해 둔다.
 *        <!--ed:about/ceo--> ... <!--/ed:about/ceo-->
 *    '@ko/...' '@en/...' 으로 시작하는 영역은 모든 화면이 함께 쓰는 머리글·바닥글이다.
 * 2. 관리자가 편집기에서 고치면 그 영역의 HTML 이 page_blocks 표에 '임시 저장(draft)' 된다.
 * 3. '게시하기'를 누르면 임시 저장본이 실제 홈페이지(html)로 옮겨진다.
 * 4. 홈페이지를 그릴 때 저장된 영역이 있으면 원래 화면 대신 그 내용을 넣는다.
 *
 * 저장된 HTML 안의 {{...}} 는 그릴 때마다 실제 값으로 바뀐다.
 *    {{site.tel}}  회사 정보(관리자 > 회사 정보) — 한 곳에서 고치면 전 화면에 반영
 *    {{base}}      사이트 주소(로컬·카페24 어디서든 맞게 바뀜)
 *    {{csrf}}      문의 폼 보안 토큰
 *    {{home_url}} 등 화면마다 다른 값 — 화면 파일 맨 위 PageEditor::tokens() 에서 정한다.
 */
class PageEditor
{
    /** 편집기 목록에 보이는 화면 (키 => [이름, 주소]) */
    public const PAGES = [
        'index'       => ['메인',           'index.html'],
        'about'       => ['회사소개',       'about.html'],
        'business'    => ['홈페이지제작',   'business.html'],
        'corporate'   => ['└ 기업 홈페이지', 'corporate.html'],
        'hospital'    => ['└ 병원 홈페이지', 'hospital.html'],
        'franchise'   => ['└ 프랜차이즈 홈페이지', 'franchise.html'],
        'shop'        => ['└ 쇼핑몰 홈페이지', 'shop.html'],
        'lawyer'      => ['└ 변호사 홈페이지', 'lawyer.html'],
        'tax'         => ['└ 세무·법무·노무·회계', 'tax.html'],
        'price'       => ['비용안내',       'price.html'],
        'maintenance' => ['유지보수',       'maintenance.html'],
        'projects'    => ['프로젝트 실적',  'projects.html'],
        'recruit'     => ['인재채용',       'recruit.html'],
        'news'        => ['홍보센터',       'news.html'],
        'contact'     => ['고객문의',       'contact.html'],
        'privacy'     => ['개인정보 처리방침', 'privacy.html'],
        'en/index'    => ['[EN] Home',      'en/index.html'],
        'en/about'    => ['[EN] About',     'en/about.html'],
        'en/business' => ['[EN] Business',  'en/business.html'],
        'en/projects' => ['[EN] Projects',  'en/projects.html'],
        'en/recruit'  => ['[EN] Careers',   'en/recruit.html'],
        'en/news'     => ['[EN] News',      'en/news.html'],
        'en/contact'  => ['[EN] Contact',   'en/contact.html'],
        'en/privacy'  => ['[EN] Privacy',   'en/privacy.html'],
    ];

    private const MARKER = '~<!--ed:([\w@/.-]+)-->(.*?)<!--/ed:\1-->~s';

    /** 화면마다 다른 값 ({{home_url}} 등) — 화면 파일이 그릴 때 채운다 */
    private static array $tokens = [];

    public static function tokens(array $values): void
    {
        self::$tokens = array_merge(self::$tokens, $values);
    }

    // ------------------------------------------------------------------
    // 그리기
    // ------------------------------------------------------------------

    /**
     * 사이트 화면을 편집 내용까지 입혀 그린다.
     *
     * @param string $page 편집기에서 쓰는 화면 키 (PAGES). 메타(제목·설명) 저장 위치로 쓴다.
     * @param bool   $deep 주소가 한 단계 이상 깊은 화면(/news/view/1 등) — 상대 경로를 절대 경로로 바꾼다.
     */
    public static function render(string $view, array $data = [], string $page = '', bool $deep = false): string
    {
        self::$tokens = [];
        $mode = self::mode();

        if ($mode === 'edit') {
            // 회사 정보 자리에 실제 값 대신 {{site.키}} 를 넣어 그린다.
            // 그래야 편집한 내용을 저장해도 회사 정보와의 연결이 끊어지지 않는다.
            service('renderer')->setData(['site' => self::siteTokens()], 'raw');
        }

        $html   = view($view, $data);
        $blocks = (new PageBlockModel())->map($mode !== 'public');

        $html = preg_replace_callback(self::MARKER, static function ($m) use ($blocks, $mode) {
            $key     = $m[1];
            $content = array_key_exists($key, $blocks) ? $blocks[$key] : $m[2];

            if ($mode === 'edit') {
                // 편집기가 영역을 알아보도록 첫 태그에 표시를 단다
                $content = preg_replace('~^(\s*<[a-zA-Z][\w-]*)~', '$1 data-ed="' . esc($key, 'attr') . '"', $content, 1);
            }

            return $content;
        }, $html);

        $origMeta = self::readMeta($html);

        if ($page !== '') {
            $html = self::applyMeta($html, $page, $blocks);
        }

        if ($mode === 'edit') {
            // 사이트 주소·보안 토큰만 채운다(편집기가 저장할 때 다시 {{base}} {{csrf}} 로 되돌린다).
            // 회사 정보·화면별 값은 {{...}} 그대로 두어 편집기가 '고정 칩'으로 보여준다.
            $html = str_replace('{{base}}', rtrim(base_url(), '/') . '/', $html);
            $html = str_replace('{{csrf}}', csrf_field(), $html);

            return self::injectEditor($html, $page, $blocks, $origMeta);
        }

        $html = self::fillTokens($html);

        if ($deep) {
            $html = self::absolutize($html);
        }

        return $html;
    }

    /**
     * public  일반 방문자
     * edit    편집기 안 (관리자 로그인 + ?edit=1)
     * preview 임시 저장본 미리보기 (관리자 로그인 + ?preview=1)
     */
    public static function mode(): string
    {
        $req = service('request');

        if (! method_exists($req, 'getGet') || ! session()->get('admin_id')) {
            return 'public';
        }

        if ($req->getGet('edit') === '1') {
            return 'edit';
        }

        return $req->getGet('preview') === '1' ? 'preview' : 'public';
    }

    /** 제목·설명(검색 결과에 나오는 문구) 바꾸기 */
    private static function applyMeta(string $html, string $page, array $blocks): string
    {
        $title = $blocks[$page . '/__title'] ?? null;
        $desc  = $blocks[$page . '/__desc'] ?? null;

        if ($title !== null && $title !== '') {
            $t    = esc($title);
            $html = preg_replace('~<title>.*?</title>~s', '<title>' . $t . '</title>', $html, 1);
            $html = preg_replace('~(<meta (?:property="og:title"|name="twitter:title") content=")[^"]*~', '${1}' . str_replace('$', '\$', $t), $html);
        }
        if ($desc !== null && $desc !== '') {
            $d    = str_replace('$', '\$', esc($desc));
            $html = preg_replace('~(<meta (?:name="description"|property="og:description"|name="twitter:description") content=")[^"]*~', '${1}' . $d, $html);
        }

        return $html;
    }

    /** 원래 화면의 제목·설명 */
    public static function readMeta(string $html): array
    {
        preg_match('~<title>(.*?)</title>~s', $html, $t);
        preg_match('~<meta name="description" content="([^"]*)"~', $html, $d);

        return [
            'title' => html_entity_decode($t[1] ?? '', ENT_QUOTES, 'UTF-8'),
            'desc'  => html_entity_decode($d[1] ?? '', ENT_QUOTES, 'UTF-8'),
        ];
    }

    /** {{...}} 를 실제 값으로 */
    public static function fillTokens(string $html): string
    {
        if (strpos($html, '{{') === false) {
            return $html;
        }

        // 화면별 값 안에 다시 {{site.*}} 가 들어 있을 수 있으므로 먼저 바꾼다
        foreach (self::$tokens as $k => $v) {
            $html = str_replace('{{' . $k . '}}', htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'), $html);
        }

        $site = (new \App\Models\SettingModel())->all();

        return preg_replace_callback('~\{\{(site\.[\w]+|base|csrf)\}\}~', static function ($m) use ($site) {
            if ($m[1] === 'base') {
                return rtrim(base_url(), '/') . '/';
            }
            if ($m[1] === 'csrf') {
                return csrf_field();
            }

            return esc($site[substr($m[1], 5)] ?? '');
        }, $html);
    }

    /** 깊은 주소 화면에서 상대 경로(about.html, assets/..)를 사이트 기준 절대 경로로 */
    private static function absolutize(string $html): string
    {
        $base = rtrim(base_url(), '/') . '/';

        return preg_replace('~(\s(?:href|src|action)=")(?![a-zA-Z][a-zA-Z0-9+.-]*:|//|/|#|"|\{\{)~', '${1}' . $base, $html);
    }

    /** 회사 정보 → {{site.키}} (값이 빈 항목은 빈 값 그대로 — 화면의 '없으면 숨김' 이 그대로 동작하도록) */
    public static function siteTokens(): array
    {
        $out = [];
        foreach ((new \App\Models\SettingModel())->all() as $k => $v) {
            $out[$k] = $v === '' ? '' : '{{site.' . $k . '}}';
        }

        return $out;
    }

    // ------------------------------------------------------------------
    // 편집기 주입
    // ------------------------------------------------------------------

    private static function injectEditor(string $html, string $page, array $blocks, array $meta): string
    {
        // 사이트 스크립트(글자 쪼개기·스크롤 애니메이션)는 편집을 방해하므로 편집 중엔 끈다.
        $html = preg_replace('~<script\b[^>]*>.*?</script>~is', '', $html);

        $site   = (new \App\Models\SettingModel())->all();
        $tokens = [];
        foreach ($site as $k => $v) {
            $tokens['site.' . $k] = $v;
        }
        foreach (self::$tokens as $k => $v) {
            $tokens[$k] = str_replace('{{site.email}}', $site['email'] ?? '', (string) $v);
        }

        $model   = new PageBlockModel();
        $state   = $model->stateMap();
        $config  = [
            'page'      => $page,
            'base'      => rtrim(base_url(), '/') . '/',
            'csrfName'  => csrf_token(),
            'csrfHash'  => csrf_hash(),
            'csrfHeader'=> config('Security')->headerName,
            'urls'      => [
                'save'   => base_url('admin/editor/save'),
                'upload' => base_url('admin/editor/upload'),
                'reset'  => base_url('admin/editor/reset'),
            ],
            'tokens'    => $tokens,
            'state'     => $state,
            'meta'      => [
                'title'         => $blocks[$page . '/__title'] ?? $meta['title'],
                'desc'          => $blocks[$page . '/__desc'] ?? $meta['desc'],
                'originalTitle' => $meta['title'],
                'originalDesc'  => $meta['desc'],
            ],
        ];

        $v      = '?v=' . (@filemtime(FCPATH . 'js/editor.js') ?: '1');
        $inject = '<link rel="stylesheet" href="' . base_url('css/editor.css') . $v . '">' . "\n"
            . '<script>window.ED_CONFIG = ' . json_encode($config, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) . ';</script>' . "\n"
            . '<script src="' . base_url('js/editor.js') . $v . '"></script>' . "\n";

        $html = str_replace('<head>', "<head>\n<meta name=\"robots\" content=\"noindex\">", $html);

        return str_ireplace('</body>', $inject . '</body>', $html);
    }

    // ------------------------------------------------------------------
    // 저장 전 정리
    // ------------------------------------------------------------------

    /**
     * 편집기에서 받은 HTML 을 저장해도 안전한 모양으로 다듬는다.
     * 관리자만 쓰는 화면이지만 스크립트·이벤트 속성은 막아 둔다.
     */
    public static function clean(string $html): string
    {
        $html = preg_replace('~<script\b[^>]*>.*?</script>~is', '', $html);
        $html = preg_replace('~<script\b[^>]*>~i', '', $html);
        $html = preg_replace('~\son[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)~i', '', $html);
        $html = preg_replace('~(href|src|action)\s*=\s*"\s*javascript:[^"]*"~i', '$1="#"', $html);
        // 영역 표시가 섞여 들어오면 화면이 꼬이므로 지운다
        $html = preg_replace('~<!--/?ed:[^>]*-->~', '', $html);

        // 사이트 주소·보안 토큰은 {{base}} {{csrf}} 로 (서버 주소가 바뀌어도 맞게)
        $base = rtrim(base_url(), '/') . '/';
        $html = str_replace($base, '{{base}}', $html);
        $html = preg_replace('~<input type="hidden" name="' . preg_quote(csrf_token(), '~') . '" value="[^"]*"\s*/?>~', '{{csrf}}', $html);

        return trim($html);
    }

    // ------------------------------------------------------------------
    // 원래 화면(파일) 읽기 — 일괄 바꾸기·되돌리기에서 쓴다
    // ------------------------------------------------------------------

    /** 영역 키 => 화면 파일 경로 */
    public static function blockFiles(): array
    {
        static $map = null;
        if ($map !== null) {
            return $map;
        }
        $map = [];
        $dir = APPPATH . 'Views/site';
        $it  = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS));
        foreach ($it as $f) {
            if ($f->getExtension() !== 'php') {
                continue;
            }
            $src = file_get_contents($f->getPathname());
            if (preg_match_all(self::MARKER, $src, $mm)) {
                foreach ($mm[1] as $k) {
                    $map[$k] = $f->getPathname();
                }
            }
        }
        ksort($map);

        return $map;
    }

    /** 영역의 원래 내용(파일 기준)을 저장 형식으로 */
    public static function originalBlock(string $key): ?string
    {
        $file = self::blockFiles()[$key] ?? null;
        if ($file === null) {
            return null;
        }
        $src = file_get_contents($file);
        if (! preg_match('~<!--ed:' . preg_quote($key, '~') . '-->(.*?)<!--/ed:' . preg_quote($key, '~') . '-->~s', $src, $m)) {
            return null;
        }

        $renderer = service('renderer');
        $renderer->setData(['site' => self::siteTokens()], 'raw');
        $out = $renderer->renderString($m[1], ['saveData' => false], false);

        return self::clean($out);
    }

    /** 영역의 지금 내용 (임시 저장본 > 게시본 > 원래 파일) */
    public static function currentBlock(string $key, array $blocks): ?string
    {
        return array_key_exists($key, $blocks) ? $blocks[$key] : self::originalBlock($key);
    }

    /** 영역이 속한 화면 키 ('about/ceo' → 'about', '@ko/head' → '@ko') */
    public static function pageOf(string $key): string
    {
        return substr($key, 0, strrpos($key, '/'));
    }

    // ------------------------------------------------------------------
    // 글자 바꾸기 (태그 밖 글자 + alt/title 등 사람이 읽는 속성만)
    // ------------------------------------------------------------------

    public static function replaceText(string $html, string $find, string $repl, int &$count): string
    {
        $count = 0;
        if ($find === '') {
            return $html;
        }
        $fe = htmlspecialchars($find, ENT_NOQUOTES, 'UTF-8');
        $re = htmlspecialchars($repl, ENT_NOQUOTES, 'UTF-8');

        $parts = preg_split('~(<[^>]*>)~', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($parts as $i => $p) {
            if ($p === '') {
                continue;
            }
            if ($p[0] === '<') {
                $parts[$i] = preg_replace_callback('~(\s(?:alt|title|placeholder|aria-label)=")([^"]*)(")~', static function ($m) use ($fe, $re, &$count) {
                    $n = 0;
                    $v = str_replace($fe, $re, $m[2], $n);
                    $count += $n;

                    return $m[1] . $v . $m[3];
                }, $p);
            } else {
                $n         = 0;
                $parts[$i] = str_replace($fe, $re, $p, $n);
                $count += $n;
            }
        }

        return implode('', $parts);
    }
}
