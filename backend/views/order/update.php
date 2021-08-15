<?php

use common\models\Order;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <h3>Заказ №<?=$model->id?><br></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Назва',
                    'attribute' => 'product.name'
                ],
                [
                    'label' => 'Количество',
                    'attribute' => 'count'
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',
                    'options' => [
                        'style' => 'width:20%',
                    ],
                    'buttons' => [
                    'update' => function($url, $model, $key){
                        return Html::a('Редактировать',['update','id'=> $model->product_id],['class'=>'btn btn-success']);
                    },
                    'delete' => function($url, $model, $key){
                        return Html::a('Удалить',['delete','id'=> $model->product_id],['class'=>'btn btn-danger']);
                    },
                    ]
                ]
            ]
        ]);

        ?>
    </div>
    <div class="col-md-6">
        <?php
        $form = ActiveForm::begin([
            'options'=> [
                'enctype' => 'multipart/form-data'
            ]
            ]);
            ?>
            <?=$form->field($model,'description')->textarea(['row'=> '5']);?>
            <?= $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => [
                Order::STATUS_ACTIVE => 'Активный',
                Order::STATUS_TREATMEAN =>'В обработке',
                Order::STATUS_DELIVERED =>'Доставленый',
                Order::STATUS_DELETED => 'Удаленный'
            ],
            'options' => ['placeholder' => 'Выберете ...'],
            'pluginOptions' => [
            'allowClear' => true,
            'multiple' => false
        ],
    ]);?>
    </div>
    <div class="col-md-6">
            <?= $form->field($model, 'data')->widget(DatePicker::classname(), [
                       'options' => ['placeholder' => 'Введите дату доставки'],
                       'pluginOptions' => [
                           'autoclose'=>true
                        ]
                   ]);?>
                    
             <?=Html::submitButton('Сохранить',['class' => 'btn btn-success  pull-right']    );?>
             <?= Html::a('назад',Url::toRoute('/order/index'),['class' => 'btn btn-primary pull-right','id' => 'promotion-view-back' ]          );?>
            <?php
            ActiveForm::end();

        ?>
    </div>
</div>
