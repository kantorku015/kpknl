<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Bkpn;

/**
 * BkpnSearch represents the model behind the search form about `backend\models\Bkpn`.
 */
class BkpnSearch extends Bkpn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','nrpn', 'ph_nama', 'pp_nama', 'keterangan', 'created_at', 'updated_at'], 'safe'],
            [['nilai_penyerahan'], 'number'],
            [[/*'status'*/'no_box', 'created_by', 'updated_by'], 'integer'],
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
        $query = Bkpn::find();

        // add conditions that should always apply here
        $query->joinWith('status0');

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
            'nilai_penyerahan' => $this->nilai_penyerahan,
            // 'status' => $this->status,
            'no_box' => $this->no_box,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nrpn', $this->nrpn])
            ->andFilterWhere(['like', 'ph_nama', $this->ph_nama])
            ->andFilterWhere(['like', 'pp_nama', $this->pp_nama])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        $query->andFilterWhere(['like', 'ur_status', $this->status]);

        return $dataProvider;
    }
}
