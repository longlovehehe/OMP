<?php

/**
 * 主控制分发器
 * @package Common
 * @require {@see contorl} {@see system}
 */
class DispatcherContorl extends contorl {

	public function __construct() {
		parent::__construct();
	}

	public function lang() {
		$lang = json_encode(coms::$res);
		coms::head('script');
		print("window.lang = $lang ;");
	}

        public function get_sessionid(){
            $username=$_SESSION['own']['om_id'];
            $usermd5= md5($_SESSION['own']['om_id'].$_SESSION['own']['om_pswd']);
            $session_id= session_id();
            echo json_encode(array("username"=>$username,"md5"=>$usermd5,"session_id"=>$session_id));
        }

        /**
	 * 分发器公用方法
	 * @param String $flag 值：none login admin
	 */
	public function common($flag = 'none') {
		session_cache_expire(20);
		$tools = new tools();
		if (file_exists('../private/config/db.json')) {
			$tools->init();
		} else {
			$this->smarty->template_dir = "../template";
			$this->smarty->cache_dir = "../runtime/cache";
			$this->smarty->compile_dir = "../runtime/template_c";
			$init = new InitContorl();

			if (isset($_REQUEST['shell'])) {
				$init->initShell();
			} else {
				$init->init_lang();
			}
			exit();
		}
		switch ($flag) {
			case 'none':

				break;
			case 'login':
				$tools->safe360();
				$this->check_out();
				$this->otherLogin();
				$this->permissions($_SESSION['own']);
				break;
			case 'admin':
				$tools->safe360();
				$this->check_out();
				$this->otherLogin();
				$this->permissions($_SESSION['own'], true);
				break;
		}
	}

        public function check_out(){
            $this->check_timeout($_SESSION['own']['om_lastlogin_time']);
        }
        public function ajaxcheck_out(){
            $this->ajaxcheck_timeout($_SESSION['own']['om_lastlogin_time']);
        }
    /**
     * 异地登录验证
     */
    public function otherLogin() {
            session_cache_expire(20);
            session_start();
            $system = new system();
            $otherlogininfo = $system->checkOtherLogin($_SESSION['own']);
            /*$tools = new tools();
            $config = $tools->getconfig();
            if($config['config']['maintain']==TRUE&&$_SESSION['own']['om_id']!='admin'){
                $this->smarty->assign('title', '集群通 - 登录');
                $this->smarty->display('modules/system/maintain.tpl');
                exit();
            }*/
            if($_SESSION['own']==null){
                header('HTTP/1.1 401 Unauthorized');
                $msg = L("请先登录平台");
                $_SESSION['own'] = NULL;
                //session_destroy();
                $this->smarty->assign('msg', $msg);
                $this->htmlrender('modules/system/login.tpl');
                exit();
            }
            if ($otherlogininfo['status']) {
                    header('HTTP/1.1 401 Unauthorized');
                    $msg = $otherlogininfo['msg'];
                    $_SESSION['own'] = NULL;
                    //session_destroy();
                    $this->smarty->assign('msg', $msg);
                    $this->htmlrender('modules/system/login.tpl');
                    exit();
            } else if ($otherlogininfo["id"]) {
                    header('HTTP/1.1 401 Unauthorized');
                    $msg = sprintf($otherlogininfo['msg'], $otherlogininfo['db_om_lastlogin_ip'], $otherlogininfo['om_lastlogin_ip']);
                    $_SESSION['own'] = NULL;
                    //session_destroy();
                    $this->smarty->assign('msg', $msg);
                    $this->htmlrender('modules/system/login.tpl');
                    exit();
            }
    }

	/**
	 * 加载器
	 */
	public function loader() {
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/contorl/LoaderContorl.class.php';
		$loaderContorl = new LoaderContorl();
		if (method_exists($loaderContorl, $action)) {
			$loaderContorl->$action();
		}
	}

	/**
	 * 帮助文档
	 * @todo 编写运营平台的帮助手册
	 */
	public function help() {
		$this->htmlrender('_help.tpl');
	}

