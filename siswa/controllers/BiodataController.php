<?php

namespace siswa\controllers;

use Yii;
use common\models\Siswa;
use common\models\User;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use \yii\web\Response;
use yii\helpers\Html;

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

    // public function actionUpdate($nis)
    // {
    //     $model = Siswa::find()->where(['nis' => $nis])->one();

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect('index');
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionUpdate($nis)
    { 
        $request = Yii::$app->request;
        $model = Siswa::find()->where(['nis' => $nis])->one();
        
        if($request->isAjax){

            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Edit Biodata",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($model->load($this->request->post()) && $model->save()){
                return [
                    'forceReload'=>'#tableBiodata',
                    'forceClose' => true
                ];  
            }else{           
                return [
                    'title'=> "Edit Biodata",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];        
            }
        }else{
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model
                ]);
            }
        }

    }

}
