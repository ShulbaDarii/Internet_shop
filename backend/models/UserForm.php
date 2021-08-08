<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UserForm extends Model
{
    public $username;
    public $email;
    public $first_name;
    public $second_name;
    public $last_name;
    public $roles;
    public $status;

    public function rules()
    {
        return [

            [['first_name','second_name','last_name'], 'string', 'message'=> 'неверный тип'],
            [['status'],'integer'],
            [['first_name','last_name','status'], 'required', 'message'=> 'значение обязательное'],
            [['roles'],'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Ник',
            'email'=>'электроная почта',
            'first_name'=> 'Имя',
            'second_name'=> 'Отчество',
            'last_name'=> 'Фамилия',
            'status'=>'Статус пользователя',
            'roles' => 'Роли пользователя'
        ];
    }

}
