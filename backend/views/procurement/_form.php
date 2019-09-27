<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Procurement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="procurement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'procurement_creation_date')->textInput() ?>

    <?= $form->field($model, 'procurement_owner')->textInput() ?>

    <?= $form->field($model, 'procurement_status')->textInput() ?>

    <?= $form->field($model, 'procurement_contract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'procurement_request')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipment_start_date')->textInput() ?>

    <?= $form->field($model, 'shipment_end_date')->textInput() ?>

    <?= $form->field($model, 'procurement_tender')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
