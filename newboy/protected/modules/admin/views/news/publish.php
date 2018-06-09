<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>详情页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="<?php echo ADMINCSS;?>/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo ADMINCSS;?>/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS;?>/animate.min.css" rel="stylesheet">
    <link href="<?php echo ADMINCSS;?>/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="<?php echo ADMINCSS;?>/diy.css" rel="stylesheet">
    <style>
        .errorMessage{color:red;font-size:10px;margin-bottom:-10px;}
    </style>
</head>


<body class="gray-bg">
<div class="row border-bottom white-bg dashboard-header">
    <div class="col-sm-3">
        所属栏目：新闻
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <!-- begin -->

                <div class="ibox-title">
                    <h5>新闻发布</h5>
                    <small class="text-muted margin">&ensp;/ 发布</small>
                    <div class="ibox-tools">
                        <a href="javascript:history.back();"><i class="fa fa-history"></i> 返回上页</a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6">
<!--                            <form action="" class="form-horizontal m-t" method="post">-->
                                <?php $form=$this->beginWidget('CActiveForm',['htmlOptions'=>['class'=>'form-horizontal m-t']]); ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php  echo $form->labelEx($model,'title');?>
                                    </label>
                                    <div class="col-sm-9">
<!--                                        <input type="text" name="" class="form-control" placeholder="请输入文本">-->
                                            <?php echo  $form->textField($model,'title',['class'=>'form-control','placeholder'=>'请输入文章标题']);?>
                                        <?php echo $form->error($model,'title') ;?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php echo $form->labelEx($model,'cateid') ;?>

                                    </label>
                                    <div class="col-sm-9">
<!--                                        <input type="text" name="" class="form-control" placeholder="请输入文本">-->
                                            <?php echo  $form->dropDownList($model,'cateid',["5"=>'原创',"1"=>'网络'],['class'=>'form-control']);?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php  echo $form->labelEx($model,'author');?>
                                    </label>
                                    <div class="col-sm-9">
<!--                                        <input type="text" name="" class="form-control" placeholder="请输入文本">-->
                                            <?php echo  $form->textField($model,'author',['class'=>'form-control']);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php  echo $form->labelEx($model,'source');?>
                                    </label>
                                    <div class="col-sm-9">
<!--                                        <input type="text" name="" class="form-control" placeholder="请输入文本">-->
                                            <?php echo  $form->textField($model,'source',['class'=>'form-control']);?>
                                    </div>
                                </div>
<!--                                <div class="form-group">-->
<!--                                    <label class="col-sm-3 control-label">-->
<!--                                        --><?php // echo $form->labelEx($model,'addtime');?>
<!--                                    </label>-->
<!--                                    <div class="col-sm-9">-->
<!--<!--                                        <input type="text" name="" class="form-control" placeholder="请输入文本">-->
<!--                                        --><?php //echo  $form->textField($model,'addtime',['class'=>'form-control']);?>
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                        <?php  echo $form->labelEx($model,'content');?>
                                    </label>
                                    <div class="col-sm-9">
<!--                                      <textarea class="form-control" rows="5" placeholder="请输入文本"></textarea>-->
                                            <?php echo $form->textArea($model,'content',['class'=>'form-control','rows'=>5]) ;?>
                                            <?php echo $form->error($model,'content') ;?>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <a href="javascript:history.back();" class="pull-right">&lt;&lt;返回</a>
<!--                                        <button class="btn btn-primary">确定</button>-->
                                            <?php echo CHtml::submitButton('提交');?>
                                    </div>
                                </div>
<!--                            </form>-->
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>

                <!-- end -->
            </div>
        </div>

    </div>
</div>
<script>

</script>
<script src="<?php echo ADMINJS ;?>/jquery.min.js?v=2.1.4"></script>
<script src="<?php echo ADMINJS ;?>/bootstrap.min.js?v=3.3.6"></script>
<script src="<?php echo ADMINJS ;?>/content.min.js?v=1.0.0"></script>
</body>
</html>