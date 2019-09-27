<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Procurement */

$this->title = 'Create Procurement';
$this->params['breadcrumbs'][] = ['label' => 'Procurements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procurement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
