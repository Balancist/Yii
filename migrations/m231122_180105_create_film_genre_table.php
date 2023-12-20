<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%film_genre}}`.
 */
class m231122_180105_create_film_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film_genre}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer()->notNull()->unique(),
            'genre_id' => $this->integer()->notNull()->unique(),
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx-film_genre-film_id',
            'film_genre',
            'film_id'
        );

        $this->createIndex(
            'idx-film_genre-genre_id',
            'film_genre',
            'genre_id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-film_genre-film_id', 'film_genre');
        $this->dropIndex('idx-film_genre-genre_id', 'film_genre');
        $this->dropTable('{{%film_genre}}');
    }
}
