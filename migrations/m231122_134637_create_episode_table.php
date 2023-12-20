<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%episode}}`.
 */
class m231122_134637_create_episode_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%episode}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(100)->notNull(),
            'video' => $this->string(1000)->notNull(),
            'price' => $this->integer()->defaultValue(0),
            'season' => $this->integer()->notNull(),
            'serie_id' => $this->integer()->notNull()
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx-episode-serie_id',
            'episode',
            'serie_id'
        );

        $this->createIndex(
            'idx-episode-slug',
            'episode',
            'slug'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-episode-serie_id', 'episode');
        $this->dropIndex('idx-episode-slug', 'episode');
        $this->dropTable('{{%episode}}');
    }
}
