<?php

class News extends CActiveRecord
{
    function tableName()
    {

        return "{{news}}"; 
             
    }

    public static function model($className = __CLASS__)
    {   

        return parent::model($className);


    }

    public function attributeLabels()
    {
        return [
            'title' =>'标题',
            'cateid'=>'分类',
            'author'=>'作者',
            'source'=>'来源',
            'addtime'=>'时间',
            'content'=>'内容',



        ];

    }

    public function rules()
    {
        return [
            ['author','safe'],
            ['source','safe'],
            ['title','unique','message'=>"标题存在"],
            ['title','required','message'=>"标题不可为空"],
            ['content','required','message'=>'内容不可为空'],
            ['cateid','required'],
            ['title','length','min'=>'2','max'=>'15','tooShort'=>'名字太短了','tooLong'=>'标题太长不合适'],
            ['addtime','safe']
        ];

    }











}
?>