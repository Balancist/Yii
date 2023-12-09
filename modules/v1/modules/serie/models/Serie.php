<?php

namespace app\modules\v1\modules\serie\models;

use Yii;

/**
 * This is the model class for table "serie".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $kind
 * @property int $season
 * @property string $status
 * @property string $poster
 * @property int $stream_id
 * @property string $first
 * @property string $last
 * @property int $total_price
 *
 * @property Company[] $companies
 * @property Episode[] $episodes
 * @property FilmCompany[] $filmCompanies
 * @property FilmGenre[] $filmGenres
 * @property Genre[] $genres
 */
class Serie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'serie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'kind', 'season', 'status', 'poster', 'stream_id', 'first', 'last', 'total_price'], 'required'],
            [['kind', 'status'], 'string'],
            [['season', 'stream_id', 'total_price'], 'integer'],
            [['first', 'last'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 100],
            [['poster'], 'string', 'max' => 1000],
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
            'kind' => 'Kind',
            'season' => 'Season',
            'status' => 'Status',
            'poster' => 'Poster',
            'stream_id' => 'Stream ID',
            'first' => 'First',
            'last' => 'Last',
            'total_price' => 'Total Price',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::class, ['id' => 'company_id'])->viaTable('film_company', ['serie_id' => 'id']);
    }

    /**
     * Gets query for [[Episodes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEpisodes()
    {
        return $this->hasMany(Episode::class, ['serie_id' => 'id']);
    }

    /**
     * Gets query for [[FilmCompanies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmCompanies()
    {
        return $this->hasMany(FilmCompany::class, ['serie_id' => 'id']);
    }

    /**
     * Gets query for [[FilmGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmGenres()
    {
        return $this->hasMany(FilmGenre::class, ['serie_id' => 'id']);
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::class, ['id' => 'genre_id'])->viaTable('film_genre', ['serie_id' => 'id']);
    }
}
