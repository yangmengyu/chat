<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:70:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\goods\index.html";i:1542078486;s:70:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\common\meta.html";i:1542078486;s:69:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\common\nav.html";i:1542078486;s:72:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\common\footer.html";i:1542078486;s:72:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\common\script.html";i:1542078486;}*/ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<title><?php echo __('goods list'); ?> - <?php echo $site['name']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<?php if(isset($keywords)): ?>
<meta name="keywords" content="<?php echo $keywords; ?>">
<?php endif; if(isset($description)): ?>
<meta name="description" content="<?php echo $description; ?>">
<?php endif; ?>
<meta name="author" content="<?php echo __('The fastest framework based on ThinkPHP5 and Bootstrap'); ?>">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet" />
<!-- Bootstrap Core CSS -->

<link href="/assets/css/index.css" rel="stylesheet" />
<link href="/assets/addons/leescore/css/score-base.css" rel="stylesheet" />

<!-- Plugin CSS -->
<link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/simple-line-icons@2.4.1/css/simple-line-icons.css" rel="stylesheet" />

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
    </head>
    <body class="bg-grays">
		<div class="visible-xs order-mobile-top navbar-fixed-top">
			<div class="col-xs-1">
				<a href="<?php echo addon_url('leescore/index/index'); ?>">
					<i class="glyphicon glyphicon-menu-left"></i>
				</a>
			</div>
			<div class="col-xs-10"><?php echo __('goods list'); ?></div>
			<div class="col-xs-1 no-padding">
				<a href="/">
					<i class="glyphicon glyphicon-home"></i>
				</a>
			</div>
		</div>
		<div class="hidden-xs">
	<nav id="mainNav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed radius-none" style="height: 50px !important; color: #fff !important;" data-toggle="collapse" data-target="#navbar-collapse-menu">
					<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span class="icon-bar text-white"></span><span class="icon-bar"></span>
				</button>
				<a class="page-scroll" style="height: 50px;" href="<?php echo addon_url('leescore/index/index'); ?>"><img style="max-height: 45px;" class="img-responsive" src="/assets/img/logo.png" alt=""></a>
			</div>

			<div class="collapse navbar-collapse" id="navbar-collapse-menu">
				<ul class="nav navbar-nav navbar-right">
					<!-- <li><a href="/"><?php echo __('Home'); ?></a></li> -->
					<li><a href="<?php echo addon_url('leescore/index'); ?>"><?php echo __('store title'); ?></a></li>
					<li><a href="<?php echo addon_url('leedraw/index/index'); ?>"><?php echo __('Lucky Draw'); ?></a></li>
					<li><a href="<?php echo addon_url('leescore/order'); ?>"><?php echo __('store order'); ?></a></li>
					<li class="dropdown">
						<?php if($user): ?>
						<a href="<?php echo url('index/user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown" style="height: 50px;padding:10px 0;">
							<span class="avatar-img"><img style="height: 100%;" src="<?php echo $user['avatar']; ?>" alt=""> </span> <span style="height: 30px; line-height: 30px; text-transform: capitalize; letter-spacing: 0px;"><?php echo $user['username']; ?> (<?php echo $user['score']; ?> Points)<b class="caret"></b></span>
						</a>
						<?php else: ?>
						<a href="<?php echo url('index/user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('User center'); ?> <b class="caret"></b></a>
						<?php endif; ?>
						<ul class="dropdown-menu">
							<?php if($user): ?>
							<li><a href="<?php echo url('index/user/index'); ?>"><i class="fa fa-user-circle"></i><?php echo __('User center'); ?></a></li>
							<li><a href="<?php echo url('index/user/profile'); ?>"><i class="fa fa-user-o"></i><?php echo __('Profile'); ?></a></li>
							<li><a href="<?php echo url('index/user/changepwd'); ?>"><i class="fa fa-key"></i><?php echo __('Change password'); ?></a></li>
							<li><a href="<?php echo url('index/user/logout'); ?>"><i class="fa fa-sign-out"></i><?php echo __('Sign out'); ?></a></li>
							<?php else: ?>
							<li><a href="<?php echo url('index/user/login'); ?>"><i class="fa fa-sign-in"></i> <?php echo __('Sign in'); ?></a></li>
							<li><a href="<?php echo url('index/user/register'); ?>"><i class="fa fa-user-o"></i> <?php echo __('Sign up'); ?></a></li>
							<?php endif; ?>
						</ul>
					</li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language"></i> Language <b class="caret"></b></a>
                        <?php							

                        	$addon = input('?param.addon') ? input('param.addon') : "leescore";
                        	$controller = input('?param.controller') ? input('param.controller') :  request()->controller();
                        	$action = input('?param.action') ? input('param.action') : request()->action();
							$uri = $addon. "/". $controller. "/". $action;
							$arr = input('param.');
							unset($arr['addon']);
							unset($arr['controller']);
							unset($arr['action']);

							$cn_arr = $arr;
							$cn_arr['lang'] = 'zh-cn';

							$en_arr = $arr;
							$en_arr['lang'] = 'us-en';
							$cn = addon_url($uri, $cn_arr);
							$en = addon_url($uri, $en_arr);
                        ?>
                        <ul class="dropdown-menu">
                        	<li><a href="<?php echo $cn; ?>">简体中文</a></li>
                            <li><a href="<?php echo $en; ?>">English</a></li>
                        </ul>
                    </li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
