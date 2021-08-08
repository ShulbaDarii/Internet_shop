<?php

use common\models\Category;
use common\models\SubCategory;
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-12">
        <h3>Просмотр <?=$model->name?></h3>
    </div>
    <div class="col-md-6">
     <?=

     Carousel::widget([
    'items' => $initial_prev
]);
?>

    </div>
    <div class="col-md-6">
        <h3>Описание</h3>
        <?=$model->description?><br>
        <label>ЦЕНА : </label>
        <?=$model->price?><br>
        <label>Количество : </label>
        <?=$model->count?><br>
        <label>Категория : </label>
        <?=$category =  Category::findOne(['id' => $model->category_id])->name?><br>
        <label>Подкатегория : </label>
        <?=$category =  SubCategory::findOne(['id' => $model->sub_category_id])->name?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::a(
            'назад',
            Url::toRoute('/product/index'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-view-back'
            ]          
        )

        ?>
    </div>
</div>