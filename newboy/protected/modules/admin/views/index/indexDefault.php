<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>个人中心</title>
    <script src="<?php echo ADMINJS; ?>/jquery.min.js?v=2.1.4"></script>
    <script src="plugins/layer/layer.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .main {
            width: 1150px;
        }

        .left {

            margin-top: 10px;
            width: 600px;
            float: left;

        }

        .right {
            width: 500px;
            margin-top: 10px;
            float: right;
        }

        .info {
            margin-left: 30px;
            background: rgba(255, 255, 255, 0.7);
            width: 100%;
            height: 500px;
            border-radius: 5px;
            padding-top: 10px;

        }

        .name {
            border: 1px dashed gray;
            border-radius: 3px;
            margin-left: 10px;
            width: 400px;
            height: 150px;
            float: left;
            line-height: 150px;
            text-align: center;
            color: gray;
            font-size: 300%;
            font-family: 华文细黑;
        }

        .pic {
            /*border:1px solid red;*/
            width: 150px;
            height: 150px;
            float: right;
            margin-right: 10px;
        }

        .top {
            margin-top: 10px;
        }

        .bottom {
            width: 580px;
            /*border:1px dashed gray;*/
            margin-left: 10px;
            margin-top: 10px;
            height: 310px;
        }

        tr {
            height: 30px;

        }

        input {
            padding-left: 10px;
            border: 0;
            width: 97%;
            height: 30px;
            outline: none;
        }

        input {
            width: 97.9%;

        }

        tr {
            background: whitesmoke;

        }

        td {
            text-align: center;
        }

        .right {
            /*border: 1px solid red;*/
            margin-right: -50px;
        }

        .mhc {
            background: url(' <?php echo ADMINIMG;?> /2333.jpg') no-repeat fixed;
            background-size: 100% 100%;

            -webkit-filter: blur(10px); /* Chrome, Opera */
            -moz-filter: blur(10px);
            -ms-filter: blur(10px);
            filter: blur(3px);

            width: 100%;
            height: 100%;

            position: fixed;
            top: 0px;
            z-index: -1;

        }
    </style>
    <script src="/newboy/plugins/code/highcharts.js"></script>
    <script src="/newboy/plugins/code/modules/exporting.js"></script>
    <script>
        $(function () {

            $('tr:even').css('background', 'whitesmoke')
            $('input:even').css('background', 'whitesmoke')
            $('li:odd').css('background', 'whitesmoke')

        })

    </script>
</head>
<body>
<div class="mhc">

</div>
<div class="main">
    <!--左边内容-->
    <div class="left">
        <div class="info">
            <div class="top">
                <div class="name">
                    <?php echo $info->name; ?>
                </div>


                <div class="pic face">
                    <?php if ($info->face) {
                        ; ?>
                        <img alt="image" style="width:150px;height:150px;border-radius:3px;"
                             src="<?php echo $info->face; ?>"/>
                    <?php } else { ?>
                        <img alt="image" style="width:150px;height:150px;border-radius:3px;"
                             src="/newboy/upload/face/boy.png"/>
                    <?php } ?>
                </div>
                <!-- 清除浮动-->
                <div style="clear:both"></div>
            </div>
            <div class="bottom">
                <form action="index.php?r=admin/index/update" method="post">
                    <table border="1" rules="all" width="100%">
                        <tr>
                            <td>
                                电话
                            </td>
                            <td>
                                <input type="text" name="tel" value="<?php echo $info->tel; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                邮箱
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $info->email; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                信息
                            </td>
                            <td>
                                <input type="text" name="message" value="<?php echo $info->message; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" style="width: 100%; background: lightslategray; color:whitesmoke"
                                       value="确定">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

        </div>
    </div>
    <!--/左边内容-->

    <!--右边内容-->
    <div class="right">


        <div id="container"></div>


    </div>
    <!--/右边内容-->
    <!-- 清除浮动-->


</div>
</body>
<script>
    $('.face').click(function () {
        layer.open({
            title: '',
            type: 2,
            //skin: 'layui-layer-rim', //加上边框
            area: ['400px', '300px'], //宽高
            content: 'index.php?r=admin/index/updateFace',
        });
    })
    $('.face').hover(function () {
        layer.tips('点击更换头像', '.pic', {
            tips: [4, 'gray'],
            area: ['120px', 'auto'],
            time: 500
        });
    })

</script>
<script>
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },

        exporting: {
            enabled: false
        },
        credits: {
            enabled: false     //不显示LOGO
        },

        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [
                // {
                //     name: 'Chrome',
                //     y: 24.03,
                //     sliced: true,
                //     selected: true
                //
                // },
                {name: 'story', y: 4900},
                {name: 'picture', y: 233},
                {name: 'joke', y: 3000}
            ]

        }]
    });


</script>
</html>