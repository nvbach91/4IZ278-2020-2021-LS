<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class MemberTable extends AbstractMigration
{
    const TABLE_NAME = 'member';
    public function up(){
        $table = $this->table(self::TABLE_NAME);
        $table->addColumn('first_name', 'string', ['limit' => 255]);
        $table->addColumn('last_name', 'string', ['limit' => 255]);
        $table->addColumn('facr_id', 'string', ['limit' => 255]);
        $table->addColumn('date_of_birth', 'timestamp');
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('created_by', 'string', ['limit' => 255]);
        $table->addColumn('modified_at', 'timestamp', ['null' => true]);
        $table->addColumn('modified_by', 'string', ['limit' => 255, 'null' => true]);
        $table->addIndex('id');
        $table->save();
    }

    public function down(){
        $this->table(self::TABLE_NAME)->drop()->save();
    }

}
