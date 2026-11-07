<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * 화면 편집기에서 고친 영역.
 *
 *   html  NULL     → 홈페이지는 원래 화면 그대로
 *   draft NULL     → 임시 저장본 없음
 *   draft ''       → '원래대로 되돌리기'를 임시 저장한 상태 (게시하면 줄이 지워진다)
 */
class PageBlockModel extends Model
{
    protected $table         = 'page_blocks';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['block_key', 'html', 'draft', 'updated_by'];
    protected $useTimestamps = true;

    /**
     * 화면에 입힐 내용 [영역 이름 => HTML].
     *
     * @param bool $withDraft true 면 임시 저장본을 우선한다(편집기·미리보기).
     */
    public function map(bool $withDraft): array
    {
        static $cache = [];
        $ck = $withDraft ? 'd' : 'p';
        if (isset($cache[$ck])) {
            return $cache[$ck];
        }

        $out = [];
        foreach ($this->findAll() as $row) {
            $value = $row['html'];
            if ($withDraft && $row['draft'] !== null) {
                $value = $row['draft'] === '' ? null : $row['draft'];
            }
            if ($value !== null) {
                $out[$row['block_key']] = $value;
            }
        }

        return $cache[$ck] = $out;
    }

    /** 편집기에 보여줄 영역 상태 [영역 이름 => ['changed' => 원래와 다른지, 'draft' => 게시 대기 중인지]] */
    public function stateMap(): array
    {
        $out = [];
        foreach ($this->findAll() as $row) {
            $out[$row['block_key']] = [
                'changed' => $row['draft'] !== null ? $row['draft'] !== '' : $row['html'] !== null,
                'draft'   => $row['draft'] !== null,
            ];
        }

        return $out;
    }

    /** 임시 저장 ('' 를 넣으면 원래대로 되돌리기 예약) */
    public function saveDraft(string $key, string $html, string $by = ''): void
    {
        $row = $this->where('block_key', $key)->first();

        if ($row === null) {
            if ($html === '') {
                return; // 원래 화면 그대로인 영역을 되돌릴 필요는 없다
            }
            $this->insert(['block_key' => $key, 'draft' => $html, 'updated_by' => $by]);

            return;
        }

        // 게시본과 같아지면 임시 저장본을 지운다(게시 대기 목록이 깨끗하게 보이도록)
        $same = ($html === '' && $row['html'] === null) || ($html !== '' && $html === $row['html']);
        if ($same && $row['html'] === null) {
            $this->delete($row['id']);

            return;
        }

        $this->update($row['id'], ['draft' => $same ? null : $html, 'updated_by' => $by]);
    }

    /** 게시 대기 중인 영역 수 */
    public function countDrafts(): int
    {
        return $this->where('draft IS NOT NULL')->countAllResults();
    }

    /** 게시 대기 중인 영역 이름들 */
    public function draftKeys(): array
    {
        return array_column($this->select('block_key')->where('draft IS NOT NULL')->orderBy('block_key')->findAll(), 'block_key');
    }

    /** 임시 저장본을 모두 홈페이지에 반영 */
    public function publish(): int
    {
        $n = 0;
        foreach ($this->where('draft IS NOT NULL')->findAll() as $row) {
            if ($row['draft'] === '') {
                $this->delete($row['id']);
            } else {
                $this->update($row['id'], ['html' => $row['draft'], 'draft' => null]);
            }
            $n++;
        }

        return $n;
    }

    /** 임시 저장본을 모두 버린다 */
    public function discard(): void
    {
        $this->where('html IS NULL')->where('draft IS NOT NULL')->delete();
        $this->builder()->set('draft', null)->where('draft IS NOT NULL')->update();
    }

    /** 홈페이지에 나가고 있는 상태 전체 [영역 이름 => HTML] */
    public function publishedMap(): array
    {
        $out = [];
        foreach ($this->where('html IS NOT NULL')->findAll() as $row) {
            $out[$row['block_key']] = $row['html'];
        }

        return $out;
    }

    /**
     * 주어진 상태를 '임시 저장본'으로 깐다 (이력 되돌리기·가져오기).
     * 목록에 없는 영역은 원래대로 되돌리기로 예약한다. 게시는 관리자가 확인 후 한다.
     */
    public function stageSnapshot(array $snapshot, string $by = ''): void
    {
        foreach ($this->findAll() as $row) {
            if (! array_key_exists($row['block_key'], $snapshot)) {
                $this->saveDraft($row['block_key'], '', $by);
            }
        }
        foreach ($snapshot as $key => $html) {
            $this->saveDraft((string) $key, (string) $html, $by);
        }
    }
}
