<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
?>
<div class="mata-pelajaran-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mata_pelajaran',
            'refTingkatKelas.tingkat_kelas',
            'refJurusan.jurusan',
            'guruMataPelajaran.guru.nama_guru'
        ],
    ]) ?>
    </div>

</div>
