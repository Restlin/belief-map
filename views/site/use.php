<?php

/* @var $this yii\web\View */
/* @var $mapId int */

    use yii\helpers\Html;
    $this->title = 'How to use this tool';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="use">
    <div class="use__container">
        <h1 class="use__title">How to use this tool </h1>
        <div class="use__caption">To get started, follow these steps:</div>

        <ol>
            <li>Log the initials of your payer stakeholders in the Stakeholder Log</li>
            <li>Double click on the payer stakeholder to bring up their profile.  Answer the questions from the drop down menu. 
                <br>Their individual position on the Stakeholder Belief Map will be shown</li>
            <li>View the stakeholder's current position on the map; and see what shift is recommended next</li>
            <li>Click on the 'shift arrow' highlighted to see the recommended arguments that will enable this shift</li>
            <li>Click on resources button to view the resources that can be used to build engagement content for your payer</li>
            <li>Click on new stakeholder to repeat for additional payers</li>
            <li>The process should be repeated after every interaction with a payer so the Progress Dashboard is accurate</li>
        </ol>

        <?= Html::a('Continue', ['map/select', 'id' => $mapId], ['class' => 'btn btn-info use__button is-blue']) ?>

    </div>
</div>        