</div>
        <div class="container padding page-content">
        	<div class="row">
	        	<div class="col-md-3 hidden-xs">
					<div class="goods-left">
						<div class="box box-danger radius-none">
							<div class="box-header with-border">
								<h3 class="box-title"><?php echo __('convert'); ?></h3>
							<!-- /.box-tools -->
							</div>
							<!-- /.box-header -->
							<div>
								<?php if(is_array($usenumdesc) || $usenumdesc instanceof \think\Collection || $usenumdesc instanceof \think\Paginator): $i = 0; $__LIST__ = $usenumdesc;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
									<div class="padding-top padding-bottom goods-detail-li <?php if(($i % 2 == 0)): ?>goods-double<?php endif; ?>">
										<div class="col-xs-5">
											<a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><img class="img-responsive center-block" style="max-height: 150px;" src="<?php echo $vo['thumb']; ?>" /></a>
										</div>
										<div class="col-xs-7 no-padding no-margin">
											<h4 class="more"><a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><?php echo $vo['name']; ?></a></h4>
											<div class="text-area row">
												<div class="col-xs-12 text-muted">
													<?php echo __('score'); ?>：<?php echo $vo['scoreprice']; ?>
												</div>
												<div class="col-xs-12 text-muted">
													<?php echo __('use stocks'); ?>：<?php echo $vo['usenum']; ?>
												</div>
											</div>
											<a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>" class="btn btn-danger btn-xs btn-block btn-flat"><?php echo __('buy'); ?></a>
										</div>
										<div class="clearfix"></div>
									</div>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-12">
					<!-- 面包屑路径导航 -->
						<ol class="breadcrumb hidden-xs">
							<li><a href="<?php echo addon_url('leescore/index/index'); ?>"><?php echo __('store title'); ?></a></li>
							<li class="active"><?php echo __('goods list'); ?></li>
						</ol>
					<!-- 面包屑路径导航 -->
					<div class="goods-right">
						<div class="clearfix search padding box box-danger radius-none">
							<form action="" name="myForm" class="form-horizontal myForm" method="get">
								<div class="col-sm-3">
									<div class="form-group">
										<label class="col-sm-4 control-label"><?php echo __('type'); ?></label>
										<div class="col-sm-8">
											<select class="form-control select2" id="type" name="type">
												<option <?php if(!input('?get.type')): ?>selected="selected"<?php endif; ?> value=""><?php echo __('all'); ?></option>
												<option <?php if(input('?get.type') AND input('get.type') == 0): ?>selected="selected"<?php endif; ?> value="0"><?php echo __('type product'); ?></option>
												<option <?php if(input('?get.type') AND input('get.type') == 1): ?>selected="selected"<?php endif; ?> value="1"><?php echo __('type virtual'); ?></option>
											</select>
											</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-sm-4 control-label"><?php echo __('flag type'); ?></label>
										<div class="col-sm-8">
											<select class="form-control select2" id="flag" name="flag">
												<option <?php if(!input('?get.flag')): ?>selected="selected"<?php endif; ?> value=""><?php echo __('all'); ?></option>
												<option <?php if(input('?get.flag') AND input('get.flag') == 'hot'): ?>selected="selected"<?php endif; ?> value="hot"><?php echo __('hot'); ?></option>
												<option <?php if(input('?get.flag') AND input('get.flag') == 'index'): ?>selected="selected"<?php endif; ?> value="index"><?php echo __('flag index'); ?></option>
												<option <?php if(input('?get.flag') AND input('get.flag') == 'new'): ?>selected="selected"<?php endif; ?> value="new"><?php echo __('flag new'); ?></option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label class="col-sm-2 col-xs-12 control-label"><?php echo __('score'); ?></label>
										<div class="col-sm-4 col-xs-5">
											<input type="Number" id="score-start" name="score-start" class="form-control" <?php if(input('?get.score-start')): ?>value="<?php echo input('get.score-start'); ?>"<?php endif; ?> placeholder="0">
										</div>
										<div class="col-sm-4 col-xs-5">
											<input type="Number" id="score-end" name="score-end" class="form-control" <?php if(input('?get.score-end')): ?>value="<?php echo input('get.score-end'); ?>"<?php endif; ?> placeholder="100" />
										</div>
										<div class="col-sm-2 col-xs-12 ">
											<div class="visible-xs margin-top clearfix">
												<button class="btn btn-danger btn-flat radius-xs btn-block search" type="button"><?php echo __('search'); ?></button>
											</div>
											<div class="hidden-xs">
												<button class="btn btn-danger btn-flat radius-xs search" type="button"> <i class="fa fa-search"></i></button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="page-header">
							<div class="text-right">
								<label class="h4 hidden-xs"><?php echo __('order'); ?>：</label>
								<button type="button" data-field="updatetime" data-status="" class="btn btn-xs btn-flat bg-maroon order-btn active"><?php echo __('order by time'); ?></button>
								<button type="button" data-field="usenum" data-status="" class="btn btn-xs btn-flat bg-maroon order-btn"><?php echo __('order by usenum'); ?></button>
								<button type="button" data-field="scoreprice" data-status="" class="btn btn-xs btn-flat bg-maroon order-btn"><?php echo __('order by scoreprice'); ?></button>
								<button type="button" data-field="stock" data-status="" class="btn btn-xs btn-flat bg-maroon  order-btn"><?php echo __('order by stock'); ?></button>
							</div>
						</div>
						<div class="goods-list">
						</div>
						<div class="col-sm-12 padding text-center page">
						</div>
					</div>
				</div>
			</div>
        </div>
        
