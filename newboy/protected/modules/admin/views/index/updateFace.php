<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>更换头像</title>
    <style>
        .inputStyle
        {
            display:block;
            color:white;
            background:orange;
            width:100%;
            height:50px;
            text-align:center;
            line-height:50px;
            margin-bottom:10px;
            font-size:20px;
        }
        .btnStyle
        {

            display:block;
            width;100%;
            height:50px;
            line-height:50px;
            text-align:center;
            color:white;
            text-align:center;
            font-size:20px;
            background:lightslategray;
        }
    </style>
    <script src="<?php echo ADMINJS;?>/jquery.min.js?v=2.1.4"></script>
</head>
<body>
    <div class="main">
        <div class="top" style="text-align: center">

            <?php if($face){;?>
                <img alt="image" style="height: 160px; border-radius: 50%" id="img" src="<?php echo $face ;?>" />
            <?php }else{ ?>
                <img alt="image" style="height: 160px; border-radius: 50%" id="img" src="/newboy/upload/face/boy.png"/>
            <?php }?>



            <form  method="post" action="index.php?r=admin/index/updateFace" enctype="multipart/form-data">
                <label for="file" class="inputStyle">

                    选择
                    <input type="file" name="face" id="file"  style="display:none">
                </label>

                <label for="btn" class="btnStyle">
                    (╬ﾟдﾟ)▄︻┻┳═一确定？
                    <input type="submit" id="btn" value="提交" style="display:none">
                </label>

            </form>
        </div>
        <div class="bottom">
            
        </div>
    </div>
</body>
<script>
    var inputBox = document.getElementById("file");
    var img = document.getElementById("img");
    inputBox.addEventListener("change",function(){
        var reader = new FileReader();
        reader.readAsDataURL(inputBox.files[0]);//发起异步请求
        reader.onload = function(){

            //读取完成后，将结果赋值给img的src
            img.src = this.result
        }
    })
</script>
</html>