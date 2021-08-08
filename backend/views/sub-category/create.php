<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\select2\Select2;


?>

<div class="row">
    <div class="col-md-12">
        <h3>Добавить подкатегорию</h3>
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
        <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
            'data' => $categories_array,
            'options' => [
                'placeholder' => 'Выберете ...',
                'id' => 'category',
            ],
                'pluginOptions' => [                  
                'allowClear' => true,
                'multiple' => false
            ],
            ])->label('Категория');?>
        <div class="form-group">
            <?= Html::submitButton('СОХРАНИТЬ', ['class' => 'btn btn->primary'])?>
        </div>
            <?php
            ActiveForm::end();
            ?>
    
    </div>
</div>