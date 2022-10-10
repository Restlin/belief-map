<?php

/* @var $this yii\web\View */
/* @var $isAdmin bool */
/* @var $isManager bool */
/* @var $company \app\models\Company */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => null, 'template' => ""];
?>
<div class="site-index">    

    <div class="about-page">
        <div class="about-page__container">
            <div class="about-page__row">
                <div class="about-page__inner">
                    <div class="about-page__left">
                        <div class="about-page__title">About this tool</div>
                        <div class="about-page__text">
                            <p>The tool has five components:</p>
                            <br>

                            <ol>
                                <li>A diagnostic that allows you to map the current beliefs, behaviours and practice of a target stakeholder</li>
                                <li>A belief map that recommends the next best belief, behaviour or practice shift for that stakeholder
                                <li>Recommended messages to enable that shift </li>
                                <li>Supporting resources for engagement</li>
                                <li>Measurement of engagement with customers</li>
                            </ol>
                        </div>
                    </div>
                    <div class="about-page__right">
                        <div class="about-page__caption">Belief Map Framework</div>

                        <?= Html::img('images/abtsh.png', ['class' => "about-page__img is-shadow"]) ?>
                    </div>
                </div>

                <div class="about-page__footer">
                    <div class="about-page__text">
                        <p>The belief map has a Y axis that outlines a series of different stakeholder beliefs (e.g. payer belief), while the X axis indicates various stakeholder practices/ behaviours (e.g. approaches to reimbursement and funding). These have been agreed in advance of developing your tool.
                        </p>
                        <p>By diagnosing and mapping the current belief and practices or behaviours, the tool provides a pathway for progressive customer engagement.</p>
                    </div>
                </div>
                
            </div>

            <div class="about-page__row">
                <div class="about-page__title">Compliance</div>
                <div class="about-page__text is-accent">
                    <p>The tool and supporting materials have all been approved at Global team level. You will need to ensure they comply with your local regulations.</p>

                    <p>For GDPR purposes, only stakeholder initials only can be used for the diagnostic. The tool does not collect or store any other information about stakeholders without their consent.</p>

                    <p>Information held is stored securely on our company system and is made available only to those who need it to perform their roles. <br> Information should be deleted when it is no longer required for the purpose of negotiation.
                    </p>
                </div>
                
            </div>

            <div class="about-page__actions">
                <?= Html::a('Start using the tool', ['use'], ['class' => 'btn btn-info about-page__button is-blue']) ?>   
            </div>
        </div>
    </div>
    

    