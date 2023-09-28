<?php
/**
 * BusinessWorker类其实也是基于基础的Worker开发的。
 * BusinessWorker是运行业务逻辑的进程，BusinessWorker收到Gateway转发来的事件及请求时会默认调用Events.php中的onConnect onMessage onClose方法处理事件及数据，
 * 开发者正是通过实现这些回调控制业务及流程。
 *
 * 设置使用哪个类来处理业务，默认值是Events，即默认使用Events.php中的Events类来处理业务。
 * 业务类至少要实现onMessage静态方法，onConnect和onClose静态方法可以不用实现。
 */

use \Workerman\Worker;
use \GatewayWorker\BusinessWorker;

// 自动加载类
require_once __DIR__ . '/../../../vendor/autoload.php';
$config = include __DIR__.'/../../../config/panda.php';

// bussinessWorker 进程
$worker = new BusinessWorker();
// worker名称
$worker->name = $config['businessWorkerName'];
$worker->eventHandler = $config['eventHandler'];
// bussinessWorker进程数量
$worker->count = $config['BusinessWorkerCount'];
// 服务注册地址
$worker->registerAddress = $config['registerAddress'];

// 如果不是在根目录启动，则运行runAll方法
if (!defined('GLOBAL_START')) {
    Worker::runAll();
}

