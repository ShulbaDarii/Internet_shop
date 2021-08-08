<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <h3>Добавить категорию</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $form = ActiveForm::begin([
            'options'=> [
                'enctype' => 'multipart/form-data'
            ]
            ]);
            echo $form->field($model,'name')->textInput();
            echo $form->field($model,'description')->textarea(['row'=> '5']);
        ?>

        <div class="form-group">
            <?= Html::submitButton('СОХРАНИТЬ', ['class' => 'btn btn-primary'])?>
        </div>
            <?php
            ActiveForm::end();
            ?>

    </div>
</div>