<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stream}}`.
 */
class m231122_134554_create_stream_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stream}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'slug' => $this->string(50)->notNull(),
            'logo' => $this->string(1000)->notNull(),
        ]);

        $this->createIndex(
            'idx-stream-slug',
            'stream',
            'slug'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-stream-slug', 'stream');
        $this->dropTable('{{%stream}}');
    }
}
