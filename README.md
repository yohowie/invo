[Phalcon][1] 是作为 C 扩展提供的 Web 框架，提供高性能和低资源消耗。

这是 Phalcon PHP 框架的示例应用程序。我们希望实现尽可能多的功能来展示框架及其潜力。

## 开始

master 分支将始终包含最新的稳定版本。如果你希望要检查当前正在开发的旧版本或新版本，请切换到相关
分支。 

### 要求

* PHP >= 7.4
* Phalcon >= 4.1
* MySQL >= 5.7
* 启用了 [mod_rewrite][2] 的 [Apache][3] Web Server 或 [Nginx][4] Web Server
* 启用最新的稳定 [Phalcon][5] 框架发布扩展 

### 安装

1. 将项目复制到本地环境 - `git clone git@github.com:yohowie/invo.git`
2. 复制文件 `cp .env.example .env`
3. 使用您的数据库连接信息编辑 .env 文件
4. 运行数据库迁移 `vendor/bin/phalcon-migrations run`

[1]: https://phalcon.io/
[2]: http://httpd.apache.org/docs/current/mod/mod_rewrite.html
[3]: http://httpd.apache.org/
[4]: http://nginx.org/
[5]: https://github.com/phalcon/cphalcon/releases
