<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>newboy后台登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo ADMINCSS; ?>/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="<?php echo ADMINCSS; ?>/animate.min.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/style.min862f.css?v=4.1.0" rel="stylesheet">

    <script>if (window.top !== window.self) {
            window.top.location = window.location;
        }</script>
    <style>
        @font-face {
            font-family: 'iconfont';  /* project id 532496 */
            src: url('//at.alicdn.com/t/font_532496_2fi6p0czol84cxr.eot');
            src: url('//at.alicdn.com/t/font_532496_2fi6p0czol84cxr.eot?#iefix') format('embedded-opentype'),
            url('//at.alicdn.com/t/font_532496_2fi6p0czol84cxr.woff') format('woff'),
            url('//at.alicdn.com/t/font_532496_2fi6p0czol84cxr.ttf') format('truetype'),
            url('//at.alicdn.com/t/font_532496_2fi6p0czol84cxr.svg#iconfont') format('svg');
        }

        .iconfont {
            font-family: "iconfont" !important;
            font-size: 13px;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            background: url('<?php echo ADMINIMG;?>/333.jpg') no-repeat fixed;
            background-size: 100% 100%;

        }

        .white {
            color: white;
        }

        .form-control {
            border-radius: 5px;
        }

        .page-footer {
            width: 100%;
            color: white;
            position: fixed;
            bottom: 0px;
            text-align: center;
            font-size: 15px;
            display: none;
        }
        .errorMessage
        {
            color: white;

            font-size: 10px;
            float: right;

        }
    </style>
</head>
<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <img style="width:150px;height:150px;margin-bottom:80%;border-radius: 50%"
                 src="<?php echo ADMINIMG; ?>/sign/4000.png" alt="">

        </div>

        <!-- <form class="m-t" role="form" action="./index.html">-->
        <?php $form = $this->beginWidget('CActiveForm', ['enableClientValidation' => true, 'clientOptions' => ['validateOnSubmit' => true]]); ?>

        <div class="form-group">
            <!--  <input type="email" class="form-control" placeholder="用户名" required="">-->
            <?php echo $form->textField($model, 'username', ['class' => 'form-control', 'placeholder' => '用户名']); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>
        <div class="form-group">
            <!--<input type="password" class="form-control" placeholder="密码" required="">-->
            <?php echo $form->passwordField($model, 'password', ['class' => 'form-control', 'placeholder' => '密码']); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
        <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
        <p class="text-muted text-center"><a href="login.html#">
                <small><span class="white">忘记密码了？</span></small>
            </a> | <a href="index.php?r=admin/user/register"><span class="white">注册一个新账号</span></a>
        </p>

        <?php $this->endWidget(); ?>
        <!-- </form>-->
    </div>
</div>
<script src="<?php echo ADMINJS; ?>/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo ADMINJS; ?>/bootstrap.min.js?v=3.3.6"></script>
<!--    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>-->
<div class="page-footer">
    <p>知识的体系结构类似一棵树, 如果你想要学得快记得牢固, 就必须把主干和粗线条先学习扎实, 因为后来的高级知识类似树叶, 需要有主干的支持才能挂靠牢固.</p>
</div>
</body>
<script>
    // $('img').hover(function () {
    //     $('.page-footer').fadeIn(2000);
    // }, function () {
    //     $('.page-footer').fadeOut(3000);
    // })
</script>
</html>
