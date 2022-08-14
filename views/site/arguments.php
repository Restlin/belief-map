<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;
if(($cellId = \Yii::$app->session->get('cellId'))) {
    $link1 = Html::a('Back', ['cell/view', 'id' => $cellId], ['class' => 'btn btn-info arguments__button']);
} else {
    $link1 = Html::a('Back', ['map/select', 'id' => 1], ['class' => 'btn btn-info arguments__button']);
}
$link2 = Html::a('Resources', ['resources'], ['class' => 'btn btn-info arguments__button']);
?>
<div class="arguments">
    <div class="arguments__container">
        <div class="arguments__header">
            <h1 class="arguments__title">Messages</h1>
            <div class="arguments__caption">Core messages support your argumentation for each shift.</div>
        </div>
        <div class="arguments__body">
            <div class="arguments__row">
                <div class="arguments__steps">
                    <div class="arguments-steps">
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #7f8daf;">D3</div>
                        </div>
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #c3d502;">C3</div>
                        </div>
                    </div>
                </div>
                <div class="arguments__text">
                    <p>The disease is a rare, progressive disorder that can be life threatening. Treatment with the current SoC, provides limited effect and is associated with treatment related adverse events, which impacts the patients QoL There is a need for a new therapy that addresses these unmet needs</p>
                </div>

                <div class="arguments__image">
                    <?=Html::img("images/a1.jpg", ['class' => "arguments__img"]) ?>
                </div>

                <div class="arguments__actions">
                    <?= $link1 ?>
                    <?= $link2 ?>
                </div>
            </div>
            <div class="arguments__row">
                <div class="arguments__steps">
                    <div class="arguments-steps">
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #7f8daf;">C3</div>
                        </div>
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #c3d502;">B2</div>
                        </div>
                    </div>
                </div>
                <div class="arguments__text">
                    <p>Product X provides an effective treatment option for the management of the disease over the current SoC-improvement in treatment related adverse events and improvement of patients' QoL</p>
                </div>

                <div class="arguments__image">
                    <?=Html::img("images/a2.jpg", ['class' => "arguments__img"]) ?>
                </div>

                <div class="arguments__actions">
                    <?= $link1 ?>
                    <?= $link2 ?>
                </div>
            </div>
            <div class="arguments__row">
                <div class="arguments__steps">
                    <div class="arguments-steps">
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #7f8daf;">B2</div>
                        </div>
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #c3d502;">A1</div>
                        </div>
                    </div>
                </div>
                <div class="arguments__text">
                    <p>Product X reduces the costs of hospitalization associated with treatment related adverse events, experienced with the SoC.  It has a predictable budget impact and is a cost-effective treatment option for the management of the disease.</p>
                </div>

                <div class="arguments__image">
                    <?=Html::img("images/a3.jpg", ['class' => "arguments__img"]) ?>
                </div>

                <div class="arguments__actions">
                    <?= $link1 ?>
                    <?= $link2 ?>
                </div>
            </div>

        </div>
    </div>
</div>