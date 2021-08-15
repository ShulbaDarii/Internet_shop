<?php

    namespace common\models;

    use yii\db\ActiveRecord;

    /**
     * @property int $id
     * @property string $description
     * @property string $data
     * @property integer $status
     * @property int $user_id
     */

     class Order extends ActiveRecord
     {
        const STATUS_DELETED = 0;
        const STATUS_TREATMEAN = 8;
        const STATUS_DELIVERED = 9;
        const STATUS_ACTIVE = 10;

        public static function tableName()
        {
            return 'orders';
        }

        public function rules()
        {
            return [];
        }

        public function getUser(){
            return $this->hasOne(User::className(),['id'=> 'user_id']);
        }

        /**
         * {@inheritdoc}
         */
        public static function findIdentity($id)
        {
            return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        }
        public function getSubOrders()
        {
            return $this->hasMany(SubOrder::className(),['order_id','id']);
        }

     }