<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:89:"E:\PHPstudy\PHPTutorial\WWW\chat\public/../application/admin\view\leescoreorder\send.html";i:1542078486;s:75:"E:\PHPstudy\PHPTutorial\WWW\chat\application\admin\view\layout\default.html";i:1541732837;s:72:"E:\PHPstudy\PHPTutorial\WWW\chat\application\admin\view\common\meta.html";i:1541732837;s:74:"E:\PHPstudy\PHPTutorial\WWW\chat\application\admin\view\common\script.html";i:1541732837;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="send-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

	<fieldset>
		<legend>
			<?php echo __('order detail info'); ?>
		</legend>
		<!-- 订单信息 -->
		<div class="col-md-10 col-md-offset-1 col-sm-12">
			<div class="box radius-none">
				<div class="box-header with-border">
					<?php echo __('order id'); ?>：<?php echo $vo['order_id']; ?>
				</div>
				<div class="box-body">
					<div class="col-md-6 padding">
						<?php echo __('goods name'); ?>: <?php echo $vo['goodsDetail']['name']; ?>
					</div>
					<div class="col-md-6 padding">
						<?php echo __('buy num'); ?>: <?php echo $vo['buy_num']; ?>
					</div>
					<div class="col-md-6 padding">
						<?php echo __('price'); ?>: <?php echo $vo['score']; ?><?php echo __('score'); ?>
					</div>
					<div class="col-md-6 padding">
						<?php echo __('order status'); ?>: 
						<?php switch($vo['status']): case "-2": ?> <span class="label label-danger"><?php echo __('order faild'); ?></span> <?php break; case "-1": ?> <span class="label label-default"><?php echo __('Status -1'); ?></span> <?php break; case "0": ?> <span class="label label-default"><?php echo __('unpaid'); ?></span> <?php break; case "1": ?> <span class="label label-success"><?php echo __('paid'); ?></span> <?php break; case "2": ?> <span class="label label-info"><?php echo __('shipped'); ?></span> <?php break; case "3": ?> <span class="label label-primary"><?php echo __('sign for'); ?></span> <?php break; case "4": ?> <span class="label label-warning"><?php echo __('outing'); ?></span> <?php break; case "5": ?> <span class="label label-danger"><?php echo __('out success'); ?></span> <?php break; default: ?> <?php echo __('order error'); endswitch; ?>
					</div>
					<div class="col-md-6 padding">
						<?php echo __('pay time'); ?>: <?php echo date("m-d-Y H:i:s",$vo['paytime']); ?>
					</div>
					<div class="col-md-6 padding">
						<?php echo __('pay type'); ?>: <?php echo __($vo['paytype']); ?><?php echo __('pay text'); ?>
					</div>
					<div class="col-md-12 padding">
						<?php echo __('order other'); ?>: <?php echo $vo['other']; ?>
						<p></p>
					</div>
					<div class="col-md-12 padding">
						<fieldset>
							<?php if(($vo['goods_type'] == 0)): ?>
								<legend><h3><?php echo __('consignee user info'); ?></h3></legend>
								<div class="col-md-6 padding">
									<?php echo __('country'); ?>: <?php echo $vo['addressInfo']['country']; ?>
								</div>
								<div class="col-md-6 padding">
									<?php echo __('province / Region'); ?>: <?php echo $vo['addressInfo']['region']; ?>
								</div>
								<div class="col-md-6 padding">
									<?php echo __('city'); ?>: <?php echo $vo['addressInfo']['city']; ?>
								</div>
								<div class="col-md-6 padding">
									<?php echo __('zip code'); ?>: <?php echo $vo['addressInfo']['zip']; ?>
								</div>
								<div class="col-md-6 padding">
									<?php echo __('mobile'); ?>: <?php echo $vo['addressInfo']['mobile']; ?>
								</div>
								<div class="col-md-12 padding">
									<?php echo __('detail address'); ?>: <?php echo $vo['addressInfo']['address']; ?>
								</div>
							<?php endif; ?>
						</fieldset>

						<fieldset>
							<legend><h3><?php echo __('replace result info'); ?></h3></legend>
								<div class="form-group">
									<input type="hidden" name="ids" id="ids" value="<?php echo $vo['id']; ?>">
									<label for="c-virtual_sn" class="control-label col-xs-12 col-sm-2"><?php echo __('virtual sn'); ?>:</label>
									<div class="col-xs-12 col-sm-8">
										<input placeholder="驳回时无需填写" id="c-virtual_sn" data-rule="required" class="form-control" name="virtual_sn" type="text" value="<?php echo $vo['virtual_sn']; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="c-virtual_name" class="control-label col-xs-12 col-sm-2"><?php echo __('virtual name'); ?>:</label>
									<div class="col-xs-12 col-sm-8">
										<input placeholder="驳回时无需填写" id="c-virtual_name" class="form-control" name="virtual_name" type="text" value="<?php echo $vo['virtual_name']; ?>">
									</div>
								</div>

								<div class="form-group">
									<label for="c-virtual_other" class="control-label col-xs-12 col-sm-2"><?php echo __('virtual other'); ?>:</label>
									<div class="col-xs-12 col-sm-8">
										<textarea name="virtual_other" id="c-virtual_other" class="form-control" rows="10"><?php echo $vo['result_other']; ?></textarea>
									</div>
								</div>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
		<!-- 订单信息 -->
	</fieldset>

	<?php if(in_array(($vo['status']), explode(',',"0,1"))): ?>
		<div class="form-group layer-footer">
			<label class="control-label col-xs-12 col-sm-2"></label>
			<div class="col-xs-12 col-sm-8">
				<button type="button" id="send" data-type="send" class="btn btn-success btn-embossed"><?php echo __('send btn'); ?></button>
				<button type="button" id="faild" data-type="result" class="btn btn-warning btn-embossed"><?php echo __('order faild'); ?></button>
			</div>
		</div>
	<?php endif; ?>
</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>