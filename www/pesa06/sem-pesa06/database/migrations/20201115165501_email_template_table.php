<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class EmailTemplateTable extends AbstractMigration
{
    private const TABLE_NAME = 'email_template';
    public function up(){
        $table = $this->table(self::TABLE_NAME);
        $table->addColumn('title', 'string', ['limit' => 255]);
        $table->addColumn('value', 'text', );
        $table->addColumn('created_at', 'timestamp', ['default' => null]);
        $table->addColumn('created_by', 'string', ['limit' => 255]);
        $table->addColumn('modified_at', 'timestamp', ['null' => true]);
        $table->addColumn('modified_by', 'string', ['null' => true, 'limit' => 255]);
        $table->addIndex('id');
        $table->save();
    }

    public function down(){
        $this->table(self::TABLE_NAME)->drop()->save();
    }

}
