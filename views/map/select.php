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
$this->title = 'Tool';
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
        if(q1 && q2) {
            cell = cellCodes[q1+q2] ? cellCodes[q1+q2] : null;
            $('.cell').removeClass('selected');
            if(cell) {                
                result = 'submit to '+ q1 + q2;
                /*if(!contact) {
                    result = 'need select contact';
                }
                $('#btn-submit').prop('disabled', contact ? false : true);
                */
                $('#btn-submit').prop('disabled', false);
                $('.cell[data-code='+q1 + q2 +']').addClass('selected');
            } else {
                result = 'N/A';
                $('#btn-submit').prop('disabled', true);
            }
        } else {
            result = 'need answers';
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
<div class="map-view is-small">
    <div class="map-view__header">
        <h1>To begin with the tool, please fill in <br>necessary information below:</h1>
        <div class="map-view__text">

            <p><b>1.  Stakeholder  Initials - Please type in or choose initials of each payer.</b></p>

            <p>
                Answer two key stakeholder questions:
                <br><b>2.  Current Belief - Use dropdown menu to choose appropriate Belief.</b>
                <br><b>3.  Current Practice - Use dropdown menu to choose appropriate Practice.</b>
            </p>
            <p>
                The tool automatically classifies your payer's starting position on the tool.
                <br>A highlighted box will appear on the map to indicate current chosen position for selected Stakeholder Initials.
                <br><b>4.  Explore the suggested Belief/Practice shifts for current stakeholder and the approved messages to for the next Shift by clicking 'Submit'.</b>
            </p>            
                
        </div>
    </div>
    <div class="map-form">
        <div class="map-form__grid">
            <div class="map-form__main">
                <?php $form = ActiveForm::begin(); ?> 

                <?php
                    if($isAdmin) {
                        echo $form->field($model, 'intro')->textArea(['maxwidth' => 2000])->label('edit only by admins');
                    } else {
                        echo Html::tag('p', $model->intro);
                    }
                ?>
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
    <div class="map-info"><span>  INFORMATION:</span> Some Belief/Practice combinations are not realistic – if you see "N/A" please different combination of chosen answers.</div>
</div>
