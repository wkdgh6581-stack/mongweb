<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * 게시 이력. '게시하기'를 누를 때마다 그 시점 홈페이지 상태 전체를 남긴다.
 */
class PageRevisionModel extends Model
{
    protected $table         = 'page_revisions';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['snapshot', 'note', 'admin_name'];
    protected $useTimestamps = true;

    /** 이력은 최근 50개까지만 둔다 */
    public const KEEP = 50;

    public function record(array $snapshot, string $note, string $by): void
    {
        $this->insert([
            'snapshot'   => json_encode($snapshot, JSON_UNESCAPED_UNICODE),
            'note'       => mb_substr($note, 0, 200),
            'admin_name' => $by,
        ]);

        $old = $this->select('id')->orderBy('id', 'DESC')->findAll(1000, self::KEEP);
        if ($old) {
            $this->whereIn('id', array_column($old, 'id'))->delete();
        }
    }
}
