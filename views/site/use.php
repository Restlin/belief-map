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
        <!--<div class="use__caption">To get started, follow these steps:</div>-->

        <ol>
            <li>Log the initials of your payer stakeholders in the tool.</li>
            <li>Click on the payer stakeholder from the drop-down list.<br>Answer the questions from the drop–down menus, and select ‘Submit’.</li>
            <li>View the stakeholder's current position on the map; and see what shift is recommended next.</li>
            <li>Click on the 'shift arrow' highlighted to see the recommended arguments that will enable this shift.</li>
            <li>Read through the messages that will support the suggested shift, and click on ‘Resources’ to see which information sources can be used to build engagement content for your payer. There are two types of resources: executive summaries (suitable for shorter discussions) and detailed presentations (suitable for longer discussions and providing more detailed evidence).</li>
            <li>At the bottom of the screen, select ‘Next customer’ to repeat the process for additional payers. Select ‘Finish’ when you have entered information for all your payers.</li>
            <li>The process should also be repeated after every interaction with a payer to ensure the Progress Dashboard is accurate.</li>
        </ol>

        <?= Html::a('Continue', ['map/select', 'id' => $mapId], ['class' => 'btn btn-info use__button is-blue']) ?>

    </div>
</div>        