<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LelangObyek;

/**
 * LelangObyekSearch represents the model behind the search form of `backend\models\LelangObyek`.
 */
class LelangObyekSearch extends LelangObyek
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'jenis_lelang', 'status_lelang', /*'id_pemenang',*/ 'id_setor_hbl', 'created_by', 'updated_by', 'kab_kota'], 'integer'],
            [['id_pemenang','pemohon_lelang', 'kode_lelang', 'obyek_lelang', 'obyek_lelang_sing', 'tempat_lelang', 'lot', 'balai_lelang', 'rl_no', 'batas_lunas', 'jurnal_rek', 'tgl_jurnal', 'kuitansi_no', 'kuitansi_abc', 'tgl_setor_hbl', 'tgl_setor_pnbp', 'billing_pnbp', 'billing_ssp', 'catatan', 'created_at', 'updated_at', 'letak_tanah_bangunan', 'status_tanah_bangunan', 'nama_debitur', 'alamat_debitur', 'npwp_debitur', 'nop','id_jenis'], 'safe'],
            [['rph_limit', 'rph_jaminan', 'rph_pokok', 'persen_penjual', 'persen_pembeli', 'persen_pph', 'rph_batal', 'rph_wanprestasi', 'rph_lunas', 'luas_tanah', 'luas_bangunan'], 'number'],
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
        $query = LelangObyek::find();

        // add conditions that should always apply here
        $query->joinWith('idPemenang');

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
            'jenis_lelang' => $this->jenis_lelang,
            'rph_limit' => $this->rph_limit,
            'rph_jaminan' => $this->rph_jaminan,
            'status_lelang' => $this->status_lelang,
            // 'id_pemenang' => $this->id_pemenang,
            'rph_pokok' => $this->rph_pokok,
            'persen_penjual' => $this->persen_penjual,
            'persen_pembeli' => $this->persen_pembeli,
            'persen_pph' => $this->persen_pph,
            'rph_batal' => $this->rph_batal,
            'rph_wanprestasi' => $this->rph_wanprestasi,
            'batas_lunas' => $this->batas_lunas,
            'rph_lunas' => $this->rph_lunas,
            'tgl_jurnal' => $this->tgl_jurnal,
            'tgl_setor_hbl' => $this->tgl_setor_hbl,
            'id_setor_hbl' => $this->id_setor_hbl,
            'tgl_setor_pnbp' => $this->tgl_setor_pnbp,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'luas_tanah' => $this->luas_tanah,
            'luas_bangunan' => $this->luas_bangunan,
            'kab_kota' => $this->kab_kota,
            'id_jenis' => $this->id_jenis,
        ]);

        $query->andFilterWhere(['like', 'pemohon_lelang', $this->pemohon_lelang])
            ->andFilterWhere(['like', 'kode_lelang', $this->kode_lelang])
            ->andFilterWhere(['like', 'obyek_lelang', $this->obyek_lelang])
            ->andFilterWhere(['like', 'obyek_lelang_sing', $this->obyek_lelang_sing])
            ->andFilterWhere(['like', 'tempat_lelang', $this->tempat_lelang])
            ->andFilterWhere(['like', 'lot', $this->lot])
            ->andFilterWhere(['like', 'balai_lelang', $this->balai_lelang])
            ->andFilterWhere(['like', 'rl_no', $this->rl_no])
            ->andFilterWhere(['like', 'jurnal_rek', $this->jurnal_rek])
            ->andFilterWhere(['like', 'kuitansi_no', $this->kuitansi_no])
            ->andFilterWhere(['like', 'kuitansi_abc', $this->kuitansi_abc])
            ->andFilterWhere(['like', 'billing_pnbp', $this->billing_pnbp])
            ->andFilterWhere(['like', 'billing_ssp', $this->billing_ssp])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'letak_tanah_bangunan', $this->letak_tanah_bangunan])
            ->andFilterWhere(['like', 'status_tanah_bangunan', $this->status_tanah_bangunan])
            ->andFilterWhere(['like', 'nama_debitur', $this->nama_debitur])
            ->andFilterWhere(['like', 'alamat_debitur', $this->alamat_debitur])
            ->andFilterWhere(['like', 'npwp_debitur', $this->npwp_debitur])
            ->andFilterWhere(['like', 'nop', $this->nop]);

        $query->andFilterWhere(['like', 'nama_pemenang', $this->id_pemenang]);

        return $dataProvider;
    }
}
