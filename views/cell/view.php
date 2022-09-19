<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $cellCodes array */
/* @var $counts array */

$map = $model->answer1->map;
$this->title = 'The tool';
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product/list']];
//$this->params['breadcrumbs'][] = ['label' => $map->product->name, 'url' => ['product/view', 'id' => $map->product->id]];
$this->params['breadcrumbs'][] = $this->title;


$code = $cellCodes[$model->id];

$shift = $model->shifts ? $model->shifts[0] : $model->prevShifts[0];
$startCode = $cellCodes[$shift->cell_start_id];
$endCode = $cellCodes[$shift->cell_end_id];
$shiftCell = $shift->cellStart;
$shiftCellCode = $cellCodes[$shiftCell->id];
$empties = [];
?>

<div class="tool">
    <div class="tool__container">
        <div class="tool__header">
            <div class="tool__maps">
                <div class="tool__map">
                    <div class="map-preview__title">Suggested next shift</div>
                    <div class="map-preview__inner is-new is-big">
                        <?php                        

                        $r = $code[0];
                        $c = $code[1];
                        $rows = $r == 'A' ? ['A', 'B'] : [chr(ord($r)-1), $r];
                        $columns = $c == '1' ? [2, 1] : [$c, $c - 1];

                        $normal = ['class' => 'cell is-big', 'style' => 'background: #fff;box-shadow: 6px 5px 18px rgba(0, 0, 0, 0.16);color: #adbd00;'];
                        $target = ['class' => 'cell is-big', 'style' => 'background: #C3D502;'];
                        $current  = ['class' => 'cell is-big', 'style' => 'background: linear-gradient(0deg, #59CBE8, #59CBE8), #C3D502;'];
                        foreach($rows as $row) {
                            echo Html::beginTag('div', ['class' => 'row']);
                            foreach($columns as $column) {
                                $cellCode = $row.$column;
                                $content = $cellCode;
                                $cellAttrs = $normal;
                                $empties[] = $cellCode;
                                if($cellCode == $startCode) {                                    
                                    if($startCode[0] == $endCode[0]) {
                                        $arrowClass = 'arrow-select arrow-right';
                                        $img = Html::img('images/abr.svg');
                                    } elseif($startCode[1] == $endCode[1]) {
                                        $arrowClass = 'arrow-select arrow-top';
                                        $img = Html::img('images/abt.svg');
                                    } else {
                                        $arrowClass = 'arrow-select arrow-right-top';
                                        $img = Html::img('images/abrt.svg');
                                    }
                                    $content .= Html::tag('div', $img, ['class' => $arrowClass]); //need correct arrow
                                } elseif($cellCode == $endCode) {
                                    $cellAttrs = $target;
                                }
                                if($cellCode == $startCode) {
                                    $cellAttrs = $current;
                                }
                                echo Html::tag('div', $content, $cellAttrs);
                            }
                            echo Html::endTag('div');
                        }
                        ?>                        

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
                    <div class="map-preview__title">Stakeholder journey overview</div>
                    <div class="map-preview__inner is-new">                        
                        <?php
                        $countRows = count($map->answers1);
                        $countColumns = count($map->answers2);
                        $rows = array_slice(['A', 'B', 'C', 'D', 'E'], 0, $countRows);
                        $columns = array_slice(['5', '4', '3', '2', '1'], 5 - $countColumns, $countColumns);

                        foreach($rows as $row) {
                            echo Html::beginTag('div', ['class' => 'row is-thin']);
                            foreach($columns as $column) {
                                $cellCode = $row.$column;
                                $content = $cellCode;
                                $normal = ['class' => 'cell', 'style' => 'background: #C3D502;']; //обычная ячейка
                                $target = ['class' => 'cell cell-target', 'style' => 'background: #C3D502;']; //клетка куда идет стрелка
                                $current  = ['class' => 'cell cell-current', 'style' => 'background: #C3D502;']; //текущая клетка
                                $empty  = ['class' => 'cell empty', 'style' => 'background: #C3D502;']; //текущая клетка
                                $cellAttrs = $empty;
                                if($cellCode == $startCode) {
                                    if($startCode[0] == $endCode[0]) {
                                        $arrowClass = 'arrow-select arrow-right';
                                        $img = Html::img('images/asr.svg');
                                    } elseif($startCode[1] == $endCode[1]) {
                                        $arrowClass = 'arrow-select arrow-top';
                                        $img = Html::img('images/ast.svg');
                                    } else {
                                        $arrowClass = 'arrow-select arrow-right-top';
                                        $img = Html::img('images/astr.svg');
                                    }
                                    $content .= Html::tag('div', $img, ['class' => $arrowClass]); //need correct arrow
                                } elseif($cellCode == $endCode) {
                                    $cellAttrs = $target;
                                } elseif(in_array($cellCode, $empties)) {
                                    $cellAttrs = $empty;
                                }
                                if($cellCode == $startCode) { //current cell
                                    $cellAttrs = $current;
                                }
                                echo Html::tag('div', $content, $cellAttrs);
                            }
                            echo Html::endTag('div');
                        }
                        ?>                                                                            

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
                                <div class="tool-tabs__text"style="background: linear-gradient(0deg, #59CBE8, #59CBE8), #FFFFFF; box-shadow: 1.6px 1.2px 4px rgba(0, 0, 0, 0.15);">
                                    <?= Html::tag('p', $shift->cellStart->answer1->content) ?>
                                </div>
                            </div>
                            <div class="tool-tabs__card" >
                                <div class="tool-tabs__title">Practice</div>
                                <div class="tool-tabs__text"style="background: linear-gradient(0deg, #59CBE8, #59CBE8), #FFFFFF; box-shadow: 1.6px 1.2px 4px rgba(0, 0, 0, 0.15);">
                                    <?= Html::tag('p', $shift->cellStart->answer2->content) ?>
                                </div>
                            </div>
                        </div>

                        <div class="tool-tabs__col">
                            <div class="tool-tabs__label">
                                Shift to
                                <!-- <img src="images/ar.svg" alt=""> -->
                            </div>
                        </div>

                        <div class="tool-tabs__col">
                            <div class="tool-tabs__card">
                                <div class="tool-tabs__title">Next best Belief</div>
                                <div class="tool-tabs__text">
                                    <?= Html::tag('p', $shift->cellEnd->answer1->content) ?>
                                </div>
                            </div>
                            <div class="tool-tabs__card">
                                <div class="tool-tabs__title">Next best Practice</div>
                                <div class="tool-tabs__text">
                                    <?= Html::tag('p', $shift->cellEnd->answer2->content) ?>
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
                            <div class="cell" style="background: linear-gradient(0deg, #59CBE8, #59CBE8), #F3F3F3;"><?=$startCode?></div>
                        </div>
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #c3d502;"><?=$endCode?></div>
                        </div>
                    </div>
                    <div class="tool-info__title">Messages</div>
                </div>
                <div class="tool-info__body">
                    <div class="tool-info__scroll scroll-area">
                        <div class="tool-info__text">
                            <?php                                
                                $links = '';
                                if(in_array($shiftCellCode, ['D3', 'C3', 'B2'])) {
                                    $disSummary = '';
                                    $summaryLink = "files/es_$shiftCellCode.pptx";
                                    $presentationLink = "files/dp_$shiftCellCode.pptx";
                                    $disPresentation = '';
                                } else {
                                    $disSummary = 'disabled';
                                    $disPresentation = 'disabled';
                                    $summaryLink = "#";
                                    $presentationLink = "#";
                                }
                                
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
                            <?=$shiftCell->content.$links ?>

                        </div>
                    </div>

                    <div class="tool-info__actions">
                        <?= Html::a('Messages', ['site/arguments'], ['class' => "btn btn-info tool-info__button"]) ?>
                        <!-- <fieldset>
                            <legend>Supporting resources</legend>
                                
                        </fieldset> -->
                        <?= Html::a('Executive Summary', $summaryLink, ['class' => "btn btn-info tool-info__button $disSummary", 'style' => 'background-color: #C3D502; border:0;width: 190px;opacity: 1 !important;']) ?>
                        <?= Html::a('Detailed Presentation', $presentationLink, ['class' => "btn btn-info tool-info__button $disPresentation", 'style' => 'background-color: #C3D502; border:0;width: 190px;opacity: 1 !important;']) ?>
                    </div> 
                </div>
                <div class="tool-info__footer">
                    <div class="arguments-steps tool-info__steps is-large">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background: linear-gradient(0deg, #59CBE8, #59CBE8), #F3F3F3;"><?=$startCode?></div>
                            </div>
                            <div class="arguments-steps__line" style="background:#c3d502;"></div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;"><?=$endCode ?></div>
                            </div>
                        </div>
                </div>
                </div>
            </div>
        </div>

        <div class="tool__footer">
            <div class="tool__actions">
                <?= Html::a('Next customer', ['map/select', 'id' => $map->id], ['class' => 'btn btn-info tool__button is-blue']) ?>
                <?= Html::a('Finish', ['site/index'], ['class' => 'btn btn-info tool__button ', 'style' => 'background-color: #c3d502; border:0;']) ?>
            </div>
                            
        </div>
    </div>
</div>
