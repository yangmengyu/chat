<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"E:\phpstudy\WWW\chat\addons\leesign\view\index\index.html";i:1531273252;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo __('day sign'); ?></title>
    <link rel="stylesheet" href="/assets/addons/leesign/css/schedule.css">
    <link href="/assets/css/frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

</head>
<body style="padding-top: 0">
<div class="panel-heading">
    <h2><?php echo __('my sign'); ?>
        <a class="btn btn-success pull-right btn-signin <?php if($sign): ?>disabled<?php endif; ?>" href="javascript:;">
            <i class="fa fa-location-arrow"></i> <span id="js-just-qiandao"><?php if($sign): ?><?php echo __('Signed in'); else: ?><?php echo __('Sign in'); endif; ?></span>
        </a>
        <a href="javascript:;" class="btn btn-default pull-right btn-rule">
            <i class="fa fa-question-circle"></i>
            <?php echo __('sign rule'); ?>
        </a>
    </h2>
</div>
<?php if($sign): ?>
<div class="alert alert-warning-light">
    <?php echo __('sign success tip','<b>'.$sign['max_sign'].'</b>'); ?>，<?php echo __('Sign in tomorrow and get %s points','<b>'.$sign['next_sign'].'</b>'); ?>
</div>
<?php else: ?>
<div class="alert alert-warning-light">
    <?php echo __('Please click sign in to receive your reward today'); ?>
</div>
<?php endif; ?>
<div id='schedule-box' class="boxshaw">

</div>
<div>
    <h3 id='h3Ele'></h3>
</div>
<div id="rule_html" class="layui-layer-content hidden" >
    <table class="table table-striped" style="width: 80%;margin: 0 auto">
        <thead>
        <tr>
            <th><?php echo __('continuous check-in'); ?></th>
            <th><?php echo __('Get point'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($rule) || $rule instanceof \think\Collection || $rule instanceof \think\Paginator): $i = 0; $__LIST__ = $rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <th scope="row"><?php echo __('The %s day',$key); ?></th>
            <td><?php echo $vo; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</div>
</body>
<script>
    var LOGIN_URL = "<?php echo url('index/user/login'); ?>?url=<?php echo request()->url(true); ?>";
    var SIGN_URL = "<?php echo addon_url('leesign/index/sign'); ?>";
    var SIGNINFO_URL = "<?php echo addon_url('leesign/index/getSignInfo'); ?>";
    var getdayList_URL = "<?php echo addon_url('leesign/index/getdayList'); ?>";
</script>
<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/assets/libs/layer/src/layer.js"></script>
<script src="/assets/addons/leesign/js/schedule.js"></script>
<script>
    var mySchedule = new Schedule({
        el: '#schedule-box',
        //date: '2018-9-20',
        /*clickCb: function (y,m,d) {
            getdayList(y+'-'+m+'-'+d);
        },*/
        nextMonthCb: function (y,m,d) {
            getdayList(y+'-'+m+'-'+d);
        },
        nextYeayCb: function (y,m,d) {
            getdayList(y+'-'+m+'-'+d);
        },
        prevMonthCb: function (y,m,d) {
            getdayList(y+'-'+m+'-'+d);
        },
        prevYearCb: function (y,m,d) {
            getdayList(y+'-'+m+'-'+d);
        }
    });
    function getdayList(date) {
        $.post(getdayList_URL,{date:date},function (res) {
            if(res.code == 1){
                $('.current-month').each(function () {
                    var dayspan = $(this).find('span');
                    var daytitle = dayspan.attr('title');
                    if(res.data.indexOf(daytitle) > '-1'){
                        dayspan.addClass('sign-flag')
                    }
                });
            }else{
                parent.layer.alert(res.msg, {
                    btn: ["<?php echo __('To log in'); ?>"],
                    yes: function () {
                        location.href = LOGIN_URL;
                    }
                });
            }
        })
    }
    getdayList();

    //点击签到按钮
    $('.btn-signin').on("click", function () {
        $.ajax({
            url: SIGN_URL,
            type: 'post',
            dataType: 'json',
            success: function (ret) {
                if (ret.code == 1) {
                    window.location.reload();
                    $('.btn-signin').addClass('disabled');
                    $('#js-just-qiandao').html('<?php echo __("Signed in"); ?>');
                } else if (ret.code == -1) {
                    parent.layer.alert(res.msg, {
                        btn: ["<?php echo __('To log in'); ?>"],
                        yes: function () {
                            location.href = LOGIN_URL;
                        }
                    });
                } else {
                    layer.alert(ret.msg);
                }
            }, error: function () {
                parent.layer.alert("操作失败请重试");
            }
        });
    }); //签到
    //签到规则
    $('.btn-rule').on("click",function () {

        parent.layer.open({
            type: 1,
            title:'<?php echo __("sign rule"); ?>',
            area:['300px','400px'],
            content: $('#rule_html').html(),
        });
    });
</script>
</html>