<?php

namespace app\modules\v1\modules\genre\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 *
 * @property FilmGenre[] $filmGenres
 * @property Film[] $films
 * @property SerieGenre[] $serieGenres
 * @property Serie[] $series
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['title', 'slug'], 'string', 'max' => 30],
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
        ];
    }

    /**
     * Gets query for [[FilmGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmGenres()
    {
        return $this->hasMany(FilmGenre::class, ['genre_id' => 'id']);
    }

    /**
     * Gets query for [[Films]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasMany(Film::class, ['id' => 'film_id'])->viaTable('serie_genre', ['genre_id' => 'id']);
    }

    /**
     * Gets query for [[SerieGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSerieGenres()
    {
        return $this->hasMany(SerieGenre::class, ['genre_id' => 'id']);
    }

    /**
     * Gets query for [[Series]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeries()
    {
        return $this->hasMany(Serie::class, ['id' => 'serie_id'])->viaTable('film_genre', ['genre_id' => 'id']);
    }
}
