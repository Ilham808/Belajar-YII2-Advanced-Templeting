<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
?>
<div class="detail-guru">

    <div id="ajaxCrudDatatable">
        <div id="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td><b>Nama Guru</b></td>
                    <td><b>Aksi</b></td>
                </tr>
                <?php foreach($model as $arr){ ?>
                    <tr>
                        <td><?php echo $arr->refGuru['nama_guru']; ?></td>
                        <td>
                            <?php 
                            echo Html::a('Hapus', ['delete-guru', 'id' => $arr->id_mata_pelajaran, 'id_guru' => $arr->refGuru['id']], [
                                'class' => 'btn btn-danger text-white btn-block',
                                'title' => 'Hapus',
                            ]);
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
