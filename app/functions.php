<?php

/*
|--------------------------------------------------------------------------
| 自定义公共函数库Helper
|--------------------------------------------------------------------------
|
*/


/*
 * $data : 发送内容
 * $mobile : 要发送的手机号
 * */
function msgSend($data,$mobile){
    $post_data = array();
    $post_data['account'] = iconv('GB2312', 'GB2312',"hiinguaixue");
    $post_data['pswd'] = iconv('GB2312', 'GB2312',"Txb123123");
    $post_data['mobile'] = $mobile;
    $post_data['msg']=mb_convert_encoding("$data",'UTF-8', 'auto');
    $url='http://222.73.117.158/msg/HttpBatchSendSM?';
    $o="";
    foreach ($post_data as $k=>$v)
    {
        $o.= "$k=".urlencode($v)."&";
    }
    $post_data=substr($o,0,-1);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $dataMsg = curl_exec($ch);//运行curl
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);//要求结果为字符串且输出到屏幕上
    curl_close($ch);
    return  $dataMsg;
}

/**
 * 格式化表单校验消息
 *
 * @param  array $messages 未格式化之前数组
 * @return string 格式化之后字符串
 */
function format_message($messages)
{
    $reason = ' ';
    foreach ($messages->all('<span class="text_error">:message</span>') as $message) {
        $reason .= $message.' ';
    }
    return $reason;
}

/**
 * 格式化表单校验消息，并进行json数组化预处理
 *
 * @param  array $messages 未格式化之前数组
 * @param array $json 原始json数组数据
 * @return array
 */
function format_json_message($messages, $json)
{
    $reason = format_message($messages);
    $info = '失败原因为：'.$reason;
    $json = array_replace($json, ['info' => $info]);
    return $json;
}

/**
 * 静态文件cdn部署
 * 如果设置过app.cdn_url参数，则启用它作为静态资源根目录，否则使用默认的app.url作为静态资源根目录
 * 如果cdn_url = 'http://ystatic.cn'
 * 则 cdn('assets/css/style.css', 'v=1.0') 实际表示的路径为 http://ystatic.cn/assets/css/style.css?v=1.0
 *
 * @param string $filepath 静态资源相对路径
 * @param string $q 尾缀符，如 assets/css/style.css?v=1.4.3
 * @return string
 */
function cdn($filepath, $q = '')
{
    $qstring = (is_string($q) && !empty($q)) ? '?'.$q:'';
    if (Config::get('app.cdn_url')) {
        $root = Config::get('app.cdn_url');
        return rtrim($root, '/').'/'.trim($filepath, '/').$qstring;
    } else {
        return app('url')->asset($filepath).$qstring;
    }
}

/**
 * 使用Minify(https://github.com/mrclay/minify)来压缩与拼合静态文件
 * 实现优化部署
 * 示例：
 * minify(array('css/yas_style.css','lib/font-awesome/css/font-awesome.min.css'))
 * http://cmf.yas.so/min/b=assets&f=css/yas_style.css,lib/font-awesome/css/font-awesome.min.css
 *
 * @param array $data 静态资源数组
 * @param string $base 相对基路径
 * @return string
 */
function minify($data, $base='assets')
{
    if (Config::get('app.minify_dir')) {
        $min = Config::get('app.cdn_url');
    } else {
        $min = 'min';
    }
    $static = $min.'/b='.$base.'&f=';
    if (is_array($data)) {
        foreach ($data as $d) {
            $static .= $d.',';
        }
    }
    $static = rtrim($static, ',');
    $static .= '?minify';
    return app('url')->asset($static);
}


/**
 * 优雅CMF后台分页helper
 *
 * @param Illuminate\Support\Collection $model
 * @param array $data 追加的参数数组
 * @return string 返回分页
 */
function page_links($model, $data = [])
{
    $presenter = new \YouYa\Extensions\YouYaPresenter($model);
    if (empty($data)) {
        $links = $model->render($presenter);
    } else {
        $links = $model->appends($data)->render($presenter);
    }
    return $links;
}

/**
 * 优雅slug URL生成
 * 优先使用string型的$slug作为slug url，否则使用int型的$id
 *
 * @param string $slug
 * @param int $id
 * @return string|int
 */
