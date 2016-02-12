<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Authors;
use \nkovacs\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\search\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'author_id')->dropDownList(Authors::GetDropdown(), ['prompt' => 'Укажите автора записи']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'name') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'date_from')->widget(DateTimePicker::className(), [
                'format' => 'Y-MM-dd',
                'clientOptions' => [
                    'extraFormats' => ['YYYY-MM-DD'],
                ],
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'date_to')->widget(DateTimePicker::className(), [
                'format' => 'Y-MM-dd',
                'clientOptions' => [
                    'extraFormats' => ['YYYY-MM-DD'],
                ],
            ]); ?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
