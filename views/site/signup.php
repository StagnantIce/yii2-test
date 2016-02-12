<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Зарегистрироваться';
$this->params['breadcrumbs'][] = 'Регистрация';

$fieldOptions = [];

?>
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">

        <!-- BEGIN CONTENT -->
        <div class="col-md-9 col-sm-9">
            <h1>Создание аккаунта</h1>
            <div class="content-form-page">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal', 'role' => 'form']]); ?>
                        <fieldset>
                            <legend>Персональная информация</legend>
                            <?= $form->field($model, 'name', $fieldOptions)->label('Имя') ?>

                            <?= $form->field($model, 'last_name', $fieldOptions)->label('Фамилия') ?>
                            <?= $form->field($model, 'email', $fieldOptions) ?>
                        </fieldset>
                        <fieldset>
                            <legend>Пароль</legend>
                            <?= $form->field($model, 'password', $fieldOptions)->passwordInput()->label('Пароль'); ?>
                            <?= $form->field($model, 'password_confirm', $fieldOptions)->passwordInput()->label('Еще раз'); ?>
                        </fieldset>
                        <div class="row">
                            <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                                <?= Html::submitButton($this->title, ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                <?= Html::a('Отмена', Url::home(), ['class' => 'btn btn-default']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->


<?php $this->beginBlock('menu-right'); ?>
<?php $this->endBlock(); ?>