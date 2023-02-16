<?php

namespace guru\controllers;

use Yii;
use common\models\Kelas;
use common\models\Siswa;
use common\models\Guru;
use guru\models\SearchKelas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class WaliKelasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $idLogIn = Yii::$app->user->identity->id;
        $getSiswa = Guru::find()->where(['id_user' => $idLogIn])->one();

        $searchModel = new SearchKelas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['id_wali_kelas' => $getSiswa->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionListSiswa($id)
    {
        $request = Yii::$app->request;
        $model = Siswa::find()->where(['id_kelas' => $id])->all();

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Daftar Siswa",
                'content' => $this->renderAjax('list-siswa', [
                    'model' => $model
                ]),
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
            ];
        } else {
            return $this->render('list-siswa', [
                'model' => $model
            ]);
        }
    }

}
