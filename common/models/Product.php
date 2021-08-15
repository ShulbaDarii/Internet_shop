<?php

    namespace common\models;

    use yii\db\ActiveRecord;

    /**
     * @property int $id
     * @property string $name
     * @property string $description
     * @property int $count
     * @property float $price
     * @property int $category_id
     * @property int $sub_category_id
     * @property string $url_image
     */

     class Product extends ActiveRecord
     {
        public static function tableName()
        {
            return 'products';
        }

        public function rules()
        {
            return [];
        }

        public function getCategory(){
            return $this->hasOne(Category::className(),['id'=> 'category_id']);
        }
        public function getSub_category(){
            return $this->hasOne(SubCategory::className(),['id'=> 'sub_category_id']);
        }
        public function getSubOrders()
        {
            return $this->hasMany(SubOrder::className(),['product_id','id']);
        }
     }