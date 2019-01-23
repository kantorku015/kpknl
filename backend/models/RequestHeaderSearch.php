<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RequestHeader;

/**
 * RequestHeaderSearch represents the model behind the search form about `backend\models\RequestHeader`.
 */
class RequestHeaderSearch extends RequestHeader
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'id_layanan',*/ 'created_by', 'updated_by'], 'integer'],
            [['no_dokumen', 'tgl_dok', 'tgl_terima', 'ticket_code', 'keterangan', 'created_at', 'updated_at', 'id_layanan', 'id_stakeholder'], 'safe'],
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
        $query = RequestHeader::find();

        // add conditions that should always apply here
        $query->joinWith('layanan');
        $query->joinWith('stakeholder');
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
            'tgl_dok' => $this->tgl_dok,
            // 'id_layanan' => $this->id_layanan,
            'tgl_terima' => $this->tgl_terima,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'no_dokumen', $this->no_dokumen])
            ->andFilterWhere(['like', 'ticket_code', $this->ticket_code])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'ur_layanan', $this->id_layanan])
            ->andFilterWhere(['like', 'nama', $this->id_stakeholder]);

        return $dataProvider;
    }
}
