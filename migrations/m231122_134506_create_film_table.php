<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\web\User;

class m231122_134506_create_film_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'slug' => $this->string(100)->notNull(),
            'poster' => $this->string(1000)->notNull(),
            'video' => $this->string(1000)->notNull(),
            'year' => $this->integer()->notNull(),
            'chapter' => $this->integer(),
            'collection_id' => $this->integer(),
            'price' => $this->integer()->defaultValue(0),
            'kind' => "ENUM('Animation', 'Anime', 'Live Action') NOT NULL",
            'publisher' => $this->integer()->notNull()
        ], 'ENGINE=InnoDB');

        $this->createIndex(
            'idx-film-collection_id',
            'film',
            'collection_id'
        );

        $this->createIndex(
            'idx-film-slug',
            'film',
            'slug'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-film-collection_id', 'film');
        $this->dropIndex('idx-film-slug', 'film');
        $this->dropTable('{{%film}}');
    }

    public static function enumItem($model, $attribute)
    {

        $attr = $attribute;

        self::resolveName($model, $attr);

        preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);

        foreach(explode(',', $matches[1]) as $value)

        {

            $value=str_replace("'",null,$value);

            $values[$value]=Yii::t('enumItem',$value);

        }

        

        return $values;

    }   
}
