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

<div class="guru-form">

	<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'id_mata_pelajaran')->hiddenInput(['value'=>$id])->label(false); ?>
	<?php 
	$dataGuru=ArrayHelper::map($guru,'id','nama_guru');
	echo $form->field($model, 'id_guru')->widget(Select2::classname(),[
		'data' => $dataGuru,
		'options' => [
			'placeholder' => '- Pilih Guru -',
			'multiple' => true
		],
	])->label('Nama Guru');
	?>


	<?php if (!Yii::$app->request->isAjax){ ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>
