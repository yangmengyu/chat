<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:70:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\index\index.html";i:1542078486;s:70:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\common\meta.html";i:1542078486;s:69:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\common\nav.html";i:1542078486;s:72:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\common\footer.html";i:1542078486;s:72:"E:\PHPstudy\PHPTutorial\WWW\chat\addons\leescore\view\common\script.html";i:1542078486;}*/ ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo __('store title'); ?> - <?php echo $site['name']; ?></title>
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
		<style>
			.tab-goods-item { margin-top: 15px; }
			.hover-gray:hover{
				color: #ccc !important;
			}
		</style>
	</head>
	<body class="no-padding-mobile bg-grays">
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
		<!-- Content  -->
		<?php
			//统计精彩活动数量
			$len = count($activicy, true);
		?>
		<!-- Mobile Start -->
			<div class="container-fulid visible-sm visible-xs">
				<div class="padding-none">
					<div id="slider-mobile" class="carousel slide" data-ride="carousel">
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<?php if(is_array($slider) || $slider instanceof \think\Collection || $slider instanceof \think\Paginator): $i = 0; $__LIST__ = $slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<div class="item item-mobile">
									<a href="<?php echo (isset($vo['path_url']) && ($vo['path_url'] !== '')?$vo['path_url']:'javascript:;'); ?>" <?php if($vo['open_mode'] == 1): ?>target="_blank" <?php endif; ?>>
										<img class="img-responsive" src="<?php echo $vo['thumb']; ?>" />
									</a>
									<div class="carousel-caption">
										<h3><?php echo $vo['name']; ?></h3>
									</div>
								</div>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						<!-- Controls -->
						<a class="left carousel-control" href="#slider-mobile" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#slider-mobile" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
				<?php if(!(empty($activicy) || (($activicy instanceof \think\Collection || $activicy instanceof \think\Paginator ) && $activicy->isEmpty()))): ?>
				<div class="container">
					<!-- 精彩活动 --> <!-- $activicy 中存放着所有的活动广告位 -->
					<div class="visible-sm visible-xs">
						<h3> <span class="fa fa-star text-red"></span> <?php echo __('activicy'); ?></h3>
						<div class="row">
							<div id="activicy-mobile" class="carousel slide" data-ride="carousel">
								<!-- Wrapper for slides -->
								<div class="carousel-inner" role="listbox">
									<?php if(is_array($activicy) || $activicy instanceof \think\Collection || $activicy instanceof \think\Paginator): $i = 0; $__LIST__ = $activicy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(($i > 1 AND ($i-1) % 3 == 0) OR ($i == 1)): ?>
											<div class="item score-activicy-mobile">
										<?php endif; ?>
											<div class="col-xs-4">
												<a href="<?php echo (isset($vo['path_url']) && ($vo['path_url'] !== '')?$vo['path_url']:'javascript:;'); ?>" <?php if($vo['open_mode'] == 1): ?>target="_blank" <?php endif; ?>><img style="max-width: 100%;" class="img-responsive" src="<?php echo $vo['thumb']; ?>" /></a>
											</div>
										<?php if(($i % 3 == 0) or $i == $len): ?>
											</div>
										<?php endif; endforeach; endif; else: echo "" ;endif; ?>
								</div>
								<!-- Controls -->
							</div>
						</div>
						<!-- ./ 精彩活动 -->
					</div>
				</div>
				<?php endif; ?>
			</div>
		<!-- Mobile End -->
			<div class="container padding page-content">
				<div class="col-md-3 no-padding">
					<!-- UserInfo Start -->
					<div class="score-sign hidden-sm hidden-xs">
						<div class="user-info">
							<div class="col-md-8 col-md-offset-2 no-padding">
								<?php if($user): ?>
									<a href="<?php echo url('index/user/index'); ?>">
										<img src="<?php echo $user['avatar']; ?>" class="img-circle img-responsive score-user-avast center-block" alt="user avatar" />
									</a>
								<?php else: ?>
									<a href="<?php echo url('index/user/login'); ?>">
										<img src="/assets/img/avatar.png" class="img-circle img-responsive score-user-avast center-block" alt="user avatar" />
									</a>
								<?php endif; ?>
							</div>
							<div class="clearfix"></div>
							<br>
							<div class="col-md-12 text-center">
							<?php if(!$user): ?>
								<?php echo __('hello'); ?>, Please <a href="<?php echo url('index/user/login'); ?>" class="text-white"><?php echo __('login'); ?></a>
								<br>
								<br>
							<?php else: ?>
								<a class="text-white hover-gray" href="<?php echo url('index/user/index'); ?>"><?php echo __('welcome'); ?>, <?php echo $user['nickname']; ?>(56 Points)</a>
								<br />
								<a class="text-white hover-gray" href="<?php echo addon_url('leescore/order/index'); ?>"><?php echo __('my orders'); ?></a>&nbsp;&nbsp;&nbsp;
								<a class="text-white hover-gray" href="<?php echo url('index/user/logout'); ?>"><?php echo __('logout'); ?></a>
							<?php endif; ?>
							</div>
							<div class="clearfix"></div>
							<div class="row margin-top">
								<div class="col-md-10 col-md-offset-1">
									<?php if(($user)): ?>
										<a target="_blank" href="<?php echo addon_url('leesign/index/index'); ?>" class="btn btn-block btn-default border-none border-radius-big"><?php echo __('sign btn'); ?></a>
									<?php else: ?>
										<a href="<?php echo url('index/user/login'); ?>" class="btn btn-block btn-default border-none border-radius-big"><?php echo __('login'); ?></a>
									<?php endif; ?>
								</div>
								<br />
								<br />
							</div>
							<div class="row">
								<div class="col-md-12">
									<ul class="padding-none sign-panl">
										<li class="col-sm-6 col-xs-3 text-center padding-small">
											<a class="lezuan" href="javascript:;">
												<i class="score-icon-two center-block padding-small"></i>
												<span><?php echo __('le zhuan ji fen'); ?></span>
											</a>
										</li>
										<li class="col-sm-6 col-xs-3 text-center padding-small">
											<a href="<?php echo addon_url('leescore/goods/index'); ?>">
												<i class="score-icon-three center-block padding-small"></i>
												<span><?php echo __('score buy'); ?></span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<!-- UserInfo End -->
				</div>
				<div class="col-md-9 padding-none hidden-sm hidden-xs">
					<div id="slider" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php if(is_array($slider) || $slider instanceof \think\Collection || $slider instanceof \think\Paginator): $i = 0; $__LIST__ = $slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<li data-target="#slider" data-slide-to="<?php echo $i-1; ?>"></li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ol>
						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<?php if(is_array($slider) || $slider instanceof \think\Collection || $slider instanceof \think\Paginator): $i = 0; $__LIST__ = $slider;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<div class="item item-pc">
									<a href="<?php echo (isset($vo['path_url']) && ($vo['path_url'] !== '')?$vo['path_url']:'javascript:;'); ?>" <?php if($vo['open_mode'] == 1): ?>target="_blank" <?php endif; ?>>
										<img class="img-responsive img-silde" src="<?php echo $vo['thumb']; ?>" />
									</a>
									<div class="carousel-caption">
										<h3><?php echo $vo['name']; ?></h3>
									</div>
								</div>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						<!-- Controls -->
						<a class="left carousel-control" href="#slider" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#slider" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
				<div class="clearfix"></div>
				<br>
				<?php if(!(empty($activicy) || (($activicy instanceof \think\Collection || $activicy instanceof \think\Paginator ) && $activicy->isEmpty()))): ?>
				<!-- 精彩活动 --> <!-- $activicy 中存放着所有的活动广告位 -->
				<div class="hidden-sm hidden-xs">
					<h3> <span class="fa fa-star text-red"></span> <?php echo __('activicy'); ?></h3>
					<div class="padding-top padding-bottom bg-white">
						<div id="activicy" class="carousel slide" data-ride="carousel">
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<?php if(is_array($activicy) || $activicy instanceof \think\Collection || $activicy instanceof \think\Paginator): $i = 0; $__LIST__ = $activicy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(($i > 1 AND ($i-1) % 4 == 0) OR $i == 1): ?>
										<div class="item score-activicy">
									<?php endif; ?>
										<div class="col-md-3 col-sm-3 col-xs-3"><a href="<?php echo (isset($vo['path_url']) && ($vo['path_url'] !== '')?$vo['path_url']:'javascript:;'); ?>" <?php if($vo['open_mode'] == 1): ?>target="_blank" <?php endif; ?>><img style="max-width: 100%;" class="img-responsive" src="<?php echo $vo['thumb']; ?>" /></a></div>
									<?php if(($i % 4 == 0) OR $i == $len): ?>
										</div>
									<?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<!-- Controls -->
							<a class="left carousel-control" href="#activicy" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#activicy" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					<!-- ./ 精彩活动 -->
					<div class="clearfix"></div>
					<br>
				</div>
				<?php endif; if(!(empty($hotList) || (($hotList instanceof \think\Collection || $hotList instanceof \think\Paginator ) && $hotList->isEmpty()))): ?>
				<!-- 热门商品 -->
				<div class="row">
					<div class="col-md-12">
						<h3> <span class="glyphicon glyphicon-fire text-red"></span> <?php echo __('hot goods'); ?> <span class="pull-right"> <a class="text-muted h5" href="<?php echo addon_url('leescore/goods/index',array('listType' => 'hot')); ?>"><?php echo __('more'); ?> <i class="fa fa-angle-double-right"></i></a> </span></h3>
						<div class="hotlist-box bg-white">
							<ul class="goods-table clearfix">
								<?php if(is_array($hotList) || $hotList instanceof \think\Collection || $hotList instanceof \think\Paginator): $i = 0; $__LIST__ = $hotList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
								<li class="col-md-4 col-xs-12 padding-none">
									<div class="padding">
										<div class="row">
											<div class="col-xs-6"><a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><img src="<?php echo $vo['thumb']; ?>" style="max-height: 120px;" class="img-responsive" /></a></div>
											<div class="col-xs-6">
												<h4><a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><?php echo $vo['name']; ?></a></h4>
												<span class="text-red"><i class="text-yellow fa fa-meetup"></i> <strong><?php echo $vo['scoreprice']; ?></strong> <?php echo __('score'); ?></span>
												<h5 class="text-muted"><?php echo __('use num'); ?>：<?php echo $vo['usenum']; ?> <?php echo __('ren'); ?></h5>
												<h5><?php echo __('stock'); ?>：<?php echo $vo['stock']; ?></h5>
												<a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>" class="btn btn-warning border-radius-big border-none btn-block"><?php echo __('buy'); ?></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
				</div>
				<!-- ./ 热门商品 -->
				<?php endif; ?>
				<div class="clearfix"></div>
				<br>
				<!-- 热门推荐 -->
				<div class="bg-white">
					<!-- 切换卡：最新兑换、首页推荐 -->
					<div class="col-md-12 no-padding">
			        	<!-- Custom Tabs -->
			        	<div class="nav-tabs-custom radius-none">
				            <ul class="nav nav-tabs">
				            	<li class="active"><a href="#all" data-toggle="tab"><?php echo __('flag all'); ?></a></li>
				            	<li><a href="#index" data-toggle="tab"><?php echo __('flag index'); ?></a></li>
				            	<li><a href="#new" data-toggle="tab"><?php echo __('flag new'); ?></a></li>
				            	<li class="pull-right more"><a href="<?php echo addon_url('leescore/goods/index'); ?>" class="text-muted"><?php echo __('more'); ?> <i class="fa fa-angle-double-right"></i></a></li>
				            </ul>
				            <div class="tab-content">
				            	<div class="tab-pane active" id="all">
									<div class="">
										<?php if(is_array($all) || $all instanceof \think\Collection || $all instanceof \think\Paginator): $i = 0; $__LIST__ = $all;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<div class="col-xs-6 col-md-3 tab-goods-item">
												<div class="thumbnail border-none">
													<a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><img class="goods-list-thumb img-responsive" src="<?php echo $vo['thumb']; ?>" alt="<?php echo $vo['name']; ?>"></a>
													<div class="caption">
														<h4 class="more"><a class="more" href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><?php echo $vo['name']; ?></a></h4>
														<div class="col-sm-6 no-padding text-muted h5">
															<?php echo __('score'); ?>：<?php echo $vo['scoreprice']; ?>
														</div>
														<div class="col-sm-6 no-padding text-muted h5">
															<?php echo __('stock'); ?>：<?php echo $vo['stock']; ?>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
				            	</div>
				            	<!-- /.tab-pane -->
				            	<div class="tab-pane" id="index">
									<div class="">
										<?php if(is_array($recomm) || $recomm instanceof \think\Collection || $recomm instanceof \think\Paginator): $i = 0; $__LIST__ = $recomm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<div class="col-xs-6 col-md-3 tab-goods-item">
												<div class="thumbnail border-none">
													<a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><img class="goods-list-thumb img-responsive" src="<?php echo $vo['thumb']; ?>" alt="<?php echo $vo['name']; ?>"></a>
													<div class="caption">
														<h4><a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><?php echo $vo['name']; ?></a></h4>
														<div class="col-sm-6 no-padding text-muted h5">
															<?php echo __('score'); ?>：<?php echo $vo['scoreprice']; ?>
														</div>
														<div class="col-sm-6 no-padding text-muted h5">
															<?php echo __('stock'); ?>：<?php echo $vo['stock']; ?>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
				            	</div>
				            	<!-- /.tab-pane -->
				            	<div class="tab-pane" id="new">
									<div class="">
										<?php if(is_array($new) || $new instanceof \think\Collection || $new instanceof \think\Paginator): $i = 0; $__LIST__ = $new;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<div class="col-xs-6 col-md-3 tab-goods-item">
												<div class="thumbnail border-none">
													<a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><img class="goods-list-thumb img-responsive" src="<?php echo $vo['thumb']; ?>" alt="<?php echo $vo['name']; ?>"></a>
													<div class="caption">
														<h4><a href="<?php echo addon_url('leescore/goods/details',array('gid' => $vo['id'])); ?>"><?php echo $vo['name']; ?></a></h4>
														<div class="col-sm-6 no-padding text-muted h5">
															<?php echo __('score'); ?>：<?php echo $vo['scoreprice']; ?>
														</div>
														<div class="col-sm-6 no-padding text-muted h5">
															<?php echo __('stock'); ?>：<?php echo $vo['stock']; ?>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
				            	</div>
				            	<!-- /.tab-pane -->
				            	<div class="clearfix"></div>
				            </div>
			            <!-- /.tab-content -->
			        	</div>
			        	<!-- nav-tabs-custom -->
					</div>
					<!-- ./ 切换卡：最新兑换、首页推荐 -->
				</div>
			</div>
		<!-- Content  -->
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


		<!-- Layer -->
		<script src="/assets/addons/leescore/js/layer/src/layer.js"></script>
		<script>
			$(document).ready(function() {
				$(".item-pc").eq(0).addClass('active');
				$(".item-mobile").eq(0).addClass('active');
				$("ol.carousel-indicators li").eq(0).addClass('active');
				$(".score-activicy").eq(0).addClass('active');
				$(".recommend-li").last().removeClass('recommend-li');
				$(".item-mobile").eq(0).addClass('active');
				$(".score-activicy-mobile").eq(0).addClass('active');
			});

			$(".lezuan").on('click', function() {
				layer.msg("暂未开放积分收益渠道，仅能通过安装签到插件获取积分。");
			});

			function opening()
			{
				layer.msg("<?php echo __('opening tips'); ?>");
			}
			/* 幻灯滑块鼠标左右拖动触发滚动 */
			$("#slider").swipe({
				swipeLeft:function(){
					$(this).carousel('next');
				},
				swipeRight:function(){
					$(this).carousel('prev');
				}
			});
			/* 幻灯滑块鼠标左右拖动触发滚动 Mobile*/
			$("#slider-mobile").swipe({
				swipeLeft:function(){
					$(this).carousel('next');
				},
				swipeRight:function(){
					$(this).carousel('prev');
				}
			});
			/* 竞猜活动鼠标左右拖动触发滚动 Mobile*/
			$("#activicy-mobile").swipe({
				swipeLeft:function(){
					$(this).carousel('next');
				},
				swipeRight:function(){
					$(this).carousel('prev');
				}
			});
		</script>
	</body>
</html>