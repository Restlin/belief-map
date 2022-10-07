<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="auth-block">
    <div class="auth-block__container">
        <div class="auth-block__header">
            <div class="auth-block__heading">Welcome to Insocius Belief Shift Transition (BeST) <br>Enter your log-in details below to access BeST and customer logbook.</div>
        </div>
        <div class="auth-block__body">
            <div class="auth-block__data">
                <div class="auth-block__title"><?= Html::encode($this->title) ?></div>
                <div class="auth-block__caption">Please fill out the following fields to login:</div>
            </div>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <div class="login-form__field">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <div class="help-block">Required</div>
            </div>

            <div class="login-form__field">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>

            <div class="login-form__field">
                <?= $form->field($model, 'rememberMe', ['options' => ['style' => 'float:right; width: 70%;']])->checkbox([
                    'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>
            </div>

            <div class="form-group">
                <div class="offset-lg-1 col-lg-11">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<!-- 
<h1 class="login-welcome-header"></h1>
<p class="login-welcome-text">
    Enter your log-in details below to access your customer belief maps and customer logbook.
</p> 
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe', ['options' => ['style' => 'float:right; width: 70%;']])->checkbox([
            'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    
</div> -->
