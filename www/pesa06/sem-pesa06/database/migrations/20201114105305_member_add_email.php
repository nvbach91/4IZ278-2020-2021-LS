<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MemberAddEmail extends AbstractMigration
{
    public function up(){
        $this->table('member')->addColumn('email', 'string', ['limit' => 255, 'null' => true, 'default' => null])->save();
    }

    public function down(){
        $this->table('member')->removeColumn('email')->save();
    }
}
