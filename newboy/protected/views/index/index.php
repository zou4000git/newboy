<!DOCTYPE HTML>
<html>
<head>
    <title>NEW BOY</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap -->
    <link href="<?php echo HOMECSS?>/bootstrap.min.css" rel='stylesheet' type='text/css' media="all" />
    <!-- //bootstrap -->
    <link href="<?php echo HOMECSS?>/dashboard.css" rel="stylesheet">
    <!-- Custom Theme files -->
    <link href="<?php echo HOMECSS?>/style.css" rel='stylesheet' type='text/css' media="all" />
    <script src="<?php echo HOMEJS?>/jquery-1.11.1.min.js"></script>
    <!--start-smoth-scrolling-->
    <!-- fonts -->
    <link href='#css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='#css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <style>
        .newboy
        {
            color: rgb(106, 196, 203);
        }
        .diy-nav
        {
            margin-left: -4%;
            margin-top: 5%;
        }
        .diy-nav>li
        {
            float: left;
            font-size: 14px;
            margin-left: 20px;
            margin-bottom: 20px;
            cursor:pointer;
            width:40px;
            border-radius: 5px;
            text-align: center;

        }
        .diy-nav>li:hover
        {
            background: green;
            color: white;

        }

    </style>
    <!-- //fonts -->
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void(0)"><h1 class="newboy"><img id="nav-show" style="height:60px;" src="<?php echo HOMEIMG;?>/logo.gif" alt="">&nbsp;&nbsp;&nbsp;NEW BOY</h1></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="top-search">
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Search...">
                    <input type="submit" value=" ">
                </form>

            </div>
            <div class="header-top-right">
                <div class="file">
                    <a href="upload.html">Upload</a>
                </div>
                <div class="signin">
                    <a href="#small-dialog2" class="play-icon popup-with-zoom-anim">注册</a>
                    <!-- pop-up-box -->
                    <script type="text/javascript" src="<?php echo HOMEJS?>/modernizr.custom.min.js"></script>
                    <link href="<?php echo HOMECSS?>/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
                    <script src="<?php echo HOMEJS?>/jquery.magnific-popup.js" type="text/javascript"></script>
                    <!--//pop-up-box -->
                    <div id="small-dialog2" class="mfp-hide">
                        <h3>Create Account</h3>
                        <div class="social-sits">
                            <div class="facebook-button">
                                <a href="#">Connect with Facebook</a>
                            </div>
                            <div class="chrome-button">
                                <a href="#">Connect with Google</a>
                            </div>
                            <div class="button-bottom">
                                <p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
                            </div>
                        </div>
                        <div class="signup">
                            <form>
                                <input type="text" class="email" placeholder="Mobile Number" maxlength="10" pattern="[1-9]{1}\d{9}" title="Enter a valid mobile number" />
                            </form>
                            <div class="continue-button">
                                <a href="#small-dialog3" class="hvr-shutter-out-horizontal play-icon popup-with-zoom-anim">CONTINUE</a>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div id="small-dialog3" class="mfp-hide">
                        <h3>Create Account</h3>
                        <div class="social-sits">
                            <div class="facebook-button">
                                <a href="#">Connect with Facebook</a>
                            </div>
                            <div class="chrome-button">
                                <a href="#">Connect with Google</a>
                            </div>
                            <div class="button-bottom">
                                <p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
                            </div>
                        </div>
                        <div class="signup">
                            <form>
                                <input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>
                                <input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
                                <input type="text" class="email" placeholder="Mobile Number" maxlength="10" pattern="[1-9]{1}\d{9}" title="Enter a valid mobile number" />
                                <input type="submit"  value="Sign Up"/>
                            </form>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div id="small-dialog7" class="mfp-hide">
                        <h3>Create Account</h3>
                        <div class="social-sits">
                            <div class="facebook-button">
                                <a href="#">Connect with Facebook</a>
                            </div>
                            <div class="chrome-button">
                                <a href="#">Connect with Google</a>
                            </div>
                            <div class="button-bottom">
                                <p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
                            </div>
                        </div>
                        <div class="signup">
                            <form action="upload.html">
                                <input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>
                                <input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
                                <input type="submit"  value="Sign In"/>
                            </form>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
