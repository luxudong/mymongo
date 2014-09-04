<?php
/**
 * Created by PhpStorm.
 * User: lxd
 * Date: 14-8-31
 * Time: 下午6:31
 */

namespace Common\Model;
use Think\Model\MongoModel;

class FileModel extends MongoModel{
    protected $_idType = self::TYPE_OBJECT;
    protected $connection = 'mongo://127.0.0.1:27017/';

    protected $dbName='test';//如果配置了全局配置,mongodb数据库和mysql数据库名称不一样的话,必须配置此项
    protected $trueTableName = 'fs.chunks';//数据表名


} 