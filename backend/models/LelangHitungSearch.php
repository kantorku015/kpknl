<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LelangHitung;

/**
 * LelangHitungSearch represents the model behind the search form about `backend\models\LelangHitung`.
 */
class LelangHitungSearch extends LelangHitung
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'id_lelang'*/], 'integer'],
            [['bl_penjual', 'bl_pembeli', 'bl_batal', 'pph_final'], 'number'],
            [['tgl_bl_penjual', 'tgl_bl_pembeli', 'tgl_bl_batal', 'tgl_pph_final', 'id_lelang'], 'safe'],
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
        $query = LelangHitung::find();

        // add conditions that should always apply here
        $query->joinWith('idLelang');

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
            // 'id_lelang' => $this->id_lelang,
            'bl_penjual' => $this->bl_penjual,
            'tgl_bl_penjual' => $this->tgl_bl_penjual,
            'bl_pembeli' => $this->bl_pembeli,
            'tgl_bl_pembeli' => $this->tgl_bl_pembeli,
            'bl_batal' => $this->bl_batal,
            'tgl_bl_batal' => $this->tgl_bl_batal,
            'pph_final' => $this->pph_final,
            'tgl_pph_final' => $this->tgl_pph_final,
        ]);

        $query->andFilterWhere(['like', 'uraian_barang', $this->id_lelang]);

        return $dataProvider;
    }
}
