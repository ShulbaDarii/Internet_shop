<?php

    namespace common\models;

    use yii\db\ActiveRecord;

    /**
     * @property int $id
     * @property string $name
     * @property string $description
     * @property string $url_image
     * @property string $date_start
     * @property string $date_end
     */

     class Promotion extends ActiveRecord
     {
        public static function tableName()
        {
            return 'promotions';
        }

        public function rules()
        {
            return [];
        }
     }