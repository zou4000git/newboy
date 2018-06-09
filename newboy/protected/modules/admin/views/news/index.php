<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>列表页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo ADMINCSS; ?>/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/animate.min.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/diy.css" rel="stylesheet">
    <script src="<?php echo ADMINJS; ?>/jquery.min.js?v=2.1.4"></script>
    <style>
        .pageArea {
            position: fixed;
            bottom: 0px;
            margin-left: 24%;
            font-size: 13px;
            background: rgba(0, 0, 0, 0.09);

        }

        .yiiPager {
            list-style-type: none;
        }

        .yiiPager > li {
            float: left;
            width: 25px;
            margin-left: 5px;
            line-height: 20px;
            text-align: center;
        }

        .yiiPager > li > a {
            text-decoration: none;
            color: dimgray;
        }

        .color {
            width: 25px;
            text-align: center;
            background: gray;
        }

        .updateBtn > a {
            text-decoration: none;
            color: white;
            font-size: 10px;
            font-family: '华文细黑';
            background: gray;
            border-radius: 2px;
            padding: 5px;
        }

        .deleteBtn > a {
            text-decoration: none;
            color: white;
            font-size: 10px;
            font-family: '华文细黑';
            background: orangered;
            border-radius: 2px;
            padding: 5px;
        }

        #detail > .loadding {

            box-shadow: 5px 5px 5px #888888;
            border-radius: 5px;
            width: 200px;
            height: 20px;
            margin-left: 300px;
            margin-top: 150px;
            /*width:100%;*/
            /*height: 100%;*/
        }

        #detail {
            border: 1px solid gray;
            width: 800px;
            height: 400px;
            overflow-y: scroll;
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            margin-top: -200px;
            margin-left: -400px;
            background: whitesmoke;
            padding: 10px;
            z-index: 9999;
            border-radius: 5px;

        }
    </style>
</head>

<body class="gray-bg">
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-sm-3">
        所属栏目：新闻
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
                    <a id="all" class="btn btn-primary btn-xs">全选</a>
                    <a id="clall" style="display:none" class="btn btn-primary btn-xs">取消</a>
                    <a id="some" class="btn btn-primary btn-xs"> 删除</a>
                    <a href="index.php?r=admin/news/publish" class="btn btn-primary btn-xs">新增</a>
                    <a href="javascript:location.reload();" class="btn btn-primary btn-xs">刷新</a>
                </div>

                <div class="ibox-content">
                    <table class="table table-hover">

                        <tbody>
                        <?php foreach ($news as $v) { ?>
                            <tr>
                                <td value="22"><input type="checkbox" class="checkBox" value="<?php echo $v->id; ?>">
                                    <input class="vvv" type="hidden" value="<?php echo $v->id; ?>"></td>
                                <td><span class="line"><?php echo $v->id; ?></td>
                                <td><?php echo $v->title; ?></td>
                                <td><?php echo $v->author; ?></td>
                                <td style="color:gray;font-family:宋体;font-size: 12px;"><?php echo mb_substr(htmlentities($v->content), 0, 15, 'utf-8'); ?>
                                    …
                                </td>
                                <td class="xxx detailBtn">

                                    <a href="#" class="xxx"
                                       style="color:white;font-size: 10px;font-family:华文细黑;background: green;border-radius:2px;padding: 5px;">
                                        详情
                                        <input type="hidden" class="ooo" value="<?php echo $v->id; ?>">
                                    </a>

                                </td>
                                <td class="updateBtn">
                                    <a href="index.php?r=admin/news/update/nid/<?php echo $v->id; ?>">修改</a>
                                </td>
                                <td class="deleteBtn">
                                    <a onclick="return confirm('确定删除该条记录？');"
                                       href="index.php?r=admin/news/delete/nid/<?php echo $v->id; ?>">删除</a>
                                </td>


                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <div class="pageArea">
                        <?php $this->widget('CLinkPager', array(
                                'header' => '',
                                'firstPageLabel' => '◂◂',
                                'lastPageLabel' => '▸▸',
                                'prevPageLabel' => '◄',
                                'nextPageLabel' => '►',
                                'pages' => $pager,
                                'maxButtonCount' => 10,
                            )
                        ); ?>

                    </div>

                </div>

                <!-- end -->
            </div>
        </div>

    </div>
</div>
<div class="zzc"
     style="width:100%; height: 100%; background: rgba(0,0,0,0.6); position:fixed;top:0;display:none;z-index: 9998">

</div>
<div id="detail">
</div>
<script src="<?php echo ADMINJS; ?>/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo ADMINJS; ?>/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo ADMINJS; ?>/content.min.js?v=1.0.0"></script>
<script src="<?php echo ADMINJS; ?>/plugins/iCheck/icheck.min.js"></script>
<script>


    $(document).ready(function () {


        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green"}
        );


        $('#detail').click(function () {

            $("#detail").hide();
            $(".zzc").hide();
        });

        $(".xxx").click(function () {

            var nid = $(this).find('.ooo').val();
            //alert(nid);
            var url = "index.php?r=admin/news/detail";

            $.ajax({
                type: 'POST',
                url: url,
                data: "nid=" + nid,
                dataType: 'json',
                beforeSend: function () {
                    $('.zzc').show();
                    $('#detail').show();
                    $('#detail').html("<img class='loadding' src='<?php echo ADMINIMG ?>/15.gif'>");


                },
                success: function (msg) {

                    //console.log(msg);

                    $('.zzc').show();
                    $('#detail').show();
                    $('#detail').html(msg);

                }
            });

        });

        $('#all').click(function () {

            var checkBoxList = document.getElementsByClassName('checkBox');
            for (i = 0; i < checkBoxList.length; i++) {


                checkBoxList[i].checked = 1;
                $('#clall').show();
                $('#all').hide();

            }


        });

        $('#clall').click(function () {

            var checkBoxList = document.getElementsByClassName('checkBox');
            for (i = 0; i < checkBoxList.length; i++) {


                checkBoxList[i].checked = 0;
                $('#all').show();
                $('#clall').hide();

            }


        });

        $('#some').click(function () {
            var nids = "";
            var checkBoxList = $('.checkBox');
            for (i = 0; i < checkBoxList.length; i++) {
                if (checkBoxList[i].checked == 1) {
                    nids += checkBoxList[i].value + ",";
                }

            }

            $.ajax({
                type: 'POST',
                url: "index.php?r=admin/news/del",
                data: "nids=" + nids,
                dataType: 'json',
                success: function (msg) {


                }
            });
            window.location.href = "index.php?r=admin/news/index";
        })


    })

    //分页区域给当前页高亮显示
    var list = document.getElementsByClassName('page');
    var p = <?php echo $pageNumber;?>;
    for (i = 0; i < list.length; i++) {
        if (list[i].className == 'page selected') {
            //            console.log(list[i]);
            list[i].className = 'page selected color';
            list[i].firstChild.style.color = "white";
        }
    }

</script>
</body>
</html>