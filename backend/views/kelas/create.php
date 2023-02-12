<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kelas */

?>
<div class="kelas-create">
    <?= $this->render('_form', [
        'model' => $model,
        'jurusan' => $jurusan,
        'tingkatKelas' => $tingkatKelas,
        'guru' => $guru,
        'tahunAjaran' => $tahunAjaran
    ]) ?>
</div>
