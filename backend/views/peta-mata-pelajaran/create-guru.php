<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */

?>
<div class="guru-create">
    <?= $this->render('_guru', [
        'model' => $model,
        'guru' => $guru,
        'id' => $id
    ]) ?>
</div>
