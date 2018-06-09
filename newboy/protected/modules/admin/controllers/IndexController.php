<?php

class IndexController extends Controller
{


    /**
     * 首页展示
     */
    public function actionIndex()
    {


        if (!isset($_COOKIE['uname'])) {
            $this->redirect('index.php?r=admin/user/login');
        } else {
            $uname = $_COOKIE['uname'];
        }

        $face = Manager::model()->findBySql("select face from nb_manager  where name = '{$uname}'")->face;
        $this->renderPartial('index', ['face' => $face]);

    }


    /**
     *
     */
    public function actionIndexDefault()
    {


        $uname = $_COOKIE['uname'];
        $info = Manager::model()->findBySql("select * from nb_manager  where name = '{$uname}'");

        $this->renderPartial('indexDefault', ['info' => $info]);

    }

    public function actionUpdate()
    {


        $uname = $_COOKIE['uname'];
        $sql = "update nb_manager set tel = '{$_POST['tel']}',email='{$_POST['email']}',message='{$_POST['message']}' where name = '{$uname}'";
        $command = Yii::app()->db->createCommand($sql);

        $command->execute();
        $this->redirect('index.php?r=admin/index/indexDefault');


    }

    public function actionUpdateFace()
    {
        if (!isset($_COOKIE['uname'])) {
            $this->redirect('index.php?r=admin/user/login');
        } else {
            $uname = $_COOKIE['uname'];
        }

        if ($_FILES) {
//           var_dump($_FILES);die;
            $file = $_FILES['face'];
            $fileName = $file['name'];

            $type = strrchr($fileName, '.');
            $allowType = ['.jpg', '.png', '.gif'];

            if (in_array($type, $allowType)) {

                $uploadPath = 'upload/face/';
                $newName = date('YmdHis', time()) . "_" . rand(0, 4000) . $type;

                if (move_uploaded_file($file['tmp_name'], $uploadPath . $newName)) {

                    $uname = $_COOKIE['uname'];
                    $picPath = '/newboy/' . $uploadPath . $newName;
                    $sql = "update nb_manager set face = '{$picPath}' where name = '{$uname}'";
                    $command = Yii::app()->db->createCommand($sql);
                    if ($command->execute()) {
                        echo "<script>window.top.location.reload();</script>";
                    }
                } else {
                    echo "Σ(ﾟдﾟ;)上传失败！";
                }

            }

        }


        $face = Manager::model()->findBySql("select face from nb_manager  where name = '{$uname}'")->face;
        $this->renderPartial('updateFace', ['face' => $face]);
    }

    public function actionTest()
    {
        $this->renderPartial('test');
    }

}

?>