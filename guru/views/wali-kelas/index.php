<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel siswa\models\SearchSiswaWali */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wali Kelas';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="ajaxCrudDatatable">
                    <div id="table-responsive">
                        <?=GridView::widget([
                            'id'=>'crud-datatable',
                            'pager' => [
                                'firstPageLabel' => 'Awal',
                                'lastPageLabel'  => 'Akhir'
                            ],
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'pjax'=>true,
                            'columns' => require(__DIR__.'/_columns.php'),         
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,
                            'panel' => [
                                // 'type' => 'primary', 
                                'heading' => 'Kelas',
                            ]  
                        ])?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
