<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AlterTeamTable extends AbstractMigration
{
    public function up(){
        $table = $this->table('team');
        $table->removeColumn('born_from');
        $table->addColumn('age_under', 'integer');
        $table->save();
    }

    public function down(){
        $table = $this->table('team');
        $table->removeColumn('age_under');
        $table->addColumn('born_from', 'timestamp', ['null' => true]);
        $table->save();
    }
}
