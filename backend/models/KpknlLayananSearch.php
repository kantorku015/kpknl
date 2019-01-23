<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KpknlLayanan;

/**
 * KpknlLayananSearch represents the model behind the search form about `backend\models\KpknlLayanan`.
 */
class KpknlLayananSearch extends KpknlLayanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'id_seksi'*/], 'integer'],
            [['ur_layanan','id_seksi'], 'safe'],
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
        $query = KpknlLayanan::find();

        // add conditions that should always apply here
        $query->joinWith('idSeksi');
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
            // 'id_seksi' => $this->id_seksi,
        ]);

        $query->andFilterWhere(['like', 'ur_layanan', $this->ur_layanan]);
        $query->andFilterWhere(['like', 'ur_seksi', $this->id_seksi]);

        return $dataProvider;
    }
}
