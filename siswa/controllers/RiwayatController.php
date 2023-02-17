<?php

namespace siswa\controllers;

use Yii;
use common\models\Siswa;
use common\models\SiswaRwKelas;
use siswa\models\SearchRiwayatKelas;
use common\models\Kelas;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class RiwayatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new SearchRiwayatKelas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        // $idLogIn = Yii::$app->user->identity->id;
        // $getSiswa = Siswa::find()->where(['id_user' => $idLogIn])->one();
        // $getRw = SiswaRwKelas::find()->where(['id_siswa' => $getSiswa->id])->orderBy('id DESC')->all();
        // return $this->render('index',[
        //     "data" => $getRw
        // ]);
    }

}
