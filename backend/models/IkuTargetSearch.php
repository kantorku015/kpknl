<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\IkuTarget;

/**
 * IkuTargetSearch represents the model behind the search form of `backend\models\IkuTarget`.
 */
class IkuTargetSearch extends IkuTarget
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pic'], 'integer'],
            [['target_q1', 'target_q2', 'target_q3', 'target_q4'], 'number'],
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
        $query = IkuTarget::find();

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
            'target_q1' => $this->target_q1,
            'target_q2' => $this->target_q2,
            'target_q3' => $this->target_q3,
            'target_q4' => $this->target_q4,
        ]);

        return $dataProvider;
    }
}
