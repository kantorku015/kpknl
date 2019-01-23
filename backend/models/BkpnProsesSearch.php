<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BkpnProses;

/**
 * BkpnProsesSearch represents the model behind the search form of `backend\models\BkpnProses`.
 */
class BkpnProsesSearch extends BkpnProses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_proses'], 'integer'],
            [['nrpn', 'tgl_proses', 'keterangan'], 'safe'],
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
        $query = BkpnProses::find();

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
            'id_proses' => $this->id_proses,
            'tgl_proses' => $this->tgl_proses,
        ]);

        $query->andFilterWhere(['like', 'nrpn', $this->nrpn])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
