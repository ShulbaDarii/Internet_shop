<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Номер заказа',
                    'attribute' => 'id'
                ],
                [
                    'label' => 'Пожелания',
                    'attribute' => 'description'
                ],
                [
                    'label' => 'Дата доставки',
                    'attribute' => 'data'
                ],
                [
                    'label' => 'Статус',
                    'value' => function($model){
                        switch(ArrayHelper::getValue($model,'status',null))
                        {
                            case 0:
                                return 'удаленный';
                                break;
                            case 8:
                                return 'в обработке';
                                break;
                            case 9:
                                return 'доставлен';
                                break;
                            case 10:
                                 return 'в корзине';
                                 break;
                            default:
                            return ArrayHelper::getValue($model,'status',null);
                        }
                    }
                ],
                 ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',
                //     'options' => [
                //         'style' => 'width:20%',
                //     ],
                    'buttons' => [
                    'update' => function($url, $model, $key){
                        return Html::a('Редактировать',['update','id'=> ArrayHelper::getValue($model,'id')],['class'=>'btn btn-success']);
                    },
                    'delete' => function($url, $model, $key){
                        if(ArrayHelper::getValue($model,'status') != 0){
                        return Html::a('Удалить',['delete','id'=> ArrayHelper::getValue($model,'id')],['class'=>'btn btn-danger']);
                        }else{
                            return Html::a('Востановить',['recovery','id'=> ArrayHelper::getValue($model,'id')],['class'=>'btn btn-primary']);
                        }
                    },
                    ]
                ]
            ]
        ]);

        ?>
    </div>
</div>
