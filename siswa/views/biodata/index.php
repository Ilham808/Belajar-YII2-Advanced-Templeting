<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
$this->title = 'Biodata';
$this->params['breadcrumbs'][] = $this->title;
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
                    ]);
                    ?>
                </div>
                <br>
                <div id="ajaxCrudDatatable">
                    
                    <div class="table-responsive">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
