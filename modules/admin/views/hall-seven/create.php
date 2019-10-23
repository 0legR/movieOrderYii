<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HallSeven */

$this->title = 'Create Hall Seven';
$this->params['breadcrumbs'][] = ['label' => 'Hall Sevens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hall-seven-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
