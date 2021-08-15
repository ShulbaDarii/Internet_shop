<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <?=Html::a(
            'Добавить товар',
            Url::toRoute(['product/create']),
            [
                'class'=>'btn btn-success pull-right'
            ]
        )?>
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
                    'label' => 'Цена',
                    'attribute' => 'price'
                ],
                [
                    'label' => 'Количество',
                    'attribute' => 'count'
                ],
                [
                    'label' => 'Категория',
                    'attribute' => 'category.name'
                ],
                [
                    'label' => 'Подкатегория',
                    'attribute' => 'sub_category.name'
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