<!--                    <div id="small-dialog8" class="mfp-hide">-->
<!--                        <h3>Subscribe to our newsletters</h3>-->
<!--                        <div class="signup subscribe-grid">-->
<!--                            <form>-->
<!--                                <input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>-->
<!--                                <input type="submit"  value="Subscribe"/>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div id="small-dialog4" class="mfp-hide">
                        <h3>Feedback</h3>
                        <div class="feedback-grids">
                            <div class="feedback-grid">
                                <p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
                            </div>
                            <div class="button-bottom">
                                <p><a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign in</a> to get started.</p>
                            </div>
                        </div>
                    </div>
                    <div id="small-dialog5" class="mfp-hide">
                        <h3>Help</h3>
                        <div class="help-grid">
                            <p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
                        </div>
                        <div class="help-grids">
                            <div class="help-button-bottom">
                                <p><a href="#small-dialog4" class="play-icon popup-with-zoom-anim">Feedback</a></p>
                            </div>
                            <div class="help-button-bottom">
                                <p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Lorem ipsum dolor sit amet</a></p>
                            </div>
                            <div class="help-button-bottom">
                                <p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Nunc vitae rutrum enim</a></p>
                            </div>
                            <div class="help-button-bottom">
                                <p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Mauris at volutpat leo</a></p>
                            </div>
                            <div class="help-button-bottom">
                                <p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Mauris vehicula rutrum velit</a></p>
                            </div>
                            <div class="help-button-bottom">
                                <p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Aliquam eget ante non orci fac</a></p>
                            </div>
                        </div>
                    </div>
                    <div id="small-dialog6" class="mfp-hide">
                        <div class="video-information-text">
                            <h4>Video information & settings</h4>
                            <p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
                            <ol>
                                <li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
                                <li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
                                <li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
                                <li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
                                <li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
                            </ol>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $('.popup-with-zoom-anim').magnificPopup({
                                type: 'inline',
                                fixedContentPos: false,
                                fixedBgPos: true,
                                overflowY: 'auto',
                                closeBtnInside: true,
                                preloader: false,
                                midClick: true,
                                removalDelay: 300,
                                mainClass: 'my-mfp-zoom-in'
                            });

                        });
                    </script>
                </div>
                <div class="signin">
                    <a href="#small-dialog" class="play-icon popup-with-zoom-anim">登录</a>
                    <div id="small-dialog" class="mfp-hide">
                        <h3>Login</h3>
                        <div class="social-sits">
                            <div class="facebook-button">
                                <a href="#">Connect with Facebook</a>
                            </div>
                            <div class="chrome-button">
                                <a href="#">Connect with Google</a>
                            </div>
                            <div class="button-bottom">
                                <p>New account? <a href="#small-dialog2" class="play-icon popup-with-zoom-anim">Signup</a></p>
                            </div>
                        </div>
                        <div class="signup">
                            <form>
                                <input type="text" class="email" placeholder="Enter email / mobile" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?"/>
                                <input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
                                <input type="submit"  value="LOGIN"/>
                            </form>
                            <div class="forgot">
                                <a href="#">Forgot password ?</a>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</nav>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="show-top-grids">
        <div class="col-sm-10 show-grid-left main-grids">
            <div class="diy-main-nav">
                <ul class="diy-nav" style="list-style: none;">
                    <li style="margin-left: 5px" class="diy-news">新闻</li>
                    <li class="diy-story">故事</li>
                    <li class="diy-video">视频</li>
                    <li class="diy-joke">笑话</li>
                </ul>
                <div style="clear: both"></div>
            </div>
            <div class="diy-video-nav" style="display: none;">
                <ul class="diy-nav" style="list-style: none;">
                    <li style="margin-left: 5px" onclick="jump(1)">游戏</li>
                    <li>动画</li>
                    <li>音乐</li>
                    <li>体育</li>
                    <li class="diy-back">返回</li>
                </ul>
                <div style="clear: both"></div>
            </div>
            <div class="diy-story-nav" style="display: none;">
                <ul class="diy-nav" style="list-style: none;">
                    <li style="margin-left: 5px">人生</li>
                    <li>哲理</li>
                    <li>名人</li>
                    <li class="diy-back">返回</li>
                </ul>
                <div style="clear: both"></div>
            </div>
            <div class="diy-joke-nav" style="display: none;">
                <ul class="diy-nav" style="list-style: none;">
                    <li style="margin-left: 5px">爆笑</li>
                    <li>幽默</li>
                    <li class="diy-back">返回</li>
                </ul>
                <div style="clear: both"></div>
            </div>
            <div class="diy-news-nav" style="display: none;">
                <ul class="diy-nav" style="list-style: none;">
                    <li style="margin-left: 5px" onclick="jump('news')">国内</li>
                    <li>国际</li>
                    <li class="diy-back">返回</li>
                </ul>
                <div style="clear: both"></div>
            </div>
            <div class="recommended">
                <div class="recommended-grids english-grid">
                    <div class="recommended-info">
                        <div class="heading">
                            <h3>音乐</h3>
                        </div>
