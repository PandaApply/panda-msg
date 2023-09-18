<?php
// +----------------------------------------------------------------------
// | Panda-msg设置
// +----------------------------------------------------------------------
return [
    // 服务注册地址
    'registerAddress' => '127.0.0.1:10110',
    // register 必须是text协议
    'registerProtocol' => 'text://0.0.0.0:10110',
    // BusinessWorker名称
    'businessWorkerName' => 'BusinessWorker',
    // BusinessWorker进程数量
    'BusinessWorkerCount' => 4,
    // 设置使用哪个类来处理业务，如果不了解不要随便修改
    'eventHandler' => 'panda\msg\Socket',

    /**
     * 协议：
     * 1、websocket协议
     * 2、text协议
     * 3、Frame协议
     * 4、自定义通讯协议
     * 5、tcp，直接裸tcp，不推荐，见通讯协议作用。
     */
    'protocol' => 'websocket://0.0.0.0:8181',
    // gateway名称
    'gatewayName' => 'Panda',
    // gateway进程
    'gatewayCount' => 4,
    // 本机IP，分布式部署时使用内网ip:此处是分布式部署的配置,具体参考workerman官方文档
    'lanIp' => '127.0.0.1',
    // gateway内部通讯起始端口，起始端口不要重复:此处是分布式部署的配置,具体参考workerman官方文档
    'gatewayStartPort' => 2000,
    // 心跳间隔
    'pingInterval' => 30,
    /**
     * 心跳设置
     * 0 代表服务端允许客户端不发送心跳，服务端不会因为客户端长时间没发送数据而断开连接
     * 1 代表客户端必须定时发送数据给服务端，否则pingNotResponseLimit*pingInterval秒内没有任何数据发来则关闭对应连接，并触发onClose
     */
    'pingNotResponseLimit' => 0,
    // 心跳数据
    'pingData' => json_encode(['type' => 'ping', 'msg' => '心跳检测', 'code' => 'heartbeat', 'data' => []]),
    // 允许连接的来源站，如果不在此站中会被关闭连接
    'source' => [],
];
