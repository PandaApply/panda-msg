# Thinkphp6.0中的服务介绍
> 官方文档：https://www.kancloud.cn/manual/thinkphp6_0/1037490

`tp的服务优先级比较高，基本上框架开始->服务层->路由->中间件->控制器->视图，在服务层可以做好多事了。加载各种应用，TP内置的各种核心组件就是通过服务和容器控制实现的`

## Demo案例
创建一个Shut.php类，这个类是被服务的类
```php
<?php
namespace app\common;
 
class Shut
{
    // 书写一个静态的变量 方便调用
    // 这也是一个可更改的变量
    public static $name = 'Panda';
    // 书写一个更改静态变量的方法，同时这里也要为静态的
    public static function setName($name)
    {
        self::$name = $name;
    }
 
    public function run()
    {
        halt(self::$name . "温馨提示，系统已关闭...");
    }
 
}
```
使用命令行，生成一个对Shut.php服务的服务类ShutService.php
命令行语句：php think make:service ShutService 
服务类有两个方法，一个是服务注册 register() ，一个是服务启动 boot()

```php
<?php
declare (strict_types = 1);
 
namespace app\service;
 
use app\common\Shut;
 
class ShutService extends \think\Service
{
    /**
     * 注册服务
     *
     * @return mixed
     */
    public function register()
    {
       // 绑定一个标识，意思是将被服务的类绑定到容器里
        // shut 是标识，Shut::class 是被绑定的被服务类
        $this->app->bind('shut',Shut::class);
    }
 
    /**
     * 执行服务
     *
     * @return mixed
     */
    public function boot()
    {
        //
        Shut::setName('李四');
    }
}
```

将系统服务配置到全局定义文件里
```php
<?php
 
// 系统服务定义文件
// 服务在完成全局初始化之后执行
return [
    \app\service\ShutService::class,
];
```
使用
```php
<?php
namespace app\controller;
 
use app\BaseController;
use app\common\Shut;
 
class Index extends BaseController
{
 
    public function test(Shut $shut)
    {
        // 使用那个服务类有三种方法
        // 第一种：就是直接在方法中注入依赖，也就是上面的 test(Shut $Shut),然后下面就可以用了.
        $shut->run();
        // 第二种：使用助手函数
        // 提示，这里的shut指的是我们在注册服务时写的标识，如果标识为abc，那么这里也要为abc
        app()->shut->run();
        // 第三种：继承基础控制器 BaseController 才能使用
        $this->app->shut->run();
    }
}
```
> 如果你需要在你的扩展中注册系统服务，首先在扩展中增加一个服务类，然后在扩展的composer.json文件中增加如下定义

```json
"extra": {
    "think": {
        "services": [
            "think\\captcha\\CaptchaService"
        ]
    }
},
```
