<?php

/* @var $this yii\web\View */
/* @var $isAdmin bool */
/* @var $isManager bool */
/* @var $company \app\models\Company */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => null, 'template' => ""];
?>
<div class="site-index">    
    

    <div class="promo">
        <div class="promo__container">
            <div class="promo__row">
                <h1 class="promo__title">Welcome</h1>
                <div class="promo__text">
                    <p>
                    Welcome to the Insocius planning tool for stakeholder-facing teams, BeST. This tool allows you to plan your next best content engagement with an individual stakeholder or customer, then work  towards a target mindset and behaviour.
                    </p>
                    <p>
                    Each of your stakeholders or customers will have a different starting point, so the tool allows you map their current belief, behaviour and practice then recommends the next best belief, behaviour or practice shift for your stakeholder as well as the messages to enable this.
                    </p>
                <div class="promo__actions">
                    <?= Html::a('Start', ['about'], ['class' => 'btn btn-info promo__button is-blue']) ?>
                </div>
            </div>
        </div>
    </div>    
    
</div>
