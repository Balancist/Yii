<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%serie_genre}}`.
 */
class m231122_180116_create_serie_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%serie_genre}}', [
            'id' => $this->primaryKey(),
            'serie_id' => $this->integer()->notNull()->unique(),
            'genre_id' => $this->integer()->notNull()->unique(),
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx-serie_genre-serie_id',
            'serie_genre',
            'serie_id'
        );

        $this->createIndex(
            'idx-serie_genre-genre_id',
            'serie_genre',
            'genre_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-serie_genre-serie_id', 'serie_genre');
        $this->dropIndex('idx-serie_genre-genre_id', 'serie_genre');
        $this->dropTable('{{%serie_genre}}');
    }
}
