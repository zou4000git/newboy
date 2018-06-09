<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>newboy后台登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo ADMINCSS; ?>/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="<?php echo ADMINCSS; ?>/animate.min.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/style.min862f.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->

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
            font-size: 16px;
            font-style: normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }

        body
        {
            /*background:url('*/<?php //echo ADMINIMG;?>/* /333.jpg') no-repeat fixed ;*/
            /*background-size: 100% 100%;*/
        }

        .t, .sendCodeStyle {
            width: 100px;
            border-radius: 3px;
            height: 34px;
            line-height: 34px;
            font-size: 13px;
            background: #1ab394;
            color: white;

            /*让字体不可被选中*/
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;

        }

        .t {
            display: none;
        }

        .sendCode:hover {
            background: deepskyblue;

            /*小手效果*/
            cursor: pointer;
        }

        .sendCode:active {

            background: dodgerblue;

        }

        .msg {
            font-size: 13px;
            display: block;
            float: right;
        }

        .form-control {
            margin-top: 22px;
        }
    </style>

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>

        <h3>NEWBOY</h3>


        <form class="m-t" role="form" method="post" action="index.php?r=admin/user/register">

            <div class="form-group">
                <input type="text" class="form-control name" name="name" placeholder="用户名" required="">
                <span class="msg"></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control pwd" name="pwd" placeholder="密码" required="">
                <span class="msg"></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control pwd2" name="pwd2" placeholder="确认密码" required="">

                <span class="msg"></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control email" name="email" placeholder="邮箱" required="">
                <span class="msg"></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control tel" name="tel" placeholder="电话" required="">
                <span class="msg"></span>
            </div>
            <div>
                <div style="width:60%;margin-bottom:10px;float:left;">
                    <input type="text" class="form-control code" name="code" placeholder="短信验证码" required="">

                </div>

                <div style="float:right;margin-top: 22px">

                    <div class="sendCodeStyle sendCode">
                        发送验证码
                    </div>
                    <div class="t">

                    </div>
                </div>

                <span class="msg" style="float: right"></span>
            </div>


            <button type="button" class="btn btn-primary block full-width m-b register">注 册</button>


            <p class="text-muted text-center"><a href="index.php?r=admin/user/login">有账号了？去登陆……</a>
            </p>

        </form>

    </div>
</div>

<script src="<?php echo ADMINJS; ?>/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo ADMINJS; ?>/bootstrap.min.js?v=3.3.6"></script>
<!--<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>-->
</body>
<script>
    var success = "<i class=\"iconfont\" style=\"color: green\" >&#xe62a;</i>";
    var error = "<i class=\"iconfont\" style=\"color: red\">&#xe629;</i>";
    var warning = "<i class=\"iconfont\" style=\"color: orange\">&#xe647;</i>";


    //短信验证码发送按钮
    var t = 59;

    function setTime() {
        if (t == 0) {
            t = 59;
            $('.t').hide();
            $('.sendCode').show();
            clearInterval(st);
        }
        $(".t").html(t);
        t--;
    }

    $(".sendCode").click(function () {
        if ($('.tel').val() !== '') {
            /**
             *如果输入电话正确就发送验证码
             */
            var tel = $('.tel').val();
            $.ajax({

                url: '/newboy/plugins/aliyun/demo/sendSms.php?tel=' + tel,
                type: 'get',
                success: function () {
                    $(".sendCode").hide();
                    $(".t").show();
                    $(".t").html(60);
                    st = setInterval("setTime()", 1000);
                }
            });
        }
        else {
            alert("请输入电话号码");
        }
    });


    $('.register').click(function () {

        if (ckName($('.name').val()) && ckPwd($('.pwd').val()) && ckPwd2($('.pwd2').val()) && ckEmail($('.email').val()) && ckTel($('.tel').val()) && ckCode($('.code').val())) {
            $('form').submit();
        }


    })

    function ckName(n) {
        if (n == '') {
            $('.name').parent().find('span').html(warning);
            return false;
        }
        else if (n.length < 2 || n.length > 15) {
            $('.name').parent().find('span').html('<span style=\"font-size: 12px;color: orange;\">2-15个字符</span>')
            return false;
        }
        else {
            var flag;
            $.ajax({
                'type': 'get',
                'async': false,
                'url': 'index.php?r=admin/user/ckName/name/' + n,
                'success': function (msg) {
                    if (msg == 500) {
                        $('.name').parent().find('span').html('<span style="font-size: 12px;color: orange;">已被占用</span>')
                        flag = false;
                    }
                    else {
                        $('.name').parent().find('span').html(success)
                        flag = true;
                    }
                }

            })

            return flag;
        }

    }

    function ckPwd(n) {
        if (n == '') {
            $('.pwd').parent().find('span').html(warning);
            return false;
        }
        else if (n.length < 2 || n.length > 15) {
            $('.pwd').parent().find('span').html('<span style=\"font-size: 12px;color: orange;\">2-15个字符</span>')
            return false;
        }
        else {
            $('.pwd').parent().find('span').html(success)
            return true;
        }

    }

    function ckPwd2(n) {

        if (n != $('.pwd').val()) {
            $('.pwd2').parent().find('span').html('<span style="font-size: 12px;color: orange;">两次输入不一致！请重新输入</span>')
        }
        else {
            $('.pwd2').parent().find('span').html(success)
            return true;
        }

    }

    function ckEmail(n) {
        var patt = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/;

        if (n == '') {
            $('.email').parent().find('span').html(warning);
            return false;
        }
        else if (patt.test(n)) {
            $('.email').parent().find('span').html(success)
            return true;
        }
        else {
            $('.email').parent().find('span').html('<span style=\"font-size: 12px;color: orange;\">格式错误</span>');
            return false;
        }

    }

    function ckTel(n) {
        var patt = /^1[3|4|5|7|8][0-9]\d{4,8}$/;
        if (n == '') {
            $('.tel').parent().find('span').html(warning);
            return false;
        }
        else if (patt.test(n)) {
            $('.tel').parent().find('span').html(success)
            return true;
        }
        else {
            $('.tel').parent().find('span').html('<span style="font-size: 12px;color: orange;">格式错误</span>');
            return false;
        }

    }

    function ckCode(n) {
        if (n == '') {
            $('.code').parent().parent().find('span').html(warning);
            return false;
        } else {
            var flag;
            $.ajax({
                'type': 'get',
                'async': false,
                'url': 'index.php?r=admin/user/ckCode/code/' + n,
                'success': function (msg) {
                    if (msg == 200) {
                        $('.code').parent().parent().find('span').html(success);
                        flag = true;
                    }
                    else {
                        $('.code').parent().parent().find('span').html(error);
                        flag = false;
                    }

                }
            })

            return flag;
        }
    }
</script>

<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
</html>
