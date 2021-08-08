<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $user,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Ник',
                    'attribute' => 'username'
                ],
                [
                    'label' => 'Фамилия',
                    'attribute' => 'last_name'
                ],
                [
                    'label' => 'Имя',
                    'attribute' => 'first_name'
                ],
                [ 
                    'label' => 'Отчество',
                    'attribute' => 'second_name'
                ],
                [
                    'label' => 'Электронный адресс',
                    'attribute' => 'email'
                ],
                [
                    'label' => 'Роль',
                    'format'=>'html',
                    'value' => function($model){
                        $auth = Yii::$app->authManager; 
                        $roles = $auth->getRolesByUser(ArrayHelper::getValue($model,'id',false));
                        $result = '';
                        foreach($roles as $key =>$value)
                        {
                            switch($key){
                                case 'admin':
                                    $result .='администратор' . '<br>';
                                    break;
                                case 'owner':
                                    $result .='владелец' . '<br>';
                                    break;
                                case 'user':
                                    $result .='пользователь' . '<br>';
                                    break;
                                case 'content_manager':
                                    $result .='контент манеджер' . '<br>';
                                    break;
                                case 'seo_manager':
                                    $result .='сео манеджер' . '<br>';
                                    break;
                                default:
                                $result .=$key . '<br>';
                            }
                        }
                        return $result;
                    }
                ],
                [
                    'label' => 'Статус',
                    'value' => function($model){
                        switch(ArrayHelper::getValue($model,'status',null))
                        {
                            case 0:
                                return 'удаленный';
                                break;
                            case 9:
                                return 'не активный';
                                break;
                            case 10:
                                 return 'активный';
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
