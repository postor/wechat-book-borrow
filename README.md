# 定制yii2的权限控制

基于yii2-advanced模板

## 启动此项目

### 迁出

```
git clone xxx
cd xxx
```

### 初始化环境，选dev可以看调试信息

```
./init
```

### 准备好mysql数据库，微信公众号后台，填好配置

`common/config/main-local.php`

```
<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
```

`frontend/config/main-local.php`

```
$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'wCeGjv-08gZPemwROGk5fnAq-eDV9nu6',
        ],
        'wechat' => [
            'class' => 'callmez\wechat\sdk\Wechat',
            'appId' => 'wx2506434984b44fa7',
            'appSecret' => '093dc1f822d6cb241a00f6455cf8f987',
            'token' => 'VwNgMZEO7M6mw9Bn'
        ],
    ],
];
```

### 初始化数据库

```
./yii migrate
```

### 启动服务


```
./yii serve --docroot="frontend/web/" 0.0.0.0 --port=80
```

前端服务供微信扫码，所以必须手机能访问，`0.0.0.0`表示绑定所有ip

注意修改微信后台的网页服务安全域名，`--port=80`是因为其他端口微信会报错

```
./yii serve --docroot="backend/web/"
```

后台服务为数据管理，账号系统使用yii2-advanced模板提供的，在前端服务中注册，后台登录后进行表管理

如需关闭注册服务可通过修改参数配置


`frontend/config/params-local.php`

```
return [
    'enableRegister' => false,
];

```

让后台服务生成对应前台地址的二维码

``common/config/params-local.php``

```
return [
    'qrCodeUrlTemplate' => 'http://192.168.1.xx/?r=borrow&id={}',
];
```

其中`{}`会被替换为图书ID，

### 使用方法

- 1.前端注册账号
- 2.后台登录
- 3.关闭账号注册
- 4.后台录入图书
- 5.后台打印图书二维码
- 6.将二维码贴在对应的书上
- 7.用户关注公众号
- 8.用户扫书上的码即可借书
- 9.后台设置微信用户的姓名、是否管理员
- 10.设置为管理员的微信用户扫图书二维码表示图书归还

### 最初的设计

这是做之前的草稿，虽然没有全做完，演示微信扫码功能还是够用了

[基于微信扫码的图书借阅管理系统界面设计](./基于微信扫码的图书借阅管理系统界面设计.pdf)