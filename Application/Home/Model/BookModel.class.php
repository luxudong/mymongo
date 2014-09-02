<?php
namespace Common\Model;
use Think\Model;

/**
 * Class CommentModel 用户模型
 * @package Common\Model
 */
class BookModel extends Model {

	/**@author lxd
	 * @description 定义自动验证
	 */
	protected $_validate    =   array(
		array('name','require','书名是必须的！'),
	);

	/**@author lxd
	 * @description 定义自动完成
	 */
	protected $_auto = array(
		//status默认为0
		array('status','ON_ROAD'),
		//valid默认为0
		array('valid','0'),
		//创建时间使用当前时间戳
		array('establish_time','time',1,'function'),
	);

	/**@author lxd
	 * @description 根据id查找name字段
	 * @param $id
	 * @return mixed
	 */
	public function findName($id){
		$res=$this->find($id);
		return $res["name"];
	}

	/**
	 * @author lxd
	 * @description 获取指定条件的书
	 * @param string $feild
	 * @param string $where
	 * @return mixed 数据库项
	 */
	public function find_books($where=''){
		return $this->where($where)->select();
	}

	/**
	 * @author lxd
	 * @description 根据id获取指定书项
	 * @param $id
	 * @return mixed
	 */
	public function find_book_by_id($id){
		return $this->where('id='.$id)->find();
	}

	/**@author lxd
	 * @description 更新数据项
	 * @param string $where
	 * @param string $data
	 * @return bool
	 */
	public function update($where='',$data=''){
		return $this->where($where)->save($data);
	}

    /**
     * @author Edwin
     * @description 查找捐书信息
     * @param $id
     * @return mixed
     */
    public  function find_donate($id){
        $map['contributor_id']=$id;
        $res=$this->where($map)->select();
        return $res;
    }

    /**
     * @author Edwin
     * @param $id
     */
    public function find_borrow($id){
        $map['contributor_id']=$id;




    }


    /**
     * @author lish
     * @description 返回正在路上的书籍列表（带有分页）
     * @param null $limit
     * @return mixed
     */
    public function list_book_user($limit=null,$where){

        if($limit!=null){
            $limitStr="limit $limit";
        }else{
            $limitStr="";
        }
	    $whereStr="";
	    foreach($where as $key=>$value){
		    $whereStr.=" and b.".$key."='".$value."'";
	    }
        $sql="select b.*,u.username from sy_book as b,sy_user as u where b.contributor_id=u.id $whereStr order by b.establish_time desc $limitStr;";
        $res=$this->query($sql);

        return $res;
    }

    /**
     * @author Edwin
     * @description 返回搜索到的书籍数量
     * @param $keyword 关键字
     * @return mixed
     */
    public function search_num($keyword,$where){
	    $whereStr="";
	    foreach($where as $key=>$value){
		    $whereStr.=" and $key='".$value."'";
	    }
        $sql="select count(*) as num from sy_book where name LIKE '%".$keyword."%' $whereStr";
        $res=$this->query($sql);

        return $res[0]['num'];

    }

    /**
     * @author Edwin
     * @description 返回搜索到的书籍
     * @param $keyword 关键字
     * @return mixed
     */
    public function search($keyword,$limit=null,$where){
        if($limit){
            $limitString="limit $limit";
        }else{
            $limitString="";
        }
	    $whereStr="";
	    foreach($where as $key=>$value){
		    $whereStr.=" and $key='".$value."'";
	    }
        $sql="select * from sy_book where name LIKE '%".$keyword."%'  $whereStr $limitString";
        $res=$this->query($sql);

        return $res;

    }
     /**
      * @author Edwin
      * @description 返回排名前十的用户的捐书数量以及用户名
      * @return mixed
      *
      */
     public function  donate_count(){
           $sql="select username,count('sy_book.contributor_id') as num from sy_book LEFT JOIN sy_user ON sy_user.id=sy_book.contributor_id  group by sy_book.contributor_id order by num DESC LIMIT 10";
           $res=$this->query($sql);
           return $res;
     }

	public function min_book_library(){
		return $this->field('id,library_id,count(id)')->group('library_id')->order('count(id)')->find();
	}
}