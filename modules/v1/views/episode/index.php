<?php

use app\models\Episode;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\EpisodeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Episodes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="episode-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= \Yii::$app->user->can('create') ? Html::a('Create Episode', ['create'], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'slug',
            'video',
            'serie_id',
            'price',
            'season',
            \Yii::$app->user->can('create') ? [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Episode $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ] : [],
        ],
    ]); ?>


</div>
