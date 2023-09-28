> 参考文档：
>
> composer常用命令：[这些Composer命令，你肯定用到着！](https://zhuanlan.zhihu.com/p/150968844)
> 
> 

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


## Composer中的autoload自动加载 （PSR-4 是当前推荐的加载方式）
参考：[Composer的自动加载机制](https://www.cnblogs.com/caibaotimes/p/13810329.html)
1. PSR-0（不推荐使用);
2. PSR-4 : `{'psr-4':{ "Panda\\Msg\\": "src/"}}` 是一个基于psr-4（http://www.php-fig.org/psr/psr-4/）规则的类库自动加载对应关系，只要在其后的对象中，以 "命名空间": "路径" 的方式写入自己的类库信息即可。
3. Class-map : `{'class-map':['a/','b/','c/']}`composer会搜寻我们指定的目录或文件,会自动扫描a，b，c目录下以.php结尾的class。并生成新的文件映射关系，放到/vendor/composer/aotuload_classmap
4. Files : `"files": ["src/helper.php" ]` 这个一般都是加载全局php文件,这种方式不管加载的文件是否用到始终都会加载，而不是按需加载

### 自动加载索
当我们更改了 composer.json 文件中的 autoload 时，需要执行 composer dump-autoload，来让 autoload 立即生效。而不必执行 install 或 update 命令。
```shell
composer dump-autoload
composer dumpautoload -o
```

## repositories属性详解
> 默认的，Composer 只使用 Packagist 仓库。通过指定仓库地址，你可以从任何地方获取包。

支持的仓库的类型有：
1. composer
   composer 仓库通过网络提供 packages.json 文件，它包含一个 composer.json 对象的列表，还有额外的 dist 或 source 信息。packages.json 文件通过 PHP 流加载。
2. vcs
   版本控制系统仓库，如：git、svn、hg。
3. pear
   通过它，你可以导入任何 pear 仓库到你的项目中。
4. package
   如果你依赖一个不支持 composer 的项目，你可以定义一个 package 类型的仓库，然后将 composer.json 对象直接写入。

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "http://packages.example.com"
        },
        {
            "type": "composer",
            "url": "https://packages.example.com",
            "options": {
                "ssl": {
                    "verify_peer": "true"
                }
            }
        },
        {
            "type": "vcs",
            "url": "https://github.com/Seldaek/monolog"
        },
        {
            "type": "pear",
            "url": "http://pear2.php.net"
        },
        {
            "type": "package",
            "package": {
                "name": "smarty/smarty",
                "version": "3.1.7",
                "dist": {
                    "url": "http://www.smarty.net/files/Smarty-3.1.7.zip",
                    "type": "zip"
                },
                "source": {
                    "url": "http://smarty-php.googlecode.com/svn/",
                    "type": "svn",
                    "reference": "tags/Smarty_3_1_7/distribution/"
                }
            }
        }
    ]
}

```
## composer中的extra(扩展)属性


## 发布一个Composer包
1. 打开[Github](https://github.com/PandaApply/panda-msg.git),复制要发布的Composer扩展
2. 打开[Packagist](https://packagist.org/)点击右上角的Submit
3. 将仓库的地址填入Repository URL，然后点击Check
4. 最后回到Github，Release一个版本，packagist就能自动更新

> composer require panda-zhy/msg
> 
> 发布成功安装会报错 Could not find a version of package panda-zhy/msg matching your minimum-stability (stable). Require it with an explicit version constraint allowing its desired stability.
> 
> 解决办法:
> 1. composer require panda-zhy/msg:dev-master 需要加上dev-master  才行。因为这还不是一个正式的版本
> 2. composer会自动解析git的版本 
>    1. git commiit后执行git tag给代码打上标签
>    2. git tag 1.0.0
>    3. 使用 git push 命令将修改后的代码和标签推送到Git仓库 --- git push origin master --tags

