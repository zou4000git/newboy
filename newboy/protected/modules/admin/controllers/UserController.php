<?php

class UserController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm;

        if (isset($_POST['LoginForm'])) {
//            print_r($_POST);die;

            $model->attributes = $_POST['LoginForm'];


            if ($model->validate() && $model->login()) {
                setcookie('uname', $_POST['LoginForm']['username'], time() + 3600*24);
                $obj = new Login();


                $obj->set($_POST['LoginForm']['username']);


//                echo "<pre>";
//                var_dump($_SESSION);die;

                $this->redirect('index.php?r=admin/index/index');
            }

        }


        $this->renderPartial('adminLogin', ['model' => $model]);


    }

    /**
     * 后台注册系统
     */
    public function actionRegister()
    {
//        print_r($_COOKIE);die;

        $model = new Manager();

        if ($_POST) {
            //var_dump($_POST);
            $pwd = md5($_POST['pwd']);
            $sql = "insert into nb_manager (name, pwd, email, tel) values ('{$_POST['name']}', '{$pwd}', '{$_POST['email']}', '{$_POST['tel']}')";
            $command = Yii::app()->db->createCommand($sql);
            if ($command->execute()) {
                $this->redirect('index.php?r=admin/user/login');
            }
        }

        $this->renderPartial('adminRegister', ['model' => $model]);
    }


    public function actionLogout()
    {
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
        $this->redirect('index.php?r=admin/user/login');

    }


    public function actionCkCode()
    {
        session_start();
        $code = isset($_SESSION['code']) ? $_SESSION['code'] : "4000";
        if ($code == $_GET['code']) {
            echo "200";
        } else {
            echo "500";
        }

    }

    public function actionCkName()
    {
        $name = $_GET['name'];
        $isExist = Manager::model()->findBySql("select * from nb_manager  where name = '{$name}'");
        if ($isExist) {
            echo "500";
        } else {
            echo "200";
        }
    }

}


?>