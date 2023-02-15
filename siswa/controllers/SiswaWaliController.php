<?php

namespace siswa\controllers;

use Yii;
use common\models\SiswaWali;
use common\models\Wali;
use common\models\Siswa;
use common\models\RefStatusWali;
use siswa\models\SearchSiswaWali;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * SiswaWaliController implements the CRUD actions for SiswaWali model.
 */
class SiswaWaliController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SiswaWali models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SearchSiswaWali();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single SiswaWali model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "SiswaWali ",
                'content'=>$this->renderAjax('view', [
                    'model' => Wali::find()->where(['id' => $id])->one(),
                ]),
                'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                Html::a('Ubah',['update','id' => $id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];    
        }else{
            return $this->render('view', [
                'model' => Wali::find()->where(['id' => $id])->one(),
            ]);
        }
    }

    /**
     * Creates a new SiswaWali model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Wali();
        $statusWali = RefStatusWali::find()->all();  

        $idLogIn = Yii::$app->user->identity->id;
        $getSiswa = Siswa::find()->where(['id_user' => $idLogIn])->one();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah SiswaWali",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'statusWali' => $statusWali,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($model->load($request->post()) && $model->save()){

                $lastInsertedId = Yii::$app->db->getLastInsertID();
                $createWali = new SiswaWali();
                $createWali->id_siswa = $getSiswa->id;
                $createWali->id_wali = $lastInsertedId;
                $createWali->save();

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah SiswaWali",
                    'content'=>'<span class="text-success">Create SiswaWali berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];         
            }else{           
                return [
                    'title'=> "Tambah SiswaWali",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'statusWali' => $statusWali,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                $lastInsertedId = Yii::$app->db->getLastInsertID();
                $createWali = new SiswaWali();
                $createWali->id_siswa = $getSiswa->id;
                $createWali->id_wali = $lastInsertedId;
                $createWali->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'statusWali' => $statusWali,
                ]);
            }
        }

    }

    /**
     * Updates an existing SiswaWali model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = Wali::find()->where(['id' => $id])->one();  
        $statusWali = RefStatusWali::find()->all();  

        $idLogIn = Yii::$app->user->identity->id;
        $getSiswa = Siswa::find()->where(['id_user' => $idLogIn])->one();       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah SiswaWali",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'statusWali' => $statusWali,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "SiswaWali ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'statusWali' => $statusWali,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
               return [
                'title'=> "Ubah SiswaWali ",
                'content'=>$this->renderAjax('update', [
                    'model' => $model,
                    'statusWali' => $statusWali,
                ]),
                'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
            ];        
        }
    }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing SiswaWali model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        Wali::find()->where(['id' => $id])->one()->delete();
        SiswaWali::find()->where(['id_wali' => $id])->one()->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing SiswaWali model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
     public function actionBulkdelete()
     {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the SiswaWali model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SiswaWali the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SiswaWali::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
