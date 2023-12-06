<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "film".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $year
 * @property string $kind
 * @property int|null $chapter
 * @property string $poster
 * @property string $video
 * @property int|null $collection_id
 * @property int $price
 *
 * @property Collection $collection
 * @property Company[] $companies
 * @property Genre[] $genres
 * @property SerieCompany[] $serieCompanies
 * @property SerieGenre[] $serieGenres
 */
class Film extends \yii\db\ActiveRecord
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
            'year' => 'Year',
            'kind' => 'Kind',
            'chapter' => 'Chapter',
            'poster' => 'Poster',
            'video' => 'Video',
            'collection_id' => 'Collection ID',
            'price' => 'Price',
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
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::class, ['id' => 'company_id'])->viaTable('serie_company', ['film_id' => 'id']);
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::class, ['id' => 'genre_id'])->viaTable('serie_genre', ['film_id' => 'id']);
    }

    /**
     * Gets query for [[SerieCompanies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSerieCompanies()
    {
        return $this->hasMany(SerieCompany::class, ['film_id' => 'id']);
    }

    /**
     * Gets query for [[SerieGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSerieGenres()
    {
        return $this->hasMany(SerieGenre::class, ['film_id' => 'id']);
    }
}
