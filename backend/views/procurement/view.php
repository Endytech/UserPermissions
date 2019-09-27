<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Procurement */

$this->title = $model->procurement_id;
$this->params['breadcrumbs'][] = ['label' => 'Procurements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="procurement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->procurement_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->procurement_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'procurement_id',
            'procurement_creation_date',
            'procurement_owner',
            'procurement_status',
            'procurement_contract',
            'procurement_request',
            'shipment_start_date',
            'shipment_end_date',
            'procurement_tender',
        ],
    ]) ?>

</div>
