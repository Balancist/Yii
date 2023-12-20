<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%serie_company}}`.
 */
class m231122_180126_create_serie_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%serie_company}}', [
            'id' => $this->primaryKey(),
            'serie_id' => $this->integer()->notNull()->unique(),
            'company_id' => $this->integer()->notNull()->unique(),
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx-serie_company-serie_id',
            'serie_company',
            'serie_id'
        );

        $this->createIndex(
            'idx-serie_company-company_id',
            'serie_company',
            'company_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-serie_company-serie_id', 'serie_company');
        $this->dropIndex('idx-serie_company-company_id', 'serie_company');
        $this->dropTable('{{%serie_company}}');
    }
}