	public function test() {
		ignore_user_abort(true);
		set_time_limit(60 * 60 * 24);
		$db = coms::db();

		$i = 99999999;
		while ($i > 0) {
			$i--;
			$db->log(L('单表压力测试') . $i);
		};
		//coms::head('reload');
	}

	/**
	 * 接口分发
	 */
	public function api() {
		require_once $this->tools->getModule('api/index');
	}

	/**
	 * 未支持提示页
	 */
	public function nonsupport() {
		$this->tools->notfound(L('不支持您使用的浏览器'));
	}

	/**
	 * 登录页
	 */
	public function login() {
		$this->smarty->assign('title', '集群通 - 登录');
		$this->smarty->display('modules/system/login.tpl');
	}

	/**
	 * 配置页
	 */
	public function config() {
		$tools = new tools();
		$tools->setlangconfig($_REQUEST['lang']);
		$this->smarty->assign('title', '初始化');
		$this->smarty->assign('lang', $_REQUEST['lang']);
		$this->htmlrender('_init.tpl');
	}

	/**
	 * 注销
	 */
	public function logout() {
		session_cache_expire(20);
		session_start();
		$db = new db();
		$db->log(DL('注销成功') . '。 IP：' . $_SERVER["REMOTE_ADDR"], 7, 0);
		$_SESSION['own'] = NULL;
		//session_destroy();
		$this->smarty->assign('msg', L("注销成功"));
		$this->smarty->assign('href', "?m=login");
		$this->htmlrender('viewer/href.tpl');
	}
        /**
         * 登陆超时检查
         */
        public function ajaxcheck_timeout($session_time){
	  session_cache_expire(20);
            $lifetime=session_cache_expire()*60;//转化为秒
            $new_time=$time;
            $old_time=strtotime ($session_time);
            if(time()-$old_time>$lifetime){
				echo -1;
            }else{
                $_SESSION['own']['om_lastlogin_time']=date("Y-m-d H:i:s",$time);
				echo 1;
            }
        }

		/**
         * 登陆超时检查
         */
        public function check_timeout($session_time){
	  session_cache_expire(20);
            $lifetime=session_cache_expire()*60;//转化为秒
            $old_time=strtotime ($session_time);
            if(time()-$old_time>$lifetime){
                $this->smarty->assign('msg', L("帐号长时间未操作,请重新登录"));
                //$this->smarty->assign('href', "?m=login");
                $doc = <<<DOC
<!DOCTYPE html>
<html>
                <head>
                        <meta charset="UTF-8">
                        <script src="layer/jquery-1.11.1.min.js"></script>
                        <script src="layer/layer.js"></script>
                <head>
<body>
DOC;

		print $doc;
                $info=L('帐号长时间未操作,请重新登录');
                //print("<script>parent.confirm('见到你真的很高兴', {icon: 6});location.href='?m=login';</script>");
                print("<script>layer.alert('".$info."', {icon: 2},function(){location.href='?m=login';});</script>");
                print('</body></html>');
                //$_SESSION['own']['em_lastlogin_time']=NULL;
               // $this->render('modules/system/login.tpl');
                exit();
            }else{
                $_SESSION['own']['om_lastlogin_time']=date("Y-m-d H:i:s",time());
            }
        }
	/**
	 * 登录检查
	 */
	public function login_check() {
		$this->common();
		session_cache_expire(20);
		session_start();

		$system = new system($_REQUEST);
		$data = $system->checkLogin();

		if ($data == -1) {
			$this->smarty->assign('msg', "帐号错误");
			$this->smarty->assign('href', "?m=login");
			$this->htmlrender("viewer/href.tpl");
			exit();
		}
		if ($data == -2) {
			$this->smarty->assign('msg', "密码错误");
			$this->smarty->assign('href', "?m=login");
			$this->htmlrender("viewer/href.tpl");
			exit();
		}
		if ($data == 0) {
			$this->smarty->assign('msg', "登陆成功");
			$this->smarty->assign('href', "?m=system&a=index");
			$this->htmlrender("viewer/href.tpl");
			exit();
		}
	}

