<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LelangRisalah;

/**
 * LelangRisalahSearch represents the model behind the search form about `backend\models\LelangRisalah`.
 */
class LelangRisalahSearch extends LelangRisalah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'id_pl'*/], 'integer'],
            [['rl_no', 'rl_tgl', 'sppl_no', 'sppl_tgl', 'id_pl'], 'safe'],
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
        $query = LelangRisalah::find();

        // add conditions that should always apply here
        $query->joinWith('idPl');

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
            'rl_tgl' => $this->rl_tgl,
            // 'id_pl' => $this->id_pl,
            'sppl_tgl' => $this->sppl_tgl,
        ]);

        $query->andFilterWhere(['like', 'rl_no', $this->rl_no])
            ->andFilterWhere(['like', 'sppl_no', $this->sppl_no]);

        $query->andFilterWhere(['like', 'nama', $this->id_pl]);

        return $dataProvider;
    }
}
