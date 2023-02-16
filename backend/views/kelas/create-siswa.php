<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kelas */

?>
<div class="siswa-create">
    <?= $this->render('_siswa', [
        'model' => $model,
        'siswa' => $siswa,
        'id'    => $id
    ]) ?>
</div>
