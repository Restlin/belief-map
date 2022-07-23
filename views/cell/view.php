<?php

use yii\helpers\Html;
use kartik\slider\Slider;
use yii\bootstrap4\Modal;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $cellCodes array */
/* @var $code string */
/* @var $colors array*/
/* @var $color string */
/* @var $shifts \app\models\Shift[] */
/* @var $contact \app\models\Contact */
/* @var $logbookForm string */

$map = $model->answer1->map;
$this->title = $code;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product/list']];
$this->params['breadcrumbs'][] = ['label' => $map->product->name, 'url' => ['product/view', 'id' => $map->product->id]];
$this->params['breadcrumbs'][] = $this->title;

$shiftCells = [];
$barColors = [];
$cellButtons = [];
$sliderValue = 1;
if($shifts) {
    $shiftCells[] = $shifts[0]->cellStart;
    $cellCode = $cellCodes[$shifts[0]->cellStart->id];
    $barColors[] = $colors[$cellCode];
    $cellButtons[] = Html::tag('div', $cellCode, ['class' => 'cell-button', 'data-num' => 1]);
    foreach($shifts as $i => $shift) {
        $shiftCells[] = $shift->cellEnd;
        $cellCode = $cellCodes[$shift->cellEnd->id];
        if($cellCode == $code) {
            $sliderValue = $i + 2;
        }
        $barColors[] = $colors[$cellCode]; 
        $cellButtons[] = Html::tag('div', $cellCode, ['class' => 'cell-button', 'data-num' => $i + 2]);
    }    
}


$js = '$(function(){$(".cell-button").on("click", function(){
        $(".selected").removeClass("selected");
        $(".previos").removeClass("previos");
        let num = $(this).data("num");
        $(".full-content-container").addClass("hidden");
        $(".full-content-container[data-num="+num+"]").removeClass("hidden");
        let code=$(this).data("code");
        $(this).addClass("selected");
        $(".cell[data-cell="+code+"]").addClass("selected");
        $(".shift-block.q1:lt("+(num - 1)+")").addClass("previos");
        $(".shift-block.q2:lt("+(num - 1)+")").addClass("previos");
        $(".shift-block[data-code="+code+"]").addClass("selected");
    }); $(".cell-button[data-code='.$code.']").click();});';
$this->registerJs($js);

$shiftBlockWidth = 185 * 4 / $map->size;
$axisWidth = 65 * $map->size;
?>
<style>
    /* .shift-block {
        width: <?=$shiftBlockWidth?>px;
    } */
    /* parent {     
          width: <?= $axisWidth?>px
    } */

</style>

