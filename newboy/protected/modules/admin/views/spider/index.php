<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo ADMINCSS ;?>/ch-ui.admin.css">
    <link rel="stylesheet" href="<?php echo ADMINCSS ;?>/font-awesome.min.css">
    <script src="<?php echo ADMINJS ;?>/jquery.min.js"></script>
    <script src="layer/layer.js"></script>

</head>
<body>
<div class="result_wrap" style="height: 50px">

</div>

<div class="result_wrap">
    <form action=" " method="post">
        <table class="add_tab">
            <tbody>

            <tr>
                <th><i class="require">*</i>启动url：</th>
                <td>
                    <input type="text" class="lg url" name="url">
                    这里应该是一个资讯类列表页面……
                </td>

            </tr>
            <tr>
                <th><i class="require">*</i>获取url：</th>
                <td>
                    <input type="text" class="lg urls" name="urls">
                    获取该页面所有资讯连接……
                </td>
            </tr>
            <tr>
                <th><i class=""></i>允许url：</th>
                <td>
                    <input type="text" class="lg allowUrl" name="allowUrl">
                     可选，根据情况可以与匹配出来的url完成拼接……
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="button" value="检测" class="ckUrls">
                </td>
            </tr>

            <tr>
                <th><i class="require">*</i>获取标题：</th>
                <td>
                    <input type="text" class="lg title" name="title">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>获取作者：</th>
                <td>
                    <input type="text" class="lg author" name="author">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>获取时间：</th>
                <td>
                    <input type="text" class="lg time" name="time">
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>获取内容：</th>
                <td>
                    <input type="text" class="lg content" name="content">
                </td>
            </tr>





            <tr>
                <th></th>
                <td>
                    <input type="button" class="submit" value="提交">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

</body>
<script>
    $('.ckUrls').click(function(){
        var url = $('.url').val()
        var urls = $('.urls').val()
        var allowUrl = $('.allowUrl').val()
        if(url==0||urls==0)
        {
            layer.msg('似乎忘记了什么事情……');
        }
        else
        {
            layer.open({
                title:'',
                type: 2,
                skin: 'layui-layer-rim', //加上边框
                area: ['600px', '400px'], //宽高
                content: 'index.php?r=admin/spider/ckUrls&url='+url+'&urls='+urls+'&allowUrl='+allowUrl,
            });
        }
    })

    $('.submit').click(function(){
        var params = $('form').serialize();
        var url = $('.url').val()
        var urls = $('.urls').val()
        var allowUrl = $('.allowUrl').val()

        var title = $('.title').val()
        var author = $('.author').val()
        var time = $('.time').val()
        var content = $('.content').val()

        if(url==0||urls==0||title==0||author==0||time==0||content==0)
        {
            layer.msg('似乎忘记了什么事情……');
        }
        else
        {
            layer.open({
                title:'',
                type: 2,
                skin: 'layui-layer-rim', //加上边框
                area: ['800px', '500px'], //宽高
                content: 'index.php?r=admin/spider/run&'+params,
            });
        }


    })
</script>
</html>