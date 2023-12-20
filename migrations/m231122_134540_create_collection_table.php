<?php

use yii\db\Migration;

class m231122_134540_create_collection_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%collection}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'slug' => $this->string(50)->notNull(),
            'chapter' => $this->integer()->notNull(),
            'status' => "ENUM('Finished', 'In Progress', 'In Publication', 'Undefined') NOT NULL"
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            '{{%idx-collection-slug}}',
            '{{%collection}}',
            'slug'
        );
    }

    public function safeDown()
    {
        $this->dropIndex('{{%idx-collection-slug}}', '{{%collection}}');
        $this->dropTable('{{%collection}}');
    }
}
