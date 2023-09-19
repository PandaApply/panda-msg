<?php

namespace panda\msg;

use GatewayClient\Gateway;
use think\facade\Config;

/**
 * User: ZhaoHongYu
 * Date: 2023/9/18
 * Desc:
 */
class PandaMsg extends Gateway
{
    public function __construct()
    {
        self::$registerAddress = Config::get('panda.registerAddress');
    }

    /**
     * 向所有客户端连接(或者 client_id_array 指定的客户端连接)广播消息
     *
     * @param array $data 向客户端发送的消息
     * @param array|null $client_id_array 客户端 id 数组
     * @param array|null $exclude_client_id 不给这些client_id发
     * @param bool $raw 是否发送原始数据（即不调用gateway的协议的encode方法）
     * @return void
     */
    public static function sendAll(array $data, array $client_id_array = null, array $exclude_client_id = null, bool $raw = false): void
    {
        self::sendToAll(json_encode($data));
    }

    /**
     * 向 group 发送
     * @param array|int|string $group 组（不允许是 0 '0' false null array()等为空的值）
     * @param array $data 数据
     * @param array|null $exclude_client_id 不给这些client_id发
     * @param bool $raw 发送原始数据（即不调用gateway的协议的encode方法）
     */
    public static function sendMsgGroup(array|int|string $group, array $data, array $exclude_client_id = null, bool $raw = false)
    {
        return self::sendToGroup($group, json_encode($data), $exclude_client_id, $raw);
    }


    /**
     * 向uid绑定的所有在线client_id发送数据。
     *
     * @param int|string|array $uid
     * @param array $data 数据
     */
    public static function sendMsgUid(int|string|array $uid, array $data): void
    {
        self::sendToUid($uid, json_encode($data));
    }


    public static function socketRes($type, $data = [], $msg = "")
    {
        $result = [
            "type" => $type,
            "msg" => $msg,
            "data" => $data,
            "time" => time()
        ];
        return json_encode($result);
    }

}
