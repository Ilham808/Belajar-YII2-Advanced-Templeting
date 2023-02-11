<?php

namespace backend\controllers;

use Yii;
use common\models\Guru;
use common\models\User;
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
    public function actionIndex()
    {    
        $searchModel = new SearchGuru();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        $modelUser = new BuatAkun();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Guru",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'modelUser' => $modelUser
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($modelUser->load($request->post()) && $modelUser->signup()){
                $lastInsertedId = Yii::$app->db->getLastInsertID();

                if ($model->load($request->post()) ) {
                    $dataPost = $request->post();
                    $namaGuru = $dataPost['Guru']['nama_guru'];

                    $createGuru = new Guru;
                    $createGuru->nama_guru = $namaGuru;
                    $createGuru->id_user = $lastInsertedId;
                    $createGuru->save();

                    $modelAuth = new AuthAssignment;
                    $modelAuth->item_name = 'Guru';
                    $modelAuth->user_id = $lastInsertedId;
                    $modelAuth->save();

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
                            'model' => $model,
                            'modelUser' => $modelUser
                        ]),
                        'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                        Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                    ]; 
                }  
            }else{           
                return [
                    'title'=> "Tambah Guru",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'modelUser' => $modelUser
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }
        }else{
            if ($modelUser->load($request->post()) && $modelUser->signup()) {
                $lastInsertedId = Yii::$app->db->getLastInsertID();
                if ($model->load($request->post()) ) {
                    $dataPost = $request->post();
                    $namaGuru = $dataPost['Guru']['nama_guru'];

                    $createGuru = new Guru;
                    $createGuru->nama_guru = $namaGuru;
                    $createGuru->id_user = $lastInsertedId;
                    $createGuru->save();

                    $modelAuth = new AuthAssignment;
                    $modelAuth->item_name = 'Guru';
                    $modelAuth->user_id = $lastInsertedId;
                    $modelAuth->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    return $this->render('create', [
                        'model' => $model,
                        'modelUser' => $modelUser
                    ]);
                }
                
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'modelUser' => $modelUser
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
