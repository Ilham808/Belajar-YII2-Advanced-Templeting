<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MataPelajaran;

/**
 * SearchMataPelajaran represents the model behind the search form about `common\models\MataPelajaran`.
 */
class SearchMataPelajaran extends MataPelajaran
{
    /** 
     * @inheritdoc
     */
    public $jurusan;
    public $tingkat_kelas;

    public function rules()
    {
        return [
            [['id', 'id_tingkat_kelas', 'id_jurusan'], 'integer'],
            [['mata_pelajaran', 'jurusan', 'tingkat_kelas'], 'safe'],
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
        $query = MataPelajaran::find()
        ->leftJoin('ref_tingkat_kelas', 'ref_tingkat_kelas.id = mata_pelajaran.id_tingkat_kelas')
        ->leftJoin('ref_jurusan', 'ref_jurusan.id = mata_pelajaran.id_jurusan');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_tingkat_kelas' => $this->id_tingkat_kelas,
            'id_jurusan' => $this->id_jurusan,
            'jurusan' => $this->jurusan,
            'tingkat_kelas' => $this->tingkat_kelas,
        ]);

        $query->andFilterWhere(['like', 'mata_pelajaran.mata_pelajaran', $this->mata_pelajaran]);
        $query->andFilterWhere(['like', 'ref_jurusan.jurusan', $this->jurusan]);
        $query->andFilterWhere(['like', 'ref_tingkat_kelas.tingkat_kelas', $this->tingkat_kelas]);

        return $dataProvider;
    }
}
