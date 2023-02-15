<?php

namespace siswa\controllers;

use Yii;
use common\models\Siswa;
use common\models\User;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

class BiodataController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $idLogIn = Yii::$app->user->identity->id;
        $getSiswa = Siswa::find()->where(['id_user' => $idLogIn])->one();
        return $this->render('index',[
            "data" => $getSiswa
        ]);
    }

    public function actionUpdate($nis)
    {
        $model = Siswa::find()->where(['nis' => $nis])->one();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

}
