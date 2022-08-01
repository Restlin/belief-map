<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Resources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="res">
    <div class="res__container">
        <div class="res__header">
            <h1 class="res__title">Resources</h1>
            <div class="res__caption">Messages for each Shift have been used to develop two specific resources <br>for use with Payers to help move their position on the map</div>
        </div>
        <div class="res__body">
            <div class="res__row">
                <div class="res-card">
                    <div class="res-card__main">
                        <div class="res-card__title"><strong>Executive summaries</strong> <br>Suitable for shorter (15 mins) discussions.</div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #7f8daf;">D3</a>
                            </div>
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #c3d502;">C3</a>
                            </div>
                        </div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #7f8daf;">C3</a>
                            </div>
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #c3d502;">B2</a>
                            </div>
                        </div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #7f8daf;">B2</a>
                            </div>
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #c3d502;">A1</a>
                            </div>
                        </div>
                    </div>
                    <div class="res-card__aside">
                        <div class="res-card__img">
                            <?= Html::img('images/r1.png') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="res__row">
                <div class="res-card">
                    <div class="res-card__main">
                        <div class="res-card__title"><strong> Detailed  Presentations</strong> 
                            <br>Suitable for shorter (30 mins) discussions
                            <br>and providing more detailed evidence.</div>

                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #7f8daf;">D3</a>
                            </div>
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #c3d502;">C3</a>
                            </div>
                        </div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #7f8daf;">C3</a>
                            </div>
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #c3d502;">B2</a>
                            </div>
                        </div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #7f8daf;">B2</a>
                            </div>
                            <div class="arguments-steps__item">
                                <a href="#" class="cell" style="background-color: #c3d502;">A1</a>
                            </div>
                        </div>
                    </div>
                    <div class="res-card__aside">
                        <div class="res-card__img">
                            <?= Html::img('images/r2.png') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="res__footer">
            <?= Html::a('other supporting materials', ['resources', 'page' => 2], ['class' => 'btn btn-info res__button', 'style' => 'background-color: #7f8daf; border:0;width: 240px;text-transform: uppercase;']) ?>
            <a href="#" class="btn btn-info res__button" style="background-color: #c3d502; border:0;text-transform: uppercase;">All references</a>
        </div>
    </div>
</div>

<style>
    .cell:hover{
        text-decoration: none;
        color: #fff;
    }
</style>
<?php
    echo $this->registerJsFile('plugins/jquery.scrollbar.min.js');
    echo $this->registerJsFile('plugins/ion.rangeSlider.min.js');
?>
