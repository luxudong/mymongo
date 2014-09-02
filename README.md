思源公益图书馆平台

==

一、环境搭建篇：

1.修改apache中默认的项目文件夹

	在httpd.conf中修改

	DocumentRoot "XXX/htdocs"  为  DocumentRoot "E:/Source/PhpStorm"
	<Directory "XXX/htdocs"> 为 <Directory "E:/Source/PhpStorm">

2.添加apache对php文件的解析

	(下载的php版本应该是VC6 X86 thread safe否则没有php5apache2_2.dll文件)
	在httpd.conf中修改

	#LoadModule vhost_alias_module modules/mod_vhost_alias.so
	在下一行添加 (引号中的位置根据PHP的所在目录而定的,如果php就在apache根目录则如下)

	LoadModule php5_module "php/php5apache2_2.dll"
	PHPIniDir "php"
	AddType application/x-httpd-php .php .html .htm

3.为方便本地测试，添加一个虚拟主机

	a.在C:\Windows\System32\Drivers\etc\hosts文件最后添加(如果保存时提示不能修改，hosts->属性->安全->编辑 全打上勾)
		127.0.0.1 www.siyuan.com
		127.0.0.1 siyuan.com

	b.httpd.conf文件中打开注释 Include conf/extra/httpd-vhosts.conf

	c.在extra/httpd-vhosts.conf文件中添加如下配置：

		<VirtualHost *:80>
			DocumentRoot "E:/Source/PhpStorm/SiYuan"
			ServerName siyuan.com
			ServerAlias *.siyuan.com
			<Directory "E:/Source/PhpStorm/SiYuan">
				DirectoryIndex index.html index.php
				Options Indexes FollowSymLinks
				AllowOverride all
				Order allow,deny
				Allow from all
			</Directory>
			ErrorLog "logs/siyuan.com-error.log"
			CustomLog "logs/siyuan.com-custom.log" common
		</VirtualHost>

	d.重启apache服务器

4.开启apache域名重定向

	在httpd.conf中打开注释
	LoadModule rewrite_module modules/mod_rewrite.so
	所有的AllowOverride均改为All

5.php.ini中打开对mysql的支持

	打开注释：
	extension=php_mysql.dll
	extension=php_mysqli.dll

	//如果没有效果的话，还需要如下这般写：(写出全路径)
	extension=D:/Program/Apache/php/ext/php_mysql.dll
	extension=D:/Program/Apache/php/ext/php_mysqli.dll

	注：查看生效方法，phpinfo();页面中查看是否有mysqli这一个栏目

5.php.ini中打开对imagecreate()函数的支持，方便绘制验证码。

    打开注释：
    extension=php_gd2.dll

    //如果不生效还需写出全路径
    extension=D:/Program/Apache/php/ext/php_gd2.dll

    注：查看生效方法，phpinfo();页面中查看是否有gd这一个栏目

6.在phpStorm添加对Less文件的支持。

	a.下载安装nodejs
	b.安装less: 在nodejs的控制台中输入：
		npm install -g less
	c.在phpStorm中 File->setting
					->File Watcher->Less(可能需要点击+,添加Less)
					->Edit->Program指定为
					C:\Users\XXX\AppData\Roaming\npm\lessc.cmd

7.添加XDebug模块。

	a.下载对应的XDebug.dll文件，放置到php/ext目录下
	b.在php.ini文件中添加如下结点：
		[xdebug]
		zend_extension = D:/Program/Apache/php/ext/php_xdebug-2.2.5-5.4-vc9.dll
		xdebug.remote_enable=on
	c.在phpStorm中Edit Configurations
		添加一个PHP Web Application
		添加一个Server.

8.phpStorm中添加对git的支持。

    a.下载git
    b.在phpStorm中指定git.exe位置
    c.VCS->Enable Version Control Integration

9.对Mysql做的相应设置：

    a.Workbench->Edit->preference->SQL Queries->"Safe Updates".Forbid 不打勾

10.添加对二级域名的支持：

    a.在hosts文件中添加

        127.0.0.1 www.sj.siyuan.com
        127.0.0.1 sj.siyuan.com

        127.0.0.1 www.tj.siyuan.com
        127.0.0.1 tj.siyuan.com

        127.0.0.1 www.fd.siyuan.com
        127.0.0.1 fd.siyuan.com

    b.在httpd-vhosts.conf中添加如下这句话（3中已经完成了这项工作）
        ServerAlias *.siyuan.com


11.添加对mongodb数据库的支持

    a.在php.ini文件中添加如下配置，然后重启apache.
        extension = D:/Program/Apache/php/ext/php_mongo-1.4.5-5.4-vc9.dll
    b.访问www.siyuan.com/index/info，查看是否包含有mongo一栏

