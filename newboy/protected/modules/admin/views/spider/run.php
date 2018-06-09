<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *
        {
            margin: 0;
            padding: 0;
        }
        body
        {
            background: whitesmoke;
        }
        table
        {
            margin:0 auto;
            width: 80%;
            margin-top: 10px;
            text-align: center;
            display: block;
            border-radius: 5px;
            padding:5px;

        }
        .btn
        {
            background: gray;
            color: whitesmoke;
            width:65px;
            height:30px;
            position: fixed;
            right: 0;
            top: 10px;
            text-align: center;
            line-height: 30px;
        }
        .btn1
        {
            top: 40px;
        }
        .btn:hover
        {
            cursor: pointer;
        }
        select
        {
            width:100%;
            height: 100%;
        }
    </style>
    <script src="<?php echo ADMINJS ;?>/jquery.min.js"></script>
</head>
<body>
<div class="btn">
    <form action="index.php?r=admin/spider/add" method="post">
        <select name="lib" id="">
            <option value="story">story</option>
            <option value="news">news</option>
        </select>
        <input type="hidden"  name="json" class="json" value="<?php echo str_replace('"', "&quot;", $jsonRes);?>">
    </form>

</div>
<div class="btn btn1">
    入库
</div>
<?php foreach($results as $k =>$v){;?>
    <table border="1" rules="all">
        <div class="content">
            <tr>
                <td>
                    title
                </td>
                <td>
                    <?php echo $v['title'];?>
                </td>
            </tr>
            <tr>
                <td>
                    author
                </td>
                <td>
                    <?php echo $v['author'];?>
                </td>
            </tr>
            <tr>
                <td>
                    time
                </td>
                <td>
                    <?php echo $v['time'];?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding:5px;">
                    <?php echo $v['content'];?>
                </td>
            </tr>

        </div>
    </table>
<?php };?>



</body>
<script>
    $('.btn1').click(function(){
        $('form').submit();
    })
</script>
</html>