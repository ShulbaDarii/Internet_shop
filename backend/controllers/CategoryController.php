<?php

namespace backend\controllers;

use Yii;
use \yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\CategoryForm;
use common\models\Category;
use service\categoryService;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\web\UploadedFile;

class CategoryController extends Controller
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
        //$category = Category::findOne(['id'=>1]);
        // var_dump($category->getSubCategories());
        // die();
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find()
        ]);
        return $this->render('index',['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new CategoryForm();
        if($model->load(Yii::$app->request->post())){   
            echo 'hello';
            die();     
                $category = new Category();
                $category->name = $model->name;
                $category->description = $model->description;
                if($category->save()){
                    Yii::$app->session->addFlash('success', 'Категория сохранена');
                }else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения категории');
                }
                return $this->redirect(['/category/index']);
        }

        return $this->render('create',['model'=>$model,'category_id'=> '']);
    }



    public function actionView($id){
        $category = Category::findOne(['id' => $id]);

        $model = new CategoryForm();
        
        $model->name=$category->name;
        $model->description = $category->description;
        return $this->render('view',['model'=>$model]);
    }

    public function actionUpdate($id){
        $category = Category::findOne(['id' => $id]);

        $model = new CategoryForm();

        if($model->load(Yii::$app->request->post())){
                $category->name = $model->name;
                $category->description = $model->description;
                if($category->save()){
                    Yii::$app->session->addFlash('success', 'Категория сохранена');
                }else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения категории');
                }
                return $this->redirect(['/category/index']);
        }
        $model->name=$category->name;
        $model->description = $category->description;
        return $this->render('create',['model'=>$model, 'category_id'=> $id]);
    }

    public function actionDelete($id){
        $category = Category::findOne(['id' => $id]);
        if($category->delete()){
            Yii::$app->session->addFlash('success', 'Категория удалена');
        }else {
            Yii::$app->session->addFlash('error', 'Ошибка удаления категории');
        }
        return $this->redirect(['/category/index']);
    }
}