<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {
        $this->table('trash')
            ->addColumn('source', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('table_name', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('data', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    public function down()
    {
        $this->dropTable('trash');
    }
}
