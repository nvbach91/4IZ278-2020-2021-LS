<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TeamAgeUnderAllowNull extends AbstractMigration
{
    public function up(){
        $this->table('team')->changeColumn('age_under', 'integer', ['null' => true])->save();
    }

    public function down(){
        $this->table('team')->changeColumn('age_under', 'integer')->save();
    }
}
