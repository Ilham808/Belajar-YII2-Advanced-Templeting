<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
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
                    <div id="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <b>
                                        NIS
                                    </b>
                                </td>
                                <td><?= $data->nis ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <b>
                                        Nama Lengkap
                                    </b>
                                </td>
                                <td><?= $data->nama ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <b>
                                        Tempat Lahir
                                    </b>
                                </td>
                                <td><?= $data->tempat_lahir ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <b>
                                        Tanggal Lahir
                                    </b>
                                </td>
                                <td><?= $data->tanggal_lahir ?></td>
                            </tr>

                            <tr>
                                <td>
                                    <b>
                                        Alamat
                                    </b>
                                </td>
                                <td><?= $data->alamat ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