function get_slug($slug, $id)
{
    $slug = e(trim($slug));
    if (empty($slug)) {
        return $id;
    } else {
        if (ctype_digit($slug)) {
            return $id;
        } else {
            return $slug;
        }
    }
}

/**
 * 优雅分类slug URL生成
 *
 * @param string $slug 分类slug
 * @param int $id 分类id
 * @return string 返回slug化的字符串
 */
function get_category_slug($slug, $id)
{
    $slug = e(trim($slug));
    if (empty($slug)) {
        return '/cat_'.$id;
    } else {
        if (ctype_digit($slug)) {
            return '/cat_'.$id;
        } else {
            return '/'.$slug;
        }
    }
}

/**
 * 优雅单页slug URL生成
 *
 * @param string $slug 单页slug
 * @param int $id 单页id
 * @return string 返回slug化的字符串
 */
function get_page_slug($slug, $id)
{
    $slug = e(trim($slug));
    if (empty($slug)) {
        return '/page_'.$id.'.html';
    } else {
        if (ctype_digit($slug)) {
            return '/page_'.$id.'.html';
        } else {
            return '/'.$slug.'.html';
        }
    }
}


/**
 * 优雅文章slug URL生成
 *
 * @param string $slug 文章slug
 * @param int $id 文章id
 * @param string $cslug 分类slug
 * @param int $id 分类id
 * @return string 返回slug化的字符串
 */
function get_article_slug($slug, $id, $cslug, $cid)
{
    $slug = get_slug($slug, $id);
    $cslug = get_category_slug($cslug, $cid);
    return '/'.ltrim($cslug, '/').'/'.$slug.'.html';
}


/**
 * 检查 特定数组 特定键名的键值 是否与待比较的值一致
 * 此helper主要用于角色权限特征判断
 *
 * @param array $array 传入的数组
 * @param string $key 待比较的数组键名
 * @param string $value 待比较的值
 * @return boolean 一致则返回true，否则返回false
 */
function check_array($array, $key, $value)
{
    $status = false;

    foreach ($array as $arr) {
        if ($arr[$key] === $value) {
            $status = true;
            break;
        } else {
            continue;
        }
    }
    
    return $status;
}

/**
 * 获取登录用户信息，用于登录之后页面显示或验证
 *
 * @param string $ret 限定返回的字段
 * @return string|object 返回登录用户相关字段信息或其ORM对象
 */
function user($ret = 'nickname')
{
    if (Auth::check()) {
        switch ($ret) {
            case 'nickname':
                return Auth::user()->nickname;  //返回昵称
                break;
            case 'username':
                return Auth::user()->username;  //返回登录名
                break;
            case 'realname':
                return Auth::user()->realname;  //返回真实姓名
                break;
            case 'id':
                return Auth::user()->id;  //返回用户id
                break;
            case 'user_type':
                return Auth::user()->user_type;  //返回用户类型
                break;
            case 'object':
                return Auth::user();  //返回User对象
                break;
            default:
                return Auth::user()->nickname;  //默认返回昵称
                break;
        }
    } else {
        if($ret === 'object'){
            $user = app()->make('YouYa\Repositories\UserRepository');
            return $user->manager(1);  //主要为了修正 `php artisan route:list` 命令出错问题
        }
        else{
            return 'No Auth::check()';
        }
    }
}


if (! function_exists('cur_nav')) {
    /**
     * 根据路由$route处理当前导航URL，用于匹配导航高亮
     * $route当前必须满足 三段以上点分 诸如 route('admin.article.index')
     *
     * @param string $route 点分式路由别名
     * @return string 返回经过处理之后路径
     */
    function cur_nav($route = '')
    {
        //explode切分法
        $routeArray = explode('.', $route);
        if ((is_array($routeArray)) && (count($routeArray)>=2)) {
            $route1 = $routeArray[0].'.'.$routeArray[1].'.index';
            $route2 = $routeArray[0].'.'.$routeArray[1];
            if (Route::getRoutes()->hasNamedRoute($route1)) {  //优先判断是否存在尾缀名为'.index'的路由
                return route($route1);
            } else {
                return route($route2);
            }
        } else {
            return route($route);
        }
    }
}

