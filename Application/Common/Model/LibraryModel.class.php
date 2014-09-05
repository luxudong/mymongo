<?php
/**
 * Created by PhpStorm.
 * User: lxd
 * Date: 14-9-4
 * Time: 下午7:44
 */

namespace Common\Model;
use Think\Model;

class LibraryModel extends Model{
    protected $_validate = array(
        array('name','require','图书馆名是必须的！'),

    );

    protected $_auto = array(
        array('establish_time','time',1,'function'),
    );

    public function getLibraries(){
        return $this->select();
    }
} 