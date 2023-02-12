<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Siswa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="siswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

    <?php
    echo '<label class="form-label">Tanggal Lahir</label>';
    echo DatePicker::widget([
        'name' => 'tanggal_lahir',
        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
        'value' => '',
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-M-yyyy'
        ]
    ]);
    ?>
    <br>

    <?= $form->field($modelUser, 'email')->label('Email') ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 3]) ?>

    <?php 
    $dataKelas=ArrayHelper::map($kelas,'id','nama_kelas');
    echo $form->field($model, 'id_kelas')->dropDownList(
        $dataKelas,
        ['prompt'=>'- Pilih Salah Satu -']
    )->label('Kelas');
    ?>

    <hr>
    <?= $form->field($modelUser, 'username')->textInput()->label('Username') ?>
    <?= $form->field($modelUser, 'password')->passwordInput()->label('Password') ?>


    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
         <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
     </div>
 <?php } ?>

 <?php ActiveForm::end(); ?>

</div>
