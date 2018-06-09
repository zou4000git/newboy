<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>列表页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo ADMINCSS ;?>/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo ADMINCSS ;?>/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS ;?>/animate.min.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS ;?>/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS ;?>/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS ;?>/diy.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.1.1/css/bootstrap.min.css"/>
    <style>
        .pageArea
        {
            position:fixed;
            bottom:0px;
            margin-left: 24%;
            font-size:13px;
            background: rgba(0,0,0,0.09);
        }

        .yiiPager
        {
            list-style-type:none;
        }
        .yiiPager>li
        {
            float:left;
            width:25px;
            margin-left:5px;
            line-height:20px;
            text-align: center;
        }
        .yiiPager>li>a
        {
            text-decoration: none;
            color:dimgray;
        }
        .color
        {
            width:25px;
            text-align: center;
            background: gray;
        }


        .detail>span
        {
            color:white;
            cursor: pointer;
            background:green;
            font-size: 10px;
            font-family:'华文细黑';
            border-radius:2px;
            padding: 5px 10px;

        }
        .updateBtn>a
        {
            text-decoration: none;
            color:white;
            font-size: 10px;
            font-family:'华文细黑';
            background: gray;
            border-radius:2px;
            padding: 5px 10px;
        }

        .deleteBtn>a
        {
            text-decoration: none;
            color:white;
            font-size: 10px;
            font-family:'华文细黑';
            background: orangered;
            border-radius:2px;
            padding: 5px 10px;
        }
        .good
        {
            font-family:'宋体';
            color:slategray;
            font-size: 13px;
        }
    </style>
</head>

<body class="gray-bg">
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-sm-3" style="width:600px">
        <span class = "good"><?php echo $good['chinese'] ;?></span>
    </div>
    <div class="col-sm-9 pull-right">
        <div class="ibox-tools" style="width:300px;">
            <div class="input-group pull-right">
                <input type="text" placeholder="请输入关键词" class="input-sm form-control">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-primary">搜索</button>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <!-- begin -->

                <div class="ibox-title">
                    <!--                    <h5>STORY</h5>-->
                    <a href="javascript:void(0)" class="btn btn-primary btn-xs selectAll">全选</a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-xs cancelAll" style="display:none;">取消</a>

                    <a href="javascript:void(0)" class="btn btn-primary btn-xs deleteM">删除</a>
                    <!--                    <div class="ibox-tools">-->
                    <a href="index.php?r=admin/story/add" class="btn btn-primary btn-xs">新增</a>
                    <a href="javascript:location.reload();" class="btn btn-primary btn-xs">刷新</a>



<!--                    </div>-->
                </div>

                <div class="ibox-content">
                    <table class="table table-hover">
                        <tbody>

                        <?php foreach($story as $v){ ;?>
                            <tr>
                                <td><input type="checkbox" class="checkBox" value="<?php echo $v->id ;?>"></td>
                                <td><span class="line"><?php echo $v->id ;?></td>
                                <td style="color:darkslategray;font-family:宋体;font-size: 15px;"><?php echo $v->title ;?></td>
                                <td style="color:gray;font-family:宋体;font-size: 12px;width:40%;"><?php echo mb_substr(htmlentities($v->content),0,15,'utf-8') ;?>…</td>
                                <td class="detail"><input type="hidden" class="sid" value="<?php echo $v->id ;?>"><span><b>详情</b></span></td>
                                <td class="updateBtn"><a  href="index.php?r=admin/story/update/sid/<?php echo  $v->id ;?>"><b>修改</b></a></td>
                                <td class="deleteBtn"><a onclick="return confirm('确定删除该条记录？');"  href="index.php?r=admin/story/delete/cateid/<?php echo $v->cateid ;?>/page/<?php echo $pageNumber ;?>/sid/<?php echo $v->id ;?>"><b>删除</b></a></td>
                            </tr>
                        <?php } ;?>

                        </tbody>
                    </table>











                    <div class="pageArea">
                        <?php $this->widget('CLinkPager',array(
                                'header'=>'',
                                'firstPageLabel' => '◂◂',
                                'lastPageLabel' => '▸▸',
                                'prevPageLabel' => '◄',
                                'nextPageLabel' => '►',
                                'pages' => $pager,
                                'maxButtonCount'=>8,
                            )
                        ); ?>

                    </div>

                </div>

                <!-- end -->
            </div>
        </div>

    </div>
</div>
<script src="<?php echo ADMINJS ;?>/jquery.min.js"></script>
<script src="plugins/layer/layer.js"></script>

<script src="<?php echo ADMINJS ;?>/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo ADMINJS ;?>/content.min.js?v=1.0.0"></script>
<script src="<?php echo ADMINJS ;?>/plugins/iCheck/icheck.min.js"></script>
<script>
    $('.detail').click(function(){
        var sid = $(this).find(".sid").val();
        // layer.ready(function(){
        //     layer.open({
        //         type: 2,
        //         title: '  ',
        //         maxmin: true,
        //         area: ['800px', '500px'],
        //         content: 'index.php?r=admin/story/detail/id/'+sid,
        //     });
        // });
        layer.open({
            title:'文章详情',
            type: 2,
            //skin: 'layui-layer-rim', //加上边框
            area: ['800px', '500px'], //宽高
            content: 'index.php?r=admin/story/detail/id/'+sid,
        });

    })

    var list = document.getElementsByClassName('page');
    var p = <?php echo $pageNumber;?>;
    for(i=0;i<list.length;i++)
    {
        if(list[i].className=='page selected')
        {
//            console.log(list[i]);
            list[i].className='page selected color';
            list[i].firstChild.style.color="white";
        }

    }

    /**
     * 全选功能
     */
    $('.selectAll').click(function(){
        var nodeList = $('.checkBox');
        for(var i=0;i<nodeList.length;i++)
        {
            nodeList[i].checked=1;
        }
        $('.selectAll').hide();
        $('.cancelAll').show();
    })

    /**
     * 取消全选
     */
    $('.cancelAll').click(function(){
        var nodeList = $('.checkBox');
        for(var i=0;i<nodeList.length;i++)
        {
            nodeList[i].checked=0;
        }
        $('.selectAll').show();
        $('.cancelAll').hide();
    })

    /**
     * 删除选中
     */
    $('.deleteM').click(function(){
        var sids = "";
        var nodeList = $('.checkBox');
        for(var i =0;i<nodeList.length;i++)
        {
            if(nodeList[i].checked==1)
            {
                sids+= nodeList[i].value+",";

                /**
                 * 把选择的id 传给控制器做删除
                 */
                $.ajax({
                    type: 'POST',
                    url: "index.php?r=admin/story/deleteM",
                    data:"sids="+sids,
                    dataType: 'json',
                    success:function(msg)
                    {
                    }
                });
                window.location.href="index.php?r=admin/story/index/page/<?php echo $pageNumber;?>";

            }
        }

    })
</script>
</body>
</html>