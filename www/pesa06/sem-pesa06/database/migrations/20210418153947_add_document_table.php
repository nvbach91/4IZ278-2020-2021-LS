<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddDocumentTable extends AbstractMigration
{
    public function up(){
        $document = $this->table('document');
        $document->addColumn('member_id', 'integer', ['null' => false]);
        $document->addColumn('type', 'string', ['null' => false, 'limit' => 255]);
        $document->addColumn('amount', 'float', ['null' => false]);
        $document->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP']);
        $document->addColumn('created_by', 'string', ['null' => false, 'limit' => 255]);
        $document->addForeignKey('member_id', 'member', 'id');
        $document->save();
    }

    public function down(){
        $this->table('document')->dropForeignKey('member_id')->save();
        $this->table('document')->drop()->save();
    }
}
