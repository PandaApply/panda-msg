<?php

/**
 * @author ZhaoHongYu
 * Gateway类用于初始化Gateway进程。Gateway进程是暴露给客户端的让其连接的进程。
 * 所有客户端的请求都是由Gateway接收然后分发给BusinessWorker处理，同样BusinessWorker也会将要发给客户端的响应通过Gateway转发出去。
 *
 * Gateway类是基于基础的Worker开发的。可以给Gateway对象的onWorkerStart、onWorkerStop、onConnect、onClose设置回调函数，但是无法给设置onMessage回调。
 * Gateway的onMessage行为固定为将客户端数据转发给BusinessWorker。
 *
 *
 * 主要定义了客户端连接的端口号、协议等信息
 */

use \Workerman\Worker;
use \GatewayWorker\Gateway;
use app\common\exception\ErrorEnum;

// 自动加载类
require_once __DIR__.'/../../../vendor/autoload.php';


// gateway 进程，这里使用Text协议，可以用telnet测试
$gateway = new Gateway("websocket://0.0.0.0:8181");
// gateway名称，status方便查看
$gateway->name = 'Examination';
// gateway进程数
$gateway->count = 4;
// 本机ip，分布式部署时使用内网ip
$gateway->lanIp = '127.0.0.1';
/**
 * Gateway进程启动后会监听一个本机端口，用来给BusinessWorker提供链接服务，
 * 然后Gateway与BusinessWorker之间就通过这个连接通讯。这里设置的是Gateway监听本机端口的起始端口。
 * 比如启动了4个Gateway进程，startPort为2000，则每个Gateway进程分别启动的本地端口一般为2000、2001、2002、2003。
 *
 */
$gateway->startPort = 2000;

// 服务注册地址 微服务
$gateway->registerAddress = '127.0.0.1:10110';

// 心跳间隔
$gateway->pingInterval = 30;
//  0代表服务端允许客户端不发送心跳，服务端不会因为客户端长时间没发送数据而断开连接
// 1 代表客户端必须定时发送数据给服务端，否则pingNotResponseLimit*pingInterval秒内没有任何数据发来则关闭对应连接，并触发onClose。
$gateway->pingNotResponseLimit = 0;
// 心跳数据
$gateway->pingData = json_encode(['type' => 'ping', 'msg' => '心跳检测', 'code' => \app\common\enum\SocketEnum::HEARTBEAT, 'data' => []]);

/*
// 当客户端连接上来时，设置连接的onWebSocketConnect，即在websocket握手时的回调
$gateway->onConnect = function($connection)
{
    $connection->onWebSocketConnect = function($connection , $http_header)
    {
        // 可以在这里判断连接来源是否合法，不合法就关掉连接
        // $_SERVER['HTTP_ORIGIN']标识来自哪个站点的页面发起的websocket链接
        if($_SERVER['HTTP_ORIGIN'] != 'http://kedou.workerman.net')
        {
            $connection->close();
        }
        // onWebSocketConnect 里面$_GET $_SERVER是可用的
        // var_dump($_GET, $_SERVER);
    };
};
*/

// 如果不是在根目录启动，则运行runAll方法
if (!defined('GLOBAL_START')) {
    Worker::runAll();
}

