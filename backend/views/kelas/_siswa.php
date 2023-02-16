<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">
	<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'id_kelas')->hiddenInput(['value'=>$id])->label(false); ?>

	<?php 
	$dataSiswa=ArrayHelper::map($siswa,'id','nama');
	echo $form->field($model, 'id')->widget(Select2::classname(),[
		'data' => $dataSiswa,
		'options' => [
			'placeholder' => '- Pilih Siswa -',
			'multiple' => true
		],
	])->label('Nama Siswa');
	?>


	<?php if (!Yii::$app->request->isAjax){ ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>
