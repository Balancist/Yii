<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%serie}}`.
 */
class m231122_134521_create_serie_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%serie}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'slug' => $this->string(100)->notNull(),
            'poster' => $this->string(1000)->notNull(),
            'season' => $this->integer()->notNull(),
            'stream_id' => $this->integer(),
            'total_price' => $this->integer()->defaultValue(0),
            'first' => $this->dateTime()->notNull(),
            'last' => $this->dateTime()->notNull(),
            'kind' => "ENUM('Animation', 'Anime', 'Live Action') NOT NULL",
            'status' => "ENUM('Finished', 'In Progress', 'In Publication', 'Undefined') NOT NULL"
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx-serie-stream_id',
            'serie',
            'stream_id'
        );

        $this->createIndex(
            'idx-serie-slug',
            'serie',
            'slug'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-serie-stream_id', 'serie');
        $this->dropIndex('idx-serie-slug', 'serie');
        $this->dropTable('{{%serie}}');
    }
}
