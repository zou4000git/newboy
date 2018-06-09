<?php
class NewsController extends Controller
{

    public function actionIndex()
    {

        echo "2b";


    }

    public function actionDetail()
    {

        $this->renderPartial('detail');

    }




}






?>