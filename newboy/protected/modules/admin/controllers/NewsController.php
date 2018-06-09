<?php
class NewsController extends Controller
{
    public function actionIndex()
    {
        $cateid = isset($_GET['cateid'])?$_GET['cateid']:1;
        $pageNumber = isset($_GET['page'])?$_GET['page']:1;

        $newsModel = News::model();
        //分页
        $count = $newsModel->countBySql("select count(*) from nb_news where cateid ={$cateid} and status=1");
        $perPage = 10;
        $offset = ($pageNumber - 1)*$perPage;

        $condition = new CDbCriteria;
        $condition->condition="cateid = $cateid and status = 1 order by id desc";
        $condition->limit=$perPage;
        $condition->offset=$offset;


        //输出对应页码数据
        $data = $newsModel->findAll($condition);


        $pager = new CPagination($count);
        $pager->pageSize=10;

        $this->renderPartial('index',['news'=>$data,'pager'=>$pager,'pageNumber'=>$pageNumber]);
    }

    /**
     * 发布新闻
     */
    public function actionPublish()
    {

        $model = new News;



        if(isset($_POST['News']))
        {
//      foreach ($_POST['News'] as $k =>$v){
//        $model->$k=$v;
//      }

           //print_r($_POST);die;
            $model->attributes=$_POST['News'];
            if($model->save()){

               echo "1";
            }else{
                echo 'error';
            }
        }




        $this->renderPartial('publish',['model'=>$model]);




    }


    public function actionDetail()
    {
        $nid = $_POST['nid'];
        $newsModel = News::model();
        $sql="select * from nb_news where id = {$nid}";
         $data = $newsModel->findBySql($sql);

//        $data = ["name"=>'4000','age'=>23];
        echo json_encode($data->content);

    }
    /**
     * 修改新闻
     */
    public function actionUpdate($nid)
    {
        $model = News::model();
//        print_r($model);die;
        $info=$model->findByPk($nid);
//        print_r($info);die;
        if(isset($_POST['News']))
        {
//            print_r($_POST['News']);die;

            $info->attributes = $_POST['News'];

            if($info->save())
            {
                echo 'success';
            }
            else
            {
                echo 'error';
            }
        }


        $this->renderPartial('update',['model'=>$info]);
    }

    public function actionDelete()
    {

        $nid = $_GET['nid'];

    //  $model = News::model();

        $sql = "update nb_news set status = '0' where id = $nid";
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
        $this->redirect('index.php?r=admin/news/index');




    }

    public function actionDel()
    {
        $nids = rtrim($_POST['nids'],',');



        $sql = "update nb_news set status = '0' where id in($nids)";
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();




    }

}

?>