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
     * 向uid绑定的所有在线client_id发送数据。
     *
     * @param int|string|array $uid
     * @param array $data 数据
     */
    public function sendMsgUid(int|string|array $uid, string $message): void
    {
        if (self::isUidOnline($uid)){
            self::sendToUid($uid, $message);
        }
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
