<?php

namespace guru\controllers;

use Yii;
use common\models\Kelas;
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
        return $this->render('index');
    }

}
