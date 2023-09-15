# Panda消息扩展
![img.png](image/img.png)

`使用workerman进一步封装，单向推送给客户端，服务端代码可自由发挥实现,该扩展只实现单向通知客户端`

## 使用方式
1. `composer require panda-zhy/msg`
2. `php think panda:create 该命令操作会自动创建workerman启动文件以及生成gateway进程启动脚本、businessWorker进程启动脚本、注册服务启动脚本` 
