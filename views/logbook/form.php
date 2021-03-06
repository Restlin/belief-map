<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Logbook */
/* @var $form yii\widgets\ActiveForm */
/* @var $contacts array */

if(get_class($this->context) == \app\controllers\LogbookController::class) {    
    $this->title = $model->isNewRecord ? 'Add Logbook' : 'Update logbook';
    $this->params['breadcrumbs'][] = ['label' => 'Logbooks', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}    

Modal::begin([
    'title' => $this->title,
    'id' => 'modal-container',
    'size' => Modal::SIZE_LARGE,
    'centerVertical' => true,
]);
$this->registerJsVar('returnUrl', Url::to(['index']));
$js = "$(function(){ $('#modal-container').modal('show'); });
    $('#modal-container').on('hide.bs.modal', function(e){location.href = returnUrl});
    ";
$this->registerJs($js);
?>
<div class="logbook-create">    
    
    <div class="logbook-form">

        <?php $form = ActiveForm::begin(); ?>        

        <?= $form->field($model, 'content')->textArea(['maxlength' => 2000])->label(false) ?>
        
        <?= $form->field($model, 'fromCell')->hiddenInput()->label(false); ?>
        
        <?= $form->field($model, 'cell_id')->hiddenInput()->label(false); ?>
        
        <?= $form->field($model, 'contact_id')->hiddenInput()->label(false); ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
            <?= Html::resetButton('Clear text', ['class' => 'btn btn-info', 'style' => 'float:right']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
<?php Modal::end();  ?>