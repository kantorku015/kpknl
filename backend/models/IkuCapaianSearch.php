<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IkuCapaian;

/**
 * IkuCapaianSearch represents the model behind the search form of `backend\models\IkuCapaian`.
 */
class IkuCapaianSearch extends IkuCapaian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pic'], 'integer'],
            [['capaian_q1', 'capaian_q2', 'capaian_q3', 'capaian_q4'], 'number'],
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
        $query = IkuCapaian::find();

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
            'id_pic' => $this->id_pic,
            'capaian_q1' => $this->capaian_q1,
            'capaian_q2' => $this->capaian_q2,
            'capaian_q3' => $this->capaian_q3,
            'capaian_q4' => $this->capaian_q4,
        ]);

        return $dataProvider;
    }
}
