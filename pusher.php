<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 18-12-8
 * Time: 下午3:08
 */

if ($_POST) {
    $msg = isset($_POST['msg']) ? $_POST['msg'] : '';
    $channels = isset($_POST['channels']) ? $_POST['channels'] : array();

    if (!$msg || !is_array($channels) || count($channels) == 0) {
        exit('参数错误');
    }

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);

    $res = 0;
    foreach ($channels as $channel) {
        $res += $redis->publish($channel, $msg);
    }

    echo $res ? 'success' : 'failed';
} else {
    exit('非法请求');
}

