<?php

use yii\db\Migration;

class m231122_073641_create_company_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'slug' => $this->string(50)->notNull(),
            'logo' => $this->string(1000)->notNull(),
            'mother_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-company-mother_id',
            'company',
            'mother_id'
        );

        $this->createIndex(
            'idx-company-slug',
            'company',
            'slug'
        );
    }

    public function safeDown()
    {
        $this->dropIndex('idx-company-mother_id', 'company');
        $this->dropIndex('idx-company-slug', 'company');
        $this->dropTable('company');
    }
}