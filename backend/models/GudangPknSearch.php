<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GudangPkn;

/**
 * GudangPknSearch represents the model behind the search form of `backend\models\GudangPkn`.
 */
class GudangPknSearch extends GudangPkn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', /*'id_lemari', 'id_satker'*/], 'integer'],
            [['id_lemari', 'id_satker','isi_berkas'], 'safe'],
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
        $query = GudangPkn::find();

        // add conditions that should always apply here
        $query->joinWith('lemari');
        $query->joinWith('satker');

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
            // 'id_lemari' => $this->id_lemari,
            // 'id_satker' => $this->id_satker,
        ]);

        $query->andFilterWhere(['like', 'isi_berkas', $this->isi_berkas]);

        $query->andFilterWhere(['like', 'ur_lemari', $this->id_lemari]);
        $query->andFilterWhere(['like', 'ur_satker', $this->id_satker]);

        return $dataProvider;
    }
}
