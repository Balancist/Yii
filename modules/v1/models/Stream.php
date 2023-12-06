<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stream".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $logo
 */
class Stream extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stream';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'logo'], 'required'],
            [['name', 'slug'], 'string', 'max' => 30],
            [['logo'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'logo' => 'Logo',
        ];
    }
}
