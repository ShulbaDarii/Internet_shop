<?php

namespace service;

use common\models\Promotion;

class PromotionService
{
    public function saveDB($model,$urlImage){
        if($model->id){
            $promotion = Promotion::findOne(['id'=>$model->id]);
            if(file_exists($promotion->url_image)){
                if($urlImage != $promotion->url_image)
                {
                    unlink($promotion->url_image);
                }
            }           
        }else{
        $promotion = new Promotion();
        }
        $promotion->name = $model->name;
        $promotion->description = $model->description;
        $promotion->url_image = $urlImage;
        $promotion->date_start = $model->date_start;
        $promotion->date_end = $model->date_end;

        return $promotion->save();
    }
}