	/**
	 * 公共模块分发
	 */
	public function system() {
		$this->common('login');
		require_once '../shell/class/dao/system.class.php';
		require_once '../shell/class/contorl/SystemContorl.class.php';

		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		$SystemContorl = new SystemContorl($smarty, $tools);
		if (method_exists($SystemContorl, $action)) {
			$SystemContorl->$action();
		}
	}

	/**
	 * 公告模块分发
	 */
	public function announcement() {
		$this->common('login');
		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once "../shell/class/page.class.php";
		require_once '../shell/class/dao/announcement.class.php';
		require_once '../shell/class/contorl/AnnouncementContorl.class.php';

		$AnnouncementContorl = new AnnouncementContorl($smarty, $tools);
		if (method_exists($AnnouncementContorl, $action)) {
			$AnnouncementContorl->$action();
		}
	}

	/**
	 * 企业模块分发
	 */
	public function enterprise() {
		$this->common('login');
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/contorl/EnterpriseViewContorl.class.php';
		require_once '../shell/class/contorl/EnterpriseAdminContorl.class.php';
		require_once '../shell/class/contorl/EnterpriseUsersContorl.class.php';
		require_once '../shell/class/contorl/EnterpriseGroupsContorl.class.php';
		require_once '../shell/class/contorl/EnterpriseUserGroupContorl.class.php';
		require_once '../shell/class/contorl/EnterpriseExportContorl.class.php';
                                    require_once '../shell/class/permit.class.php';
		$enterpriseViewContorl = new EnterpriseViewContorl();
		$enterpriseAdminContorl = new EnterpriseAdminContorl();
		$enterpriseUsersContorl = new EnterpriseUsersContorl();
		$enterpriseGroupsContorl = new EnterpriseGroupsContorl();
		$enterpriseUserGroupContorl = new EnterpriseUserGroupContorl();
		$enterpriseExportContorl = new EnterpriseExportContorl();

		if (method_exists($enterpriseViewContorl, $action)) {
			$enterpriseViewContorl->$action();
		}

		if (method_exists($enterpriseAdminContorl, $action)) {
			$enterpriseAdminContorl->$action();
		}

		if (method_exists($enterpriseUsersContorl, $action)) {
			$enterpriseUsersContorl->$action();
		}

		if (method_exists($enterpriseGroupsContorl, $action)) {
			$enterpriseGroupsContorl->$action();
		}
		if (method_exists($enterpriseExportContorl, $action)) {
			$enterpriseExportContorl->$action();
		}
		if (method_exists($enterpriseUserGroupContorl, $action)) {
			$enterpriseUserGroupContorl->$action();
		}
	}

