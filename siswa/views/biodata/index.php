<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\bootstrap4\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
$this->title = 'Biodata';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
$this->registerJS('
$.pjax.defaults.timeout = false;
');
?>
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Biodata</h4>
                <div class="float-right">
                    <?php 
                    echo Html::a('Update', ['update', 'nis' => $data->nis], [
                        'class' => 'btn btn-success text-white btn-block',
                        'title' => 'Update',
                        'role' => 'modal-remote'
                    ]);
                    ?>
                </div>
                <br>
                <br>
                <div id="ajaxCrudDatatable">
                    <div class="table-responsive">
                        <?php Pjax::begin(['id' => 'tableBiodata']); ?>
                        <?= DetailView::widget([
                            'model' => $data,
                            'attributes' => [
                                'nis',
                                'nama',
                                'tempat_lahir',
                                'tanggal_lahir',
                                'alamat',
                            ],
                        ]) ?>
                        <?php Pjax::end(); ?>
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