<?php

/* @var $this yii\web\View */
/* @var $isAdmin bool */
/* @var $isManager bool */
/* @var $company \app\models\Company */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => null, 'template' => ""];
?>
<div class="site-index">

    <div class="informer">Prototype tool for demonstration purposes</div>

    <div class="promo">
        <div class="promo__container">

            

            <div class="promo__inner">
                <div class="promo__left">
                    <p>Welcome to the Insocius planning tool for stakeholder-facing teams, Belief Shift Transition (BeST). This tool allows you to plan your next best content engagement with a stakeholder or customer, and then work towards a target mindset or behaviour.
                    
                     </p>
                    <p>
                        Each of your stakeholders or customers will have a different starting point, so the tool allows you map their current belief, behaviour and practice then recommends the next best belief, behaviour or practice shift for them and the messages to enable this.
                     </p>
                </div>
                <div class="promo__right">
                    <img src="images/h11.jpg" alt="">
                </div>
            </div>


            <div class="promo__actions">
                <?= Html::a('About this tool', ['about'], ['class' => 'btn btn-info promo__button is-blue']) ?>
            </div>
        </div>
    </div>    
    
</div>
