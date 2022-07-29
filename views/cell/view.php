<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $cellCodes array */
/* @var $counts array */

$map = $model->answer1->map;
$this->title = 'Tool';
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['product/list']];
//$this->params['breadcrumbs'][] = ['label' => $map->product->name, 'url' => ['product/view', 'id' => $map->product->id]];
$this->params['breadcrumbs'][] = $this->title;


$code = $cellCodes[$model->id];

$shift = $model->shifts ? $model->shifts[0] : $model->prevShifts[0];
$startCode = $cellCodes[$shift->cell_start_id];
$endCode = $cellCodes[$shift->cell_end_id];
$shiftCell = $shift->cellStart;
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
                        $current  = ['class' => 'cell is-big', 'style' => 'background: #7F8DAF;'];
                        foreach($rows as $row) {
                            echo Html::beginTag('div', ['class' => 'row']);
                            foreach($columns as $column) {
                                $cellCode = $row.$column;
                                $content = $cellCode;
                                $cellAttrs = $normal;
                                if($cellCode == $startCode) {                                    
                                    if($startCode[0] == $endCode[0]) {
                                        $arrowClass = 'arrow-select arrow-right';
                                        $img = Html::img('images/arr.svg');
                                    } elseif($startCode[1] == $endCode[1]) {
                                        $arrowClass = 'arrow-select arrow-top';
                                        $img = Html::img('images/at.svg');
                                    } else {
                                        $arrowClass = 'arrow-select arrow-right-top';
                                        $img = Html::img('images/at1.svg');
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
                    <div class="map-preview__title">Overall Tool Perspective</div>
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
                                $cellAttrs = $normal;
                                if($cellCode == $startCode) {
                                    if($startCode[0] == $endCode[0]) {
                                        $arrowClass = 'arrow-select arrow-right';
                                        $img = Html::img('images/arr.svg');
                                    } elseif($startCode[1] == $endCode[1]) {
                                        $arrowClass = 'arrow-select arrow-top';
                                        $img = Html::img('images/at.svg');
                                    } else {
                                        $arrowClass = 'arrow-select arrow-right-top';
                                        $img = Html::img('images/at1.svg');
                                    }
                                    $content .= Html::tag('div', $img, ['class' => $arrowClass]); //need correct arrow
                                } elseif($cellCode == $endCode) {
                                    $cellAttrs = $target;
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
                                <div class="tool-tabs__text"style="background-color: #7F8DAF;">
                                    <?= Html::tag('p', $shift->cellStart->answer1->content) ?>
                                </div>
                            </div>
                            <div class="tool-tabs__card" >
                                <div class="tool-tabs__title">Practice</div>
                                <div class="tool-tabs__text"style="background-color: #7F8DAF;">
                                    <?= Html::tag('p', $shift->cellStart->answer2->content) ?>
                                </div>
                            </div>
                        </div>

                        <div class="tool-tabs__col">
                            <div class="tool-tabs__label">
                                Shift to
                                <img src="images/ar.svg" alt="">
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
                            <div class="cell" style="background-color: #7F8DAF;"><?=$startCode?></div>
                        </div>
                        <div class="arguments-steps__item">
                            <div class="cell" style="background-color: #c3d502;"><?=$endCode?></div>
                        </div>
                    </div>
                    <div class="tool-info__title">Core Message Summary</div>
                </div>
                <div class="tool-info__body">
                    <div class="tool-info__scroll scroll-area">
                        <div class="tool-info__text">
                            <?php                                
                                $links = '';
                                $disSummary = $shiftCell->link_full_deck ? '' : 'disabled';
                                $disPresentation = $shiftCell->link_pdf ? '' : 'disabled';
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
                        <div class="tool-info__actions">
                            <?= Html::a('Executive Summary', $shiftCell->link_pdf, ['class' => "btn btn-info tool-info__button $disSummary", 'style' => 'background:#7F8DAF; border:0;opacity: 1 !important;']) ?>
                            <?= Html::a('Detailed Presentation', $shiftCell->link_full_deck, ['class' => "btn btn-info tool-info__button $disPresentation", 'style' => 'background-color: #C3D502; border:0;width: 190px;opacity: 1 !important;']) ?>
                        </div>                    

                    </div>
                </div>
                <div class="tool-info__footer">
                    <div class="arguments-steps tool-info__steps is-large">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #7F8DAF;"><?=$startCode?></div>
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
                <?= Html::a('Next customer', ['map/select', 'id' => $map->id], ['class' => 'btn btn-info tool__button is-blue', 'style' => 'background-color: #7F8DAF; border:0;']) ?>
                <?= Html::a('Finish', ['site/index'], ['class' => 'btn btn-info tool__button ', 'style' => 'background-color: #c3d502; border:0;']) ?>
            </div>
                            
        </div>
    </div>
</div>
