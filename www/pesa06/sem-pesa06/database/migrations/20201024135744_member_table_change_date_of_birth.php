<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MemberTableChangeDateOfBirth extends AbstractMigration
{
    public function up(){
        $this->table('member')->removeColumn('date_of_birth')->addColumn('year_of_birth', 'integer')->save();
    }

    public function down(){
        $this->table('member')->removeColumn('year_of_birth')->addColumn('date_of_birth', 'datetime')->save();
    }
}
