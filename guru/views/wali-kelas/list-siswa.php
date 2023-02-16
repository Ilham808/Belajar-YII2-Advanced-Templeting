<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
?>
<div class="list-siswa">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td><b>No</b></td>
                <td><b>NIS</b></td>
                <td><b>Nama</b></td>
                <td><b>Tempat/Tanggal Lahir</b></td>
                <td><b>Alamat</b></td>
            </tr>
            <?php $no=1; foreach($model as $arr){ ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $arr->nis; ?></td>
                    <td><?php echo $arr->nama; ?></td>
                    <td><?php echo $arr->tempat_lahir.'/'.$arr->tanggal_lahir; ?></td>
                    <td><?php echo $arr->alamat; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
