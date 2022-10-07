<?php

/* @var $this yii\web\View */
/* @var $mapId int */

    use yii\helpers\Html;
    $this->title = 'How to use this tool';
    $this->params['breadcrumbs'][] = $this->title;
?>


    <div class="about-page">
        <div class="about-page__container is-small">
            <div class="about-page__row">
                <div class="about-page__title">How to use this tool </div>
                <div class="about-page__text">
                    <p>To get started, follow these steps:</p>

                    <ol>
                        <li>Log the initials of your payer stakeholders in the Stakeholder Log</li>

                        <li>Click on the payer stakeholder from the drop-down list. Answer the questions from the drop–down menus, and select ‘Submit</li>
                        <li>View the stakeholder's current position on the map; and see what shift is recommended next</li>
                        <li>Read through the messages that will support the suggested shift, and click on ‘Resources’ to see which information sources can be used to build engagement content for your payer. There are two types of resources: executive summaries (suitable for shorter discussions) and detailed presentations (suitable for longer discussions and providing more detailed evidence)</li>
                        <li>At the bottom of the screen, select ‘Next customer’ to repeat the process for additional payers. Select ‘Finish’ when you have entered information for all your payers</li>
                        <li>The process should be repeated after every interaction with a payer so the Progress Dashboard is accurate</li>
                    </ol>
                </div>


                <?= Html::a('Submit', ['map/select', 'id' => $mapId], ['class' => 'btn btn-info about-page__button is-margin is-blue']) ?>
                
            </div>
        </div>
    </div>