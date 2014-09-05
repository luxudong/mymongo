<?php
/**
 * Created by PhpStorm.
 * User: lxd
 * Date: 14-9-5
 * Time: 上午11:24
 */
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

define('BIND_MODULE','Home');