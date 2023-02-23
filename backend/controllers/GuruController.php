<?php

namespace backend\controllers;

use Yii;
use common\models\Guru;
use common\models\User;
use common\models\GuruMataPelajaran;
use common\models\AuthAssignment;
use backend\models\SearchGuru;
use backend\models\BuatAkun;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * GuruController implements the CRUD actions for Guru model.
 */
class GuruController extends Controller
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
     * Lists all Guru models.
     * @return mixed
     */
    public function actionIndex($id_mapel = null)
    {    
        $request = Yii::$app->request;
        $searchModel = new SearchGuru();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Pilih Guru",
                'content'=>$this->renderAjax('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'id_mapel' => $id_mapel
                ]),
                'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"])
            ];
        }else{
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id_mapel' => $id_mapel
            ]);
        }
    }


    /**
     * Displays a single Guru model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Guru ",
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

    public function actionAddAkun($id)
    {
        $request = Yii::$app->request;
        $model = new BuatAkun();
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Akun Guru",
                    'content'=>$this->renderAjax('add-akun', [
                        'model' => $model
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($model->load($request->post()) && $model->signup($id, "Guru")){

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Akun Guru",
                    'content'=>'<span class="text-success">Berhasil Membuat Akun</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"])

                ];  
            }else{           
                return [
                    'title'=> "Tambah Guru",
                    'content'=>$this->renderAjax('add-akun', [
                        'model' => $model
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }
        }else{
            if ($model->load($request->post()) && $model->signup($id, "Guru")) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('add-akun', [
                    'model' => $model
                ]);
            }
        }

    }

    public function actionViewAkun($id)
    {
        $request = Yii::$app->request;
        $getAkun = User::findOne($id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Detail Akun",
                'content'=>$this->renderAjax('view-akun', [
                    'model' => User::findOne($id),
                ]),
                'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"])
            ];    
        }else{
            return $this->render('view-akun', [
                'model' => User::findOne($id),
            ]);
        }
    }
    /**
     * Creates a new Guru model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */ 
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Guru();
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Guru",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($model->load($request->post()) && $model->save()){

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Guru",
                    'content'=>'<span class="text-success">Create Guru berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];  
            }else{           
                return [
                    'title'=> "Tambah Guru",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }
        }else{
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model
                ]);
            }
        }

    }

    /**
     * Updates an existing Guru model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);  
        // $model = new Guru();  
        // $modelUser = new BuatAkun();

        $modelUser = User::find()->where(['id' => $model->id_user])->one(); 

        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah Guru",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'modelUser' => $modelUser
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){

                if ($modelUser->load($request->post())) {
                    if ($modelUser->newPassword){
                        $modelUser->setPassword($modelUser->newPassword);
                    }
                    $modelUser->save();
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Guru ",
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                            'modelUser' => $modelUser
                        ]),
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                        Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];

                }else{
                    return [
                        'title'=> "Ubah Guru ",
                        'content'=>$this->renderAjax('update', [
                            'model' => $model,
                            'modelUser' => $modelUser
                        ]),
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                        Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                    ];   
                } 
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Guru ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'modelUser' => $modelUser
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
               return [
                'title'=> "Ubah Guru ",
                'content'=>$this->renderAjax('update', [
                    'model' => $model,
                    'modelUser' => $modelUser
                ]),
                'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
            ];        
        }
    }else{
        if ($model->load($request->post()) && $model->save()) {
            if ($modelUser->load($request->post())) {
                if ($modelUser->newPassword){
                    $modelUser->setPassword($modelUser->newPassword);
                }
                $modelUser->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('update', [
                    'model' => $model,
                    'modelUser' => $modelUser
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelUser' => $modelUser
            ]);
        }
    }
}

    /**
     * Delete an existing Guru model.
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
     * Delete multiple existing Guru model.
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


    public function actionAddMapel($id_mapel, $id_guru)
    {
        $searchModel = new SearchGuru();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $request = Yii::$app->request;

        $model = new GuruMataPelajaran();
        $model->id_mata_pelajaran = $id_mapel;
        $model->id_guru = $id_guru ;
        $model->setStatusGuruMapel();
        
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceReload'=>'#crud-datatable-mapel-guru-pjax',
                'title'=> "Pilih Guru",
                'content'=>$this->renderAjax('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'id_mapel' => $id_mapel
                ]),
                'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"])
            ];
        }else{
            return [
                'forceReload'=>'#crud-datatable'
            ];
        }
    }

    /**
     * Finds the Guru model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Guru the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Guru::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
