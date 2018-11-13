<?php

namespace addons\leescore;

use app\common\library\Menu;
use think\Addons;

/**
 * 积分商城
 */
class Leescore extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        $menu = [
            [

                'name'    => 'leescore',
                'title'   => '积分商城',
                'sublist' => [
                    [
                        'name'    => 'leescorecategory',
                        'title'   => '分类管理',
                        'ismenu'  => 1,
                        'icon'    => 'fa fa-file-text-o',
                        'sublist' => [
                        ]
                    ],
                    [
                        'name'    => 'leescoregoods',
                        'title'   => '商品管理',
                        'icon'    => 'fa fa-list',
                        'ismenu'  => 1,
                        'sublist' => [
 
                        ]
                    ],
                    [
                        'name'    => 'leescoreorder',
                        'title'   => '订单管理',
                        'icon'    => 'fa fa-list',
                        'ismenu'  => 1,
                        'sublist' => [

                        ]
                    ],
                    [
                        'name'    => 'leescoreads',
                        'title'   => '广告位管理',
                        'icon'    => 'fa fa-list',
                        'ismenu'  => 1,
                        'sublist' => [

                        ]
                    ],
                ]
            ]
        ];
        Menu::create($menu);
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        Menu::delete('leescore');
        return true;
    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable()
    {
        Menu::enable('leescore');
        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable()
    {
        Menu::disable('leescore');
        return true;
    }

    /**
     * 实现钩子方法
     * @return string
     */
    public function leescorehook($param)
    {
        //获取插件配置信息
        $cfg = $this->getConfig();

        //检测用户是否上传入口图片
        $img = !empty($cfg['enterimg']) ? $cfg['enterimg'] : cdnurl('/assets/addons/leescore/img/scoregoods.png');
        $this->assign('path', $img);
        return $this->fetch('view/hook');
    }

}