二、代码规范篇：

1.项目后端框架采用ThinkPHP3.2.2

    官方网站：http://www.thinkphp.cn/
    学习手册：http://document.thinkphp.cn/manual_3_2.html

    特别提醒：在开发过程中请勿擅自修改/ThinkPHP下的任何代码，如果实在需要修改请征求我的意见。并且在第三篇中添加上修改说明。

2.项目前端框架采用bootstrap3.2

    官方网站：http://getbootstrap.com/
    中文网站：http://www.bootcss.com/

    特别提醒：开发过程中请勿擅自修改/Public/css/Bootstrap3.2.0，/Public/js/bootstrap.js, /Public/js/bootstrap.min.js下任何代码,
    如果确实需要修改，请征求我的意见，并且在第三篇中添加修改说明。

3.JQuery采用1.11.1版本

    官方网站：http://jquery.com/

4.表单验证采用Validform

    官方网站：http://validform.rjboy.cn/

    在需要进行验证的form表单中添加属性 data-validate="true"即可。
    需要验证的格式请参考Validform官网文档。




三、修改说明篇：

1.对ThinkPHP框架的修改：

    a.添加自定义html标签

        在/ThinkPHP/Library/Think/Template/TagLib下添加Sy.class.php文件

    b.修改验证一次就删除session的问题

        在E:\Source\PhpStorm\SiYuan\ThinkPHP\Library\Think\Verify.class.php添加$delete变量。


2.对Bootstrap框架的修改：

    a.重新指定字体资源文件：

        在/Public/css/Bootstrap3.2.0/variables.less中修改如下：
        @icon-font-path:          "../fonts/";
        改为
        @icon-font-path:          "/Public/fonts/";

四、全局变量代码篇

1.全局变量

    a.图书馆相关

    LIBRARY_DOMAIN表示当前访问的图书馆的short_name.
    LIBRARY_NAME表示当前访问的图书馆的name.
    LIBRARY_ID表示当前访问的图书馆的id.

    测试github是否生效，成功了


## 简介

ThinkPHP 是一个免费开源的，快速、简单的面向对象的 轻量级PHP开发框架 ，创立于2006年初，遵循Apache2开源协议发布，是为了敏捷WEB应用开发和简化企业应用开发而诞生的。ThinkPHP从诞生以来一直秉承简洁实用的设计原则，在保持出色的性能和至简的代码的同时，也注重易用性。并且拥有众多的原创功能和特性，在社区团队的积极参与下，在易用性、扩展性和性能方面不断优化和改进，已经成长为国内最领先和最具影响力的WEB应用开发框架，众多的典型案例确保可以稳定用于商业以及门户级的开发。

## 全面的WEB开发特性支持

最新的ThinkPHP为WEB应用开发提供了强有力的支持，这些支持包括：

*  MVC支持-基于多层模型（M）、视图（V）、控制器（C）的设计模式
*  ORM支持-提供了全功能和高性能的ORM支持，支持大部分数据库
*  模板引擎支持-内置了高性能的基于标签库和XML标签的编译型模板引擎
*  RESTFul支持-通过REST控制器扩展提供了RESTFul支持，为你打造全新的URL设计和访问体验
*  云平台支持-提供了对新浪SAE平台和百度BAE平台的强力支持，具备“横跨性”和“平滑性”，支持本地化开发和调试以及部署切换，让你轻松过渡，打造全新的开发体验。
*  CLI支持-支持基于命令行的应用开发
*  RPC支持-提供包括PHPRpc、HProse、jsonRPC和Yar在内远程调用解决方案
*  MongoDb支持-提供NoSQL的支持
*  缓存支持-提供了包括文件、数据库、Memcache、Xcache、Redis等多种类型的缓存支持

## 大道至简的开发理念

ThinkPHP从诞生以来一直秉承大道至简的开发理念，无论从底层实现还是应用开发，我们都倡导用最少的代码完成相同的功能，正是由于对简单的执着和代码的修炼，让我们长期保持出色的性能和极速的开发体验。在主流PHP开发框架的评测数据中表现卓越，简单和快速开发是我们不变的宗旨。

## 安全性

框架在系统层面提供了众多的安全特性，确保你的网站和产品安全无忧。这些特性包括：

*  XSS安全防护
*  表单自动验证
*  强制数据类型转换
*  输入数据过滤
*  表单令牌验证
*  防SQL注入
*  图像上传检测

## 商业友好的开源协议

ThinkPHP遵循Apache2开源协议发布。Apache Licence是著名的非盈利开源组织Apache采用的协议。该协议和BSD类似，鼓励代码共享和尊重原作者的著作权，同样允许代码修改，再作为开源或商业软件发布。