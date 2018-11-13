<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:89:"E:\PHPstudy\PHPTutorial\WWW\chat\public/../application/admin\view\leescoregoods\edit.html";i:1542078486;s:75:"E:\PHPstudy\PHPTutorial\WWW\chat\application\admin\view\layout\default.html";i:1541732837;s:72:"E:\PHPstudy\PHPTutorial\WWW\chat\application\admin\view\common\meta.html";i:1541732837;s:74:"E:\PHPstudy\PHPTutorial\WWW\chat\application\admin\view\common\script.html";i:1541732837;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label for="c-category_id" class="control-label col-xs-12 col-sm-2"><?php echo __('Category name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select  id="c-category_id" data-rule="required" class="form-control selectpicker" name="row[category_id]">
                <?php if(is_array($options) || $options instanceof \think\Collection || $options instanceof \think\Paginator): if( count($options)==0 ) : echo "" ;else: foreach($options as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="c-name" class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" class="form-control" name="row[name]" type="text" value="<?php echo $row['name']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-paytype" class="control-label col-xs-12 col-sm-2"><?php echo __('Paytype'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select  id="c-paytype" class="form-control selectpicker" name="row[paytype]">
                <?php if(is_array($payTypeList) || $payTypeList instanceof \think\Collection || $payTypeList instanceof \think\Paginator): if( count($payTypeList)==0 ) : echo "" ;else: foreach($payTypeList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="c-type" class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-type" class="form-control selectpicker" name="row[type]">
                <?php if(is_array($typeList) || $typeList instanceof \think\Collection || $typeList instanceof \think\Paginator): if( count($typeList)==0 ) : echo "" ;else: foreach($typeList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['type'])?$row['type']:explode(',',$row['type']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label for="c-status" class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_radios('row[status]', [ 1=> __('depot'), 2 => __('selling')], $row['status']); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="c-thumb" class="control-label col-xs-12 col-sm-2"><?php echo __('Thumb'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-image" readonly class="form-control" size="50" name="row[thumb]" type="text" value="<?php echo $row['thumb']; ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-input-id="c-image" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-image"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-input-id="c-image" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-image"></span>
            </div>
            <ul class="row list-inline plupload-preview images" id="p-image"></ul>
        </div>
    </div>
    <div class="form-group">
        <label for="c-pics" class="control-label col-xs-12 col-sm-2"><?php echo __('Pics'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input readonly id="c-pics" class="form-control" size="50" name="row[pics]" type="text" value="<?php echo $row['pics']; ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-images" class="btn btn-danger plupload" data-input-id="c-pics" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-pics"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-images" class="btn btn-primary fachoose" data-input-id="c-pics" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-pics"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-pics"></ul>
        </div>
    </div>
    <div class="form-group">
        <label for="c-weigh" class="control-label col-xs-12 col-sm-2"><?php echo __('Weigh'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-weigh" class="form-control" name="row[weigh]" type="number" value="<?php echo $row['weigh']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-stock" class="control-label col-xs-12 col-sm-2"><?php echo __('Stock'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-stock" class="form-control" name="row[stock]" type="number" value="<?php echo $row['stock']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-scoreprice" class="control-label col-xs-12 col-sm-2"><?php echo __('Scoreprice'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-scoreprice" class="form-control" name="row[scoreprice]" type="number" value="<?php echo $row['scoreprice']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-firsttime" class="control-label col-xs-12 col-sm-2"><?php echo __('Firsttime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-firsttime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[firsttime]" type="text" value="<?php echo datetime($row['firsttime']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-lasttime" class="control-label col-xs-12 col-sm-2"><?php echo __('Lasttime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-lasttime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[lasttime]" type="text" value="<?php echo datetime($row['lasttime']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-money" class="control-label col-xs-12 col-sm-2"><?php echo __('Money'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-money" class="form-control" step="0.01" name="row[money]" type="number" value="<?php echo $row['money']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-usenum" class="control-label col-xs-12 col-sm-2"><?php echo __('Usenum'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-usenum" class="form-control" name="row[usenum]" type="number" value="<?php echo $row['usenum']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-flag" class="control-label col-xs-12 col-sm-2"><?php echo __('Flag'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-flag" data-rule="required" class="form-control selectpicker" multiple="" name="row[flag][]">
                <?php if(is_array($flagList) || $flagList instanceof \think\Collection || $flagList instanceof \think\Paginator): if( count($flagList)==0 ) : echo "" ;else: foreach($flagList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['flag'])?$row['flag']:explode(',',$row['flag']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>

    <div class="form-group">
        <label for="c-rule" class="control-label col-xs-12 col-sm-2"><?php echo __('Rule'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-rule" class="form-control editor" rows="5" name="row[rule]" cols="50"><?php echo $row['rule']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-body" class="control-label col-xs-12 col-sm-2"><?php echo __('Body'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-body" class="form-control editor" rows="5" name="row[body]" cols="50"><?php echo $row['body']; ?></textarea>
        </div>
    </div>

    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
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