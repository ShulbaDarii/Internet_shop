<?php

namespace frontend\controllers;

use common\models\Order;
use common\models\Product;
use common\models\Promotion;
use common\models\SubOrder;
use frontend\models\ProductForm;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class ProductController extends Controller
{
    public function actionIndex($id)
    {
        $model = new ProductForm();
        $count = 1;
        $product = Product::findOne(['id'=>$id]);
        $order = Order::find()->where(['status'=>10,'user_id'=>Yii::$app->user->id])->one();
        if(!$order){
            $order = new Order();
            $order->user_id = Yii::$app->user->id;
            $order->data = mktime(0, 0, 0, date("m")  , date("d")+7, date("Y"));
            $order->save();
        }
        $sub_order = SubOrder::find()->where(['order_id'=>$order->id,'product_id'=>$id])->one();
        if(!$sub_order){
            $sub_order=new SubOrder();
            $sub_order->count=1;
        }
        if($model->load(Yii::$app->request->post()))
        {
                $sub_order->order_id=$order->id;
                $sub_order->count=$model->countOrder;
                $sub_order->product_id=$id;
                if($sub_order->save()){
                    Yii::$app->session->addFlash('success', 'Продукт добавлен');
                }else{
                    Yii::$app->session->addFlash('error', 'Ошибка добавлении продукта');
                }
                return $this->redirect(['/shop/index']);
        }

        $model->countOrder=$sub_order->count;
        $model->name=$product->name;
        $model->description=$product->description;
        $model->count=$product->count;
        $model->category_id=$product->category_id;
        $model->price=$product->price;
        $model->sub_category_id=$product->sub_category_id;
        $initial_prev = [];

        $images= json_decode($product->url_images,true);

        if($images){
            foreach($images as $image){

                $initial_prev[] ='<img src="../../' .$image . '" style="height:300px;display: block;margin-left: auto; margin-right: auto;">';
            }
        }
        return $this->render('index',['model'=>$model,'initial_prev'=>$initial_prev,'count'=> $count]);
    }
}