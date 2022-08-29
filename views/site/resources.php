<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Resources';
$this->params['breadcrumbs'][] = $this->title;
if(($cellId = \Yii::$app->session->get('cellId'))) {
    $back = Html::a('Back', ['cell/view', 'id' => $cellId], ['class' => 'btn btn-info res__button', 'style' => 'background-color: #7f8daf; border:0;width: 240px;']);
} else {
    $back = Html::a('Back', ['map/select', 'id' => 1], ['class' => 'btn btn-info res__button', 'style' => 'background-color: #7f8daf; border:0;width: 240px;']);
}
?>
<div class="res">
    <div class="res__container">
        <div class="res__header">
            <h1 class="res__title">Resources</h1>
            <div class="res__caption">Messages for each shift have been used to develop two specific resources for use with payers to help move their position on the map.
                <br>ou can access the supporting references and additional materials for help with your discussions by clicking on each shift below e.g. D3 – C3. This will bring up PowerPoint slides for each shift.                
            </div>
        </div>
        <div class="res__body">
            <div class="res__row">
                <div class="res-card">
                    <div class="res-card__main">
                        <div class="res-card__title"><strong>Executive summaries</strong>                             
                            <br>Suitable for shorter (15 minute) discussions</div>


                        <a href="files/es_D3.pptx" class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #7f8daf;">D3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
                            </div>
                        </a>
                        <a href="files/es_C3.pptx" class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #7f8daf;">C3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">B2</div>
                            </div>
                        </a>
                        <a href="files/es_B2.pptx" class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #7f8daf;">B2</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">A1</div>
                            </div>
                        </a>
                    </div>
                    <div class="res-card__aside">
                        <div class="res-card__img">
                            <?= Html::img('images/r1.jpg') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="res__row">
                <div class="res-card">
                    <div class="res-card__main">
                        <div class="res-card__title"><strong> Detailed  presentations</strong>
                            <br>Suitable for longer (30 minute) discussions
                            <br>and providing more detailed evidence</div>

                        <a href="files/dp_D3.pptx" class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #7f8daf;">D3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">C3</div>
                            </div>
                        </a>
                        <a href="files/dp_C3.pptx" class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #7f8daf;">C3</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">B2</div>
                            </div>
                        </a>
                        <a href="files/dp_B2.pptx" class="arguments-steps res-card__steps">
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #7f8daf;">B2</div>
                            </div>
                            <div class="arguments-steps__item">
                                <div class="cell" style="background-color: #c3d502;">A1</div>
                            </div>
                        </a>
                    </div>
                    <div class="res-card__aside">
                        <div class="res-card__img">
                            <?= Html::img('images/r2.jpg') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="res__footer">
            <?= $back ?>
            <?= Html::a('Оther supporting materials', ['resources', 'page' => 2], ['class' => 'btn btn-info res__button', 'style' => 'background-color: #c3d502; border:0;width: 240px;']) ?>
            <!-- <a href="#" class="btn btn-info res__button" style="background-color: #c3d502; border:0;text-transform: uppercase;">All references</a> -->
        </div>
    </div>
</div>

<style>
    a:hover{
        text-decoration: none;
    }
</style>
<?php
    echo $this->registerJsFile('plugins/jquery.scrollbar.min.js');
    echo $this->registerJsFile('plugins/ion.rangeSlider.min.js');
?>
