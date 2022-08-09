<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Logbook;
use app\models\Cell;

/* @var $this yii\web\View */
/* @var $model app\models\Map */
/* @var $form yii\widgets\ActiveForm */
/* @var $sizes array */
/* @var $cellCodes array */
/* @var $cellIds array */
/* @var $cellCounts array */

$this->title = "Progress Dashboard";
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product/list']];
//$this->params['breadcrumbs'][] = ['label' => $model->product->name, 'url' => ['product/view', 'id' => $model->product->id]];
$this->params['breadcrumbs'][] = $this->title;

$datesRaw = array_keys(reset($cellCounts));
$dates = [];
foreach ($datesRaw as $date) {
    $dates[$date] = $date;
}
var_dump($cellCounts);
var_dump($dates);
die(1);

$js = "$(function(){        
        $('#select-date').on('change', function(){
            let date = $('.irs-single').text().trim();
            $('.logbook-count').addClass('hidden');
            $('.logbook-count.date-'+date).removeClass('hidden');
        }).change();
    });";
$this->registerJs($js);
?>
<div class="map-report">

    <div class="map-form">
        <div class="map-form__grid is-revert">
            <div class="map-preview map-form__aside">
                <div class="map-form__instruction">
                    <h2>Instructions</h2>

                    <!--<p>Baseline grid / current position</p>
                    <p>Grid at last entry [date]</p>!-->
                    <p>You can view the progress of your stakeholder journey by using the slider to look at your starting point and, historical entries versus current position.  This can be used both for individual stakeholders or to provide an overview of the journey for all stakeholders.  The numbers in the circles indicate the total number of stakeholders at that position.</p>
                </div>
                <div class="map-preview__inner is-new">
                    <?php
                    $countRows = count($model->answers1);
                    $countColumns = count($model->answers2);
                    $rows = array_slice(['A', 'B', 'C', 'D', 'E'], 0, $countRows);
                    $columns = array_slice(['5', '4', '3', '2', '1'], 5 - $countColumns, $countColumns);
                    foreach ($rows as $row) {
                        echo Html::beginTag('div', ['class' => 'row']);
                        foreach ($columns as $column) {
                            $arrows = [];
                            $cellCode = $row . $column;
                            $cellId = isset($cellIds[$cellCode]) ? $cellIds[$cellCode] : null;
                            if (key_exists($cellId, $cellCounts)) {
                                foreach ($cellCounts[$cellId] as $date => $count) {
                                    if ($count > 99) {
                                        $count = "99+";
                                    }
                                    $arrows[] = Html::tag('div', $count, ['class' => "logbook-count hidden date-$date"]);
                                }
                                //$arrow = Html::tag('div', $count, ['class' => "logbook-count"]);
                            }
                            $arrow = implode("\n", $arrows);
                            $color = $colors[$cellCode];
                            echo Html::tag("div", $cellCode . $arrow, ['class' => "cell", 'style' => "background: $color", 'data-code' => $cellCode]), "\n";
                        }
                        echo Html::endTag('div');
                    }
                    ?>
                    <parent class="vertical">
                        <div class="legend">&nbsp;Current&nbsp;belief&nbsp;</div>
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
            <div class="map-form__main">
                <div class="report-data-container">

                    <div class="date-slider" style="margin-bottom: 20px;">
                        <div class="date-slider__start">Start  <span><?= reset($dates) ?></span></div>
                        <input type="range" class="date-slider__input js-date-slider" data-dates="<?= implode(', ', $dates) ?>" id="select-date">
                        <div class="date-slider__end">Today<span><?= end($dates) ?></span></div>
                    </div>

                    <div class="scroll-area">
                        <?php Pjax::begin(); ?>

                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'summary' => null,
                            'columns' => [
                                [
                                    'attribute' => 'contactName',
                                    'label' => 'Contact',
                                    'value' => function (Logbook $model) {
                                        return $model->contact->name;
                                    },
                                    'filter' => $contacts,
                                ],
                                [
                                    'attribute' => 'cell_id',
                                    'label' => 'Position',
                                    'value' => function (Logbook $model) {
                                        $codes = Cell::getCodeList($model->cell->answer1->map_id);
                                        return $codes[$model->cell->id];
                                    },
                                    'filter' => false,
                                ],
                                [
                                    'attribute' => 'date_in',
                                    'format' => 'datetime',
                                    'filter' => false
                                ],
                            ],
                        ]);
                        ?>

<?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>