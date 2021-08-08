<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\Promotion;
use yii\web\Controller;
use Yii;

class ShopController extends Controller
{
    public function actionIndex()
    {
        $promotions = Promotion::find()->all();
        $images_array =[];
        foreach($promotions as $promotion)
        {
            $images_array[] ='<img src="' . $promotion->url_image . '" style="height:300px;width:100%">
            <div class="carousel-caption d-none d-md-block">
            <h3>'.$promotion->name.'</h3>
            <p>'.$promotion->description.'</p></div>';
        }
        $products = Product::find()->all();
        return $this->render('index',['products'=>$products,'images_array'=>$images_array,'promotions'=>$promotions]);
        //echo Yii::getAlias('@app');
    }
}