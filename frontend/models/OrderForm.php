<?php

namespace frontend\models;

use yii\base\Model;

class OrderForm extends Model
{
    public $id;
    public $description;
    public $price;
    public $user_id;
    public $data;


    public function rules()
    {
        return [

            [['id','description'], 'string'],
            [['description','user_id'], 'required' ],
            [['user_id'], 'integer'],
            [['price'],'number'],
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
