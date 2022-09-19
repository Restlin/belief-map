<?php

use yii\helpers\Html;
use kartik\color\ColorInput;
//use dosamigos\ckeditor\CKEditor;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Cell */
/* @var $map \app\models\Map */
/* @var $form yii\widgets\ActiveForm */
/* @var $code string */

/* @var $answers1 array */
/* @var $answers2 array */

$this->title = $model->isNewRecord ? 'Create Cell' : "Update Cell $code";
$this->params['breadcrumbs'][] = ['label' => 'Maps', 'url' => ['map/index']];
$this->params['breadcrumbs'][] = ['label' => $map->name, 'url' => ['map/view', 'id' => $map->id]];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'title' => $this->title,
    'id' => 'modal-container',
    'size' => Modal::SIZE_LARGE,
    'centerVertical' => true,
]);
$this->registerJsVar('returnUrl', Url::to(['map/view', 'id' => $map->id, 'tab' => 'cells']));
$js = "$(function(){ $('#modal-container').modal('show'); });
    $('#modal-container').on('hide.bs.modal', function(e){location.href = returnUrl});
    ";
$this->registerJs($js);
?>
<div class="cell-create">    

    <div class="cell-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'answer1_id')->dropDownList($answers1) ?>

        <?= $form->field($model, 'answer2_id')->dropDownList($answers2) ?>
        
        <?= $form->field($model, 'question1_compact')->textInput(['maxlength' => '150']) ?>
        
        <?= $form->field($model, 'question2_compact')->textInput(['maxlength' => '150']) ?>
        
        <?= $form->field($model, 'content')->widget(CKeditor::class, [
            'options' => ['rows' => 8],
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],            
        ]) ?>
        
        <?= $form->field($model, 'links')->textArea(['maxlength' => '4000'])->hint('Use space as separator between links') ?>
        
        <?= $form->field($model, 'link_full_deck')->textArea(['maxlength' => '500']) ?>
        
        <?= $form->field($model, 'link_pdf')->textArea(['maxlength' => '500']) ?>
        
        <?= $form->field($model, 'color')->widget(ColorInput::class, [
                'options' => ['placeholder' => 'Select color ...'],
            ])
        ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<?php Modal::end();  ?>
