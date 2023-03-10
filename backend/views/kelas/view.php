<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
?>
<div class="kelas-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'refTahunAjaran.tahun_ajaran',
            'nama_kelas',
            'refTingkatKelas.tingkat_kelas',
            'guru.nama_guru',
            'refJurusan.jurusan',
        ],
    ]) ?>
    </div>

</div>
