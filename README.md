```json
{
    "name": "panda/msg", // 包名称
    "description": "This is a public chat extension package", // 介绍
    "type": "library",
    "license": "MIT", // 开源许可证 -MIT,Apache-2.0,GPL3.0
    "minimum-stability": "stable",        //最小稳定性
    "autoload": { // 自动加载
        "psr-4": { // 加载一个PSR-4规范到Panda\Msg\命名空间
            "Panda\\Msg\\": "src/"
        }
    },
    "authors": [
        {
            "name": "赵宏宇",
            "email": "327698476@qq.com"
        }
    ],
    "require": {
      
    }
}

```
## License 开源许可证
**Apache-2.0,GPL3.0**
1. 软件可以随便用，但不能随便改，比如原商标一般不让修改，你如果修改了某个地方，必须进行突出的通知。
2. 可以免费，可以收费。
3. 软件的源文件里必须有这个许可证文档;
4. 我提供这个软件不是为了犯法，你要用它来犯法，那与我无关;
5. 你用这个软件犯事了，责任全在你自己，与其他贡献者无关。

**MIT**
1. 软件可以随便用，随便改。
2. 可以免费，可以收费。
3. 软件的源文件里必须有这个许可证文档;
4. 我提供这个软件不是为了犯法，你要用它来犯法，那与我无关;
5. 你用这个软件犯事了，责任全在你自己，与其他贡献者无关。

## 理解 Composer 的 minimal-stability 属性
在 **composer.json** 文件中，可以使用 **minimum-stability** 字段来设置最低稳定性等级。该字段的值可以是以下几种之一：
* stable: 仅允许安装稳定版本的软件包，默认值为 stable。
* beta: 允许安装 beta 和稳定版本的软件包。
* RC: 允许安装 RC（Release Candidate）和稳定版本的软件包。
* alpha: 允许安装 alpha、beta 和稳定版本的软件包。
* dev: 允许安装开发版软件包，包括 alpha、beta、RC 和稳定版本。

>使用 **minimum-stability** 选项时，还可以结合使用 **prefer-stable** 选项。**prefer-stable** 
> 的值为 **true** 或 **false**，默认为 **false**。当设置为 **true** 时，**Composer** 倾向于安装稳定版本的软件包，
> 但仍会遵循 **minimum-stability** 的限制。设置为 **false** 时，**Composer** 将更倾向于安装最新的可用版本，包括开发版软件包。

```json
{
    "name": "acme/my-project",
    "require": {
        "some/package": "^1.0"
    },
    "minimum-stability": "beta",
    "prefer-stable": true
}
```
上述配置将允许安装 some/package 的 beta 和稳定版本，同时倾向于安装稳定版本。
