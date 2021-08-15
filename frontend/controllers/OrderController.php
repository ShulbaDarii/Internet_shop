<?php

namespace frontend\controllers;

use common\models\Order;
use common\models\Product;
use common\models\SubOrder;
use frontend\models\OrderForm;
use frontend\models\ProductForm;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use Yii;


class OrderController extends Controller
{
    public function actionIndex()
    {
        $model = new OrderForm();
        $order = Order::findOne(['status'=>10,'user_id'=>Yii::$app->user->id]);
        if(!$order){
            $order = new Order();
            $order->user_id = Yii::$app->user->id;
            $order->data = date("d/m/y");
            $order->save();
        }
        if($model->load(Yii::$app->request->post()))
        {
                $order->data=$model->data;
                $order->status=8;
                $order->description=$model->description;
                if($order->save()){
                    Yii::$app->session->addFlash('success', 'Продукт добавлен');
                }else{
                    Yii::$app->session->addFlash('error', 'Ошибка добавлении продукта');
                }
                return $this->redirect(['/shop/index']);
        }
        $model->id=$order->id;
        $model->data=$order->data;
        // $model->data="sss";
        $dataProvider = new ActiveDataProvider([
            'query' => SubOrder::find()->where(['order_id'=>$order->id])
        ]);
        return $this->render('index',['model'=>$model,'dataProvider' => $dataProvider]);
    }

    public function actionUpdate($id)
    {
            $model = new ProductForm();
            $count = 1;
            $product = Product::findOne(['id'=>$id]);
            $order = Order::find()->where(['status'=>10,'user_id'=>Yii::$app->user->id])->one();
            if(!$order){
                $order = new Order();
                $order->user_id = Yii::$app->user->id;
                $order->data =date("d/m/y");
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
                    return $this->redirect(['/order/index']);
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
            return $this->render('update',['model'=>$model,'initial_prev'=>$initial_prev,'count'=> $count]);
    }
}