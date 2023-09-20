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


    /**
     * 好友消息
     */
    const CHAT = 'chat';
    // 类型：1文字，2表情，3音频，4文件，5图片，6视频,7预约，8承诺，9合同
    const CHAT_TEXT = 1;
    const CHAT_EMOTE = 2;
    const CHAT_AUDIO = 3;
    const CHAT_FILE = 4;
    const CHAT_IMAGE = 5;
    const CHAT_VIDEO = 6;
    const CHAT_APP = 7;
    const CHAT_PROMISE = 8;
    const CHAT_CONTRACT = 9;

}
