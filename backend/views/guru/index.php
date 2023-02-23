<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchGuru */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gurus';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<!-- <div class="element-wrapper">
    <h6 class="element-header">
            </h6>
            <div class="element-box"> -->
                <div class="row">
                    <div class="col-12">
                        <div id="ajaxCrudDatatable">
                            <div id="table-responsive">
                                <?php Pjax::begin();?>
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
                                    'heading' => '<i class="glyphicon glyphicon-list"></i> Gurus listing',
                                    'before'=>Html::a('Tambah', ['create'],
                                        ['role'=>'modal-remote','title'=> 'Create new Gurus','class'=>'btn btn-primary']),
                        // 'after'=>BulkButtonWidget::widget([
                        //             'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                        //                 ["bulk-delete"] ,
                        //                 [
                        //                     "class"=>"btn btn-danger btn-xs",
                        //                     'role'=>'modal-remote-bulk',
                        //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                        //                     'data-request-method'=>'post',
                        //                     'data-confirm-title'=>'Are you sure?',
                        //                     'data-confirm-message'=>'Are you sure want to delete this item'
                        //                 ]),
                        //         ]).                        
                                    '<div class="clearfix"></div>',
                                ]
                            ])?>
                            <?php Pjax::end(); ?>
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
