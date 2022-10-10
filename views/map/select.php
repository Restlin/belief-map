<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $answers1 array */
/* @var $answers2 array */
/* @var $cellCodes array */
/* @var $contacts array */
/* @var $colors array */
/* @var $isAdmin bool */

$this->title = 'Customer Belief Mapping Tool';
$this->title = 'The tool';
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product/list']];
//$this->params['breadcrumbs'][] = ['label' => $model->product->name, 'url' => ['product/view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$cellCodes = array_flip($cellCodes);
$this->registerJsVar('cellCodes', $cellCodes);

$js = "$('#map-question1, #map-question2').on('change', function() {        
        let q1 = $('#map-question1').val();
        let q2 = $('#map-question2').val();
        //let contact = $('#map-contactname').val();
        //console.log(contact);
        let result = '';
        $('.red-error').hide();
        if(q1 && q2) {
            cell = cellCodes[q1+q2] ? cellCodes[q1+q2] : null;
            $('.cell').removeClass('selected');            
            if(q1+q2 == 'A1') {
                $('.red-error').show();
                $('.cell[data-code='+q1 + q2 +']').addClass('selected');
                result = 'SUBMIT';
                $('#btn-submit').prop('disabled', true);
            } else if(cell) {
                result = 'submit to '+ q1 + q2;
                result = 'SUBMIT'; //from figma design                
                $('#btn-submit').prop('disabled', false);
                $('.cell[data-code='+q1 + q2 +']').addClass('selected');
            } else {
                result = 'Not Applicable';
                $('#btn-submit').prop('disabled', true);
            }
        } else {
            // result = 'need answers';
            $('#btn-submit').prop('disabled', true);
        }
        //result = 'SUBMIT'; //from figma design
        $('#btn-submit').text(result);
    }).change();"
    ;
$this->registerJs($js);
$axisWidth = 75 * $model->size + 25;
?>
<!-- <style>
    parent {
          width: <?= $axisWidth?>px
    }
</style> -->

<div class="about-tool">
    <div class="about-tool__container">
        <div class="about-tool__header">
            <div class="about-tool__title">The tool</div>
            <div class="about-tool__text">
                <div class="about-tool__row">
                    <p>Please complete the information below to populate the tool with knowledge about your payer stakeholders:<br>
                    <span> 1. Stakeholder initials - Please type in or choose initials of each payer</span>
                    </p>
                </div>
                <div class="about-tool__row">
                    <p>Answer two key customer questions
                        <br><span>2. Current Belief - Use dropdown menu to choose appropriate Belief</span><span>3. Current Practice - Use dropdown menu to choose appropriate Practice</span>
                    </p>
                </div>
                <div class="about-tool__row">
                    <p>The tool automatically classifies your payer’s starting position on the tool<br>A highlighted box will appear on the map to indicate the current position for the selected Stakeholder initials</p>
                    <span>4. Explore the suggested Belief/Practice shifts for the current stakeholder and the appropriate messages for the next Shift by clicking ‘Submit’ </span>
                    <span>5. Read through the messages that will support the suggested shift and click on ‘Resources’ to see which information sources can be used to build       engagement content for your payer </span><span>6. At the bottom of the screen, select ‘Next customer’ to repeat the process for additional payers. Select ‘Finish’ when you have entered information for all your payers</span>
                </div>
            </div>
        </div>

        <div class="about-tool__body">
            <div class="about-tool__form">
                <div class="map-form">
                    <div class="map-form__grid">
                        <div class="map-form__main">
                            <?php $form = ActiveForm::begin(); ?> 
                            
                            <?= $form->field($model, 'contactName')->widget(Select2::class, [
                                'data' => $contacts,
                                'options' => ['placeholder' => 'Insert or select  contact ...'],
                                'pluginOptions' => [
                                    'tags' => true          
                                ],
                            ]); ?>

                            <?= $form->field($model, 'question1')->widget(Select2::class, [
                                'data' => $answers1,
                                'options' => ['placeholder' => 'Select your answer'],
                                'pluginOptions' => [
                                    'minimumResultsForSearch' => '-1',            
                                ], 
                            ])->label('CURRENT BELIEF') ?>

                            <?= $form->field($model, 'question2')->widget(Select2::class, [
                                'data' => $answers2,
                                'options' => ['placeholder' => 'Select your answer'],
                                'pluginOptions' => [
                                    'minimumResultsForSearch' => '-1',            
                                ],
                            ])->label('CURRENT PRACTICE') ?>

                            <div class="red-error">There are no more shift as you have successful achieved the end goal</div>

                            <div class="form-group">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-info', 'id' => 'btn-submit', /*'disabled' => true*/]) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="map-preview map-form__aside">
                        <!-- <h2 class="map-preview__title">customer position<br>map</h2> -->
                        <div class="map-preview__inner is-new">
                            <?php
                                $countRows = count($model->answers1);
                                $countColumns = count($model->answers2);
                                $rows = array_slice(['A', 'B', 'C', 'D', 'E'], 0, $countRows);
                                $columns = array_slice(['5', '4', '3', '2', '1'], 5 - $countColumns, $countColumns);
                                foreach($rows as $row) {
                                    echo Html::beginTag('div', ['class' => 'row']);
                                    foreach($columns as $column) {
                                        $arrow = '';
                                        $cellCode = $row.$column;
                                        $color = $colors[$cellCode];
                                        echo Html::tag("div", $cellCode.$arrow, ['class' => "cell", 'style' => "background: $color", 'data-code' => $cellCode]), "\n";
                                    }
                                    echo Html::endTag('div');
                                }        
                            ?>
                                <parent class="vertical">
                                    <span class="legend">&nbsp;Current&nbsp;belief&nbsp;</span>
                                    <div class="line">
                                        <div class="bullet"></div>
                                    </div>
                                </parent>
                                <parent class="horizontal">
                                    <span class="legend">&nbsp;Current&nbsp;Practice&nbsp;</span>
                                    <div class="line">
                                        <div class="bullet"></div>
                                    </div>
                                </parent>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>

        <div class="about-tool__note"><strong>PLEASE NOTE</strong>
            Some Belief/Practice combinations are not realistic - if you see ‘Not Applicable’ please choose different combination of chosen answers
        </div>
    </div>
</div>