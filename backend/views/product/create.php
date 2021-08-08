<?php

use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;

$this->title = "Добавить товар";

$this->params['breadcrumbs'][]=['label'=>'Продусты','url'=>['index']];
$this->params['breadcrumbs'][]=$this->title;

if($model->sub_category_id)
{
    $init=true;
}else{
    $init=false;
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?=$this->title?></h4>
    </div>
    <div class="panel-body">
        <?php
            $form = ActiveForm::begin();
            ?>
            <div class="row">
                <div class="col-md-12">
                <?=$form->field($model,'name')->textInput()->label('Название товара');?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <?=$form->field($model,'description')->textarea(['row'=>'5'])->label('Описание товара');?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                
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
                </div>
                <div class="col-md-6">
                    <?= Html::hiddenInput('sel-subcategory',$model->category_id,['id'=>'sel-subcategory'])?>
                <?= $form->field($model, 'sub_category_id')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'data' => [],
                    'options' => [
                        'id' => 'sub_category',
                        'placeholder' => 'Начниете вводить название категории ...'
                    ],
                    'select2Options' => ['pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => false
                        ]],
                    'pluginOptions' => [
                        'depends' => ['category'],
                        'initialize' =>$init,
                        'url' => Url::to(['/select-data/sub-category']),
                        'params' => ['category','sel-subcategory'],
                        'loadingText'=>'Ожидайте загрузки ...'
                    ]
            ])->label('Подкатегории');?>
    
                 </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                     <?=$form->field($model,'count')->textInput(['type'=>'number','min'=>'0','step'=>'1'])->label('Количество товара');?>
                </div>
                <div class="col-md-6">
                      <?=$form->field($model,'price')->textInput(['type'=>'number','min'=>'0','step'=>'0.01'])->label('Цена товара');?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo $form->field($model,'images')->widget( FileInput::classname(),[
                        'options'=>[
                            'accept' =>'image/*',
                            'multiple'=>true,
                            'max'=> 10
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
                            'maxFileSize'=>2800,
                            //'deleteUrl' =>Url::to(['/select-data/file-delete-promotion?id='. $promotion_id])
                        ]
                        ])->label('Фото товара');
                    ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
            </div>
            <?php
             ActiveForm::end();
             ?>
    </div>

</div>