<div class="clearfix"></div>

<div class="visible-xs">
	<br>
	<br>
	<nav class="bottom-nav">
		<div class="visible-xs nav-bottom-mobile navbar-fixed-bottom text-center">
<!-- 			<div class="col-xs-3 no-padding">
	<a href="/" target="_blank"><i class="fa fa-home"></i> <?php echo __('Home'); ?></a>
</div> -->
			<div class="col-xs-4 no-padding">
				<a href="<?php echo addon_url('leescore/index'); ?>"><i class="fa fa-home"></i> <?php echo __('Home'); ?></a>
			</div>
			<div class="col-xs-4 no-padding">
				<a href="<?php echo addon_url('leescore/order'); ?>"><i class="fa fa-shopping-cart"></i> <?php echo __('store order'); ?></a>
			</div>
			<div class="col-xs-4 no-padding">
				<a href="<?php echo url('index/user/index'); ?>"><i class="fa fa-user-circle"></i> <?php echo __('User center'); ?></a>
			</div>
		</div>
	</nav>
</div>

<div class="hidden-xs">
	<footer class="foot-leescore clearfix">
	    <p class="copyright">Copyright&nbsp;©&nbsp;<?php echo $site['name']; ?> <?php echo date('Y',time());?>. All Rights Reserved. <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $site['beian']; ?></a></p>
	</footer>
</div>
        <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.1.4/dist/jquery.min.js"></script>

<!-- jQuery Cookie -->
<script src="https://cdn.jsdelivr.net/npm/jquery.cookie@1.4.1/jquery.cookie.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

