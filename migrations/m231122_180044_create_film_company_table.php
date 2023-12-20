<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%film_company}}`.
 */
class m231122_180044_create_film_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film_company}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer()->notNull()->unique(),
            'company_id' => $this->integer()->notNull()->unique(),
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx-film_company-film_id',
            'film_company',
            'film_id'
        );

        $this->createIndex(
            'idx-film_company-company_id',
            'film_company',
            'company_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-film_company-company_id', 'film_company');
        $this->dropIndex('idx-film_company-film_id', 'film_company');
        $this->dropTable('{{%film_company}}');
    }
}
