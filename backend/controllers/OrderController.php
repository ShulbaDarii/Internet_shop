<?php

namespace backend\controllers;

use backend\models\OrderForm;
use Yii;
use \yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Order;
use common\models\SubOrder;
use yii\data\ActiveDataProvider;


class OrderController extends Controller
{
    // public categoryService $category_service;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['logout', 'index', 'create'],
                        'allow' => true,
                        'roles' => ['admin', 'owner', 'seo_manager', 'content_manager'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()
        ]);
        return $this->render('index',['dataProvider' => $dataProvider]);
    }

    public function actionDelete($id)
    {
        $order = Order::findOne(['id'=>$id]);
        $order->status = Order::STATUS_DELETED;
        $order->save();
        //message
        return $this->redirect(['/order/index']);
    }

    public function actionRecovery($id)
    {
        $order = Order::findOne(['id'=>$id]);
        $order->status = Order::STATUS_ACTIVE;
        $order->save();
        //message
        return $this->redirect(['/order/index']);
    }

    public function actionUpdate($id)
    {
        $model = new OrderForm();
        $order = Order::findOne(['id'=>$id]);
        if($model->load(Yii::$app->request->post()))
        {
                $order->data=$model->data;
                $order->description=$model->description;
                $order->status=$model->status;
                if($order->save()){
                    Yii::$app->session->addFlash('success', 'Заказ обновлен');
                }else{
                    Yii::$app->session->addFlash('error', 'Ошибка обновления заказа');
                }
                return $this->redirect(['/order/index']);
        }
        $model->id=$order->id;
        $model->data=$order->data;
        $model->description=$order->description;
        $model->status=$order->status;
        $dataProvider = new ActiveDataProvider([
            'query' => SubOrder::find()->where(['order_id'=>$order->id])
        ]);
        return $this->render('update',['model'=>$model,'dataProvider' => $dataProvider]);
    }

 
}