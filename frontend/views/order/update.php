<?php

use common\models\Category;
use common\models\SubCategory;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;

?>


</style>
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
        <label>Категория : </label>
        <?=$category =  Category::findOne(['id' => $model->category_id])->name?><br>
        <label>Подкатегория : </label>
        <?=$category =  SubCategory::findOne(['id' => $model->sub_category_id])->name?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $form = ActiveForm::begin([
            'options'=> [
                'enctype' => 'multipart/form-data'
            ]
            ]);
            echo $form->field($model,'countOrder')->input('number',['style'=>'width:75px;','value'=>$model->countOrder]);
            ?>
             <?=Html::submitButton(
            'заказать',
            [
                'class' => 'btn btn-primary'
            ]    
            );?>
             <?= Html::a(
            'назад',
            Url::toRoute('/shop/index'),
            [
                'class' => 'btn btn-success pull-right',
                'id' => 'promotion-view-back'
            ]          
            );
            ?>
            <?php
            ActiveForm::end();

        ?>
    </div>
</div>