# phpsso
php ＋ js 简单单点登录框架

###SSO介绍

>SSO英文全称Single Sign On，单点登录。
SSO是在多个应用系统中，用户只需要登录一次就可以访问所有相互信任的应用系统。
它包括可以将这次主要的登录映射到其他应用中用于同一个用户的登录的机制。
它是目前比较流行的企业业务整合的解决方案之一。

####原理说明

1. 用户访问目标网站 (profile.phpsso.com)
2. 目标网站(profile.phpsso.com)执行phpsso client js
3. phpsso client js发送异步请求向验证服务器（login.phpsso.com）发送验证请求
4. 验证服务器（login.phpsso.com）未登陆，phpsso client js执行跳转登陆界面(login.phpsso.com)，输入用户名、密码验证。已登陆跳转到**步骤5**。
5. 验证服务器（login.phpsso.com）验证通过，phpsso client js成功执行回调事件

_*注：phpsso client js为客户端 [login.js](https://github.com/ouyangjunqiu/phpsso/blob/master/client/login.js)_

####目录结构说明：

｜－ server *服务端，主要登录验证程序，简单案列*

｜－ client *客户端，需要部署到需要验证的应用中*

####安全性
验证都是通过cookie传递，相对安全性一般。

目标网址与验证服务器无双向验证，相对简单。
