<?php

namespace panda\msg\enum;

/**
 * User: ZhaoHongYu
 * Date: 2023/9/19
 * Desc: 消息类型
 */
abstract class MsgEnum
{
    // 系统通知
    const SYSTEM = 'system';
    /**
     * 系统通知-好友申请
     */
    const SYSTEM_FRIEND_APPLY = 'system_friend_apply';
    /**
     * 系统通知-站内消息
     */
    const SYSTEM_PRIVATE_MSG = 'system_private_msg';
//    const SYSTEM = 'system';
}
