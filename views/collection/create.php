<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Collection $model */

$this->title = 'Create Collection';
$this->params['breadcrumbs'][] = ['label' => 'Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
