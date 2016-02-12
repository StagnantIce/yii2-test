<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\search\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            ['attribute' => 'preview', 'format' => 'raw', 'value' => function($model) {
                    return $model->preview ? Html::img(['/thumb/show', 'src'=>$model->preview, 'width' => 100], ['class' => "showImage", "url" =>  $model->preview]) : ''; 
                }
            ],
            ['attribute' => 'author_id', 'value' => function($model) {
                    return trim($model->author->firstname . ' ' . $model->author->lastname);
                }
            ],
            'date_create',
            'date_update',
            'date',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action', 'template' => '{update} {view} {delete}', 'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('[ред]', $url);
                },
                'view' => function ($url, $model) {
                    return Html::a('[просм]', 'javascript:showBook("' . $url . '")');
                },
                'delete' => function ($url,$model,$key) {
                    return Html::a('[удл]', $url);
                },
            ]]
        ],
    ]); ?>

</div>

<?
    Modal::begin([
        'header' => '<h2>View image</h2>',
        'id' => 'showImage',
    ]);

    Modal::end();

    Modal::begin([
        'header' => '<h2>View image</h2>',
        'id' => 'showBook',
    ]);

    Modal::end();
?>

