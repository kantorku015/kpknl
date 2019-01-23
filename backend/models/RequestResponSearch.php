<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RequestRespon;

/**
 * RequestResponSearch represents the model behind the search form of `backend\models\RequestRespon`.
 */
class RequestResponSearch extends RequestRespon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_respon'], 'integer'],
            [['ticket_code', 'comment', 'tgl_respon'], 'safe'],
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
        $query = RequestRespon::find();

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
            'id_respon' => $this->id_respon,
            'tgl_respon' => $this->tgl_respon,
        ]);

        $query->andFilterWhere(['like', 'ticket_code', $this->ticket_code])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
