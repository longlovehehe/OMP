<?php

/**
 * 代理商控制器
 * @category  账号管理
 * @package 代理商管理
 * @subpackage  控制器层
 */
class AgentsContorl extends contorl
{

    public $agents;
    public $page;
    public $basic;
/**
 * 代理商构造函数
 * 初始化参数
 */
    public function __construct ()
    {
        parent::__construct ();
        $this->agents = new agents ( $_REQUEST );
        $this->page = new page ( $_REQUEST );
        $this->basic=new basic($_REQUEST);
    }

    /**
     * 代理商首页
     * 展示首页
     */
    public function index ()
    {
        $this->render ( 'modules/agents/agents.tpl' , L('代理商管理') );
    }

    /**
     * 添加或编辑代理商页面
     */
    public function agents_save ()
    {
        //获得当前代理商编号
        $ag_number = $this->agents->getagNum ();
        $data = 0;
        $parent_id="000";
        $date=  date(ymd);
        if ( $_REQUEST["do"] != 'edit' )
        {
            $mininav = array (
            array (
                "url" => "?m=agents&a=index" ,
                "name" => L("代理商管理") ,
                "next" => ">>"
            ) ,
            array (
                "url" => "#" ,
                "name" => L("新增代理商") ,
            )
        );
            if ( count ( $ag_number ) == 0 )
            {
                $id="001";
                $data=$id.$parent_id.$date;
            }
            else
            {
               
               $id=substr($ag_number[0]['ag_number'],0,3);
               $id=autoInc($id);
               $data = $id.$parent_id.$date;
            }
           
            $this->smarty->assign ( 'mininav' , $mininav );
            $this->smarty->assign ( 'data' , $data );
            $this->smarty->assign ( 'ep_phone_num' , $ep_phone_num );
            $this->smarty->assign ( 'ag_phone_num' , $ag_phone_num );
            $this->smarty->assign ( 'res' , $_REQUEST );
            //$this->smarty->assign ( 'info' , $info );
            //$this->smarty->assign ( 'se' , $list );
            if($_SESSION['ident']=="VT"){
                    $this->render ( 'modules/agents/agents_save_vt.tpl' , L('新增代理商') );
               }else if($_SESSION['ident']=="GQT"){
                     $this->render ( 'modules/agents/agents_save.tpl' , L('新增代理商') );
               }else{
                     $this->render ( 'modules/agents/agents_save_vt.tpl' , L('新增代理商') );
               }
           
        }
        else
        {
            $mininav = array (
            array (
                "url" => "?m=agents&a=index" ,
                "name" => L("代理商管理") ,
                "next" => ">>"
            ) ,
            array (
                "url" => "#" ,
                "name" =>L("编辑代理商") ,
            )
        );
            $agents = new agents ( );
            $info = $this->agents->getByid ();
            $_REQUEST['id']=$_REQUEST['ag_number'];
            $basic=new basic($_REQUEST);
            $res=$basic->getByid();
            /**
             * 获取当前代理商已分配用户
             */
            $permit=new permit();
            $dd=$permit->get_ag_permit1(array ( 'ag_number' => $_REQUEST['ag_number'] ),array ( 'aggents_number' => $_REQUEST['ag_number'] , 'ag_level' =>$info['ag_level'] ));
            $agents = new agents ( array ( 'ag_number' => $_REQUEST['ag_number'] ) );
            $info = $agents->getByid ();
            $this->smarty->assign ( 'mininav' , $mininav );
            $this->smarty->assign ( 'data' , $_REQUEST['ag_number'] );
            $this->smarty->assign ( 'res' , $_REQUEST );
            $this->smarty->assign ( 'info' , $info );
            $this->smarty->assign ( 'result' , $res );
            $this->smarty->assign ( 'phone_num' , $dd['phone'] );
            $this->smarty->assign ( 'dispatch_num' , $dd['dispatch']);
            $this->smarty->assign ( 'gvs_num' , $dd['gvs'] );

            $this->smarty->assign ( 'se' , $_SESSION['own'] );
            if($_SESSION['ident']=="VT"){
                    $this->render ( 'modules/agents/agents_save_vt.tpl' , L('编辑代理商') );
               }else if($_SESSION['ident']=="GQT"){
                     $this->render ( 'modules/agents/agents_save.tpl' , L('编辑代理商') );
               }else{
                     $this->render ( 'modules/agents/agents_save_vt.tpl' , L('编辑代理商') );
               }
        }
    }

