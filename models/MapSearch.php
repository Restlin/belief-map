<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Map;

/**
 * MapSearch represents the model behind the search form of `app\models\Map`.
 */
class MapSearch extends Map
{
    public $companyId;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'size', 'companyId'], 'integer'],
            [['name', 'question1_text', 'question2_text'], 'safe'],
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
        $query = Map::find();

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
        
        if($this->companyId) {
            $query->joinWith('mapCompanies mc', false);
            $query->andWhere(['mc.company_id' => $this->companyId]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['ilike', 'name', $this->name])
            ->andFilterWhere(['ilike', 'question1_text', $this->question1_text])
            ->andFilterWhere(['ilike', 'question2_text', $this->question2_text]);

        return $dataProvider;
    }
}
