<?php
declare(strict_types=1);

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Migrations\Mvc\Model\Migration;

class ProductTypesMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('product_types', [
            'columns' => [
                new Column('id', [
                    'type' => Column::TYPE_INTEGER,
                    'unsigned' => true,
                    'notNull' => true,
                    'autoIncrement' => true,
                    'size' => 10,
                    'first' => true
                ]),
                new Column('name', [
                    'type' => Column::TYPE_VARCHAR,
                    'notNull' => true,
                    'size' => 70,
                    'after' => 'id'
                ])
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '3',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8mb4_general_ci'
            ]
        ]);
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        $this->batchInsert('product_types', ['id', 'name']);
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        $this->batchDelete('product_types');
    }
}
