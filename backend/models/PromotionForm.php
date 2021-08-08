<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class PromotionForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $imageFile;
    public $date_start;
    public $date_end;

    public function rules()
    {
        return [

            [['id','name','description','date_start','date_end'], 'string', 'message'=> 'неверный тип'],
            [['name','description'], 'required', 'message'=> 'значение обязательное'],
            [['imageFile'],'file','skipOnEmpty'=> false, 'extensions'=> 'png, jpg', 'message'=>'необходимо загрузить файл'],

            [['date_start'],'required','when' =>function($model){
                if(empty($model->date_end)||$model->date_end==''){
                    return false;
                }else{
                    return true;
                }
            },
            'whenClient' =>'function(){
                return !$("#promotionform-date_end").val()=="";
            }'],
            [['date_start','date_end'],'validateDate']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'название акции',
            'description' => 'Описание акции',
            'imageFile' => 'Картинка акции',
            'date_start'=>'Начало акции',
            'date_end'=>'Конец акции',
        ];
    }
    public function upload()
    {   
        if($this->validate())
        {
            $urlImage = $this->imagePath();
            $this->imageFile->saveAs($urlImage);
            return $urlImage;
        }
        return false;
    }

    public function imagePath()
    {
        if(!file_exists('../../uploads/')){
            mkdir('../../uploads/');
        }
        return '../../uploads/' . md5(microtime() . rand(0, 1000000000)) . '.' . $this->imageFile->extension;
    }

    public function validateDate(){
        if($this->date_start !== ""&& $this->date_end !== ""&& $this->date_start>=$this->date_end){
            $this->addError('date_start','Неправильно введена дата');
            $this->addError('date_end','Неправильно введена дата');
        }
    }
}
