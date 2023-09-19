<?php

namespace panda\msg\facade;

use think\Facade;

/**
 * User: ZhaoHongYu
 * Date: 2023/9/15
 * Desc: 门面
 * @mixin \panda\msg\PandaMsg
 * @method void sendMsgUid(int|string|array $uid, string $message) 向uid绑定的所有在线client_id发送数据。
 */
class PandaMsg extends Facade
{
    protected static function getFacadeClass()
    {
        return 'panda\msg\PandaMsg';
    }
}
