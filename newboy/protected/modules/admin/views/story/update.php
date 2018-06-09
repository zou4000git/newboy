<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo ADMINCSS; ?>/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/animate.min.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS; ?>/diy.css" rel="stylesheet">
    <script src="<?php echo ADMINJS; ?>/jquery.min.js?v=2.1.4"></script>
    <script type="text/javascript" src="/newboy/plugins/utf8-php/ueditor.config.js"></script>
    <script type="text/javascript" src="/newboy/plugins/utf8-php/ueditor.all.js"></script>
</head>

<body class="gray-bg">


<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <!-- begin -->

                <div class="ibox-title">
                    <h5>故事</h5>
                    <small class="text-muted margin">&ensp;/ 修改</small>
                    <div class="ibox-tools">
                        <a href="javascript:history.back();"><i class="fa fa-history"></i> 返回上页</a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php $form = $this->beginWidget('CActiveForm', ['htmlOptions' => ['class' => 'form-horizontal m-t'],]); ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">标题：</label>
                                <div class="col-sm-9">
                                    <?php echo $form->textField($model, 'title', ['class' => 'form-control input1 title', 'placeholder' => '故事标题']); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">作者：</label>
                                <div class="col-sm-9">

                                    <?php echo $form->textField($model, 'author', ['class' => 'form-control author', 'placeholder' => '你的名字']); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">类别：</label>
                                <div class="col-sm-9">

                                    <?php echo $form->dropDownList($model, 'cateid', ['1' => '哲理故事', '2' => '励志故事', '3' => '幽默故事', '4' => '寓言故事', '5' => '名人故事'], ['class' => 'form-control']); ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-3 control-label">内容：</label>
                                <div class="col-sm-9">
                                    <div style="width: 150%" class="editor">

                                        <script id="container" class="content" name="content" type="text/plain">
                                                <?php echo $model->content; ?>

                                        </script>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <input type="button" class="btn btn-primary" id="jqueryBtn" value="确定"/>
                                </div>
                            </div>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>

                <!-- end -->
            </div>
        </div>

    </div>
</div>
<script src="plugins/layer/layer.js"></script>
<script src="<?php echo ADMINJS; ?>/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo ADMINJS; ?>/content.min.js?v=1.0.0"></script>
<script type="text/javascript">
    var ue = UE.getEditor('container', {
        toolbars: [
            ['bold', 'time', 'insertimage']
        ],
    });
    $('#jqueryBtn').click(function () {

        var content = ue.getContent();
        var title = $('.title').val();
        var author = $('.author').val();
        if (title.length > 2 && title.length < 10 && author.length < 10 && author.length > 2 && content.length > 10) {
            $("form").submit();

        }
        else {
            layer.msg('填写不符合规范');
        }


    });
    $('.title').click(function(){
        layer.tips('2~10字数', '.title');
    })
    $('.author').click(function(){
        layer.tips('2~10字数', '.author');
    })
    $('.editor').hover(function(){
        layer.tips('10+字数', '.content');
    })

</script>
</body>
</html>