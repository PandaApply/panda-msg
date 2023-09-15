<?php


namespace panda\msg;


use panda\msg\command\SecretCommand;

/**
 * User: ZhaoHongYu
 * Date: 2023/9/14
 * Desc: 服务：参考官方文档：https://www.kancloud.cn/manual/thinkphp6_0/1037490
 * 大白话解释：把一个类的对象注册到容器里面，方便调用。它的优先级很高在程序执行前就已经完成了注入，可以做一些初始化，配置一些参数，扩展插件等等
 */
class Service extends \think\Service
{
    public function boot()
    {
        $this->commands(SecretCommand::class);
    }
}
