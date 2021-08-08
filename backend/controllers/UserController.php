<?php

namespace backend\controllers;

use backend\models\UserForm;
use Yii;
use \yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider; 
use common\models\User;

class UserController extends Controller
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

        $user =(new \yii\db\Query())
        ->select(['id','username','first_name','second_name','last_name','email','status'])
        ->from('user')
        ->all();
        $user = new ArrayDataProvider([
            'allModels'=>$user,
            'pagination' => [
                'pageSize' => 10,
            ]

        ]);

        return $this->render('index', ['user' => $user]);
    }

    public function actionDelete($id)
    {
        $user = User::findOne(['id'=>$id]);
        $user->status = User::STATUS_DELETED;
        $user->save();
        //message
        return $this->redirect(['/user/index']);
    }

    public function actionRecovery($id)
    {
        $user = User::findOne(['id'=>$id]);
        $user->status = User::STATUS_ACTIVE;
        $user->save();
        //message
        return $this->redirect(['/user/index']);
    }

    public function actionUpdate($id)
    {
        $user = User::findOne(['id'=>$id]);
        $model = new UserForm();
        $model->username= $user->username;
        $model->email= $user->email;
        $model->first_name= $user->first_name;
        $model->second_name= $user->second_name;
        $model->last_name= $user->last_name;
        $model->status=$user->status;
        $auth= Yii::$app->authManager;

        if($model->load(Yii::$app->request->post())&& $model->validate())
        {
            $user->last_name = $model->last_name;
            $user->first_name = $model->first_name;
            $user->second_name = $model->second_name;
            $user->status = $model->status;
            if($user->save()){
                $auth->revokeAll($id);
                foreach($model->roles as $value){
                    $role = $auth->getRole($value);
                    $auth->assign($role,$id);

                }
            }
            $this->redirect(['user/index']);
        }

        $roles = $auth->getRoles();
        $roles_array=[];
        foreach($roles as $key => $value)
        {
            switch($key){
                case 'admin':
                    $roles_array[$key]='администратор';
                    break;
                case 'owner':
                    $roles_array[$key]='владелец';
                    break;
                case 'user':
                    $roles_array[$key]='пользователь';
                    break;
                case 'content_manager':
                    $roles_array[$key]='контент манеджер';
                    break;
                case 'seo_manager':
                    $roles_array[$key]='сео манеджер';
                    break;
                default:
                $roles_array[$key]=$key;
            }
        }
        $roles =$auth->getRolesByUser($id);
        $model->roles =[];
        foreach($roles as $key => $value)
        {
            $model->roles[]=$key;
        }
        return $this->render('update',['model'=>$model,'roles_array'=>$roles_array]);

    }

}
