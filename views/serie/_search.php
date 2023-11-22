<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SerieSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="serie-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'kind') ?>

    <?= $form->field($model, 'season') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'poster') ?>

    <?php // echo $form->field($model, 'stream_id') ?>

    <?php // echo $form->field($model, 'first') ?>

    <?php // echo $form->field($model, 'last') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