if (! function_exists('fragment')) {
    /**
     * 根据碎片slug获取碎片模型内容
     * 如果$slug真实存在，则默认返回该碎片内容,
     * 否则返回空HTML注释字符串'<!--不存在该碎片-->'
     *
     * @param string $slug 碎片slug（URL SEO化别名）
     * @param string $ret 限定返回的字段
     * @return string 返回碎片相关字段信息
     */
    function fragment($slug, $ret = '')
    {
        $content = app()->make('YouYa\Repositories\ContentRepository');
        $fragment = $content->fragment($slug);
        if (is_null($fragment)) {
            return '<!--no this fragment-->';
        }  //返回空HTML注释字符串
        else {
            switch ($ret) {
                case 'content':
                    return htmlspecialchars_decode($fragment->content);  //返回碎片
                    break;
                case 'thumb':
                    return $fragment->thumb;  //返回碎片缩略图地址
                    break;
                case 'title':
                    return $fragment->title;  //返回碎片标题
                    break;
                default:
                    return htmlspecialchars_decode($fragment->content);  //默认返回碎片内容
                    break;
            }
        }
    }
}
//php获取本周和上周的开始日期和结束日期
function getWeekDate(){
    $date=date('Y-m-d');  //当前日期

    $first=1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期

    $w=date('w',strtotime($date));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6

    $now_start=date('Y-m-d',strtotime("$date -".($w ? $w - $first : 6).' days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天

    $now_end=date('Y-m-d',strtotime("$now_start +6 days"));  //本周结束日期
    $monday   =     date('Y-m-d',strtotime("$now_start +0 days"));  //本周结束日期
    $tuesday  =     date('Y-m-d',strtotime("$now_start +1 days"));  //星期2
    $wednesday=     date('Y-m-d',strtotime("$now_start +2 days"));  //星期3
    $thursday =     date('Y-m-d',strtotime("$now_start +3 days"));  //星期4
    $friday   =     date('Y-m-d',strtotime("$now_start +4 days"));  //星期5
    $saturday =     date('Y-m-d',strtotime("$now_start +5 days"));  //星期6

    $last_start=date('Y-m-d',strtotime("$now_start - 7 days"));  //上周开始日期
    $last_end=date('Y-m-d',strtotime("$now_start - 1 days"));  //上周结束日期

    $ret['monday'] = $now_start;
    $ret['tuesday'] = $tuesday;
    $ret['wednesday'] = $wednesday;
    $ret['thursday'] = $thursday;
    $ret['friday'] = $friday;
    $ret['saturday'] = $saturday;
    $ret['sunday'] = $now_end;
    return $ret;
}

// 获取指定日期所在星期的开始时间与结束时间
function getWeekRange($date){
    $ret=array();
    $timestamp=strtotime($date);
    $w=strftime('%u',$timestamp);
    $ret['sdate']=date('Y-m-d 00:00:00',$timestamp-($w-1)*86400);
    $ret['edate']=date('Y-m-d 23:59:59',$timestamp+(7-$w)*86400);
    return $ret;
}

// 获取指定日期所在月的开始日期与结束日期
function getMonthRange($date){
    $ret=array();
    $timestamp=strtotime($date);
    $mdays=date('t',$timestamp);
    $ret['sdate']=date('Y-m-1 00:00:00',$timestamp);
    $ret['edate']=date('Y-m-'.$mdays.' 23:59:59',$timestamp);
    return $ret;
}


//  以上两个函数的应用
function getFilter($n){
    $ret=array();
    switch($n){
        case 1:// 昨天
            $ret['sdate']=date('Y-m-d 00:00:00',strtotime('-1 day'));
            $ret['edate']=date('Y-m-d 23:59:59',strtotime('-1 day'));
            break;
        case 2://本星期
            $ret=getWeekRange(date('Y-m-d'));
            break;
        case 3://上一个星期
            $strDate=date('Y-m-d',strtotime('-1 week'));
            $ret=getWeekRange($strDate);
            break;
        case 4: //上上星期
            $strDate=date('Y-m-d',strtotime('-2 week'));
            $ret=getWeekRange($strDate);
            break;
        case 5: //本月
            $ret=getMonthRange(date('Y-m-d'));
            break;
        case 6://上月
            $strDate=date('Y-m-d',strtotime('-1 month'));
            $ret=getMonthRange($strDate);
            break;
    }
    return $ret;
}