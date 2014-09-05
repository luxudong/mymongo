<?php
/**
 * Created by PhpStorm.
 * User: lxd
 * Date: 14-9-5
 * Time: 上午10:08
 */
namespace Home\Model;
use Think\Model;

class BookModel extends Model{
    protected $_validate = array(
        array('name','require','书名是必须的！'),
    );
    protected $_auto = array(
        array('catagory','0'),
    );

    public function getAllBooks(){
        return $this->select();
    }
}