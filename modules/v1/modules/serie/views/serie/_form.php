<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Serie $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="serie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kind')->dropDownList([ 'Live Action' => 'لایواکشن', 'انیمیشن' => 'انیمیشن', 'انیمه' => 'انیمه', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'season')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 1 => 'در حال پخش', 'در حال ساخت' => 'در حال ساخت', 'پایان یافته' => 'پایان یافته', 'نامعلوم' => 'نامعلوم', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'poster')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stream_id')->textInput() ?>

    <?= $form->field($model, 'first')->textInput() ?>

    <?= $form->field($model, 'last')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
