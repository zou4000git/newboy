<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="<?php echo ADMINJS;?>/jquery.min.js?v=2.1.4"></script>
</head>
<body>
<input type="file" id="inpuxtBox" >
<img src="" id="img">
</body>
<script>
    var inputBox = document.getElementById("inputBox");
    var img = document.getElementById("img");
    inputBox.addEventListener("change",function(){
        var reader = new FileReader();
        reader.readAsDataURL(inputBox.files[0]);//发起异步请求
        reader.onload = function(){
            //读取完成后，将结果赋值给img的src
            img.src = this.result
        }
    })
    // $('#inpuxtBox').change(function(){
    //    var reader = new FileReader();
    //     reader.readAsDataURL(inpuxtBox.files[0]);
    //     reader.onload = function(){
    //         img.src = this.result
    //     }
    // })


</script>
</html>