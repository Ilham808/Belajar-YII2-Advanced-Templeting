<?php

namespace guru\controllers;

use Yii;
use common\models\Kelas;
use guru\models\SearchKelas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class KelasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new SearchKelas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
