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
                        <div class="res-card__title">Executive summaries <br>Suitable for shorter (15 min) discussions</div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #0e2f4a;">D3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
                            </div>
                        </div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #0e2f4a;">D3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
                            </div>
                        </div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #0e2f4a;">D3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
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
                        <div class="res-card__title">Detailed  Presentations
                            <br>Suitable for longer (30-60 min) discussions
                            <br>and providing more detailed evidence</div>

                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #0e2f4a;">D3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
                            </div>
                        </div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #0e2f4a;">D3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
                            </div>
                        </div>
                        <div class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #0e2f4a;">D3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
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
            <?= Html::a('other supporting materials', ['resources', 'page' => 2], ['class' => 'btn btn-info res__button', 'style' => 'background-color: #0e2f4a; border:0;width: 240px;text-transform: uppercase;']) ?>
            <a href="#" class="btn btn-info res__button" style="background-color: #a2bdc1; border:0;text-transform: uppercase;">All references</a>
        </div>
    </div>
</div>
<?php
    echo $this->registerJsFile('plugins/jquery.scrollbar.min.js');
    echo $this->registerJsFile('plugins/ion.rangeSlider.min.js');
?>