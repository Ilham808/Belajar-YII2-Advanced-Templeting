<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Wali */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wali-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

	<?php 
	$dataWali=ArrayHelper::map($wali,'id','status_wali');
	echo $form->field($model, 'id_status_wali')->dropDownList(
		$dataWali,
		['prompt'=>'- Pilih Salah Satu -']
	)->label('Status Wali');
	?>

	<?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>
