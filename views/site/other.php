<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Other';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arguments">
    <div class="arguments__container is-large">
        <div class="arguments__header">
            <h1 class="arguments__title">Other Supporting materials</h1>
            <div class="arguments__caption">
                A range of additional materials are available to support your discussions with payers.​
                <br>Please click on the titles below to open each one.
                <br>Please note local compliance and approval must be obtained before external use of any of the materials in part or whole.
            </div>
        </div>
        <div class="arguments__body">
            <div class="arguments__row">

                <div class="arguments__image is-large">
                    <?=Html::img('images/a4.png', ['class' => 'arguments__img']) ?>
                </div>

                <div class="arguments__actions">
                    <?= Html::a('back', ['resources'], ['class' => 'btn btn-info arguments__button', 'style' => 'width: 73px;']) ?>                    
                    <a href="#" class="btn btn-info arguments__button" style="background-color: #a2bdc1;border-color: #a2bdc1;">All references</a>
                </div>
            </div>

        </div>
    </div>
</div>