<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Other';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arguments">
    <div class="arguments__container" style="max-width: 1095px;">
        <div class="arguments__header">
            <h1 class="arguments__title" style="margin-bottom: 25px;">Other supporting materials</h1>
            
            <div class="res-card is-column">
                <div class="res-card__title">A range of additional materials are available to support your discussions with payers.​<br>Please note local compliance and approval must be obtained before external use of any of the materials in part or whole.
                </div>
                <?=Html::img('images/r15.png', ['class' => 'res-card__img']) ?>
            </div>

           
        </div>
        <div class="arguments__actions">
            <?= Html::a('Back', ['resources'], ['class' => 'btn btn-info is-blue arguments__button', 'style' => 'width: 190px;']) ?>
            <a href="#" class="btn btn-info is-blue arguments__button" style="background-color: #C3D503 !important;border-color: #C3D503 !important;width: 190px;">All references</a>
        </div>
    </div>
</div>