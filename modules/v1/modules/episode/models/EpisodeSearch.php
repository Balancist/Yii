<?php

namespace app\modules\v1\modules\episode\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\v1\modules\episode\models\Episode;

/**
 * EpisodeSearch represents the model behind the search form of `app\models\Episode`.
 */
class EpisodeSearch extends Episode
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'serie_id', 'price', 'season'], 'integer'],
            [['slug', 'video'], 'safe'],
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
        $query = Episode::find();

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
            'serie_id' => $this->serie_id,
            'price' => $this->price,
            'season' => $this->season,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'video', $this->video]);

        return $dataProvider;
    }
}
