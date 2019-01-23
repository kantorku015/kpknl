<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LelangSetorHbl;

/**
 * LelangSetorHblSearch represents the model behind the search form about `backend\models\LelangSetorHbl`.
 */
class LelangSetorHblSearch extends LelangSetorHbl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['sppb_no', 'sppb_tgl', 'surat_no', 'surat_tgl', 'surat_perihal', 'rek_tujuan_no', 'rek_tujuan_an', 'rek_tujuan_bank', 'penjual_alamat', 'cf'], 'safe'],
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
        $query = LelangSetorHbl::find();

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
            'sppb_tgl' => $this->sppb_tgl,
            'surat_tgl' => $this->surat_tgl,
        ]);

        $query->andFilterWhere(['like', 'sppb_no', $this->sppb_no])
            ->andFilterWhere(['like', 'surat_no', $this->surat_no])
            ->andFilterWhere(['like', 'surat_perihal', $this->surat_perihal])
            ->andFilterWhere(['like', 'rek_tujuan_no', $this->rek_tujuan_no])
            ->andFilterWhere(['like', 'rek_tujuan_an', $this->rek_tujuan_an])
            ->andFilterWhere(['like', 'rek_tujuan_bank', $this->rek_tujuan_bank])
            ->andFilterWhere(['like', 'penjual_alamat', $this->penjual_alamat])
            ->andFilterWhere(['like', 'cf', $this->cf]);

        return $dataProvider;
    }
}
