<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "episode".
 *
 * @property int $id
 * @property string $slug
 * @property string $video
 * @property int $serie_id
 * @property int $price
 * @property int $season
 *
 * @property Serie $serie
 */
class Episode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'episode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'video', 'serie_id', 'price', 'season'], 'required'],
            [['serie_id', 'price', 'season'], 'integer'],
            [['slug'], 'string', 'max' => 50],
            [['video'], 'string', 'max' => 1000],
            [['serie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Serie::class, 'targetAttribute' => ['serie_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'video' => 'Video',
            'serie_id' => 'Serie ID',
            'price' => 'Price',
            'season' => 'Season',
        ];
    }

    /**
     * Gets query for [[Serie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSerie()
    {
        return $this->hasOne(Serie::class, ['id' => 'serie_id']);
    }
}
