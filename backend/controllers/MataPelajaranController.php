<?php

namespace backend\controllers;

use Yii;
use common\models\MataPelajaran;
use common\models\RefJurusan;
use common\models\RefTingkatKelas;
use common\models\Guru;
use common\models\GuruMataPelajaran;
use backend\models\SearchMataPelajaran;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


/**
 * MataPelajaranController implements the CRUD actions for MataPelajaran model.
 */
class MataPelajaranController extends Controller
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
        $searchModel = new SearchMataPelajaran();
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
        $model = $this->findModel($id);
        
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "MataPelajaran ",
                'content'=>$this->renderAjax('view', [
                    'model' => $model
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
     * Creates a new MataPelajaran model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new MataPelajaran();  
        $jurusan = RefJurusan::find()->all();
        $tingkatKelas = RefTingkatKelas::find()->all();
        $guru = Guru::find()->all();
        $guruMataPelajaran = new GuruMataPelajaran();

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
                        'jurusan' => $jurusan,
                        'tingkatKelas' => $tingkatKelas,
                        'guru' => $guru,
                        'guruMataPelajaran' =>  $guruMataPelajaran
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])

                ];         
            }else if($model->load($request->post()) && $model->save()){
                $idMataPelajaran = Yii::$app->db->getLastInsertID();
                $dataPost = $request->post();
                $idGuru = $dataPost['GuruMataPelajaran']['id_guru'];

                $createMataPelajaran = new GuruMataPelajaran;
                $createMataPelajaran->id_guru = $idGuru;
                $createMataPelajaran->id_mata_pelajaran = $idMataPelajaran;
                $createMataPelajaran->save();

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
                        'jurusan' => $jurusan,
                        'tingkatKelas' => $tingkatKelas,
                        'guru' => $guru,
                        'guruMataPelajaran' =>  $guruMataPelajaran
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
                $idMataPelajaran = Yii::$app->db->getLastInsertID();
                $dataPost = $request->post();
                $idGuru = $dataPost['GuruMataPelajaran']['id_guru'];

                $createMataPelajaran = new GuruMataPelajaran;
                $createMataPelajaran->id_guru = $idGuru;
                $createMataPelajaran->id_mata_pelajaran = $idMataPelajaran;
                $createMataPelajaran->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'jurusan' => $jurusan,
                    'tingkatKelas' => $tingkatKelas,
                    'guru' => $guru,
                    'guruMataPelajaran' =>  $guruMataPelajaran
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
        $jurusan = RefJurusan::find()->all();
        $tingkatKelas = RefTingkatKelas::find()->all();
        $guru = Guru::find()->all();
        $guruMataPelajaran = GuruMataPelajaran::find()->where(['id_mata_pelajaran'=>$model->id])->one();


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
                        'jurusan' => $jurusan,
                        'tingkatKelas' => $tingkatKelas,
                        'guru' => $guru,
                        'guruMataPelajaran' =>  $guruMataPelajaran
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::button('Simpan',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                $dataPost = $request->post();
                $idGuru = $dataPost['GuruMataPelajaran']['id_guru'];

                $guruMataPelajaran->id_guru = $idGuru;
                $guruMataPelajaran->id_mata_pelajaran = $model->id;
                $guruMataPelajaran->save();
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "MataPelajaran ",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                        'jurusan' => $jurusan,
                        'tingkatKelas' => $tingkatKelas,
                        'guru' => $guru,
                        'guruMataPelajaran' =>  $guruMataPelajaran
                    ]),
                    'footer'=> Html::button('Tutup',['class'=>'btn btn-default float-left','data-dismiss'=>"modal"]).
                    Html::a('Ubah',['update', 'id' => $model->id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
               return [
                'title'=> "Ubah MataPelajaran ",
                'content'=>$this->renderAjax('update', [
                    'model' => $model,
                    'jurusan' => $jurusan,
                    'tingkatKelas' => $tingkatKelas,
                    'guru' => $guru,
                    'guruMataPelajaran' =>  $guruMataPelajaran
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
                $dataPost = $request->post();
                $idGuru = $dataPost['GuruMataPelajaran']['id_guru'];
                
                $guruMataPelajaran->id_guru = $idGuru;
                $guruMataPelajaran->id_mata_pelajaran = $model->id;
                $guruMataPelajaran->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'jurusan' => $jurusan,
                    'tingkatKelas' => $tingkatKelas,
                    'guru' => $guru
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
