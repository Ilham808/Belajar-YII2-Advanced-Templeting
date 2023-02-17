<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
$this->title = 'Riwayat Kelas';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-12">
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
                            'toolbar'=> [
                                ['content'=>
                                    Html::a('<i class="fas fa-redo"></i> ', [''],
                                    ['data-pjax'=>1, 'class'=>'btn btn-primary', 'title'=>'Reset Grid']).
                                    '{toggleData}'
                                    // .'{export}'
                                ],
                            ],          
                            'striped' => true,
                            'condensed' => true,
                            'responsive' => true,          
                            'panel' => [
                                // 'type' => 'primary', 
                                'heading' => '<i class="glyphicon glyphicon-list"></i> Riwayat Kelas',
                            ]
                        ])?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
