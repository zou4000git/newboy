<?php
class Story extends CActiveRecord
{
    function tableName()
    {
        return '{{story}}';
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public function rules()
    {
        return [
            ['title','required','message'=>'error'],
            ['title','unique','message'=>'error'],
            ['author','required','message'=>'error'],
            ['cateid','safe','message'=>'error'],
            ['content','required','message'=>'error'],
        ];


    }





}
?>

















