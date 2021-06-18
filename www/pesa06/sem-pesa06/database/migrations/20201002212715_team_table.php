<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TeamTable extends AbstractMigration
{
    const TABLE_NAME = 'team';
    public function up(){
        $table = $this->table(self::TABLE_NAME);
        $table->addColumn('name', 'string', ['limit' => 255]);
        $table->addColumn('competition', 'string', ['limit' => 255]);
        $table->addColumn('is_youth', 'boolean');
        $table->addColumn('born_from', 'timestamp', ['null' => true]);
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