<div class="tool">
    <div class="tool__container">
        <div class="tool__header">
            <div class="tool__maps">
                <div class="tool__map">
                    <div class="map-preview__title">Suggested next shift</div>
                    <div class="map-preview__inner is-new is-big">
                        <div class="row">
                            <div class="cell is-big" style="background: #fff;box-shadow: 6px 5px 18px rgba(0, 0, 0, 0.16);color: #adbd00;">a3</div>
                            <div class="cell is-big" style="background: #C3D502;">a2
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="cell is-big" style="background: #7f8daf;">a3<div class="arrow-select arrow-right-top">
                                    <img src="/web/images/at1.svg" alt="">
                                </div></div>
                            <div class="cell is-big" style="background: #fff;box-shadow: 6px 5px 18px rgba(0, 0, 0, 0.16);color: #adbd00;">a2
                                
                            </div>
                        </div>

                        <parent class="vertical">
                            <span class="legend">Current belief</span>
                            <div class="line">
                                <div class="bullet"></div>
                            </div>
                        </parent>
                        <parent class="horizontal">
                            <span class="legend">Current practice
                            <div class="line">
                                <div class="bullet"></div>
                            </div>
                        </parent>
                    </div>
                </div>
                <div class="tool__map">
                    <div class="map-preview__title">Overall Tool Perspective</div>
                    <div class="map-preview__inner is-new">
                        <div class="row is-thin">
                            <div class="cell" style="background: #C3D502;">a3</div>
                            <div class="cell" style="background: #C3D502;">a2
                                <div class="logbook-count">3</div>
                            </div>
                            <div class="cell" style="background: #C3D502;">a1</div>
                        </div>
                        <div class="row is-thin">
                            <div class="cell" style="background: #C3D502;">a3</div>
                            <div class="cell" style="background: #C3D502;">a2<div class="arrow-select arrow-right-top">
                                    <img src="/web/images/at1.svg" alt="">
                                </div></div>
                            <div class="cell" style="background: #C3D502;">a1</div>
                        </div>
                        <div class="row is-thin">
                            <div class="cell" style="background: #C3D502;">
                                a3
                                <div class="arrow-select arrow-right-top">
                                    <img src="/web/images/at1.svg" alt="">
                                </div>
                            </div>
                            <div class="cell" style="background: #C3D502;">a2</div>
                            <div class="cell" style="background: #C3D502;">a1</div>
                        </div>
                        <div class="row is-thin">
                            <div class="cell" style="background-color: #7f8daf;">
                                a3

                                <div class="arrow-select arrow-top">
                                    <img src="/web/images/at.svg" alt="">
                                </div>
                            </div>
                            <div class="cell" style="background: #C3D502;">a2</div>
                            <div class="cell" style="background: #C3D502;">a1</div>
                        </div>

                        <parent class="vertical">
                            <span class="legend">Current belief</span>
                            <div class="line">
                                <div class="bullet"></div>
                            </div>
                        </parent>
                        <parent class="horizontal">
                            <span class="legend">Current practice
                            <div class="line">
                                <div class="bullet"></div>
                            </div>
                        </parent>
                    </div>
                </div>
            </div>
        </div>

        <div class="tool__body">
            <div class="tool__tabs">
                <div class="tool-tabs">
                    <div class="tool-tabs__grid">
                        <div class="tool-tabs__col">
                            <div class="tool-tabs__card" >
                                <div class="tool-tabs__title">Belief</div>
                                <div class="tool-tabs__text"style="background-color: #7f8daf;">
                                    <p>There is no or limited awareness of the disease unmet need or issues with existing SoC</p>
                                </div>
                            </div>
                            <div class="tool-tabs__card" >
                                <div class="tool-tabs__title">Practice</div>
                                <div class="tool-tabs__text"style="background-color: #7f8daf;">
                                    <p>Other therapies, including SoC, are reimbursed for the disease - but not Product X</p>
                                </div>
                            </div>
                        </div>

                        <div class="tool-tabs__col">
                            <div class="tool-tabs__label">
                                Shift to
                                <img src="/web/images/ar.svg" alt="">
                            </div>
                        </div>

                        <div class="tool-tabs__col">
                            <div class="tool-tabs__card">
                                <div class="tool-tabs__title">Next best Belief</div>
                                <div class="tool-tabs__text">
                                    <p>The disease is progressive and life-threatening. <br>There are limitations with existing SoC</p>
                                </div>
                            </div>
                            <div class="tool-tabs__card">
                                <div class="tool-tabs__title">Next best Practice</div>
                                <div class="tool-tabs__text">
                                    <p>Other therapies, including SoC, are reimbursed for the disease - but not Product X</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tool-info tool__info">
                <div class="tool-info__container">
                <div class="tool-info__header">
                    <div class="arguments-steps tool-info__steps">
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #0e2f4a;">D3</div>
                        </div>
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #c3d502;">C3</div>
                        </div>
                    </div>
                    <div class="tool-info__title">Core Message Summary</div>
                </div>
                <div class="tool-info__body">
                    <div class="tool-info__scroll scroll-area">
                        <div class="tool-info__text">
                            <h2>Unmet need message summary</h2>
                            <p>The disease is most common in the elderly, with the highest proportion of costs attributed to hospitalisations
                                <br>•  The disease affects approximately 8% of the adult population in Europe 1
                                <br>•  It affects as many as 6 % of people > 60 years of age 1</p>
                            <p>Elderly and frail patients with the disease have an increased risk of earlier death and have an impaired quality of life (QoL) 3,4   
                            <br>•  Patients with the disease over 60 years old were 40% more die during the median follow up time of 3 years than those 	      without disease 3  
                            <br>•  Patients with the disease had a decreased adjusted HRQoL score of 4.7, reflecting a poorer QoL4</p>
                            <p>European guidelines recommend screening for patients with the disease5</p>
                            <p>The European guidelines state ‘’ diagnostics tests should be used for initial assessment of a patient with newly diagnosed disease in order to evaluate their suitability for particular therapies’’ 5</p>
                            <p>The limitations of current therapies</p>
                            <p>Current therapies are associated with substantial toxicity, which contributes to morbidity and mortality</p>
                            <p>
                            Current therapies are associated with substantial toxicity, due to non-specific effects, causing adverse events6  
                            <br>Over 50% of mortalities in the disease may be due to treatment related adverse events7 
                            </p>

                        </div>
                        <div class="tool-info__actions">
                            <a href="#" class="btn btn-info tool-info__button" style="background-color: #7f8daf; border:0;">Executive Summary</a>
                            <a href="#" class="btn btn-info tool-info__button" style="background-color: #a2bdc1; border:0;width: 190px;">Detailed Presentation</a>
                        </div>
                    </div>
                </div>
                <div class="tool-info__footer">
                    <div class="arguments-steps tool-info__steps is-large">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #7f8daf;">D3</div>
                            </div>
                            <div class="arguments-steps__line" style="background:#c3d502;"></div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
                            </div>
                        </div>
                </div>
                </div>
            </div>
        </div>

        <div class="tool__footer">
            <div class="tool__actions">
                <a href="#" class="btn btn-info tool__button" style="background-color: #c3d502; border:0;">Next customer</a>
                <a href="#" class="btn btn-info tool__button" style="background-color: #a2bdc1; border:0;">Finish</a>
            </div>
                            
        </div>
    </div>
