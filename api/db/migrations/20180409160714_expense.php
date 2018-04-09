<?php

use Phinx\Migration\AbstractMigration;

class Expense extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $expenses = $this->table('expenses');

        $expenses
            ->addColumn('car_id', 'integer', ['null' => false])
            ->addColumn('amount', 'float', ['null' => false])
            ->addColumn('type', 'string', ['null' => true])
            ->addColumn('reason', 'text', ['null' => false])
            ->addColumn('date', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('created', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
        ;

        $expenses->addIndex(['car_id'], ['name' => 'car']);

        $expenses->create();
    }
}