<!-- Jquery.touchSwipe -->
<script src="https://cdn.bootcss.com/jquery.touchswipe/1.6.18/jquery.touchSwipe.min.js"></script>


        <script>
        	$(document).ready(function() {
        		$(".recommend-li").last().removeClass('recommend-li');
        		$(".search").on('click', function() {
	        		//查询条件
	        		var flag = $("#flag").val();
	        		var type = $("#type").find("option:selected").val();
	        		var start = $("#score-start").val();
	        		var end = $("#score-end").val();
	        		var param = {"flag":flag, "type":type, "start":start, "end":end};
        			getDataList('updatetime','desc',param);
        		});
        	/* 对排序控件进行初始化 */
        		//初始化排序
        		if($.cookie('orderby') === undefined)
        		{
        			$.cookie('orderby','fa-angle-down');
        		}
        		//查询条件
        		var flag = $("#flag").val();
        		var type = $("#type").find("option:selected").val();
        		var start = $("#score-start").val();
        		var end = $("#score-end").val();
        		var param = {"flag":flag, "type":type, "start":start, "end":end};
        		var cookie = $.cookie("orderby");
        		//排序
        		var toStr = "<i class=\"fa "+ cookie +"\"></i>";
        		$(".order-btn").eq(0).append(toStr).attr('data-status',"fa-angle-down");
        		$.cookie("field", $(".order-btn").eq(0).attr("data-field"));
        		//数据提取
        		getDataList('updatetime','desc',param);
        	/* 排序控件进行初始化完成 */
        		$(".order-btn").on('click', function(event) {
	        		//查询条件
	        		var flag = $("#flag").val();
	        		var type = $("#type").find("option:selected").val();
	        		var start = $("#score-start").val();
	        		var end = $("#score-end").val();
	        		var param = {"flag":flag, "type":type, "start":start, "end":end};
        			if($(this).attr('data-status') == '')
        			{
        				$(this).attr('data-status','fa-angle-down')
        			}
        			var status = $(this).attr('data-status');
        			var field = $(this).attr('data-field');
        			$.cookie('field',field);
        			if(field == $.cookie('field') && status == 'fa-angle-down')
        			{
        				toStr = "<i class=\"fa fa-angle-up\"></i>";
        				$(this).attr("data-status","fa-angle-up");
        				$.cookie('orderby','fa-angle-up');
        				var paramOrder = 'asc';
        			}
        			else if(field == $.cookie('field') && status == 'fa-angle-up')
        			{
        				toStr = "<i class=\"fa fa-angle-down\"></i>";
        				$(this).attr("data-status","fa-angle-down");
        				$.cookie('orderby','fa-angle-down');
        				var paramOrder = 'desc';
        			}
        			getDataList(field, paramOrder, param);
        			$(".order-btn").removeClass('active');
        			$(".order-btn i").remove();
        			$(this).addClass('active').append(toStr);
        		});
        	});
        	//请求分页数据
        	function getDataList(field,sort,param)
        	{
        		param.field = field;
        		param.sort = sort;
        		var uri = "<?php echo addon_url('leescore/goods/getList'); ?>";
        		$.ajax({
        			url: uri,
        			type: 'GET',
        			dataType: 'json',
        			data: param,
        			success: function(list)
        			{
        				$(".page").html(list.page);
        				$(".goods-list").html(list.list);
        			},
        			error: function(error)
        			{
        				console.log(error);
        			}
        		});
        	}
	    	function ajaxPage(page){
	    		//排序
	       		var url = "<?php echo addon_url('leescore/goods/getList'); ?>";
	       		var sort = $.cookie('orderby') ? (($.cookie('orderby') == 'fa-angle-down') ? 'desc' : 'asc') : 'desc';
        		//查询条件
        		var flag = $("#flag").val();
        		var type = $("#type").find("option:selected").val();
        		var start = $("#score-start").val();
        		var end = $("#score-end").val();
	       		var param = {"flag":flag, "type":type, "start":start, "end":end , "field": $.cookie('field'), "sort": sort, "page": page};
	            $.ajax({
	                url:url,
	                type:'post',
	                dataType:'json',
	                data: param,
	                success:function(list){
        				$(".page").html(list.page);
        				$(".goods-list").html(list.list);
	                }
	            });
	        }
        </script>
    </body>
</html>