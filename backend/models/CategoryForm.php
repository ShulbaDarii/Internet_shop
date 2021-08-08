<?php

namespace backend\models;

use yii\base\Model;

class CategoryForm extends Model
{
    public $name;
    public $description;

    public function rules()
    {
        return [
            [['name','description'], 'string', 'message'=> 'неверный тип'],
            [['name','description'], 'required', 'message'=> 'значение обязательное'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название категории',
            'description' => 'Описание категории',
        ];
    }

}
