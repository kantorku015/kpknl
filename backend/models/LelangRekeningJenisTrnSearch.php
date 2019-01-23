<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LelangRekeningJenisTrn;

/**
 * LelangRekeningJenisTrnSearch represents the model behind the search form of `backend\models\LelangRekeningJenisTrn`.
 */
class LelangRekeningJenisTrnSearch extends LelangRekeningJenisTrn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jns_rek', 'm_k', 'ur_trn'], 'safe'],
            [['hak_negara'], 'integer'],
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
        $query = LelangRekeningJenisTrn::find();

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
            'hak_negara' => $this->hak_negara,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'jns_rek', $this->jns_rek])
            ->andFilterWhere(['like', 'm_k', $this->m_k])
            ->andFilterWhere(['like', 'ur_trn', $this->ur_trn]);

        return $dataProvider;
    }
}
