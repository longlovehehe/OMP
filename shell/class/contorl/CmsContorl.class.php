<?php
/**
 * 版本控制器
 * @category  管理员管理
 * @package 版本管理
 * @subpackage  控制器层
 */
class CmsContorl extends contorl {
    public $cms;
    public function __construct() {
        parent::__construct();
        $this->cms= new cms($_REQUEST);
    }

    /**
     * 版本控制首页
     */
    public function index() {
        $cms = new cms($_REQUEST);
        $page = new page($_REQUEST);
        $android_info = $cms->getandroidList($page->getLimit());
        $ios_info = $cms->getiosList($page->getLimit());
        $this->smarty->assign('android_info', $android_info);
        $this->smarty->assign('ios_info', $ios_info);
        $this->smarty->assign('title', "版本管理");
        $this->render('modules/cms/index.tpl', L('版本管理'));
    }
    /**
     * Keeper相关展示页
     */
    public function index_keeper() {
        $cms = new cms($_REQUEST);
        //$page = new page($_REQUEST);
        //$android_info = $cms->getandroidList($page->getLimit());
        //$ios_info = $cms->getiosList($page->getLimit());
        $info=$cms->get_keeper("GQT-KEEPER");
        //获取图片
        $this->smarty->assign('info', $info);
        $this->smarty->assign('title', "版本管理");
        $this->render('modules/cms/index_keeper.tpl', L('版本管理'));
    }
    /*
    * console版本控制
    */
    public function index_console() {
        $cms = new cms($_REQUEST);
        $aKey['p_type'] = 'console';
        $console_info = $cms->getconsoleList($aKey);
        $this->smarty->assign('console_info', $console_info);
        $this->smarty->assign('title', "版本管理");
        $this->render('modules/cms/index_console.tpl', L('版本管理'));
    }
    /**
     * 用户头像显示
     */
    function users_face_item() {
            $pic = new pic($_REQUEST);
            $pic->show();
    }
    /**
     * 图像上传
     */
    public function upload_img(){
       
        $pic = new pic($_REQUEST);
        try
            {
                    $result['msg'] = $pic->getId_keeper();
                    $result['status'] = 0;
            } catch (Exception $ex) {
                    $result['msg'] = $ex->getMessage();
                    $result['status'] = -1;
            }
            foreach ($_FILES as $key => $value) {
            if($value['size']>3685728){
                $result['msg'] = "图片大小超过3M限制,请检查图片";
                $result['status'] = -1;
            }
        }
            $result = json_encode($result);
            print <<<RESULT
                <script>parent.callback($result);</script>
RESULT;
    }
/**
 * 上传成功跳转页
 */
    public function upload_soft() {
        $cms = new cms($_REQUEST);
        $ptype = $_REQUEST['ptype'];
        $pdir = $_REQUEST['dir_name'];

        if ($cms->getfetchinfo($ptype, $pdir) && $_REQUEST['flag'] == 'save') {
            if($ptype == 'android')
            {
                $this->smarty->assign('href', '?m=cms&a=index');
            }
            else
            {
                $this->smarty->assign('href', '?m=cms&a=index_console');
            }
            $this->render('viewer/href.tpl', L('CMS管理'));
        } else {
            $res = $cms->upload_soft($_FILES);
            if($ptype == 'android')
            {
                $this->smarty->assign('href', '?m=cms&a=index');
            }
            else
            {
                $this->smarty->assign('href', '?m=cms&a=index_console');
            }
            $this->render('viewer/href.tpl', L('CMS管理'));
        }
    }
    /**
     * Keeper 软件上传<br />
     * 通过Ajax 来异步请求
     */
    public function upload_soft_keeper() {
        $info=  $this->cms->get_keeper("GQT-KEEPER");
        if($info!=false){
            $_REQUEST['flag']="edit";
        }
        $_REQUEST['p_type']="GQT-KEEPER";
        $_REQUEST['p_time']=time();
        $cms = new cms($_REQUEST);
        
        $res = $cms->upload_soft_keeper($_FILES);
        if($res['status']===0){
            echo 1;
        }else{
            echo 2;
        }
    }
/**
 * 获得 软件版本管理信息
 */
    public function getlist() {
        $cms = new cms($_REQUEST);
        $pid = $cms->getById();
        echo $pid;
    }
/**
 * 获得 软件版本管理信息<br />
 * 通过Ajax 来异步请求
 */
    public function getinfo() {
        $cms = new cms($_REQUEST);
        $res = $cms->getinfo();
        echo json_encode($res);
    }
/**
 * 删除目录
 */
    public function del_dir() {
        $cms = new cms($_REQUEST);
        $res = $cms->del_dir();
        echo $res;
    }
/**
 * 清空目录
 */
    public function empty_dir() {
        $cms = new cms($_REQUEST);
        $res = $cms->empty_dir();
        echo $res;
    }
/**
 * 检查名称
 */
    public function checkname() {
        $p_dir = $_REQUEST['p_dir'];
        $p_type = $_REQUEST['p_type'];
        $cms = new cms($_REQUEST);
//           var_dump($cms->getfetchinfo($p_type, $p_dir));
        if ($cms->getfetchinfo($p_type, $p_dir) != false) {
            echo "off"; //获取到
        } else {
            echo "on"; //未获取到
        }
    }

    /**
     * 文件上传页面
     */
    public function keeper_soft(){
        $info=  $this->cms->get_keeper("GQT-KEEPER");
        $this->smarty->assign('list',$info);
        $this->htmlrender("viewer/upload_soft.tpl");
    }

}
