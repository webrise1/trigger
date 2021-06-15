<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use webrise1\trigger\models\Trigger;
?>
<div class="trigger-form">
    <?php $form = ActiveForm::begin([]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList(Trigger::getStatuses()) ?>
    <?= $form->field($model, 'function_name')->dropDownList($model->ArrayMapFunctions) ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
