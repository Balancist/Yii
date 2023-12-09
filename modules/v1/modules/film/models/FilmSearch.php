<?php

namespace app\modules\v1\modules\film\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\v1\modules\film\models\Film;

/**
 * FilmSearch represents the model behind the search form of `app\models\Film`.
 */
class FilmSearch extends Film
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year', 'chapter', 'collection_id', 'price'], 'integer'],
            [['title', 'slug', 'kind', 'poster', 'video'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Film::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'chapter' => $this->chapter,
            'collection_id' => $this->collection_id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'kind', $this->kind])
            ->andFilterWhere(['like', 'poster', $this->poster])
            ->andFilterWhere(['like', 'video', $this->video]);

        return $dataProvider;
    }
}
