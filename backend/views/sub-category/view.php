<?php

use common\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <h2>Просмотр <?=$model->name?></h2>
        <h3>Описание</h3>
        <?=$model->description?>
        <h3>Категория</h3>
        <?=$category =  Category::findOne(['id' => $model->category_id])->name
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::a(
            'назад',
            Url::toRoute('/sub-category/index'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-view-back'
            ]          
        )

        ?>
    </div>
</div>