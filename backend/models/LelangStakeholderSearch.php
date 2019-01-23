<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LelangStakeholder;

/**
 * LelangStakeholderSearch represents the model behind the search form about `backend\models\LelangStakeholder`.
 */
class LelangStakeholderSearch extends LelangStakeholder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nama', 'no_id', 'alamat1', 'alamat2', 'telp', 'kuasa_dari', 'pekerjaan', 'keterangan'], 'safe'],
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
        $query = LelangStakeholder::find();

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
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_id', $this->no_id])
            ->andFilterWhere(['like', 'alamat1', $this->alamat1])
            ->andFilterWhere(['like', 'alamat2', $this->alamat2])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'kuasa_dari', $this->kuasa_dari])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
