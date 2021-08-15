<?php

    namespace common\models;

    use yii\db\ActiveRecord;
    use common\models\Category;

    /**
     * @property int $id
     * @property int $count
     * @property int $product_id
     * @property int $order_id
     */

     class SubOrder extends ActiveRecord
     {
        public static function tableName()
        {
            return 'sub_orders';
        }

        public function rules()
        {
            return [];
        }
        public function getProduct(){
            return $this->hasOne(Product::className(),['id'=> 'product_id']);
        }
        public function getOrder(){
            return $this->hasOne(Product::className(),['id'=> 'order_id']);
        }
    }