	/**
	 * 设备模块分发
	 */
	public function device() {
		$this->common('login');

		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/dao/device.class.php';
		require_once '../shell/class/dao/enterprise.class.php';
		require_once '../shell/class/dao/area.class.php';
		require_once '../shell/class/page.class.php';
		require_once '../shell/class/contorl/DeviceContorl.class.php';

		$deviceContorl = new DeviceContorl($smarty, $tools);
		if (method_exists($deviceContorl, $action)) {
			try
			{
				$deviceContorl->$action();
            }
            catch ( Exception $ex )
            {
                $tools->log ( '发送了' . $name . '消息。命令：' . $ex->getMessage () . "。结果：" . $ex->getCode () , 'shell_error' );
                $tools->call ( $ex->getMessage () , $ex->getCode () , true );
            }
        }
    }
    /**
	 * 终端模块分发
	 */
	public function terminal() {
		$this->common('login');

		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/dao/terminal.class.php';
		require_once '../shell/class/page.class.php';
		require_once '../shell/class/contorl/TerminalContorl.class.php';
                
		$terminalContorl = new TerminalContorl($smarty,$tools);
		
		if (method_exists($terminalContorl, $action)) {
			$terminalContorl->$action();
		}

	}
    /**
     * 代理商管理模块分发
     */
    public function agents ()
    {
        $this->common ( 'login' );
        $smarty = $this->smarty;
        $tools = $this->tools;
        $action = $tools->get ( "action" ) != "" ? $tools->get ( 'action' ) : $tools->get ( 'a' );
        require_once '../shell/class/dao/agents.class.php';
        require_once '../shell/class/dao/enterprise.class.php';
        require_once '../shell/class/dao/area.class.php';
        require_once '../shell/class/page.class.php';
        require_once '../shell/class/contorl/AgentsContorl.class.php';
        require_once '../shell/class/permit.class.php';
        $agentsContorl = new AgentsContorl ( $smarty , $tools );
        if ( method_exists ( $agentsContorl , $action ) )
        {
            try
            {
                $agentsContorl->$action ();
            }
            catch ( Exception $ex )
            {
                $tools->log ( '发送了' . $name . '消息。命令：' . $ex->getMessage () . "。结果：" . $ex->getCode () , 'shell_error' );
                $tools->call ( $ex->getMessage () , $ex->getCode () , true );
            }
        }
    }
    /**
     * 数据报表模块分发
     */
    public function report()
    {
        $this->common ( 'login' );
        $smarty = $this->smarty;
        $tools = $this->tools;
        $action = $tools->get ( "action" ) != "" ? $tools->get ( 'action' ) : $tools->get ( 'a' );
        require_once '../shell/class/dao/report.class.php';
        require_once '../shell/class/dao/agents.class.php';
        require_once '../shell/class/dao/enterprise.class.php';
        require_once '../shell/class/dao/area.class.php';
        require_once '../shell/class/page.class.php';
        require_once '../shell/class/formatdate.class.php';
        require_once '../shell/class/contorl/ReportContorl.class.php';
        $reportContorl = new ReportContorl ( $smarty , $tools );
        if ( method_exists ( $reportContorl , $action ) )
        {
            try
            {
                $reportContorl->$action ();
            }
            catch ( Exception $ex )
            {
                $tools->log ( '发送了' . $name . '消息。命令：' . $ex->getMessage () . "。结果：" . $ex->getCode () , 'shell_error' );
                $tools->call ( $ex->getMessage () , $ex->getCode () , true );
            }
        }
    }
    /**
     * 计费报表模块分发
     */
    public function account()
    {
        $this->common ( 'login' );
        $smarty = $this->smarty;
        $tools = $this->tools;
        $action = $tools->get ( "action" ) != "" ? $tools->get ( 'action' ) : $tools->get ( 'a' );
        require_once '../shell/class/dao/account.class.php';
        require_once '../shell/class/dao/agents.class.php';
        require_once '../shell/class/dao/enterprise.class.php';
        require_once '../shell/class/dao/area.class.php';
        require_once '../shell/class/page.class.php';
        require_once '../shell/class/contorl/AccountContorl.class.php';
        $accountContorl = new AccountContorl ( $smarty , $tools );
        if ( method_exists ( $accountContorl , $action ) )
        {
            try
            {
                $accountContorl->$action ();
            }
            catch ( Exception $ex )
            {
                $tools->log ( '发送了' . $name . '消息。命令：' . $ex->getMessage () . "。结果：" . $ex->getCode () , 'shell_error' );
                $tools->call ( $ex->getMessage () , $ex->getCode () , true );
            }
        }
    }
    /**
     * 流量卡管理模块分发
     *
     */
    public function gprs ()
    {
        $this->common ( 'login' );
        $smarty = $this->smarty;
        $tools = $this->tools;
        $action = $tools->get ( 'action' ) != '' ? $tools->get ( 'action' ) : $tools->get ( 'a' );
        require_once '../shell/class/dao/gprs.class.php';
        require_once '../shell/class/dao/enterprise.class.php';
        require_once '../shell/class/dao/area.class.php';
        require_once '../shell/class/page.class.php';
//        require_once '../shell/class/function.class.php';
        require_once '../shell/class/contorl/GprsContorl.class.php';
        $gprsContorl = new GprsContorl ( $smarty , $tools );
        if ( method_exists ( $gprsContorl , $action ) )
        {
            try
            {
                $gprsContorl->$action ();
            }
            catch ( Exception $ex )
            {
				$tools->log('发送了' . $name . '消息。命令：' . $ex->getMessage() . "。结果：" . $ex->getCode(), 'shell_error');
				$tools->call($ex->getMessage(), $ex->getCode(), true);
			}
		}
	}

