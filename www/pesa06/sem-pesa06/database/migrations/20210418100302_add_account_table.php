<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddAccountTable extends AbstractMigration
{
    public function up(){
        $acc = $this->table('account');
        $acc->addColumn('email', 'string', ['null' => false, 'limit' => 255]);
        $acc->addColumn('password', 'string', ['null' => false, 'limit' => 255]);
        $acc->addColumn('staff_id', 'integer', ['null' => true]);
        $acc->addColumn('is_active', 'boolean', ['default' => true]);
        $acc->addColumn('role', 'string', ['null' => false, 'limit' => 255]);
        $acc->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
        $acc->addColumn('created_by', 'string', ['null' => false, 'limit' => 255]);
        $acc->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => true]);
        $acc->addColumn('modified_by', 'string', ['null' => true, 'limit' => 255]);
        $acc->addForeignKey('staff_id', 'staff', 'id');
        $acc->save();
    }

    public function down(){
        $this->table('account')->dropForeignKey('staff_id')->save();
        $this->table('account')->drop()->save();
    }
}
