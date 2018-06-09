<?php
class StoryController extends Controller
{
    /**
     * 首页展示
     * @param string ‘’  ‘’
     */
    public function actionIndex()
    {
        $cateid = isset($_GET['cateid'])?$_GET['cateid']:1;
        $pageNumber = isset($_GET['page'])?$_GET['page']:1;

        $model = Story::model();
        $count = $model->countBySql("select count(*) from nb_story where cateid ={$cateid} and status = 1");

        $perPage = 10;
        $offset = ($pageNumber-1)*$perPage;

        $condition = new CDbCriteria;
        $condition->condition="cateid = {$cateid} and status = 1 order by id desc";
        $condition->limit=$perPage;
        $condition->offset=$offset;

        $data = $model->findAll($condition);

        /**
         * 调用YII分类类
         */
        $pager = new CPagination($count);
        $pager->pageSize=10;

        /**
         * 名人名言
         */
        $gid = rand(1,242);
        $sql = "select * from nb_good where id = {$gid}";
        $command = Yii::app()->db->createCommand($sql);
        $rs = $command->queryAll();
//        print_r($rs[0]);die;

        $this->renderPartial('index',['model'=>$model,'story'=>$data,'pager'=>$pager,'pageNumber'=>$pageNumber,'good'=>$rs[0]]);
    }

    public function actionDetail($id)
    {

        $model =Story::model();
        $data  = $model->findByPk($id);
        $this->renderPartial('detail',['detail'=>$data->content]);

    }


    public function actionDelete()
    {
        $page = $_GET['page'];
        $sid = $_GET['sid'];
        $cateid= $_GET['cateid'];
        $sql = "update nb_story set status = '0' where id = {$sid}";
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
        $this->redirect("index.php?r=admin/story/index/cateid/$cateid/page/$page");
    }

    public function actionDeleteM()
    {
        $sids = rtrim($_POST['sids'],',');
        $sql = "update nb_story set status = '0' where id in($sids)";
        $command = Yii::app()->db->createCommand($sql);
        $command->execute();
    }


    public function actionAdd()
    {
        $model = new Story;
        if(isset($_POST['Story']))
        {
            $model->attributes = $_POST['Story'];
            $model->content = $_POST['content'];
            if($model->save())
            {
                echo "1";
            }
            else
            {
                echo "0";
            }


        }

        $this->renderPartial('add',['model'=>$model]);
    }

    public function actionUpdate($sid)
    {
        $model = STORY::model();
        $info=$model->findByPk($sid);
        if(isset($_POST['Story']))
        {
            $info->attributes = $_POST['Story'];
            $info->content = $_POST['content'];
            if($info->save())
            {
                $this->redirect("index.php?r=admin/story/update/sid/$sid");
            }

        }
        $this->renderPartial('update',['model'=>$info]);

    }

}
?>