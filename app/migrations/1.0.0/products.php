<?php
declare(strict_types=1);

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Migrations\Mvc\Model\Migration;

class ProductsMigration_100 extends Migration
{
    public function morph()
    {
        $this->morphTable('products', [
            'columns' => [
                new Column('id', [
                    'type' => Column::TYPE_INTEGER,
                    'unsigned' => true,
                    'autoIncrement' => true,
                    'size' => 10,
                    'first' => true
                ]),
                new Column('product_types_id', [
                    'type' => Column::TYPE_INTEGER,
                    'unsigned' => true,
                    'notNull' => true,
                    'size' => 10,
                    'after' => 'id'
                ]),
                new Column('name', [
                    'type' => Column::TYPE_VARCHAR,
                    'notNull' => true,
                    'size' => 70,
                    'after' => 'product_types_id'
                ]),
                new Column('price', [
                    'type' => Column::TYPE_DECIMAL,
                    'notNUll' => true,
                    'size' => 16,
                    'scale' => 2,
                    'after' => 'name'
                ]),
                new Column('active', [
                    'type' => Column::TYPE_BOOLEAN,
                    'size' => 1,
                    'after' => 'price'
                ])
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => 8,
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8mb4_general_ci'
            ]
        ]);
    }

    public function up()
    {
        $this->batchInsert('products', [
            'id',
            'product_types_id',
            'name',
            'price',
            'active'
        ]);
    }

    public function down()
    {
        $this->batchDelete('products');
    }
}
