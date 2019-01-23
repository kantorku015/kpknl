<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Perkara;

/**
 * PerkaraSearch represents the model behind the search form about `frontend\models\Perkara`.
 */
class PerkaraSearch extends Perkara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','no_perkara', 'tempat', 'tahun', 'nama_penggugat', 'posisi_kpknl', 'no_box', 'ket', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
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
        $query = Perkara::find();

        // add conditions that should always apply here
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
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'no_perkara', $this->no_perkara])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'nama_penggugat', $this->nama_penggugat])
            ->andFilterWhere(['like', 'posisi_kpknl', $this->posisi_kpknl])
            ->andFilterWhere(['like', 'no_box', $this->no_box])
            ->andFilterWhere(['like', 'ket', $this->ket]);

        $query->andFilterWhere(['like', 'ur_status', $this->status]);

        return $dataProvider;
    }
}
