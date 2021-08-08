<?php

namespace backend\controllers;

use common\models\SubCategory;
use Yii;
use \yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider; 
use backend\models\SubCategoryForm;
use common\models\Category;

class SubCategoryController extends Controller
{
    // public PromotionService $promotion_service;

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
                        'roles' => ['admin', 'owner'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        
        $dataProvider = new ActiveDataProvider([
            'query'=>SubCategory::find()
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new SubCategoryForm();

        if($model->load(Yii::$app->request->post())){        
                $sub_category = new SubCategory();
                $sub_category->name = $model->name;
                $sub_category->description = $model->description;
                $sub_category->category_id=$model->category_id;
                if($sub_category->save()){
                    Yii::$app->session->addFlash('success', 'Подкатегория сохранена');
                }else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения подкатегории');
                }
                return $this->redirect(['/sub-category/index']);
        }
        $categories = Category::find()->all();
        $categories_array=[];
        foreach($categories as $category)
        {
            $categories_array[$category->id]=$category->name;
        }
        return $this->render('create',['model'=>$model,'categories_array'=>$categories_array,'sub_category_id'=> '']);
    }


    public function actionView($id){
        $sub_category = SubCategory::findOne(['id' => $id]);

        $model = new SubCategoryForm();
        
        $model->name=$sub_category->name;
        $model->description = $sub_category->description;
        $model->category_id=$sub_category->category_id;
        return $this->render('view',['model'=>$model,'categories_array'=>[],'sub_category_id'=> '']);
    }
    

    public function actionUpdate($id){
        $sub_category = SubCategory::findOne(['id' => $id]);

        $model = new SubCategoryForm();

        if($model->load(Yii::$app->request->post())){
                $sub_category->name = $model->name;
                $sub_category->description = $model->description;
                $sub_category->category_id = $model->category_id;
                if($sub_category->save()){
                    Yii::$app->session->addFlash('success', 'Подкатегория сохранена');
                }else {
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения подкатегории');
                }
                return $this->redirect(['/sub-category/index']);
        }
        $model->name=$sub_category->name;
        $model->description = $sub_category->description;
        $model->category_id=$sub_category->category_id;
        $categories = Category::find()->all();
        $categories_array=[];
        foreach($categories as $category)
        {
            $categories_array[$category->id]=$category->name;
        }
        return $this->render('create',['model'=>$model,'categories_array'=>$categories_array, 'sub_category_id'=> $id]);
    }


    public function actionDelete($id){
        $sub_category = SubCategory::findOne(['id' => $id]);
        if($sub_category->delete()){
            Yii::$app->session->addFlash('success', 'Подкатегория удалена');
        }else {
            Yii::$app->session->addFlash('error', 'Ошибка удаления подкатегории');
        }
        return $this->redirect(['/sub-category/index']);
    }
}
