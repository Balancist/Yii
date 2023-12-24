<?php

namespace app\modules\v1\modules\film\models;

use Yii;
use app\modules\v1\modules\collection\models\Collection;
use app\modules\v1\modules\auth\models\User;

/**
 * This is the model class for table "film".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $poster
 * @property string $video
 * @property int $year
 * @property int|null $chapter
 * @property int|null $collection_id
 * @property int|null $price
 * @property string $kind
 * @property int $publisher
 *
 * @property Collection $collection
 * @property FilmCompany $filmCompany
 * @property FilmGenre $filmGenre
 * @property User $publisher0
 */
class Film extends \app\components\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'year', 'poster', 'video', 'price'], 'required'],
            [['year', 'chapter', 'collection_id', 'price'], 'integer'],
            ['year', 'integer', 'min' => 1950, 'max' => 2050],
            [['kind'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 50],
            [['poster', 'video'], 'string', 'max' => 1000],
            [['collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collection::class, 'targetAttribute' => ['collection_id' => 'id']],
            [['publisher'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['publisher' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'poster' => 'Poster',
            'video' => 'Video',
            'year' => 'Year',
            'chapter' => 'Chapter',
            'collection_id' => 'Collection ID',
            'price' => 'Price',
            'kind' => 'Kind',
            'publisher' => 'Publisher',
        ];
    }

    /**
     * Gets query for [[Collection]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::class, ['id' => 'collection_id']);
    }

    /**
     * Gets query for [[FilmCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmCompany()
    {
        return $this->hasOne(FilmCompany::class, ['film_id' => 'id']);
    }

    /**
     * Gets query for [[FilmGenre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmGenre()
    {
        return $this->hasOne(FilmGenre::class, ['film_id' => 'id']);
    }

    /**
     * Gets query for [[Publisher0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher0()
    {
        return $this->hasOne(User::class, ['id' => 'publisher']);
    }
}