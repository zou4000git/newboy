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
            padding: 0px;
            margin: 0px;
        }
        body
        {
            background: gray;
        }
        div
        {
            border:1px solid white;
            background: gray;
            text-align: center;
            height: 30px;
            line-height: 30px;
            color: white;
        }
        div:hover
        {
            background: whitesmoke;
            color: gray;
        }

    </style>
</head>
<body>

<table border="1" rules="all" width="100%">
    <?php  foreach($result as $k => $v){ ;?>
        <tr>
            <td>
                <div>
                    <?php echo $v ;?>
                </div>
            </td>
        </tr>
    <?php };?>
</table>


</body>
</html>