<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\MataPelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mata-pelajaran-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'mata_pelajaran')->textInput(['maxlength' => true]) ?>

	<?php 
	$listDataTingkat=ArrayHelper::map($tingkatKelas,'id','tingkat_kelas');
	echo $form->field($model, 'id_tingkat_kelas')->dropDownList(
		$listDataTingkat,
		['prompt'=>'- Pilih Salah Satu -']
	)->label('Tingkat Kelas');
	?>

	<?php 
	$listDataJurusan=ArrayHelper::map($jurusan,'id','jurusan');
	echo $form->field($model, 'id_jurusan')->dropDownList(
		$listDataJurusan,
		['prompt'=>'- Pilih Salah Satu -']
	)->label('Jurusan');
	?>

	<?php if (!Yii::$app->request->isAjax){ ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php } ?>

	<?php ActiveForm::end(); ?>

</div>
