<?php

namespace panda\msg;

use GatewayWorker\Lib\Gateway;

/**
 * User: ZhaoHongYu
 * Date: 2023/9/14
 * Desc: 初始化
 */
class Socket
{
    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     *
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        echo "新的链接进来了" . $client_id . PHP_EOL;
        Gateway::sendToClient($client_id, json_encode(array(
            'type' => 'init',
            'client_id' => $client_id,
            'msg' => '初始化成功',
            'data' => ''
        )));
    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {

    }

    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        // 向所有人发送
        GateWay::sendToAll($client_id, json_encode(array(
            'type' => 'close',
            'client_id' => $client_id,
            'msg' => '链接断开',
            'data' => ''
        )));
    }
}
