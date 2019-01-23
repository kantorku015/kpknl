<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RekeningPenerimaan;

/**
 * RekeningPenerimaanSearch represents the model behind the search form of `backend\models\RekeningPenerimaan`.
 */
class RekeningPenerimaanSearch extends RekeningPenerimaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['post_date', 'value_date', 'branch', 'journal_no', 'description', 'jns_trn', 'no_dokumen', 'tgl', 'jam', 'keterangan'], 'safe'],
            [['debit', 'credit'], 'number'],
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
        $query = RekeningPenerimaan::find();

        // add conditions that should always apply here
        $query->joinWith('jnsTrn');

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
            'debit' => $this->debit,
            'credit' => $this->credit,
            'tgl' => $this->tgl,
            'jam' => $this->jam,
        ]);

        $query->andFilterWhere(['like', 'post_date', $this->post_date])
            ->andFilterWhere(['like', 'value_date', $this->value_date])
            ->andFilterWhere(['like', 'branch', $this->branch])
            ->andFilterWhere(['like', 'journal_no', $this->journal_no])
            ->andFilterWhere(['like', 'description', $this->description])
            // ->andFilterWhere(['like', 'jns_trn', $this->jns_trn])
            ->andFilterWhere(['like', 'no_dokumen', $this->no_dokumen])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        $query->andFilterWhere(['like', 'ur_trn', $this->jns_trn]);


        return $dataProvider;
    }
}
