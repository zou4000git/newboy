<?php
class UserController extends Controller
{

    public function actionLogin()
    {
        
        $this->renderPartial('login');

    }
}


?>