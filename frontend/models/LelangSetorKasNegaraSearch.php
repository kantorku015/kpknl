<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\LelangSetorKasNegara;

/**
 * LelangSetorKasNegaraSearch represents the model behind the search form about `frontend\models\LelangSetorKasNegara`.
 */
class LelangSetorKasNegaraSearch extends LelangSetorKasNegara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tgl_bl_penjual', 'tgl_bl_pembeli', 'tgl_bl_batal', 'tgl_pph_final'], 'safe'],
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
        $query = LelangSetorKasNegara::find();

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
            'tgl_bl_penjual' => $this->tgl_bl_penjual,
            'tgl_bl_pembeli' => $this->tgl_bl_pembeli,
            'tgl_bl_batal' => $this->tgl_bl_batal,
            'tgl_pph_final' => $this->tgl_pph_final,
        ]);

        return $dataProvider;
    }
}
