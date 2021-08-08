<?php

namespace backend\models;

use yii\base\Model;

class SubCategoryForm extends Model
{
    public $name;
    public $description;
    public $category_id;

    public function rules()
    {
        return [
            [['name','description'], 'string', 'message'=> 'неверный тип'],
            [['name','description','category_id'], 'required'],
            [['category_id','sub_category_id','count'], 'integer'],
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
