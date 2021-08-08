<?php

namespace backend\controllers;

use common\models\Category;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Product;
use backend\models\ProductForm;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class ProductController extends Controller
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
            'query' => Product::find()
        ]);
        return $this->render('index',['dataProvider' => $dataProvider]);
    }

    public function actionCreate(){
        $model = new ProductForm();

        if($model->load(Yii::$app->request->post()))
        {
            $model->images = UploadedFile::getInstances($model,'images');
            if($images_path=$model->upload()){
                $product=new Product();
                $product->name=$model->name;
                $product->description=$model->description;
                $product->count=$model->count;
                $product->category_id=$model->category_id;
                $product->price=$model->price;
                $product->sub_category_id=$model->sub_category_id;
                $product->url_images = json_encode($images_path);
                if($product->save()){
                    
                }
                return $this->redirect(['/product/index']);
            }
            // echo \Yii::getAlias('@app');
            // die();
        }

        $categories = Category::find()->all();
        $categories_array=[];
        foreach($categories as $category)
        {
            $categories_array[$category->id]=$category->name;
        }
        return $this->render('create',[
            'model'=>$model,
            'categories_array'=>$categories_array,
            'initial_prev'=>[],
            'image_conf'=>[],
            'product_id'=> ''
        ]);
    }

    public function actionUpdate($id){
        $model = new ProductForm();
        $product = Product::findOne(['id'=>$id]);

        $model->name=$product->name;
        $model->description=$product->description;
        $model->count=$product->count;
        $model->category_id=$product->category_id;
        $model->price=$product->price;
        $model->sub_category_id=$product->sub_category_id;


        $categories = Category::find()->all();
        $categories_array=[];
        foreach($categories as $category)
        {
            $categories_array[$category->id]=$category->name;
        }
        $initial_prev = [];
        $image_conf=[];

        $images= json_decode($product->url_images,true);

        if($images){
            foreach($images as $image){

                $initial_prev[] = '../../' . $image;
                $name_file = explode('/', $image);
                $image_conf=[              
                        'key' => $name_file[count($name_file)-1],
                ];

            }
        }
        return $this->render('create',[
            'model'=>$model,
            'categories_array'=>$categories_array,
            'initial_prev'=>$initial_prev,
            'image_conf'=>$image_conf,
            'product_id'=> $id
        ]);
    }


    public function actionDelete($id){
        $product = Product::findOne(['id' => $id]);
        if($product->delete()){
            Yii::$app->session->addFlash('success', 'продукта удалена');
        }else {
            Yii::$app->session->addFlash('error', 'Ошибка удаления продукта');
        }
        return $this->redirect(['/product/index']);
    }

    public function actionView($id){
        $product = Product::findOne(['id' => $id]);

        $model = new ProductForm();
        
        $model->name=$product->name;
        $model->description = $product->description;
        $model->count = $product->count;
        $model->price = $product->price;
        $model->category_id=$product->category_id;
        $model->sub_category_id=$product->sub_category_id;




        $categories = Category::find()->all();
        $categories_array=[];
        foreach($categories as $category)
        {
            $categories_array[$category->id]=$category->name;
        }
        $initial_prev = [];
        $image_conf=[];

        $images= json_decode($product->url_images,true);

        if($images){
            foreach($images as $image){

                $initial_prev[] = '<img src="../../' . $image . '"style=width:100%;"/>';
                $name_file = explode('/', $image);
                $image_conf=[              
                        'key' => $name_file[count($name_file)-1],
                ];

            }
        }
        return $this->render('view',[
            'model'=>$model,
            'categories_array'=>$categories_array,
            'initial_prev'=>$initial_prev,
            'image_conf'=>$image_conf,
            'product_id'=> $id
        ]);
    }

}