# 将Laravel框架进行一些配置处理，让其在开发API时更得心应手

## 来源

根据fork的gaosi的项目使用laravel6.0进行学习重写


## 实现功能

- 解决跨域问题

- 统一Response响应处理

- Api-Resource资源返回

- 使用Enum枚举

- jwt-auth用户认证与无感知自动刷新

- jwt-auth多角色认证不串号

- 单一设备登陆

- horizon管理异步队列

- 添加php_cs格式化代码

- 开发环境使用laravel-log-viewer

## 环境

| 程序 | 版本 |
| -------- | -------- |
| PHP| `>= 7.2` |
| MySQL| `>= 5.5` |
| Redis| `>= 2.8` |

## 安装

1.先把项目克隆到本地

```
git clone https://github.com/gangsusu/Laravel_api_init.git
```

2.打开项目目录，下载依赖扩展包

```
composer install
```

3.复制配置文件

```
cp .env.example .env
```
自行配置`.env`里的相关配置信息

4.生成`APP_KEY`和`JWT_SECRET`
```
php artisan key:generate
php artisan jwt:secret
```

5.创建迁移
```
php artisan migrate
```

6.填充数据
```
php artisan db:seed
```

## 测试数据
users:
guoasi1    12345678
guoasi2    12345678

admins:
guaosi123  12345678
guaosi124  12345678