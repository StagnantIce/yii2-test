<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Authors;
use \nkovacs\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <? if ( $model->preview ): ?>
        <?=  Html::img(['/thumb/show', 'src'=>$model->preview, 'width' => 100]); ?><br/>
        <a href="<?=Url::to(['books/remove-image', 'id' => $model->id]);?>">Remove image</a>
    <? endif; ?>

    <?= $form->field($model, 'preview')->fileInput() ?>

    <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
        'format' => 'Y-MM-dd',
        'clientOptions' => [
            'extraFormats' => ['YYYY-MM-DD'],
        ],
    ]); ?>

    <?= $form->field($model, 'author_id')->dropDownList(Authors::GetDropdown(), ['prompt' => 'Укажите автора записи']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
