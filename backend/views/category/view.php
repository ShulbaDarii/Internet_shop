<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <h2>Просмотр <?=$model->name?></h2>
        <h3>Описание</h3>
        <?=$model->description?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::a(
            'назад',
            Url::toRoute('/category/index'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-view-back'
            ]          
        )

        ?>
    </div>
</div>