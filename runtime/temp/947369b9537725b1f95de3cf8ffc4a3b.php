<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"E:\phpstudy\WWW\chat\addons\epay\view\index\index.html";i:1531711638;s:57:"E:\phpstudy\WWW\chat\addons\epay\view\layout\default.html";i:1531711638;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>企业微信支付宝收款 - FastAdmin</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/assets/addons/epay/css/common.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo addon_url('example/index/index'); ?>">FastAdmin</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                </li>
                <?php if($user): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">欢迎你! <?php echo $user['nickname']; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo url('index/user/index'); ?>">会员中心</a>
                        </li>
                        <li>
                            <a href="<?php echo url('index/user/profile'); ?>">个人资料</a>
                        </li>
                        <li>
                            <a href="<?php echo url('index/user/logout'); ?>">退出登录</a>
                        </li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">会员中心 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo url('index/user/login'); ?>">登录</a>
                        </li>
                        <li>
                            <a href="<?php echo url('index/user/register'); ?>">注册</a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Header Carousel -->
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <a href="https://www.fastadmin.net/store/epay.html" target="_blank">
                <div class="fill"
                     style="background-image:url('https://bg.fastadmin.net?text=random&color=9b59b6');"></div>
                <div class="carousel-body">
                    <div class="container">
                        <h1 class="display-1 text-white">企业微信支付宝收款插件</h1>
                        <h2 class="display-4 text-white">提供微信、支付宝企业收款功能，实时通知和回调，可快速接入FastAdmin订单系统</h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="https://www.fastadmin.net/store/pay.html" target="_blank">
                <div class="fill"
                     style="background-image:url('https://bg.fastadmin.net?text=random&color=3498db');"></div>
                <div class="carousel-body">
                    <div class="container">
                        <h1 class="display-1 text-white">个人微信支付宝收款插件</h1>
                        <h2 class="display-4 text-white">
                            提供微信、支付宝个人收款功能，免备注，实时通知和回调，可快速接入FastAdmin或自有订单系统
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="https://www.fastadmin.net/store/cms.html" target="_blank">
                <div class="fill"
                     style="background-image:url('https://bg.fastadmin.net?text=random&color=3498db');"></div>
                <div class="carousel-body">
                    <div class="container">
                        <h1 class="display-1 text-white">CMS插件</h1>
                        <h2 class="display-4 text-white">简单强大的内容管理系统，可自定义内容模型、标签、伪静态、区块、个性化模板等功能<br>包含完整的小程序CMS客户端,拥有完善的资讯模块、产品模块、评论模块、会员模块
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="https://www.fastadmin.net/store/blog.html" target="_blank">
                <div class="fill"
                     style="background-image:url('https://bg.fastadmin.net?text=random&color=2ecc71');"></div>
                <div class="carousel-body">
                    <div class="container">
                        <h1 class="display-1 text-white">简单博客</h1>
                        <h2 class="display-4 text-white">响应式博客插件，包含日志、评论、分类、归档，包含完善的后台管理和前台功能<br/>包含完整的小程序博客客户端,拥有博客日志列表、日志详情、评论等功能
                        </h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="https://www.fastadmin.net/store/docs.html" target="_blank">
                <div class="fill"
                     style="background-image:url('https://bg.fastadmin.net?text=random&color=9c88ff');"></div>
                <div class="carousel-body">
                    <div class="container">
                        <h1 class="display-1 text-white">Markdown文档生成插件</h1>
                        <h2 class="display-4 text-white">将Github或本地Git环境中的Markdown文件解析并生成HTML，可在线浏览或导出为HTML离线浏览</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                开始接入
            </h2>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-check"></i> 准备工作</h4>
                </div>
                <div class="panel-body">
                    <p>支付定企业支付配置参数</p>
                    <p>微信企业支付配置参数</p>
                    <a href="https://www.fastadmin.net/store/epay.html" class="btn btn-success">下载插件</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-gift"></i> 开发工作</h4>
                </div>
                <div class="panel-body">
                    <p>在你的PHP代码中调用
                        <code>\addons\epay\library\Service::createPay('alipay')->web(订单数组信息)->send();</code>
                        进行支付</p>
                    <a href="https://www.fastadmin.net/store/epay.html" class="btn btn-success">查看文档</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-compass"></i> 立即体验</h4>
                </div>
                <div class="panel-body">
                    <p>请选择对应的支付金额和支付方式</p>
                    <p>
                        <span class="input-group">
                            <input type="number" name="amount" step="2" value="<?php echo mt_rand(1, 99)/100; ?>"
                                   class="form-control" placeholder="请输入一个随机金额"/>
                            <span class="input-group-addon" style="padding:0;width:100px;">
                                <select class="form-control" name="method" id="method" style="border:none;height: 32px;">
                                    <option value="web">PC网页支付</option>
                                    <option value="wap">手机网页支付</option>
                                    <option value="mp">公众号支付</option>
                                    <option value="app">APP支付</option>
                                    <option value="scan">扫码支付</option>
                                    <option value="mp">公众号支付</option>
                                    <option value="miniapp">小程序支付</option>
                                </select>
                            </span>
                        </span>
                    </p>
                    <button data-type="alipay" class="btn btn-info btn-experience">支付宝支付</button>
                    <button data-type="wechat" class="btn btn-success btn-experience">微信支付</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row addonlist">
        <div class="col-lg-12">
            <h2 class="page-header">模块&插件</h2>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="https://www.fastadmin.net/store/blog.html" target="_blank">
                <img class="img-responsive img-addon img-hover" src="https://cdn.fastadmin.net/uploads/addons/blog.png"
                     alt="">
                <p>博客模块</p>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="https://www.fastadmin.net/store/cms.html" target="_blank">
                <img class="img-responsive img-addon img-hover" src="https://cdn.fastadmin.net/uploads/addons/cms.png"
                     alt="">
                <p>CMS模块</p>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="https://www.fastadmin.net/store/pay.html" target="_blank">
                <img class="img-responsive img-addon img-hover" src="https://cdn.fastadmin.net/uploads/addons/pay.png"
                     alt="">
                <p>个人微信支付宝收款</p>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="https://www.fastadmin.net/store/docs.html" target="_blank">
                <img class="img-responsive img-addon img-hover" src="https://cdn.fastadmin.net/uploads/addons/docs.png"
                     alt="">
                <p>文档生成模块</p>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="https://www.fastadmin.net/store/filemanager.html" target="_blank">
                <img class="img-responsive img-addon img-hover"
                     src="https://cdn.fastadmin.net/uploads/addons/filemanager.png" alt="">
                <p>文件管理器插件</p>
            </a>
        </div>
        <div class="col-md-4 col-sm-6">
            <a href="https://www.fastadmin.net/store/qiniu.html" target="_blank">
                <img class="img-responsive img-addon img-hover" src="https://cdn.fastadmin.net/uploads/addons/qiniu.png"
                     alt="">
                <p>七牛上传插件</p>
            </a>
        </div>
    </div>
    <!-- /.row -->

    <hr>

    <!-- Call to Action Section -->
    <div class="well">
        <div class="row">
            <div class="col-md-8">
                <p>感谢你对FastAdmin的支持！如果你在使用FastAdmin开发插件的过程中有任何疑问或需要寻求帮助，请前往FastAdmin交流社区与小伙伴们一起交流。</p>
            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-default btn-block" href="https://forum.fastadmin.net"
                   target="_blank">立即前往社区</a>
            </div>
        </div>
    </div>

    <hr>

</div>

<div class="container">
    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; <a href="https://www.fastadmin.net">FastAdmin</a> 2018</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="https://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script src="/assets/addons/epay/js/common.js"></script>

</body>

</html>
