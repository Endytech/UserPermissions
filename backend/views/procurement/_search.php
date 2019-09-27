<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProcurementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="procurement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'procurement_id') ?>

    <?= $form->field($model, 'procurement_creation_date') ?>

    <?= $form->field($model, 'procurement_owner') ?>

    <?= $form->field($model, 'procurement_status') ?>

    <?= $form->field($model, 'procurement_contract') ?>

    <?php // echo $form->field($model, 'procurement_request') ?>

    <?php // echo $form->field($model, 'shipment_start_date') ?>

    <?php // echo $form->field($model, 'shipment_end_date') ?>

    <?php // echo $form->field($model, 'procurement_tender') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
