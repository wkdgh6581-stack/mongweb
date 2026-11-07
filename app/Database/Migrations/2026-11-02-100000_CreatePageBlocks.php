<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * 홈페이지 화면 편집기.
 *
 * page_blocks     화면 영역별로 고친 내용. html = 홈페이지에 나가는 것, draft = 임시 저장본.
 * page_revisions  '게시하기'를 누를 때마다 그 시점 전체 상태를 남겨 되돌릴 수 있게 한다.
 */
class CreatePageBlocks extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'block_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'comment'    => '영역 이름 (about/ceo, @ko/head …)',
            ],
            'html' => [
                'type'    => 'MEDIUMTEXT',
                'null'    => true,
                'comment' => '홈페이지에 나가는 내용. NULL 이면 원래 화면 그대로',
            ],
            'draft' => [
                'type'    => 'MEDIUMTEXT',
                'null'    => true,
                'comment' => '임시 저장본. NULL = 없음, 빈 문자열 = 원래대로 되돌리기 예약',
            ],
            'updated_by' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('block_key');
        $this->forge->createTable('page_blocks');

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'snapshot' => [
                'type'    => 'LONGTEXT',
                'comment' => '게시 직후의 전체 영역 {영역 이름: HTML} (JSON)',
            ],
            'note'       => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'admin_name' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('page_revisions');
    }

    public function down()
    {
        $this->forge->dropTable('page_revisions');
        $this->forge->dropTable('page_blocks');
    }
}
