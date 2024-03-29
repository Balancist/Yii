<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Collection $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="collection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chapter')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'در حال پخش' => 'در حال پخش', 'در حال ساخت' => 'در حال ساخت', 'پایان یافته' => 'پایان یافته', 'نامعلوم' => 'نامعلوم', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
