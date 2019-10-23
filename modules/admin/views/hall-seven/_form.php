<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HallSeven */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hall-seven-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'row')->textInput() ?>

    <?= $form->field($model, 'seat')->textInput() ?>

    <?= $form->field($model, 'is_free')->textInput() ?>

    <?= $form->field($model, 'seance')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
