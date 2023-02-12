<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Kelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
    $dataTahunAjaran=ArrayHelper::map($tahunAjaran,'id','tahun_ajaran');
    echo $form->field($model, 'id_tahun_ajaran')->dropDownList(
        $dataTahunAjaran,
        ['prompt'=>'- Pilih Salah Satu -']
    )->label('Tahun Ajaran');
    ?>

    <?= $form->field($model, 'nama_kelas')->textInput(['maxlength' => true]) ?>

    <?php 
    $dataTingkatKelas=ArrayHelper::map($tingkatKelas,'id','tingkat_kelas');
    echo $form->field($model, 'id_tingkat')->dropDownList(
        $dataTingkatKelas,
        ['prompt'=>'- Pilih Salah Satu -']
    )->label('Tingkatan Kelas');
    ?>

    <?php 
    $dataGuru=ArrayHelper::map($guru,'id','nama_guru');
    echo $form->field($model, 'id_wali_kelas')->dropDownList(
        $dataGuru,
        ['prompt'=>'- Pilih Salah Satu -']
    )->label('Wali Kelas');
    ?>

    <?php 
    $dataJurusan=ArrayHelper::map($jurusan,'id','jurusan');
    echo $form->field($model, 'id_jurusan')->dropDownList(
        $dataJurusan,
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
