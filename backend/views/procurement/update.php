<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Procurement */

$this->title = 'Update Procurement: ' . $model->procurement_id;
$this->params['breadcrumbs'][] = ['label' => 'Procurements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->procurement_id, 'url' => ['view', 'id' => $model->procurement_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="procurement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
