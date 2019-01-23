<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LemariPkn;

/**
 * LemariPknSearch represents the model behind the search form of `backend\models\LemariPkn`.
 */
class LemariPknSearch extends LemariPkn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_order'], 'integer'],
            [['ur_lemari'], 'safe'],
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
        $query = LemariPkn::find();

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
            'id_order' => $this->id_order,
        ]);

        $query->andFilterWhere(['like', 'ur_lemari', $this->ur_lemari]);

        return $dataProvider;
    }
}
