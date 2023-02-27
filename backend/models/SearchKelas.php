<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Kelas;

/**
 * SearchKelas represents the model behind the search form about `common\models\Kelas`.
 */
class SearchKelas extends Kelas
{
    /**
     * @inheritdoc
     */
    public $tahun_ajaran;
    public $tingkat_kelas;
    public $nama_guru;
    public $jurusan;

    public function rules()
    {
        return [
            [['id', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas', 'id_jurusan'], 'integer'],
            [['nama_kelas', 'tahun_ajaran', 'tingkat_kelas','nama_guru','jurusan'], 'safe'],
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
        $query = Kelas::find()
        ->leftJoin('ref_tahun_ajaran', 'ref_tahun_ajaran.id = kelas.id_tahun_ajaran')
        ->leftJoin('ref_tingkat_kelas', 'ref_tingkat_kelas.id = kelas.id_tingkat')
        ->leftJoin('guru', 'guru.id = kelas.id_wali_kelas')
        ->leftJoin('ref_jurusan', 'ref_jurusan.id = kelas.id_jurusan');

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
            'id_tahun_ajaran' => $this->id_tahun_ajaran,
            'id_tingkat' => $this->id_tingkat,
            'id_wali_kelas' => $this->id_wali_kelas,
            'id_jurusan' => $this->id_jurusan,
        ]);

        $query->andFilterWhere(['like', 'nama_kelas', $this->nama_kelas]);
        $query->andFilterWhere(['like', 'tahun_ajaran', $this->tahun_ajaran]);
        $query->andFilterWhere(['like', 'tingkat_kelas', $this->tingkat_kelas]);
        $query->andFilterWhere(['like', 'nama_guru', $this->nama_guru]);
        $query->andFilterWhere(['like', 'jurusan', $this->jurusan]);

        return $dataProvider;
    }
}
