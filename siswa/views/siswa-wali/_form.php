<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\SiswaWali */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-wali-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
    $dataStatus=ArrayHelper::map($statusWali,'id','status_wali');
    echo $form->field($model, 'id_status_wali')->dropDownList(
        $dataStatus,
        ['prompt'=>'- Pilih Salah Satu -']
    )->label('Status');
    ?>

    <?= $form->field($model, 'nama')->textInput() ?>
    <?= $form->field($model, 'no_hp')->textInput() ?>
    <?= $form->field($model, 'alamat')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
