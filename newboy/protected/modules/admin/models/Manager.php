<?php

class Manager extends CActiveRecord
{

    public $code;

    function tableName()
    {

        return "{{manager}}";

    }

    public static function model($className = __CLASS__)
    {

        return parent::model($className);


    }


    //表单验证
    public function rules()
    {
        return [
            ['name', 'required', 'message' => '昵称为空'],
            ['name', 'unique', 'message' => '该昵称被占用'],
            ['pwd', 'required', 'message' => '密码为空'],
            ['email', 'email', 'message' => '格式错误'],
            ['tel', 'checkTel'],
            ['code', 'checkCode']
        ];


    }

}

?>