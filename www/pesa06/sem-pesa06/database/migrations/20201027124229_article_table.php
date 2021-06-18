<?php
declare(strict_types=1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class ArticleTable extends AbstractMigration
{
    const TABLE_NAME = 'article';
    public function up(){
        $table = $this->table(self::TABLE_NAME);
        $table->addColumn('team_id', 'integer', ['null' => true]);
        $table->addColumn('title', 'string', ['limit' => 255]);
        $table->addColumn('value', 'text', ['null' => false, 'limit' => MysqlAdapter::TEXT_LONG]);
        $table->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP']);
        $table->addColumn('created_by', 'string', ['limit' => 255]);
        $table->addColumn('modified_at', 'timestamp', ['null' => true]);
        $table->addColumn('modified_by', 'string', ['null' => true, 'limit' => 255]);
        $table->addForeignKey('team_id', 'team', 'id');
        $table->save();
    }

    public function down(){
        $this->table(self::TABLE_NAME)->dropForeignKey('team_id')->save();
        $this->table(self::TABLE_NAME)->drop()->save();
    }
}
