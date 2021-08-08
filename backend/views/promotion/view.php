<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <h3>Просмотр <?=$model->name?></h3>
    </div>
    <div class="col-md-6">
        <?= Html::img($initial_prev[0], ['alt' => '', 'style'=>"width:100%;height: 500px;"]) ?>

    </div>
    <div class="col-md-6">
        <h3>Описание</h3>
        <?=$model->description?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::a(
            'назад',
            Url::toRoute('/promotion/index'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-view-back'
            ]          
        )

        ?>
    </div>
</div>