<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Rekening;

/**
 * RekeningSearch represents the model behind the search form of `backend\models\Rekening`.
 */
class RekeningSearch extends Rekening
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['post_date', 'value_date', 'branch', 'journal_no', 'description'], 'safe'],
            [['debit', 'credit'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Rekening::find();

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
            'debit' => $this->debit,
            'credit' => $this->credit,
        ]);

        $query->andFilterWhere(['like', 'post_date', $this->post_date])
            ->andFilterWhere(['like', 'value_date', $this->value_date])
            ->andFilterWhere(['like', 'branch', $this->branch])
            ->andFilterWhere(['like', 'journal_no', $this->journal_no])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
