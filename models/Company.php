<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $logo
 * @property int|null $mother_id
 *
 * @property Company[] $companies
 * @property FilmCompany[] $filmCompanies
 * @property Film[] $films
 * @property Company $mother
 * @property SerieCompany[] $serieCompanies
 * @property Serie[] $series
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'logo'], 'required'],
            [['mother_id'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 30],
            [['logo'], 'string', 'max' => 1000],
            [['mother_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['mother_id' => 'id']],
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
            'mother_id' => 'Mother ID',
        ];
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(Company::class, ['mother_id' => 'id']);
    }

    /**
     * Gets query for [[FilmCompanies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmCompanies()
    {
        return $this->hasMany(FilmCompany::class, ['company_id' => 'id']);
    }

    /**
     * Gets query for [[Films]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasMany(Film::class, ['id' => 'film_id'])->viaTable('serie_company', ['company_id' => 'id']);
    }

    /**
     * Gets query for [[Mother]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMother()
    {
        return $this->hasOne(Company::class, ['id' => 'mother_id']);
    }

    /**
     * Gets query for [[SerieCompanies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSerieCompanies()
    {
        return $this->hasMany(SerieCompany::class, ['company_id' => 'id']);
    }

    /**
     * Gets query for [[Series]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeries()
    {
        return $this->hasMany(Serie::class, ['id' => 'serie_id'])->viaTable('film_company', ['company_id' => 'id']);
    }
}