</div>

<!-- <div class="cell-view">  
    <div class="cell-view__content">
        <div class="row">
            <div class="col-lg-3" style="align-items: center;">
                <div class="map-preview">
                    <h4 class="map-preview__title">Customer<br>position map</h4>
                    <div class="map-preview__inner">
                        <?php 
                            if($code == 'A1') {
                                echo Html::tag("div", "No approach shifts required for A1 profile payers", ['class' => "answer-block"]), "\n";
                            } else {                    
                                $rows = array_slice(['A', 'B', 'C', 'D', 'E'], 0, $map->size);
                                $columns = array_slice(['5', '4', '3', '2', '1'], 5 - $map->size, $map->size);
                                $wide = 7 - $map->size;
                                foreach($rows as $i => $row) {
                                    echo Html::beginTag('div', ['class' => 'row']);
                                    foreach($columns as $j => $column) {
                                        $arrow = '';
                                        $cellCode = $row.$column;
                                        $cellClass = "cell";
                                        foreach($shifts as $i => $shift) {
                                            if($cellCodes[$shift->cell_start_id] == $cellCode) {
                                                $cellClass = "cell cell-with-arrow";
                                                $endCell = $cellCodes[$shift->cell_end_id];
                                                if($endCell[0] == $row) {
                                                    $vectorClass = 'arrow-right';
                                                } elseif($endCell[1] == $column) {
                                                    $vectorClass = 'arrow-top';
                                                } else {
                                                    $vectorClass = 'arrow-right-top';
                                                }
                                                $num = $i + 1;
                                                $arrow = Html::tag('div', Icon::show('arrow-right')."<br>".$num, ['class' => "arrow-select $vectorClass"]);
                                            }
                                            if($cellCodes[$shift->cell_end_id] == $cellCode) {
                                                $cellClass = "cell cell-with-arrow";
                                            }
                                        }                            
                                        $color = $colors[$cellCode];
                                        if($cellClass == 'cell') {
                                            $cellCode = '';
                                        }
                                        echo Html::tag("div", $cellCode. $arrow, ['class' => $cellClass, 'style' => "background: $color", 'data-cell' => $cellCode ]), "\n";
                                    }
                                    echo Html::endTag('div');                        
                                }
                                ?>       
                                <parent class="vertical">
                                    <span class="legend">&nbsp;Payer&nbsp;belief&nbsp;</span>
                                    <div class="line">
                                        <div class="bullet"></div>
                                    </div>
                                </parent>
                                <parent class="horizontal">
                                    <span class="legend">&nbsp;Payer&nbsp;Practice&nbsp;</span>
                                    <div class="line">
                                        <div class="bullet"></div>
                                    </div>                                                
                                </parent>                    
                            <?php }
                        ?>       
                    </div>    
                </div>
            </div>
            <?php if($code == 'A1') { ?>
            <div class="col-lg-9">
                <div class="answer-block">You have successfully achieved your payer ideal approach/funding goal! No further shifts are required.</div>
            </div>
            <?php } else { ?>        
            <div class="col-lg-9">
                <div class="shift-block-container">
                    <div class="shift-title"> Belief</div>       
                    <div class="shift-block-grid">       
                        <?php
                            $count = count($shiftCells);
                            foreach($shiftCells as $i => $shiftCell) {
                                    $cellCode = $cellCodes[$shiftCell->id];
                                    $cellColor = $colors[$cellCode];
                                ?>
                                <div
                                    class="shift-block q1"
                                    data-num="<?=$i+1 ?>"
                                    data-code ="<?=$cellCode ?>"
                                    data-color="<?=$cellColor?>"
                                >
                                    <?=$shiftCell->question1_compact ?>
                                </div>
                            <?php }
                        ?>         
                    </div>         
                </div>
                <div class="row steps-row">
                    <?php
                        $count = count($shiftCells);
                        foreach($shiftCells as $i => $shiftCell) {
                                $cellCode = $cellCodes[$shiftCell->id];
                                $cellColor = $colors[$cellCode];
                            ?>
                            <div
                                class="cell-button"
                                data-num="<?=$i+1 ?>"
                                data-code ="<?=$cellCode ?>"
                            >
                                <?=$cellCode?>
                            </div>
                        <?php
                            if($i < $count - 1) {
                                ?>
                                <div class="arrow-between">
                                    <?= Icon::show('arrow-right') ?><br>Shift <?=$i+1 ?>
                                </div>
                            <?php }
                        }
                    ?>                
                </div>
                <div class="shift-block-container">
                    <div class="shift-title second"> Practice</div>
                    <div class="shift-block-grid"> 
                        <?php
                            foreach($shiftCells as $i => $shiftCell) { 
                                    $cellCode = $cellCodes[$shiftCell->id];
                                    $cellColor = $colors[$cellCode];                            
                                ?>                        
                                <div 
                                    class="shift-block q2" 
                                    data-num="<?=$i+1 ?>" 
                                    data-code ="<?=$cellCode ?>" 
                                    data-color="<?=$cellColor?>"
                                >                             
                                    <?=$shiftCell->question2_compact ?>                            
                                </div>
                            <?php }
                        ?>
                    </div>  
                </div>            
            </div> 
        </div>  
    </div>
    <div class="cell-view__footer">
        <?php 
            foreach($shiftCells as $i => $shiftCell) {
                    $num = $i +1;
                    $links = '';
                    $dis2 = $shiftCell->link_full_deck ? '' : 'disabled';
                    $dis3 = $shiftCell->link_pdf ? '' : 'disabled';
                    if($shiftCell->links) {
                        $urls = explode(' ', $shiftCell->links);
                        $links = [];
                        foreach($urls as $j => $url) {                        
                            $linkNum = $j + 1;
                            $links[] = Html::a('link '.$linkNum, $url);
                        }
                        $links = Html::tag('div', implode(', ', $links));                    
                    }
                    ?>                
                    <div class="full-content-container hidden" data-num="<?=$num?>">
                        <div class="shift-content">
                            <?=$shiftCell->content.$links?>
                        </div>
                        <div class="shift-content__titles">
                            <h3 class="shift-content__title-accent">Shift <?=$num ?> Messaging :</h3>
                        </div>
                        <h4>Learn more :</h4>
                        <div class="shift-content-actions">
                            <?= Html::a("Presentation", $shiftCell->link_full_deck, ['class' => "btn content-btn-1 $dis2", 'target' => '_blank']) ?>
                            <?= Html::a("Message Summary", $shiftCell->link_pdf, ['class' => "btn content-btn-2 $dis3", 'target' => '_blank',]); ?>
                        </div>
                    </div>                
            <?php }
        } ?> 
    </div>
</div>
<p>
    &nbsp;
</p> -->