	/**
	 * 运营管理员模块分发
	 */
	public function manager() {
		$this->common('admin');
		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/contorl/ManagerContorl.class.php';

		$ManagerContorl = new ManagerContorl($smarty, $tools);

		if (method_exists($ManagerContorl, $action)) {
			$ManagerContorl->$action();
		}
	}

	/**
	 * 区域管理分发
	 */
	public function area() {
		$this->common('login');
		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/dao/log.class.php';
		require_once '../shell/class/dao/area.class.php';
		require_once "../shell/class/page.class.php";
		require_once '../shell/class/dao/enterprise.class.php';
		require_once '../shell/class/dao/admins.class.php';
		require_once '../shell/class/dao/groups.class.php';

		require_once '../shell/class/contorl/AreaContorl.class.php';

		$AreaContorl = new AreaContorl($smarty, $tools);

		if (method_exists($AreaContorl, $action)) {
			$AreaContorl->$action();
		}
	}

	/**
	 * 产品管理分发
	 */
	public function product() {
		$this->common('login');
		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/dao/log.class.php';
		require_once '../shell/class/dao/area.class.php';
		require_once '../shell/class/dao/basic.class.php';
		require_once "../shell/class/page.class.php";
		require_once '../shell/class/dao/enterprise.class.php';
		require_once '../shell/class/dao/admins.class.php';
		require_once '../shell/class/dao/groups.class.php';
		require_once '../shell/class/dao/product.class.php';

		require_once '../shell/class/contorl/ProductContorl.class.php';

		$ProductContorl = new ProductContorl($smarty, $tools);

		if (method_exists($ProductContorl, $action)) {
			$ProductContorl->$action();
		}
	}

	/**
	 * 日志管理分发
	 */
	public function log() {
		$this->common('login');
		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/dao/log.class.php';
		require_once '../shell/class/dao/area.class.php';
		require_once "../shell/class/page.class.php";
		require_once '../shell/class/dao/enterprise.class.php';
		require_once '../shell/class/dao/admins.class.php';
		require_once '../shell/class/dao/groups.class.php';

		require_once '../shell/class/contorl/LogContorl.class.php';

		$LogContorl = new LogContorl($smarty, $tools);

		if (method_exists($LogContorl, $action)) {
			$LogContorl->$action();
		}
	}

	/**
	 * 版本控制CMS分发
	 */
	public function cms() {
		$this->common('login');
		$smarty = $this->smarty;
		$tools = $this->tools;
		$action = $tools->get('action') != '' ? $tools->get('action') : $tools->get('a');

		require_once '../shell/class/contorl/CmsContorl.class.php';

		$CmsContorl = new CmsContorl($smarty, $tools);

		if (method_exists($CmsContorl, $action)) {
			$CmsContorl->$action();
		}
	}

	/**
     *数据备份模块分发
     */
    public function backup ()
    {
        $this->common ( 'admin' );
        $smarty = $this->smarty;
        $tools = $this->tools;
        $action = $tools->get ( 'action' ) != '' ? $tools->get ( 'action' ) : $tools->get ( 'a' );
        require_once '../shell/class/dao/backup.class.php';
        require_once '../shell/class/dao/enterprise.class.php';
        require_once '../shell/class/dao/area.class.php';
        require_once '../shell/class/page.class.php';
        require_once '../shell/class/function.class.php';
        require_once '../shell/class/contorl/BackupContorl.class.php';
        $backupContorl = new BackupContorl ( $smarty , $tools );
        if ( method_exists ( $backupContorl , $action ) )
        {
            try
            {
                $backupContorl->$action ();
            }
            catch ( Exception $ex )
            {
				$tools->log('发送了' . $name . '消息。命令：' . $ex->getMessage() . "。结果：" . $ex->getCode(), 'shell_error');
				$tools->call($ex->getMessage(), $ex->getCode(), true);
			}
		}
	}

}
