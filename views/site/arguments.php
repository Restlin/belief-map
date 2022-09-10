<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
if(($cellId = \Yii::$app->session->get('cellId'))) {
    $link1 = Html::a('Back', ['cell/view', 'id' => $cellId], ['class' => 'btn btn-info is-blue arguments-card__button']);
} else {
    $link1 = Html::a('Back', ['map/select', 'id' => 1], ['class' => 'btn btn-info is-blue arguments-card__button']);
}
$link2 = Html::a('Resources', ['resources'], ['class' => 'btn btn-info is-blue arguments-card__button is-lime']);
?>
<div class="arguments">
    <div class="arguments__container">
        <div class="arguments__header">
            <h1 class="arguments__title">Messages</h1>
            <div class="arguments__caption">For these payer stakeholders, there are three important shifts. The core messages below support your argumentation for each shift.</div>
        </div>

        <div class="arguments__body">
            <div class="arguments__row">
                <div class="arguments-card">
                    <div class="arguments-card__left">
                        <?=Html::img("images/m1.png", ['class' => "arguments-card__img"]) ?>
                        <div class="arguments-card__text">
                            <p>The disease is a rare, progressive disorder that can be life threatening Treatment with the current SoC, provides   limited effect and iassociated treatment related adverse events, which impacts the patients QoL There is a need for a new therapy that addresses these unmet needs</p>
                        </div>
                        <div class="arguments-card__actions">
                            <?= $link1 ?>
                            <?= $link2 ?>
                        </div>
                    </div>
                    <div class="arguments-card__right">
                        <?=Html::img("images/m2.png", ['class' => "arguments-card__img"]) ?>
                    </div>
                </div>
                
            </div>
            <div class="arguments__row">
                <div class="arguments-card">
                    <div class="arguments-card__left">
                        <?=Html::img("images/m3.png", ['class' => "arguments-card__img"]) ?>
                        <div class="arguments-card__text">
                            <p>Product X provides an effective treatment option for the management of the disease over the current SoC-improvement in treatment related adverse events and improvement of patients’ QoL</p>
                        </div>
                        <div class="arguments-card__actions">
                            <?= $link1 ?>
                            <?= $link2 ?>
                        </div>
                    </div>
                    <div class="arguments-card__right">
                        <?=Html::img("images/m4.png", ['class' => "arguments-card__img"]) ?>
                    </div>
                </div>
                
            </div>
            <div class="arguments__row">
                <div class="arguments-card">
                    <div class="arguments-card__left">
                        <?=Html::img("images/m5.png", ['class' => "arguments-card__img"]) ?>
                        <div class="arguments-card__text">
                            <p>Product X reduces the costs hospitalization associated with treatment related adverse events, experienced with the SoC. It has a predictable budget impact and is a cost- effective treatment option for the management of the disease</p>
                        </div>
                        <div class="arguments-card__actions">
                            <?= $link1 ?>
                            <?= $link2 ?>
                        </div>
                    </div>
                    <div class="arguments-card__right">
                        <?=Html::img("images/m6.png", ['class' => "arguments-card__img"]) ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>