<?php

namespace backend\controllers;

use Yii;
use common\models\MataPelajaran;
use common\models\Guru;
use common\models\GuruMataPelajaran;
use backend\models\SearchPetaMataPelajaran;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * PetaMataPelajaranController implements the CRUD actions for MataPelajaran model.
 */
class PetaMataPelajaranController extends Controller
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
     * Lists all MataPelajaran models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SearchPetaMataPelajaran();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single MataPelajaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "MataPelajaran ",
                'content'=>$this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                Html::a('Ubah',['update','id' => $id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    public function actionDetailGuru($id)
    {
        $request = Yii::$app->request;
        $model = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id])->all();

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Detail Guru Pengajar",
                'content' => $this->renderAjax('detail-guru', [
                    'model' => $model
                ]),
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
            ];
        } else {
            return $this->render('detail-guru', [
                'model' => $model
            ]);
        }
    }

    /**
     * Creates a new MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddGuru($id)
    {
        $request = Yii::$app->request;
        $model = new GuruMataPelajaran();
        $dataGuru = Guru::find()->all();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isGet){
                return [
                    'title'=> "Tambah Guru",
                    'content'=>$this->renderAjax('create-guru', [
                        'model' => $model,
                        'guru' => $dataGuru,
                        'id' => $id
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($request->post()){

                $dataPost = $request->post();
                foreach ($dataPost['GuruMataPelajaran']['id_guru'] as $key => $value) {
                    $cekGuru = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id, 'id_guru' => $value ])->exists();
                    if ($cekGuru == FALSE) {
                        $createDb = new GuruMataPelajaran();
                        $createDb->id_guru = $value;
                        $createDb->id_mata_pelajaran = $id;
                        $createDb->save();
                    }
                }
                $dataGuruNew = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id])->all();
                return [
                    'title' => "Detail Guru Pengajar",
                    'content' => $this->renderAjax('detail-guru', [
                        'model' => $dataGuruNew
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
                ];        
            }else{           
                return [
                    'title'=> "Tambah Guru",
                    'content'=>$this->renderAjax('create-guru', [
                        'model' => $model,
                        'guru' => $dataGuru,
                        'id' => $id
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($request->post()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create-guru', [
                    'model' => $model,
                    'guru' => $dataGuru,
                    'id' => $id
                ]);
            }
        }

    }

    public function actionDeleteGuru($id, $id_guru)
    {
        $request = Yii::$app->request;
        GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id, 'id_guru' => $id_guru ])->one()->delete();

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $dataGuruNew = GuruMataPelajaran::find()->where(['id_mata_pelajaran' => $id])->all();
            return [
                'title' => "Detail Guru Pengajar",
                'content' => $this->renderAjax('detail-guru', [
                    'model' => $dataGuruNew
                ]),
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"])
            ];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MataPelajaran();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah MataPelajaran",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah MataPelajaran",
                    'content'=>'<span class="text-success">Create MataPelajaran berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];         
            }else{           
                return [
                    'title'=> "Tambah MataPelajaran",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
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
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah MataPelajaran",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "MataPelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
               return [
                'title'=> "Ubah MataPelajaran ",
                'content'=>$this->renderAjax('update', [
                    'model' => $model,
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
     * Delete an existing MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

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
     * Delete multiple existing MataPelajaran model.
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
     * Finds the MataPelajaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MataPelajaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MataPelajaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
