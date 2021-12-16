<?php
declare(strict_types=1);

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class UsersMigration_100
 */
class ContactMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('contact', [
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
                ]),
                new Column('email', [
                    'type' => Column::TYPE_VARCHAR,
                    'notNull' => true,
                    'size' => 70,
                    'after' => 'name'
                ]),
                new Column('comments', [
                    'type' => Column::TYPE_TEXT,
                    'notNull' => true,
                    'size' => 1,
                    'after' => 'email'
                ]),
                new Column('created_at', [
                    'type' => Column::TYPE_TIMESTAMP,
                    'default' => 'CURRENT_TIMESTAMP(1)',
                    'notNull' => true,
                    'size' => 1,
                    'after' => 'comments'
                ])
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => 1,
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
    public function up(): void
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {

    }
}
