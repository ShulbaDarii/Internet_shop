<?php

namespace backend\models;

use yii\base\Model;

class OrderForm extends Model
{
    public $id;
    public $description;
    public $price;
    public $user_id;
    public $data;
    public $status;


    public function rules()
    {
        return [

            [['id','description','data'], 'string'],
            [['description','user_id'], 'required' ],
            [['user_id','status'], 'integer'],
            [['price'],'number']
        ];
    }

    public function attributeLabels()
    {
        return [
            'description' => 'Дополнительные пожелания',
            'data'=>'Дата доставки',
            'price'=>'Цена'
        ];
    }


}
