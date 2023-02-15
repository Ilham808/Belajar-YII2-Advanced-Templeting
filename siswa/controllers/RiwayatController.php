<?php

namespace siswa\controllers;

use Yii;
use common\models\Siswa;
use common\models\SiswaRwKelas;
use common\models\Kelas;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class RiwayatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $idLogIn = Yii::$app->user->identity->id;
        $getSiswa = Siswa::find()->where(['id_user' => $idLogIn])->one();
        $getRw = SiswaRwKelas::find()->where(['id_siswa' => $getSiswa->id])->all();

        return $this->render('index',[
            "data" => $getRw
        ]);
    }

}
