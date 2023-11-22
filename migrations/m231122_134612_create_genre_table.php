<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genre}}`.
 */
class m231122_134612_create_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%genre}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(30)->notNull(),
            'slug' => $this->string(30)->notNull(),
        ]);

        $this->createIndex(
            'idx-genre-slug',
            'genre',
            'slug'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-genre-slug', 'genre');
        $this->dropTable('{{%genre}}');
    }
}