<!--                        <div class="heading-right">-->
<!--                            <a  href="#small-dialog8" class="play-icon popup-with-zoom-anim">xxx</a>-->
<!--                        </div>-->
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/eg1.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>7:34</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">1,200 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/eg2.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>9:34</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">4,200 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/eg3.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>3:04</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">2,200 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/eg4.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>2:06</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">2,114 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/eg2.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>4:23</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">2,114 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/eg2.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>4:23</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">2,114 views</p>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="recommended">
                <div class="recommended-grids">
                    <div class="recommended-info">
                        <div class="heading">
                            <h3>搞笑</h3>
                        </div>
<!--                        <div class="heading-right">-->
<!--                            <a  href="#small-dialog8" class="play-icon popup-with-zoom-anim">Subscribe</a>-->
<!--                        </div>-->
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/my1.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>2:34</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">2,200 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/my2.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>3:45</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">1,200 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/my3.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>7:34</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">4,200 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/my4.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>6:30</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">2,200 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/my5.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>5:25</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">7,200 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/my6.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>6:45</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">5,786 views</p>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="recommended">
                <div class="recommended-grids">
                    <div class="recommended-info">
                        <div class="heading">
                            <h3>动画</h3>
                        </div>
<!--                        <div class="heading-right">-->
<!--                            <a  href="#small-dialog8" class="play-icon popup-with-zoom-anim">Subscribe</a>-->
<!--                        </div>-->
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/mt1.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>5:32</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">5,763 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/mt2.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>2:34</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">7,854 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/mt3.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>8:26</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">5,658 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/mt4.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>3:44</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views"> 7,897 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/mt5.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>4:46</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">5,576 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/mt6.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>5:14</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">2,476 views</p>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="recommended">
                <div class="recommended-grids">
                    <div class="recommended-info">
                        <div class="heading">
                            <h3>电影</h3>
                        </div>
<!--                        <div class="heading-right">-->
<!--                            <a  href="#small-dialog8" class="play-icon popup-with-zoom-anim">Subscribe</a>-->
<!--                        </div>-->
                        <div class="clearfix"> </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/ma1.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>5:09</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">1,897 views</p>
                          </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/ma2.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>6:23</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">9,565 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/ma3.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>3:34</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">9,576 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/ma4.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>5:23</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">4,675 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/ma5.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>5:04</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">9,443 views</p>
                        </div>
                    </div>
                    <div class="col-md-2 resent-grid recommended-grid show-video-grid">
                        <div class="resent-grid-img recommended-grid-img">
                            <a href="single.html"><img src="<?php echo HOMEIMG?>/ma6.jpg" alt="" /></a>
                            <div class="time small-time show-time">
                                <p>3:34</p>
                            </div>
                            <div class="clck show-clock">
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="resent-grid-info recommended-grid-info">
                            <h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
                            <p class="author"><a href="#" class="author">John Maniya</a></p>
                            <p class="views">4,545 views</p>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 show-grid-right" style="position: fixed;right: 10px;top: 22%;width:14%;">
            <h3>TOP</h3>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Spanish TV Shows</a></li>
                </ul>
            </div>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Italian TV Shows</a></li>
                </ul>
            </div>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Dutch TV Shows</a></li>
                </ul>
            </div>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Chinese TV Shows</a></li>
                </ul>
            </div>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Russian TV Shows</a></li>
                </ul>
            </div>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Hindi TV Shows</a></li>
                </ul>
            </div>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Telugu TV Shows</a></li>
                </ul>
            </div>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Tamil TV Shows</a></li>
                </ul>
            </div>
            <div class="show-right-grids">
                <ul>
                    <li class="tv-img"><a href="#"><img src="<?php echo HOMEIMG?>/tv.png" alt="" /></a></li>
                    <li><a href="#">Marathi TV Shows</a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>

</div>
<div class="clearfix"> </div>
<div class="drop-menu">
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu4">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Regular link</a></li>
        <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled link</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another link</a></li>
    </ul>
</div>
<!-- footer -->
<div class="footer" style="height:60px">
    <div class="footer-grids">
        <div class="footer-top">
            <div class="footer-top-nav">
                <ul>
                    <li><a href="about.html">关于</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">


        </div>
    </div>
</div>
<!-- //footer -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo HOMEJS?>/bootstrap.min.js"></script>
<script>
    $('.diy-video').click(function(){
        $('.diy-main-nav').hide();
        $('.diy-video-nav').show();

    })
    $('.diy-news').click(function(){
        $('.diy-main-nav').hide();
        $('.diy-news-nav').show();

    })
    $('.diy-joke').click(function(){
        $('.diy-main-nav').hide();
        $('.diy-joke-nav').show();

    })
    $('.diy-story').click(function(){
        $('.diy-main-nav').hide();
        $('.diy-story-nav').show();

    })

    $('.diy-back').click(function(){
        $(this).parent().parent().hide();
        $('.diy-main-nav').show();
    })

    function jump(x)
    {
        window.location.href="index.php?r=index/"+ x
    }
</script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
</body>
</html>