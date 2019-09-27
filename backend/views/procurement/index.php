<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProcurementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procurements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procurement-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Procurement', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'procurement_id',
            'procurement_creation_date',
            'procurement_owner',
            'procurement_status',
            'procurement_contract',
            //'procurement_request',
            //'shipment_start_date',
            //'shipment_end_date',
            //'procurement_tender',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
