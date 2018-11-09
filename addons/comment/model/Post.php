<?php

namespace addons\comment\model;

use addons\comment\library\Markdown;
use app\common\library\Auth;
use app\common\library\Email;
use think\Db;
use think\Exception;
use think\Model;
use think\Validate;

/**
 * 评论模型
 */
class Post Extends Model
{

    protected $name = "comment_post";
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 追加属性
    protected $append = [
        'create_date',
        'human_date',
    ];
    protected static $config = [];

    //自定义初始化
    protected static function init()
    {
        self::$config = get_addon_config('comment');
    }

    public function getCreateDateAttr($value, $data)
    {
        return datetime($data['createtime']);
    }

    public function getHumanDateAttr($value, $data)
    {
        return human_date($data['createtime']);
    }

    public static function getChildrenCommentList(&$commentList, $site_id, $article_id, $level = 1)
    {
        //如果评论为空
        if (!$commentList)
            return;
        //如果超过最大层级则不再取数据
        if ($level > self::$config['maxlevel'])
            return;
        //从评论列表获取ID集合
        $ids = implode(',', array_keys($commentList));
        $status = 'normal';
        $maxSize = self::$config['floorpagesize'];
        //取分组前10条数据
        $sql = "SELECT a.id FROM fa_comment_post AS a,
                    (SELECT GROUP_CONCAT(id order by id desc) AS ids FROM fa_comment_post WHERE status='{$status}' AND site_id='{$site_id}' AND article_id='{$article_id}' GROUP BY pid) AS b
                    WHERE FIND_IN_SET(a.id, b.ids) BETWEEN 1 AND {$maxSize} AND status='{$status}' AND site_id='{$site_id}' AND article_id='{$article_id}' AND a.pid IN ({$ids}) ORDER BY a.pid ASC, a.id ASC";
        $list = Db::query($sql);
        if ($list) {
            $ids = [];
            foreach ($list as $index => $item) {
                $ids[] = $item['id'];
            }
            $childrenList = [];
            $result = self::where('id', 'in', $ids)->with(['userinfo'])->field('id,pid,content,user_id,likes,comments,createtime')->select();
            $result = collection($result)->toArray();
            foreach ($result as $index => $item) {
                $item['children'] = [];
                //如果启用Markdown
                if (self::$config['markdown']) {
                    $item['content'] = Markdown::text($item['content']);
                }
                $childrenList[$item['id']] = $item;
            }
            if ($childrenList) {
                self::getChildrenCommentList($childrenList, $site_id, $article_id, $level + 1);
            }
            foreach ($childrenList as $index => $item) {
                $commentList[$item['pid']]['children'][] = $item;
            }

        }
    }

    /**
     * 关联会员模型
     */
    public function userinfo()
    {
        return $this->belongsTo("app\common\model\User")->field('id,nickname,avatar')->setEagerlyType(1);
    }

}
