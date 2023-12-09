<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Episode $model */

$this->title = 'Create Episode';
$this->params['breadcrumbs'][] = ['label' => 'Episodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="episode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
