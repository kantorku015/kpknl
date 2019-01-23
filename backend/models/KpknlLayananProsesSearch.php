<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KpknlLayananProses;

/**
 * KpknlLayananProsesSearch represents the model behind the search form about `backend\models\KpknlLayananProses`.
 */
class KpknlLayananProsesSearch extends KpknlLayananProses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'id_layanan'*/], 'integer'],
            [['ur_proses','id_layanan', 'id_seksi'], 'safe'],
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
        $query = KpknlLayananProses::find();

        // add conditions that should always apply here
        $query->joinWith('idLayanan');
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
            // 'id_layanan' => $this->id_layanan,
        ]);

        $query->andFilterWhere(['like', 'ur_proses', $this->ur_proses]);
        $query->andFilterWhere(['like', 'ur_layanan', $this->id_layanan]);
        $query->andFilterWhere(['like', 'ur_seksi', $this->id_seksi]);

        return $dataProvider;
    }
}
