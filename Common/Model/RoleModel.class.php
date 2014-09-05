<?php
/**
 * Created by PhpStorm.
 * User: lxd
 * Date: 14-9-5
 * Time: 上午10:47
 */
namespace Common\Model;
use Think\Model;
class RoleModel extends Model{
    protected $_validate = array(
        array('name','require','名字是必须的!'),
    );

    protected $_auto = array(
        array('status',1),
    );

    public function getAllRoles(){
        return $this->select();
    }
}