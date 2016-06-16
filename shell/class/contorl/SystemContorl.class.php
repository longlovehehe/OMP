<?php
/**
 * 系统控制器，包含 系统首页，修改密码等
 * @package Common
 * @require {@see contorl} {@see area} {@see enterprise}
 */
class SystemContorl extends contorl
{

    public function __construct ()
    {
        parent::__construct ();
    }

    /**
     * 登录后的首页
     */
    public function index ()
    {
        $_REQUEST['d_area'] = '#';
        $system = new System ( $_REQUEST );
        //$list = $system->getList();
        $ep = new enterprise ( $_REQUEST );
        $device = new device ( $_REQUEST );
        $this->smarty->assign ( "en" , $ep->getTotal () );
        $this->smarty->assign ( "device" , $device->getMDSTotal () );
        //$this->smarty->assign("list", $list);
        $this->render ( 'modules/system/index.tpl' , L("首页") );
    }

    /**
     * 个人信息查看显示层
     * @deprecated 未使用
     * @category view
     */
    public function person ()
    {
        $user = $_SESSION['om_id'];
        $this->smarty->assign ( "username" , $user );
        $this->render ( 'modules/system/person.tpl' , L("个人信息查看") );
    }

    /**
     * 个人信息查看
     * @deprecated 未使用
     */
    public function person_edit ()
    {
        $this->render ( 'modules/system/person_edit.tpl' , L("个人信息查看") );
    }

    /**
     * 修改密码显示层
     */
    public function resetpassword ()
    {
        $this->render ( 'modules/system/resetpassword.tpl' , L("修改密码") );
    }

    /**
     * 首页公告详细内容
     */
    public function pro_details ()
    {
        $system = new system ( $_REQUEST );
        $data = $system->pro_details ();
        $this->smarty->assign ( "data" , $data );
        $this->render ( 'modules/system/pro_details.tpl' );
    }

    /**
     * 首页公告显示层
     */
    public function announcement ()
    {
        $this->render ( 'modules/system/announcement.tpl' , L("标题") );
    }

    /**
     * 首页公告列表后台接口
     */
    public function index_item ()
    {
        $system = new system ( $_REQUEST );
        $page = new page ( $_REQUEST );
        $list = $system->getList ();
        $page->setTotal ( $system->getAnTotal () );
        $getAnList = $system->getAnList ( $page->getLimit () );
        $this->smarty->assign ( 'getAnList' , $getAnList );
        $numinfo = $page->getNumInfo ();
        $prev = $page->getPrev ();
        $next = $page->getNext ();
        $this->smarty->assign ( "list" , $list );
        $this->smarty->assign ( 'numinfo' , $numinfo );
        $this->smarty->assign ( 'prev' , $prev );
        $this->smarty->assign ( 'next' , $next );
        $this->htmlrender ( 'modules/system/index_item.tpl' );
    }

    /**
     * 修改密码后台接口
     */
    public function changepassword ()
    {
        $system = new system ( $_REQUEST );
        $data = $system->chgPwd ();
        echo json_encode ( $data );
    }
    
     public function sysconfig(){
        $tools = new tools();
        $config = $tools->getconfig();
        $this->smarty->assign ( 'sys_maintain' , $config['config']['maintain']==FALSE?"0":"1");
        $this->render ( 'modules/system/sysconfig.tpl' );
    }
     public function setsystem(){
         $system = new system ( $_REQUEST );
         echo json_encode($system->setsystem());
         die;
    }

}
