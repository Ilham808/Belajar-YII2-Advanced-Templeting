<?php

namespace siswa\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SiswaWali;
use common\models\Siswa;

/**
 * SearchSiswaWali represents the model behind the search form about `common\models\SiswaWali`.
 */
class SearchSiswaWali extends SiswaWali
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_siswa', 'id_wali'], 'integer'],
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
        $getSiswa = Siswa::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $query = SiswaWali::find()->where(['id_siswa' => $getSiswa->id]);

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
            'id_siswa' => $this->id_siswa,
            'id_wali' => $this->id_wali,
        ]);

        return $dataProvider;
    }
}
