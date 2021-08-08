<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\date\DatePicker;

?>

<div class="row">
    <div class="col-md-12">
        <h3>Добавить акцию</h3>
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
            <div class='row'>
                <div class="col-md-6">
                    <?= $form->field($model, 'date_start')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Enter birth date ...'],
                        'pluginOptions' => [
                            'autoclose'=>true
                        ]
                    ]);?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'date_end')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Enter birth date ...'],
                        'pluginOptions' => [
                            'autoclose'=>true
                        ]
                    ]);?>
                </div>
            </div>
            <?php
            echo $form->field($model,'imageFile')->widget( FileInput::classname(),[
                'options'=>[
                    'accept' =>'image/*',
                    'multiple'=>false
                ],
                'pluginOptions' => [
                    'initialPreview'=>$initial_prev,
                    'initialPreviewConf'=>$image_conf,
                    'initialPreviewAsData'=>true,
                    'showCaption' =>false,
                    'showRemove' =>true,
                    'showUpload'=>false,
                    'removeClass'=> 'btn btn-default pull-right',
                    'browseClass'=> 'btn btn-primary pull-right',
                    'removeLabel' => 'Удалить',
                    'browseLabel' => 'Загрузить',
                    // 'initialCaption'=>"The Moon and the Earth",
                    // 'initialPreviewConfig' => [
                    //     ['caption' => 'Moon.jpg', 'size' => '873727'],
                    //     ['caption' => 'Earth.jpg', 'size' => '1287883'],
                    // ],
                    //'overwriteInitial'=>false,
                    'maxFileSize'=>2800,
                    'deleteUrl' =>Url::to(['/select-data/file-delete-promotion?id='. $promotion_id])
                ]
                ]);
        ?>

        <div class="form-group">
            <?= Html::submitButton('СОХРАНИТЬ', ['class' => 'btn btn->primary'])?>
        </div>
            <?php
            ActiveForm::end();
            ?>

    </div>
</div>