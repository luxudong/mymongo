<?php
namespace Home\Controller;
use Think\Controller;

use \Application\Common\Model;

class IndexController extends Controller {
    public function index(){

        /*
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>[ 您现在访问的是Home模块的Index控制器 ]</div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
//        $userDB = D("User");
//        $res = $userDB->select();
//        foreach($res as $r){
//            $temp = $r['username'];
//        }
//        $this->username = $temp;



        $model = D("User");

        $res = $model->select();


//        $res1= new \MongoClient("mongodb://localhost:27017");
//        $gridfs = $res1->selectDB('test')->getGridFS();
//        $id = $gridfs->storeFile('C:\\Users\\lxd\\Downloads\\open.png');
//        $gridfsFile = $gridfs->get($id);
//        var_dump($gridfsFile->file);
//        pt($gridfsFile);

        //pt($res);


        $files = D("File");
        $result = $files->select();

        $binarray = array();
        foreach($result as $r){
            //pt($r["data"]->bin);
            echo($r['data']->bin);
            $binarray[]= $r['data']->bin;
        }

        //pt($result);
        //die();

        $this->list=$binarray;
        $this->display();
        */

        $name = MODULE_NAME;
        //$libraryDD = new Model\LibraryModel();
        $libraryDB = D("Library");

//        $bookDB = D("Book");
//        $res = $bookDB->getAllBooks();


        $res = $libraryDB->getLibraries();

        $this->display();
    }


}