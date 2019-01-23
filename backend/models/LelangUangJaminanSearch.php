<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LelangUangJaminan;

/**
 * LelangUangJaminanSearch represents the model behind the search form about `backend\models\LelangUangJaminan`.
 */
class LelangUangJaminanSearch extends LelangUangJaminan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'id_lelang',*/ /*'peserta',*/ /*'status'*/], 'integer'],
            [['jml_jaminan'], 'number'],
            [['tgl_setor', 'tempat_setor', 'tgl_kembali', 'tempat_kembali', 'id_lelang', 'peserta', 'status'], 'safe'],
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
        $query = LelangUangJaminan::find();

        // add conditions that should always apply here
        $query->joinWith('idLelang');
        $query->joinWith('peserta0');
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
            'id' => $this->id,
            // 'id_lelang' => $this->id_lelang,
            // 'peserta' => $this->peserta,
            'jml_jaminan' => $this->jml_jaminan,
            // 'status' => $this->status,
            'tgl_setor' => $this->tgl_setor,
            'tgl_kembali' => $this->tgl_kembali,
        ]);

        $query->andFilterWhere(['like', 'tempat_setor', $this->tempat_setor])
            ->andFilterWhere(['like', 'tempat_kembali', $this->tempat_kembali]);

        $query->andFilterWhere(['like', 'uraian_barang', $this->id_lelang]);
        $query->andFilterWhere(['like', 'nama', $this->peserta]);
        $query->andFilterWhere(['like', 'ur_status', $this->status]);

        return $dataProvider;
    }
}
