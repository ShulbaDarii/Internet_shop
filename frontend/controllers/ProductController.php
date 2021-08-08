<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\Promotion;
use frontend\models\ProductForm;
use yii\web\Controller;
use Yii;

class ProductController extends Controller
{
    public function actionIndex($id)
    {
        $model = new ProductForm();
        $product = Product::findOne(['id'=>$id]);
        $model->name=$product->name;
        $model->description=$product->description;
        $model->count=$product->count;
        $model->category_id=$product->category_id;
        $model->price=$product->price;
        $model->sub_category_id=$product->sub_category_id;
        $initial_prev = [];
        $image_conf=[];

        $images= json_decode($product->url_images,true);

        if($images){
            foreach($images as $image){

                $initial_prev[] ='<img src="../../' .$image . '" style="height:300px;display: block;margin-left: auto; margin-right: auto;">';
                $name_file = explode('/', $image);
                $image_conf=[              
                        'key' => $name_file[count($name_file)-1],
                ];

            }
        }


        return $this->render('index',['model'=>$model,'initial_prev'=>$initial_prev,]);
    }
}