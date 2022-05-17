<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use kartik\icons\Icon;
use app\models\Product;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $userName string */
/* @var $lastLogin string */
/* @var $company app\models\Company */

Icon::map($this, Icon::FA);

$this->title = 'My Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-hello">
    <?= Icon::show('exclamation-circle')?> Welcome back, <?=$userName ?>! You last logged on <?=$lastLogin ?>.
</div>
<div class="product-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function (Product $model, $key, $index, $widget) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]).Html::tag('div', $model->description);
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>
<div class="product-list-info">
    <h1>How it works</h1>
    <div><?=$company->hello_left?></div>
    <div><?=$company->hello_right?></div>
</div>