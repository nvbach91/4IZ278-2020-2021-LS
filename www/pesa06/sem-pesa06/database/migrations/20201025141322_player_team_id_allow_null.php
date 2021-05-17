<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PlayerTeamIdAllowNull extends AbstractMigration
{
    public function up(){
        $this->table('player')->changeColumn('team_id', 'integer', ['null' => true])->save();
    }

    public function down(){
        $this->table('player')->changeColumn('team_id', 'integer')->save();
    }
}
