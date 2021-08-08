<?php

namespace backend\controllers;

use Yii;
use \yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\PromotionForm;
use common\models\Promotion;
use service\PromotionService;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\web\UploadedFile;

class PromotionController extends Controller
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
                        'roles' => ['admin', 'owner', 'seo_manager', 'content_manager'],
                    ],
                ],
            ],
        ];
    }

    // public function __construct($id,$moduls,PromotionService $promotion_service, $config= [])
    // {
    //     parent::__construct($id,$moduls,$config);
    //     $this->promotion_service = $promotion_service;
    // }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Promotion::find()
        ]);
        return $this->render('index',['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new PromotionForm();

        if($model->load(Yii::$app->request->post())){
            $model->imageFile = UploadedFile::getInstance($model,'imageFile');
            
            if($urlImage=$model->upload()){
                //if($this->promotion_service->saveDB($model, $urlImage)){
                    $promotion = new Promotion();
                    $promotion->name = $model->name;
                    $promotion->description = $model->description;
                    $promotion->date_start = $model->date_start;
                    $promotion->date_end = $model->date_end;
                    $promotion->url_image = $urlImage;
                if( $promotion->save()){
                    Yii::$app->session->addFlash('success', 'Акция сохранена');
                }else{
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения акции');
                }
                return $this->redirect(['/promotion/index']);
            }
        }

        return $this->render('create',['model'=>$model,'initial_prev'=>[],'image_conf'=>[],'promotion_id'=> '']);
    }

    public function actionView($id){
        $promotion = Promotion::findOne(['id' => $id]);

        $model = new PromotionForm();
        
        $model->name=$promotion->name;
        $model->description = $promotion->description;
        $initial_prev = ['../../' . $promotion->url_image];
        return $this->render('view',['model'=>$model,'initial_prev' =>$initial_prev]);
    }

    public function actionUpdate($id){
        $promotion = Promotion::findOne(['id' => $id]);
        $model = new PromotionForm();
        $model->id=$id;
        if($model->load(Yii::$app->request->post())){
            $model->imageFile = UploadedFile::getInstance($model,'imageFile');
            
            if($urlImage=$model->upload()){
                //if($this->promotion_service->saveDB($model, $urlImage)){
                    $promotion->name = $model->name;
                    $promotion->description = $model->description;
                    $promotion->date_start = $model->date_start;
                    $promotion->date_end = $model->date_end;
                    if(file_exists($promotion->url_image)){
                        if($urlImage != $promotion->url_image)
                        {
                            unlink($promotion->url_image);
                        }
                    }  
                    $promotion->url_image = $urlImage;         
                if($promotion->save()){
                    Yii::$app->session->addFlash('success', 'Акция сохранена');
                }else{
                    Yii::$app->session->addFlash('error', 'Ошибка сохранения акции');
                }
                return $this->redirect(['/promotion/index']);
            }
        }
        $model->name=$promotion->name;
        $model->description = $promotion->description;
        $initial_prev = ['../../' . $promotion->url_image];
        $name_file = explode('/', $promotion->url_image);
        $image_conf=[
            [
                'key' => $name_file[count($name_file)-1],
            ]
        ];

        return $this->render('create',['model'=>$model,'initial_prev' =>$initial_prev,'image_conf'=>$image_conf, 'promotion_id'=> $id]);
    }

    public function actionDelete($id){
        $promotion = Promotion::findOne(['id' => $id]);
        $urlImage = $promotion->url_image;
        if($promotion->delete()){
            if(file_exists($urlImage)){
                unlink($urlImage);
            }
            Yii::$app->session->addFlash('success', 'Акция удалена');
        }else {
            Yii::$app->session->addFlash('error', 'Ошибка удаления акции');
        }
        return $this->redirect(['/promotion/index']);
    }
}
