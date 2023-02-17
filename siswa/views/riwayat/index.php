<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Riwayat Kelas</h4>
                <br>
                <div id="ajaxCrudDatatable">
                    <div id="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td width="1%"><b>No</b></td>
                                <td><b>Tahun Ajaran</b></td>
                                <td><b>Nama Kelas</b></td>
                                <td><b>Tingkat</b></td>
                                <td><b>Wali Kelas</b></td>
                            </tr>

                            <?php $no=1; foreach($data as $arr){ ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $arr->refTahunAjaran->tahun_ajaran ?></td>
                                    <td><?= $arr->nama_kelas ?></td>
                                    <td><?= $arr->refTingkatKelas->tingkat_kelas ?></td>
                                    <td>
                                        <?php 
                                        if ($arr->guru == NULL) {
                                            echo "-";
                                        }else{
                                            echo $arr->guru->nama_guru;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
