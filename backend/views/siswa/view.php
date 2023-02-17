<?php

use yii\widgets\DetailView;
?>
<div class="siswa-view">
    <div class="table-responsive">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nis',
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat:ntext',
            'kelas.nama_kelas',
        ],
    ]) ?>
    </div>

</div>
