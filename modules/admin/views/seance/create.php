<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Seances */

$this->title = 'Create Seances';
$this->params['breadcrumbs'][] = ['label' => 'Seances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seances-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
