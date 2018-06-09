<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        *
        {
            margin: 0;
            padding: 0;
        }
        body
        {
            background: lightslategray;
        }
        table
        {
            width: 1200px;
            margin: 10px auto;
            border-color: lightslategray;
            background: whitesmoke;
            border-radius: 10px;

        }
        td
        {
            padding: 10px;
        }
        .btn,.backBtn
        {
            width: 100px;
            height: 50px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            position: fixed;
            top: 10px;
            right: 10px;
            border-radius: 5px;
            text-align: center;
            line-height: 50px;

        }
        .backBtn
        {
            top: 70px;
        }
    </style>
    <script src="<?php echo ADMINJS;?>/jquery.min.js?v=2.1.4"></script>
</head>
<body>
<div class="btn">
    入 库
</div>
<div class="backBtn">
    返回
</div>

<?php foreach($contents as $k =>  $v){ ?>
    <table border="1" rules = "all">
        <tr>
            <td>
                title
            </td>
            <td>
                <?php  echo $v['title'] ;?>
            </td>
        </tr>
        <tr>
            <td>
                author
            </td>
            <td>
                <?php  echo $v['author'] ;?>
            </td>
        </tr>
        <tr>
            <td>
                time
            </td>
            <td>
                <?php  echo $v['time'] ;?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php  echo $v['content'] ;?>
            </td>

        </tr>
    </table>
<?php } ;?>
</body>
<script>
    $('.btn').click(function(){

        var contents = <?php echo json_encode($contents);?>;
        for(n in contents)
        {
            console.log(contents[n]);
        }


    })
    $('.backBtn').click(function(){
        history.go(-1)
    })

</script>
</html>