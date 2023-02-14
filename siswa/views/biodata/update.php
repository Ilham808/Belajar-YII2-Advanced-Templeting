<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Update Biodata</h4>
        <div class="siswa-update">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
