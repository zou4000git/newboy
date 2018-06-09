<!DOCTYPE html>
<html>
<!-- Mirrored from www.zi-han.net/theme/hplus/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:16:41 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title>New Boy 后台管理系统 </title>

    <meta name="keywords" content="new boy">
    <meta name="description" content="喜欢游戏，热爱动漫，享受生活">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo ADMINCSS; ?>/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/animate.min.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/style.min862f.css?v=4.1.0" rel="stylesheet">
    <style>
        .identity {
            border-radius: 2px;
            color: white;
            font-size: 12px;
            padding: 3px;
            font-family: 华文细黑;
        }
    </style>
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                            <span>
                                <?php if ($face) {
                                    ; ?>
                                    <img alt="image" style="width:64px;height:64px;border-radius:50%"
                                         src="<?php echo $face; ?>"/>
                                <?php } else { ?>
                                    <img alt="image" style="width:64px;height:64px;border-radius:50%"
                                         src="/newboy/upload/face/boy.png"/>
                                <?php } ?>

                            </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                               <span class="block m-t-xs">
                                        &nbsp;&nbsp;&nbsp;
                                   <strong class="font-bold">
                                       <?php echo Yii::app()->user->name; ?>
                                   </strong>
                               </span>
                        </a>
                        <a class="identity" style="background:green;"><b>超级管理员</b></a>
                    </div>
                    <div class="logo-element">
                        NB
                    </div>
                </li>


                <!--爬虫程序-->
                <li>
                    <a href="#">

                        <span class="nav-label">爬虫</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/s/php">PHPcURL</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/spider/index">PHPxpath</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index_v2.html">Python</a>
                        </li>

                    </ul>

                </li>
                <!--/爬虫程序-->


                <!--新闻-->
                <li>
                    <a href="#">

                        <span class="nav-label">新闻</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <!--                            <li>-->
                        <!--                                <a class="J_menuItem" href="index.php?r=admin/news/index/cateid/0">原创</a>-->
                        <!--                            </li>-->
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/news/index">网络</a>
                        </li>


                    </ul>
                </li>
                <!--/新闻-->

                <!--讯息-->
                <li>
                    <a href="#">

                        <span class="nav-label">故事</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">

                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/story/index/cateid/1">哲理</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/story/index/cateid/2">励志</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/story/index/cateid/3">幽默</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/story/index/cateid/4">寓言</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/story/index/cateid/5">名人</a>
                        </li>


                    </ul>
                </li>
                <!--/讯息-->

                <!--图片-->
                <li>
                    <a href="#">

                        <span class="nav-label">图片</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/news/index">查看</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/news/publish">发布</a>
                        </li>


                    </ul>
                </li>
                <!--/图片-->
                <!--笑话-->
                <li>
                    <a href="#">

                        <span class="nav-label">笑话</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/news/index">冷笑话</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/news/publish">小段子</a>
                        </li>


                    </ul>
                </li>
                <!--/笑话-->
                <!--操作-->
                <li>
                    <a href="#">

                        <span class="nav-label">操作</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/news/index">发布</a>
                        </li>

                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/news/index">已删</a>
                        </li>


                    </ul>
                </li>
                <!--/操作-->
                <!--chat-->
                <li>
                    <a href="#">

                        <span class="nav-label">聊天</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/chat/index">chat</a>
                        </li>

                        <li>
                            <a class="J_menuItem" href="index.php?r=admin/news/index">已删</a>
                        </li>


                    </ul>
                </li>
                <!--/chat-->


                <li>
                    <a href="mailbox.html">

<!--                        <i class="fa fa-envelope"></i>-->

                        <span class="nav-label">信箱 </span>
                        <span class="label label-warning pull-right">16</span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="mailbox.html">收件箱</a>
                        </li>
                        <li><a class="J_menuItem" href="mail_detail.html">查看邮件</a>
                        </li>
                        <li><a class="J_menuItem" href="mail_compose.html">写信</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    <!-- <form role="search" class="navbar-form-custom" method="post" action="https://www.baidu.com/s?ie=utf-8&wd=bootstrap">
                        <div class="form-group">
                            <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form> -->
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="hidden-xs">
                        <a href="index_v1.html" data-index="0" target="_blank">
                            <i class="fa fa-home"></i> 前台首页
                        </a>
                    </li>

                    <!-- <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 主题
                        </a>
                    </li> -->
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">个人中心</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="index.php?r=admin/user/login" style="color:red;" class="roll-nav roll-right J_tabExit"><i
                        class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%"
                    src="index.php?r=admin/index/indexDefault" frameborder="0" data-id="index_v1.html"
                    seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">
                <?php echo Yii::app()->user->name; ?>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
    <div id="right-sidebar">
        <div class="sidebar-container">

            <ul class="nav nav-tabs navs-3">

                <li class="active">
                    <a data-toggle="tab" href="#tab-1">
                        <i class="fa fa-gear"></i> 主题
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="sidebar-title">
                        <h3><i class="fa fa-comments-o"></i> 主题设置</h3>
                        <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                    </div>
                    <div class="skin-setttings">
                        <div class="title">主题设置</div>
                        <div class="setings-item">
                            <span>收起左侧菜单</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox"
                                           id="collapsemenu">
                                    <label class="onoffswitch-label" for="collapsemenu">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定顶部</span>

                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox"
                                           id="fixednavbar">
                                    <label class="onoffswitch-label" for="fixednavbar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                                <span>
                                    固定宽度
                                </span>

                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox"
                                           id="boxedlayout">
                                    <label class="onoffswitch-label" for="boxedlayout">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--右侧边栏结束-->

</div>
<script src="<?php echo ADMINJS; ?>/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo ADMINJS; ?>/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo ADMINJS; ?>/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo ADMINJS; ?>/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo ADMINJS; ?>/plugins/layer/layer.min.js"></script>
<script src="<?php echo ADMINJS; ?>/hplus.min.js?v=4.1.0"></script>
<script src="<?php echo ADMINJS; ?>/contabs.min.js"></script>
<script src="<?php echo ADMINJS; ?>/plugins/pace/pace.min.js"></script>
</body>
</html>