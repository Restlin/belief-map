<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\models\User;
use app\models\Company;
use kartik\icons\Icon;

AppAsset::register($this);
Icon::map($this, Icon::FAS);  
Icon::map($this, Icon::FAR);  

$this->title = Yii::$app->name;

if(Yii::$app->user->isGuest) {
    $type = 'guest';
    $company = null;
    $product = null;
} else {
    $types = User::getTypeList();
    $type = $types[Yii::$app->user->identity->user->type];
    $company = Yii::$app->user->identity->user->company;
    $product = Yii::$app->user->identity->product;
    
}
$companyIcon = false;
if($company) {    
    $brandColor = $company->getColor();    
    $textColor = $company->color_text;
    $brandLabel = Html::tag('span', $company->name, ['style' => "color: $textColor; font-size: 22px;"]);
    if($company->icon) {
        $companyIcon = $company->icon;
    }
} else {
    $brandColor = Company::DEFAULT_COLOR;    
    $textColor = '#fff';
    $brandLabel = Html::tag('span', Yii::$app->name, ['style' => "color: $textColor; font-size: 22px;"]);    
}


$mapId = 1;
$viewUrl = ['cell/view'] + $this->context->actionParams;
$toolUrl = $this->context->id == 'cell' && $this->context->action->id == 'view' ? $viewUrl :  ['/map/select', 'id' => $mapId];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="page-header">
    <?php    
    NavBar::begin([
        'brandLabel' => $brandLabel,
        'brandImage' => $companyIcon,
        'brandOptions' => ['class' => 'logo'],
        'id' => 'header-navbar',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-main',
            'style' => "background: $brandColor !important;",
        ],
        'innerContainerOptions' => [
           'style' => 'max-width: 100% !important'
        ],
    ]);    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'encodeLabels' => false,
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'About the tool', 'url' => ['/site/about'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'How to use this tool', 'url' => ['/site/use'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'The tool', 'url' => $toolUrl, 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'Messages', 'url' => ['/site/arguments'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'Resources', 'items' => [
                ['label' => 'Resources', 'url' => ['/site/resources']],
                ['label' => 'Other supporting materials', 'url' => ['/site/resources', 'page' => 2]],
            ], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            ['label' => 'Progress dashboard', 'url' => ['/map/report', 'id' => $mapId], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            //['label' => 'Help', 'url' => ['/site/help'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]],
            //['label' => 'Introduction and Guidance', 'url' => ['/product/introduction', 'id' => $product ? $product->id : $product], 'visible' => $product ? true : false, 'linkOptions' => ['style' => "color: $textColor"]],
            Yii::$app->user->isGuest ? (
                ['label' => Icon::show('sign-in-alt'), 'url' => ['/site/login'], 'visible' => $type !== 'guest', 'linkOptions' => ['style' => "color: $textColor"]]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    Html::tag('span', 'Logout'),
                    ['class' => 'logout-btn']
                )
                . Html::endForm()
                . '</li>'
                . '<li> <a href="#" class="profile-link"></a>'
                
                . '</li>'
            ),            
        ],
    ]);
    //echo $companyImg;
    NavBar::end();    
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <!--<div style="height: 60px;">&nbsp;</div>!-->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto">
    <div class="container">        
        <div class="copyright">© Copyright 2022. All rights reserved.</div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
