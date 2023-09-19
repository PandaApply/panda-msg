<?php

namespace panda\msg\facade;

use think\Facade;

/**
 * User: ZhaoHongYu
 * Date: 2023/9/15
 * Desc: 门面
 * @mixin \panda\msg\PandaMsg
 * @method void sendAll() 向所有客户端连接或者client_id_array指定的客户端连接广播消息
 * @method bool sendMsgGroup() 向 group 发送
 * @method void sendMsgUid() 向uid绑定的所有在线client_id发送数据。
 */
class PandaMsg extends Facade
{
    protected static function getFacadeClass()
    {
        return 'panda\msg\PandaMsg';
    }
}
