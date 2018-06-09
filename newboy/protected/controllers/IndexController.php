<?php

//前台模块
class IndexController extends Controller
{

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->select =  "english" ;
        $criteria->addCondition("id<3");


        $results = good::model()->findall($criteria);
        echo "<pre>";
        var_dump($results);
        //echo $results->english;


    }

    public function actionNews()
    {
        $this->renderPartial('news');
    }
}
