<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TmpChanges extends AbstractMigration
{
    public function up(){
        $this->table('staff')->dropForeignKey('team_id')->save();
        $this->table('staff')->removeColumn('position')->removeColumn('team_id')->save();

        $position = $this->table('position');
        $position->addColumn('name', 'string', ['null' => false, 'limit' => 255]);
        $position->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
        $position->addColumn('created_by', 'string', ['null' => false, 'limit' => 255]);
        $position->addIndex('id');
        $position->save();

        $values = [
            [
                'name' => 'ROLE_ADMIN',
                'created_by' => 'console'
            ],
        ];
        $position->insert($values)->save();

        $staffPosition = $this->table('staff_position_team');
        $staffPosition->addColumn('staff_id', 'integer', ['null' => false]);
        $staffPosition->addColumn('position_id', 'integer', ['null' => false]);
        $staffPosition->addColumn('team_id', 'integer', ['null' => true, 'default' => null]);
        $staffPosition->addForeignKey('staff_id', 'staff', 'id');
        $staffPosition->addForeignKey('position_id', 'position', 'id');
        $staffPosition->addForeignKey('team_id', 'team', 'id');
        $staffPosition->save();
    }

    public function down(){

    }
}
