<?php

namespace backend\controllers;

use Yii;
use common\models\Kelas;
use common\models\Siswa;
use common\models\RefTingkatKelas;
use common\models\RefJurusan;
use common\models\RefTahunAjaran;
use common\models\Guru; 
use backend\models\ActionSiswaKelas;
use backend\models\SearchKelas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * KelasController implements the CRUD actions for Kelas model.
 */
class KelasController extends Controller
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
     * Lists all Kelas models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new SearchKelas();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Kelas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Kelas ",
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

    public function actionCreateSiswa($id)
    {
        $request = Yii::$app->request;
        $model = new Siswa();
        $siswa = Siswa::find()->where(['!=', 'id_kelas', $id])->all();
        $saveData = new ActionSiswaKelas();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Siswa ke Kelas",
                    'content'=>$this->renderAjax('create-siswa', [
                        'model' => $model,
                        'siswa' => $siswa,
                        'id'    => $id
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($request->post() && $saveData->updateSiswaKelas($request->post())){
                
                return [
                    'title' => "Daftar Siswa",
                    'content' => $this->renderAjax('list-siswa', [
                        'model' => Siswa::find()->where(['id_kelas' => $id])->all()
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]).
                    Html::a('Tambah Siswa',['create-siswa', 'id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];     
            }else{           
                return [
                    'title'=> "Tambah Kelas",
                    'content'=>$this->renderAjax('create-siswa', [
                        'model' => $model,
                        'siswa' => $siswa,
                        'id'    => $id
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
                return $this->render('create-siswa', [
                    'model' => $model,
                    'siswa' => $siswa,
                    'id'    => $id
                ]);
            }
        }
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
                'options' => [
                    'class' => 'card-lg'
                ],
                'footer' => Html::button('Tutup', ['class' => 'btn btn-default float-left', 'data-dismiss' => "modal"]).
                Html::a('Tambah Siswa',['create-siswa', 'id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        } else {
            return $this->render('list-siswa', [
                'model' => $model
            ]);
        }
    }

    public function actionDeleteSiswa($id_siswa, $id_kelas)
    {
        $siswa = Siswa::find()->where(['id' => $id_siswa])->one();
        $siswa->id_kelas = 0;
         Yii::$app->response->format = Response::FORMAT_JSON;
        if($siswa->save()){
            return $this->redirect(['index']);        
        }
    }

    /**
     * Creates a new Kelas model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Kelas();  
        $jurusan = RefJurusan::find()->all();
        $tingkatKelas = RefTingkatKelas::find()->all();
        $guru = Guru::find()->all();
        $tahunAjaran = RefTahunAjaran::find()->all();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Tambah Kelas",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'jurusan' => $jurusan,
                        'tingkatKelas' => $tingkatKelas,
                        'guru' => $guru,
                        'tahunAjaran' => $tahunAjaran
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tambah Kelas",
                    'content'=>'<span class="text-success">Create Kelas berhasil</span>',
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Tambah Lagi',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                ];         
            }else{           
                return [
                    'title'=> "Tambah Kelas",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'jurusan' => $jurusan,
                        'tingkatKelas' => $tingkatKelas,
                        'guru' => $guru,
                        'tahunAjaran' => $tahunAjaran
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
     * Updates an existing Kelas model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id); 
        $jurusan = RefJurusan::find()->all();
        $tingkatKelas = RefTingkatKelas::find()->all();
        $guru = Guru::find()->all();
        $tahunAjaran = RefTahunAjaran::find()->all();      

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Ubah Kelas",
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'jurusan' => $jurusan,
                        'tingkatKelas' => $tingkatKelas,
                        'guru' => $guru,
                        'tahunAjaran' => $tahunAjaran
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Kelas ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'jurusan' => $jurusan,
                        'tingkatKelas' => $tingkatKelas,
                        'guru' => $guru,
                        'tahunAjaran' => $tahunAjaran
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
               return [
                'title'=> "Ubah Kelas ",
                'content'=>$this->renderAjax('update', [
                    'model' => $model,
                    'jurusan' => $jurusan,
                    'tingkatKelas' => $tingkatKelas,
                    'guru' => $guru,
                    'tahunAjaran' => $tahunAjaran
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
     * Delete an existing Kelas model.
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
     * Delete multiple existing Kelas model.
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
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
