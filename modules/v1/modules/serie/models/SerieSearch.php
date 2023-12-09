<?php

namespace app\modules\v1\modules\serie\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\v1\modules\serie\models\Serie;

/**
 * SerieSearch represents the model behind the search form of `app\models\Serie`.
 */
class SerieSearch extends Serie
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'season', 'stream_id', 'total_price'], 'integer'],
            [['title', 'slug', 'kind', 'status', 'poster', 'first', 'last'], 'safe'],
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
        $query = Serie::find();

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
            'season' => $this->season,
            'stream_id' => $this->stream_id,
            'first' => $this->first,
            'last' => $this->last,
            'total_price' => $this->total_price,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'kind', $this->kind])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'poster', $this->poster]);

        return $dataProvider;
    }
}