    /**
     * 代理商列表
     */
    public function agents_item ()
    {
        $list = $this->agents->getList ( $this->page->getLimit () );
        $total = $this->agents->getTotal ();
        $this->page->setTotal ( $total );
        $numinfo = $this->page->getNumInfo ();
        $prev = $this->page->getPrev ();
        $next = $this->page->getNext ();
        foreach ( $list as $k => $v )
        {
            foreach ( $list as $key => $value )
            {
                if ( strpos ( $value['ag_path'] , $v['ag_number'] ) > 0 )
                {
                    $str_path = trim ( $value['ag_path'] , "|" );
                    $arr_path = explode ( "||" , $str_path );
                    $arr_num = count ( $arr_path );
                    $arr_key = array_search ( $v['ag_number'] , $arr_path );
                    if ( $arr_num - $arr_key > 1 )
                    {
                        $list[$k]['stat'] = 1;
                        break;
                    }
                }
            }

            $ep = new enterprise ( array ( "ag_number" => $v['ag_number'] ) );
            $res = $ep->getList_ag ();
            if ( count ( $res ) > 0 )
            {
                $list[$k]['stat'] = 1;
            }
        }

        $this->smarty->assign ( 'numinfo' , $numinfo );
        $this->smarty->assign ( 'prev' , $prev );
        $this->smarty->assign ( 'next' , $next );

        $this->smarty->assign ( "list" , $list );
        $this->htmlrender ( 'modules/agents/agents_item.tpl' );
    }

    /**
     * 代理商保存
     * @throws Exception 错误时抛出相关异常
     */
    public function save ()
    {
        //$this->agent_license ();
        try
        {
            $msg=$this->agents->save ();
            
            $_REQUEST['id']=$_REQUEST['ag_number'];
            $basic=new basic($_REQUEST);
            $basic->save_price_ag();
        }
        catch ( Exception $exc )
        {
            throw new Exception ( $exc->getMessage () );
        }
        $this->tools->call ( $msg['msg'] , 0 , true );
    }
/**
 * 批量删除代理商
 * <pre>
 *  有子级代理 不允许删除
 * </pre>
 */
    public function batchdel ()
    {
        $list = $_REQUEST['checkbox'];
        foreach ($_REQUEST['checkbox'] as $key => $value) {
            $res=$this->agents->getchild($value);
            if($res>=1){
                unset($list[$key]);
            }
        }
        
        $count = $this->agents->delList ( $list );
        echo $count;
        exit ();
    }
/**
 * 获得当前代理商列表
 * @param type $data 权限信息
 */
    public function option ( $data )
    {
        $list = $this->agents->getoptionlist ();
        $this->smarty->assign ( "list" , $list );
        $this->htmlrender ( 'modules/agents/agents_option.tpl' );
    }
    /**
     * 代理商许可
     */
    public function agent_license ()
    {
        //获得当前登录代理商的手机,调度台,GVS最大允许数
        $agent = new agents ( $_REQUEST );
        $info = $agent->getByid ();
        var_dump ( $info );
        die;
    }
    /**
     * 检查代理商许可
     */
    public function check_agents_license(){
        //获得当前登录代理商的手机,调度台,GVS最大允许数
        $permit=new permit();
        $dd=$permit->get_ag_permit(array ( 'ag_number' => $_REQUEST['ag_number'] ),array ( 'aggents_number' => $_REQUEST['ag_number'] , 'ag_level' => "1" ));
        $phone=$_REQUEST['ag_phone_num'];
        $dispatch=$_REQUEST['ag_dispatch_num'];
        $gvs=$_REQUEST['ag_gvs_num'];
        if($_REQUEST['do']=="edit"){
                if ($phone < $dd['phone']) {
                        throw new Exception(L("手机用户数小于已存在手机用户数,最小应为").":" . $dd['phone'], -1);
                } else if ($dispatch <  $dd['dispatch']) {
                        throw new Exception(L("调度台用户数小于已存在调度台用户数,最小应为").":" . $dd['dispatch'], -1);
                } else if ($gvs <  $dd['gvs']) {
                        throw new Exception(L("GVS用户数小于已存在GVS用户数,最小应为").":" . $dd['gvs'], -1);
                }
        }     
    }
    
     function check_name(){
        $res=$this->agents->get_can_name();
        if($res==true){
            echo "1";
        }else{
            echo "2";
        }
    }

}
