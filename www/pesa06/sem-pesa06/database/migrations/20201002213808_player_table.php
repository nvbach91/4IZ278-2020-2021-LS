<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class PlayerTable extends AbstractMigration
{
    const TABLE_NAME = 'player';
    public function up(){
        $table = $this->table(self::TABLE_NAME);
        $table->addColumn('member_id', 'integer');
        $table->addColumn('team_id', 'integer');
        $table->addColumn('is_active', 'boolean');
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('created_by', 'string', ['limit' => 255]);
        $table->addColumn('modified_at', 'timestamp', ['null' => true]);
        $table->addColumn('modified_by', 'string', ['limit' => 255, 'null' => true]);
        $table->addForeignKey('member_id', 'member', 'id');
        $table->addForeignKey('team_id', 'team', 'id');
        $table->addIndex('id');
        $table->save();
    }

    public function down(){
        $table = $this->table(self::TABLE_NAME);
        $table->dropForeignKey('member_id')->dropForeignKey('team_id')->save();
        $table->drop()->save();
    }

}
