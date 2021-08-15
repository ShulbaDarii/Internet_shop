<?php

    namespace common\models;

    use yii\db\ActiveRecord;
    use common\models\Category;

    /**
     * @property int $id
     * @property string $name
     * @property string $description
     * @property int $category_id
     */

     class SubCategory extends ActiveRecord
     {
        public static function tableName()
        {
            return 'sub_categories';
        }

        public function rules()
        {
            return [];
        }
        public function getCategory(){
            return $this->hasOne(Category::className(),['id'=> 'category_id']);
        }
        public function getProducts()
        {
            return $this->hasMany(Product::className(),['sub_category_id','id']);
        }
    }