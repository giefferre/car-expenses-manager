<?php

use Phinx\Migration\AbstractMigration;

class Car extends AbstractMigration
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
        $cars = $this->table('cars');

        $cars
            ->addColumn('manufacturer', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('model', 'string', ['limit' => 255, 'null' => false])
            // https://it.wikipedia.org/wiki/Targhe_d'immatricolazione_italiane
            ->addColumn('plateNumber', 'string', ['limit' => 8, 'null' => false])
            ->addColumn('created', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
        ;

        $cars->addIndex(['plateNumber'], ['name' => 'plate']);

        $cars->create();
    }
}
