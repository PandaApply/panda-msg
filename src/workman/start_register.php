<?php

/**
 * @author ZhaoHongYu
 * Gateway进程和BusinessWorker进程启动后分别向Register进程注册自己的通讯地址
 * Gateway进程和BusinessWorker通过Register进程得到通讯地址后，就可以建立起连接并通讯了
 *
 * 注意，客户端不要连接Register服务的端口，Register服务是GatewayWorker内部通讯用的。
 * 注意，register服务只能开一个进程，不能开启多个进程。
 * 注意，register不支持Gateway接口(包括GatewayClient接口)，不要在register进程写任何业务。
 *
 * Register类只能定制监听的ip和端口，并且目前只能使用text协议。text://0.0.0.0:1238
 */
use \Workerman\Worker;
use \GatewayWorker\Register;

// 自动加载类
require_once __DIR__.'/../../../vendor/autoload.php';
$config = include __DIR__.'/../../../config/panda.php';

// register 必须是text协议
$register = new Register($config['registerProtocol']);

// 如果不是在根目录启动，则运行runAll方法
if(!defined('GLOBAL_START'))
{
    Worker::runAll();
}

