<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\LelangHeader;

/**
 * LelangHeaderSearch represents the model behind the search form about `frontend\models\LelangHeader`.
 */
class LelangHeaderSearch extends LelangHeader
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'stakeholder',*/ /*'progres',*/ 'pejabat'], 'integer'],
            [['tahun','uraian_barang', 'keterangan', 'no_rl', 'tgl_rl', 'tgl_pelunasan', 'stakeholder', 'progres'], 'safe'],
            [['hpl', 'jml_pelunasan'], 'number'],
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
        $query = LelangHeader::find();

        // add conditions that should always apply here
        $query->joinWith('stakeholder0');
        $query->joinWith('progres0');

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
            // 'stakeholder' => $this->stakeholder,
            // 'progres' => $this->progres,
            'tgl_rl' => $this->tgl_rl,
            'hpl' => $this->hpl,
            'pejabat' => $this->pejabat,
            'jml_pelunasan' => $this->jml_pelunasan,
            'tgl_pelunasan' => $this->tgl_pelunasan,
        ]);

        $query->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'uraian_barang', $this->uraian_barang])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'no_rl', $this->no_rl]);

        #tambahan
        $query->andFilterWhere(['like', 'nama', $this->stakeholder]);
        $query->andFilterWhere(['like', 'ur_status', $this->progres]);

        return $dataProvider;
    }
}
