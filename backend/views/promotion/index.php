<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="col-md-12">
        <?= Html::a(
            'ДОБАВИТЬ АКЦИЮ',
            Url::toRoute('/promotion/create'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-create'
            ]          
        )

        ?>
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
                    'attribute' => 'name'
                ],
                [
                    'label' => 'Описание',
                    'attribute' => 'description'
                ],
                [
                    'label' => 'начало акции',
                    'attribute' => 'date_start'
                ],
                [
                    'label' => 'окончание акции',
                    'attribute' => 'date_end'
                ],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
                    'options' => [
                        'style' => 'width:20%',
                    ],
                    'buttons' => [
                        'view' => function($url, $model, $key){
                        return Html::a('Посмотреть',['view','id'=> $model->id],['class'=>'btn btn-primary']);
                    },
                    'update' => function($url, $model, $key){
                        return Html::a('Редактировать',['update','id'=> $model->id],['class'=>'btn btn-success']);
                    },
                    'delete' => function($url, $model, $key){
                        return Html::a('Удалить',['delete','id'=> $model->id],['class'=>'btn btn-danger']);
                    },
                    ]
                ]
            ]
        ]);

        ?>
    </div>
</div>
