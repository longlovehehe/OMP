<?php
/**
 * 设备控制器
 * @category  管理员管理
 * @package 设备管理
 * @subpackage  控制器层
 */
class DeviceContorl extends contorl {
 
	/**
	 * 构造器，继承至contorl
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * 刷新设备状态
	 * <pre>
	 * - 1、从用户选择的设备列表中筛选出设备状态为0（处理中），2（处理失败）的设备，将其状态设置为0（处理中）
	 * - 2、循环筛选出的设备ID，向数据中心发送DevSave消息，参数 设备id 设备ip1 设备ip1端口
	 * - 3、发送失败或数据中心返回非200状态码，修改该设备id状态为2（处理失败），并向上层抛出该异常
	 * - 4、上层截获异常，将异常消息输出至浏览器
	 * - 5、上层未截获异常，输出成功至浏览器，并中断当前程序执行
	 * </pre>
	 * @throws Exception
	 */
	function refresh() {
//实例化一个设备对象
		$device = new device($_REQUEST);
//实例化一个工具类
		$tools = new tools();
//获得当前设备所有数据
		$data = $device->get();
		$resultlist = array();
		try
		{
//刷新设备状态，并将处理了的设备id传给resultlist
			$resultlist = $device->refreshList();
//循环已处理设备id
			foreach ($resultlist as $value) {
				$data['d_id'] = $value;
				$device->set($data);
				$deviceitem = $device->getByid();

//发送消息到数据中心
				try
				{
					$tools->send("DevSave", $deviceitem["d_id"] . ' ' . $deviceitem['d_ip1'] . ' ' . $deviceitem['d_port1']);
				} catch (Exception $ex) {
					$device->updateStatus(array(2, $deviceitem['d_id']));
					throw new Exception($ex->getMessage(), 0);
				}
			}
		} catch (Exception $ex) {
			$tools->call($ex->getMessage(), 0, true);
		}
//操作结束，提示信息
		$tools->call(L("刷新成功"), 0, true);
	}

	/**
	 * 获得option格式的mds列表
	 * 根据view参数，获取不同类型的option片断，供前台select下拉框使用
	 * @return String HTML格式的设备列表
	 */
	function mds_option() {
		$device = new device($_REQUEST);
		$list = $device->getMDSListOption();
		if($_REQUEST['e_id'])
		{
			$ep=new enterprise($_REQUEST);
        	$info=$ep->getByid();
		}
		
		if ($_REQUEST['view'] != "") {
			$this->smarty->assign('list', $list);
			$this->htmlrender('modules/device/mds_option_view.tpl');
		} else {
			if($info['e_mds_id'])
			{
				$this->smarty->assign('e_mds_id',$info['e_mds_id']);
			}
			
			$this->smarty->assign('list', $list);
			$this->htmlrender('modules/device/mds_option.tpl');
		}
	}
	/*
	* 获取区域大于等于现有设备的server设备
	*
	*/
	function mds_option_area() {
		$device = new device($_REQUEST);
		$list = $device->getMDSListOption1();
		if($_REQUEST['e_id'])
		{
			$ep=new enterprise($_REQUEST);
        	$info=$ep->getByid();
		}
		
		if ($_REQUEST['view'] != "") {
			$this->smarty->assign('list', $list);
			$this->htmlrender('modules/device/mds_option_view.tpl');
		} else {
			if($info['e_mds_id'])
			{
				$this->smarty->assign('e_mds_id',$info['e_mds_id']);
			}
			
			$this->smarty->assign('list', $list);
			$this->htmlrender('modules/device/mds_option.tpl');
		}
	}
    /**
     * 获得option格式的RS列表
     * 根据view参数，获取不同类型的option片断，供前台select下拉框使用
     * @return String HTML格式的设备列表
     */
    function rs_option() {
            $device = new device($_REQUEST);
            $list = $device->getRSListOption();
            if($_REQUEST['e_id'])
            {
                    $ep=new enterprise($_REQUEST);
                    $info=$ep->getByid();
            }
            if ($_REQUEST['view'] != "") {
                    $this->smarty->assign('list', $list);
                    $this->htmlrender('modules/device/rs_option_view.tpl');
            } else {
                    if($info['e_vcr_id'])
                    {
                            $this->smarty->assign('e_vcr_id',$info['e_vcr_id']);
                    }

                    $this->smarty->assign('list', $list);
                    $this->htmlrender('modules/device/rs_option.tpl');
            }
    }
    /**
     * 获得option格式的SS列表
     * 根据view参数，获取不同类型的option片断，供前台select下拉框使用
     * @return String HTML格式的设备列表
     */
    function ss_option() {
            $device = new device($_REQUEST);
            $list = $device->getSSListOption();
            foreach ($list as $key => $value) {
                    $list[$key]['d_space_free'] = floor($value['d_space_free']/1024);
                    $list[$key]['d_space'] = floor($value['d_space']/1024);
            }
            if($_REQUEST['e_id'])
            {
                    $ep=new enterprise($_REQUEST);
                    $info=$ep->getByid();
            }
            if ($_REQUEST['view'] != "") {
                    $this->smarty->assign('list', $list);
                    $this->htmlrender('modules/device/ss_option_view.tpl');
            } else {
                    if($info['e_ss_id'])
                    {
                            $this->smarty->assign('e_ss_id',$info['e_ss_id']);
                    }
                    $this->smarty->assign('list', $list);
                    $this->htmlrender('modules/device/ss_option.tpl');
            }
    }
	/**
	 * 获得mds列表表格形式
	 * 提供分页形式的设备列表，表格风格
	 */
	function mds_item() {
		$device = new device($_REQUEST);
		$page = new page($_REQUEST);
		$this->page = $page;
		$this->page->setTotal($device->getMDSTotal());
		$list = $device->getMDSList($this->page->getLimit());
		$numinfo = $this->page->getNumInfo();
		$prev = $this->page->getPrev();
		$next = $this->page->getNext();
		$this->smarty->assign('list', $list);
		$this->smarty->assign('numinfo', $numinfo);
		$this->smarty->assign('prev', $prev);
		$this->smarty->assign('next', $next);

		$this->htmlrender('modules/device/mds_item.tpl');
	}

	/**
	 * 删除mds设备
	 * 删除提交过来的设备id的设备，将返回删除总数
	 */
	function mds_del() {
		$device = new device($_REQUEST);
		$result[count] = $device->delMDSList();
		echo $result[count];
	}

	/**
	 * 通过mds id获得包含该mds详细信息的json格式的mds
	 * 由mds_id获得该设备的详细信息，表现形式为json格式
	 * @return json 单个mds详细信息
	 */
	function mds_id() {
		$device = new device($_REQUEST);
		echo json_encode($device->GetJsonByMDSId());
	}

	/**
	 * 保存mds设备
	 * 保存一个设备，如果保存的设备名称或外网地址重复，则抛出异常信息，并中断程序
	 * 如果保存成功，则获取保存成功的设备详细信息，根据设备的类型进行处理
	 * 如果是mds/vcr类型，则发送DevSave消息,参数为 设备id 设备ip1 设备端口1
	 * 发送失败，设置设备状态为2（发布失败），日志记录 设备保存失败，抛出 设备保存失败，请管理员检查日志 异常消息
	 * 如果是vcrs类型，则发送DevVcrs消息，参数为 设备id
	 * 处理完毕，显示json格式的消息结果
	 * @throws Exception
	 */
	function mds_save() {
		$device = new device($_REQUEST);
		try
		{
			$msg = $device->save();
		} catch (Exception $ex) {
			$this->tools->call(L("设备名称/设备外网地址重复"), -1, TRUE);
		}

		$data = $device->get();
		try
		{
			//发送dbm消息
			$this->tools->send("DevSave", $data["d_id"] . ' ' . $data['d_ip1'] . ' ' . $data['d_port1']);
		} catch (Exception $ex) {
			$device->updateStatus(array(2, $data['d_id']));

			$device->log(DL("设备保存失败") . "：" . $ex->getMessage(), 2, 2);
			throw new Exception(L('设备保存失败，请管理员检查日志'), 0);
		}
		echo json_encode($msg);
	}

	/**
	 * 通用设备列表
	 */
	function device_list_item() {
		$enterprise = new enterprise($_REQUEST);
		$result = $enterprise->getDeviceList();

		$this->smarty->assign('list', $result['fetchall']);
		$this->smarty->assign('page', $result['page']);
		if ($_REQUEST['do'] == 'mds') {
			$this->htmlrender('modules/device/mds_list_item.tpl');
		} else if ($_REQUEST['do'] == 'rs') {
			$this->htmlrender('modules/device/rs_list_item.tpl');
		} else {
			$this->tools->send("DevSs", $_REQUEST['device_id']);
			$this->htmlrender('modules/device/ss_list_item.tpl');
		}
	}

	/**
	 * 设备添加显示层
	 */
	function device_add() {
		$mininav = array(
			array(
				"url" => "?m=device&a=server",
				"name" => "设备管理",
				"next" => ">>",
			),
			array(
				"url" => "#",
				"name" => "新增设备",
			),
		);
		//获取部署ID信息
		$device = new device($_REQUEST);
		$aCluster = $device->getClusterList();

		$this->smarty->assign('aCluster', $aCluster);
		$this->smarty->assign('mininav', $mininav);
		$this->smarty->assign('data', $_REQUEST);
		$this->render('modules/device/device_add.tpl', L('新增设备'));
	}

	/**
	 * 设备编辑显示层
	 */
	function device_edit() {
		$mininav = array(
			array(
				"url" => "?m=device&a=server",
				"name" => "设备管理",
				"next" => ">>",
			),
			array(
				"url" => "#",
				"name" => "编辑设备",
			),
		);
		//获取部署ID信息
		$device = new device($_REQUEST);
		$aCluster = $device->getClusterList();

		$this->smarty->assign('aCluster', $aCluster);
		$this->smarty->assign('mininav', $mininav);
		$device = new device($_REQUEST);
		$data = $device->getByid();
		$this->smarty->assign('data', $data);
		$this->render('modules/device/device_edit.tpl', L('编辑设备'));
	}

	/**
	 * 设备信息获取
                  *  通过Ajax 获取并返回    
	 */
	function get_device() {
		$device = new device($_REQUEST);
		$data = $device->getByid();
		echo json_encode($data);
	}

	/**
	 * 获取区域名称
	 */
	public function get_area_name() {
		$area = new area($_REQUEST);
		$d_area_str = $area->getareaname($_REQUEST["am_id"]);
		echo $d_area_str["am_name"];
	}

	/**
	 * 获取当前设备的区域名称
	 */
	function get_area() {
		$area = new area($_REQUEST);
		$d_area = explode(",", $_REQUEST['d_area']);
		$d_area_str = "";

		foreach ($d_area as $value) {
			$d_area_str1 = $area->getareaname($value);
			$d_area_str2 = $d_area_str1["am_name"];
			$d_area_str .= $d_area_str2 . " ";
		}
		echo $d_area_str;
	}

	/**
	 * 获得区域差集
	 */
	public function get_diff_area() {
		$area = new area($_REQUEST);
		$d_area = explode(",", $_REQUEST['d_area']);
		$array = $area->getList();
		$arr = array();
		
		$manager = new manager();
		$manager = $manager->getarea($_SESSION['own']['om_id']);
		if($manager['om_area'] == '["#"]')
		{
			$arr[] = '#';
		}
		foreach ($array as $value) {
			$arr[] = $value["am_id"];
		}
		$d_area_str = array();
		foreach ($d_area as $value) {
			$d_area_str1 = $area->getareaname($value);
			$d_area_str[] = $d_area_str1['am_id'];
		}
		$diff_arr = array_diff($arr, $d_area_str);
		$diff_arr=indextoassoc($diff_arr);
		echo json_encode($diff_arr, true);
	}

	/**
	 *
	 */
	public function add_d_area() {
		$device = new device($_REQUEST);
		$result = $device->up_area();
		echo json_encode($result);
	}

	/**
	 * 设备使用详情显示层
	 */
	function device_list() {
		$mininav = array(
			array(
				"url" => "?m=device&a=server",
				"name" => "设备管理",
				"next" => ">>",
			),
			array(
				"url" => "#",
				"name" => "使用详情",
			),
		);
		$enterprise = new enterprise($_REQUEST);
		$result = $enterprise->getDeviceList();

		$this->smarty->assign('list', $result['fetchall']);
		$this->smarty->assign('page', $result['page']);
		$this->smarty->assign('mininav', $mininav);
		$this->smarty->assign('data', $_REQUEST);
		$this->render('modules/device/device_list.tpl', L('使用详情'));
	}


	/**
	 * mds显示层
	 */
	function server() {
		$this->render('modules/device/mds.tpl', L($_SESSION['ident'].'-Server管理'));
	}

	/**
	 * mds显示层
	 */
	function mds() {
		$this->render('modules/device/mds.tpl', L($_SESSION['ident'].'-Server列表'));
	}

	/**
	 * 超级控制台
	 */
	function console() {
		$this->render('viewer/super_console.tpl', L('超级控制台'));
	}
    /**
     * @author 作者 hongyuan.li
     * @date 2015.7.29
     * 功能 rs设备列表页
     */
    function rs() {
    	$device = new device();
    	$aCluster = $device->getClusterList();
    	$this->smarty->assign('aCluster', $aCluster);
		$this->render('modules/device/rs.tpl', L($_SESSION['ident'].'-RS管理'));
	}
    /**
     * @author hongyuan.li
     * @date 2015.7.29
     * 功能 rs设备列表页
     */
    function rs_item() {
        $device = new device($_REQUEST);
        $page = new page($_REQUEST);
        $this->page = $page;
        $this->page->setTotal($device->getMDSTotal('rs'));
        $list = $device->getRsList($this->page->getLimit());
        $numinfo = $this->page->getNumInfo();
        $prev = $this->page->getPrev();
        $next = $this->page->getNext();
        $this->smarty->assign('list', $list);
        $this->smarty->assign('numinfo', $numinfo);
        $this->smarty->assign('prev', $prev);
        $this->smarty->assign('next', $next);
        $this->htmlrender('modules/device/rs_item.tpl');
	}
        /**
         * @author hongyuan.li
         * @date 2015.7.29
         * 功能 rs设备添加
         */
        function rs_add() {
        	$mininav = array(
			array(
				"url" => "?m=device&a=rs",
				"name" => "设备管理",
				"next" => ">>",
			),
			array(
				"url" => "#",
				"name" => "新增设备",
			),
		);
		$this->smarty->assign('mininav', $mininav);
        //获取部署ID信息
		$device = new device($_REQUEST);
		$aCluster = $device->getClusterList();
		$this->smarty->assign('aCluster', $aCluster);
		$this->render('modules/device/rs_add.tpl', L($_SESSION['ident'].'-RS管理'));
	}

	/**
	 * @author hongyuan.li
	 * 时间 2015.7.31
	 * 功能 rs设备编辑
	 */
	function rs_edit() {
		$mininav = array(
			array(
				"url" => "?m=device&a=rs",
				"name" => "RS管理",
				"next" => ">>",
			),
			array(
				"url" => "#",
				"name" => "编辑设备",
			),
		);

		$this->smarty->assign('mininav', $mininav);
		$device = new device($_REQUEST);
		$data = $device->getByid();
		$this->smarty->assign('data', $data);

		$device = new device($_REQUEST);
		$aCluster = $device->getClusterList();
		$this->smarty->assign('aCluster', $aCluster);		
		$this->render('modules/device/rs_edit.tpl', L('编辑设备'));
	}

    /**
    * @author hongyuan.li
    * 时间 2015.7.31
    * 功能 rs设备详情页
    */
function rs_list() {
            $mininav = array(
                    array(
                            "url" => "?m=device&a=rs",
                            "name" => "设备管理",
                            "next" => ">>",
                    ),
                    array(
                            "url" => "#",
                            "name" => "使用详情",
                    ),
            );
            $enterprise = new enterprise($_REQUEST);
            $result = $enterprise->getDeviceList();
            //$data = $enterprise->getByid();
            //$this->smarty->assign('data', $data);
            $this->smarty->assign('list', $result['fetchall']);
            $this->smarty->assign('page', $result['page']);
            //获取已用和总并发数
            $device = new device($_REQUEST);
            $rec = $device->getRec();
            $this->smarty->assign('rec', $rec);

            $this->smarty->assign('mininav', $mininav);
            $this->smarty->assign('data', $_REQUEST);
            $this->render('modules/device/rs_list.tpl', L('使用详情'));
    }
/**
* @author hongyuan.li
* 时间 2015.8.12
* 功能 ss设备详情页
*/
function ss_list() {
            $mininav = array(
                    array(
                            "url" => "?m=device&a=ss",
                            "name" => "设备管理",
                            "next" => ">>",
                    ),
                    array(
                            "url" => "#",
                            "name" => "使用详情",
                    ),
            );
            //获取已用空间和总空间
            $device = new device($_REQUEST);
            $space = $device->getSpace();
    	    $space['space'] = floor($space['space']/1024);
    	    $space['d_space'] = floor($space['d_space']/1024);
            $this->smarty->assign('space', $space);
            $enterprise = new enterprise($_REQUEST);
            $result = $enterprise->getDeviceList();

            $this->smarty->assign('list', $result['fetchall']);
            $this->smarty->assign('page', $result['page']);
            $this->smarty->assign('mininav', $mininav);
            $this->smarty->assign('data', $_REQUEST);
            $this->tools->send("DevSs", $_REQUEST['device_id']);
            $this->render('modules/device/ss_list.tpl', L('使用详情'));
    }
    /**
     * @author hongyuan.li
     * 时间 2015.8.11
     * 功能 ss设备列表页
     */
    function ss() {
    	$device = new device();
    	$aCluster = $device->getClusterList();
    	$this->smarty->assign('aCluster', $aCluster);
		$this->render('modules/device/ss.tpl', L($_SESSION['ident'].'-SS管理'));
	}
	 /**
     * @author hongyuan.li
     * 时间 2015.7.29
     * 功能 ss设备列表页
     */
    function ss_item() {
        $device = new device($_REQUEST);
        $page = new page($_REQUEST);
        $this->page = $page;
        $this->page->setTotal($device->getMDSTotal('ss'));
        $list = $device->getSsList($this->page->getLimit(),'ss');

        $numinfo = $this->page->getNumInfo();
        $prev = $this->page->getPrev();
        $next = $this->page->getNext();
        $this->smarty->assign('list', $list);
        $this->smarty->assign('numinfo', $numinfo);
        $this->smarty->assign('prev', $prev);
        $this->smarty->assign('next', $next);
        $this->htmlrender('modules/device/ss_item.tpl');
	}
    /**
     * @author hongyuan.li
     * 时间 2015.7.29
     * 功能 rs设备添加
     */
    function ss_add() {
    	$mininav = array(
			array(
				"url" => "?m=device&a=ss",
				"name" => "设备管理",
				"next" => ">>",
			),
			array(
				"url" => "#",
				"name" => "新增设备",
			),
		);
	$this->smarty->assign('mininav', $mininav);
    //获取部署ID信息
	$device = new device($_REQUEST);
	$aCluster = $device->getClusterList();
	$this->smarty->assign('aCluster', $aCluster);
	$this->render('modules/device/ss_add.tpl', L($_SESSION['ident'].'-SS管理'));
	}
	/**
	 * @author hongyuan.li
	 * 时间 2015.8.12
	 * 功能 rs设备编辑
	 */
	function ss_edit() {
		$mininav = array(
			array(
				"url" => "?m=device&a=ss",
				"name" => "SS管理",
				"next" => ">>",
			),
			array(
				"url" => "#",
				"name" => "编辑设备",
			),
		);

		$this->smarty->assign('mininav', $mininav);
		$device = new device($_REQUEST);
		$data = $device->getByid();
		$this->smarty->assign('data', $data);

		$device = new device($_REQUEST);
		$aCluster = $device->getClusterList();
		$this->smarty->assign('aCluster', $aCluster);		
		$this->render('modules/device/ss_edit.tpl', L('编辑设备'));
	}

	/**
	* @author hongyuan.li
	* 时间 2015.8.10
	* 功能 部署列表
	*/
	function cluster() 
	{
		$this->render('modules/device/cluster.tpl', L('部署管理'));
	}
	/**
     * @author hongyuan.li
     * 时间 2015.8.10
     * 功能 部署id列表页
     */
    function cluster_item() 
    {
        $device = new device($_REQUEST);
        $page = new page($_REQUEST);
        $this->page = $page;
        $this->page->setTotal($device->getClusterTotal('RS'));
        $list = $device->getClusterList($this->page->getLimit());
        $numinfo = $this->page->getNumInfo();
        $prev = $this->page->getPrev();
        $next = $this->page->getNext();
        if($list)
        {
        	foreach ($list as $key => $value) {
        		if(strlen($value['cluster_id'])< 3)
        		{
        			$list[$key]['cluster_id'] = str_pad($value['cluster_id'],3,"0",STR_PAD_LEFT);
        		}
        	}
        }
        $this->smarty->assign('page', $this->page->getPage());
        $this->smarty->assign('list', $list);
        $this->smarty->assign('numinfo', $numinfo);
        $this->smarty->assign('prev', $prev);
        $this->smarty->assign('next', $next);
        $this->htmlrender('modules/device/cluster_item.tpl');
	}
	/**
     * @author hongyuan.li
     * 时间 2015.8.10
     * 功能 部署id添加
     */
    function cluster_add() 
    {
		$this->render('modules/device/cluster_add.tpl', L('部署管理'));
	}
	/**
     * @author hongyuan.li
     * 时间 2015.8.10
     * 功能 部署id保存
     */

	function cluster_save() {
		$device = new device($_REQUEST);
		$msg = $device->cluster_save();
		echo json_encode($msg);
		exit();
	}
	/**
     * @author hongyuan.li
     * 时间 2015.8.10
     * 功能 部署id编辑
     */
	function cluster_edit() {
		$device = new device($_REQUEST);
		$status = $device->getClusterStatus($_REQUEST['cluster_id'],'d_deployment_id');

		$data = $device->getCluster();
		if(strlen($data['cluster_id'])< 3)
		{
			$data['cluster_id'] = str_pad($data['cluster_id'],3,"0",STR_PAD_LEFT);
		}
		$this->smarty->assign('status', $status);
		$this->smarty->assign('data', $data);
		$this->render('modules/device/cluster_edit.tpl', L('编辑设备'));
	}

	/**
     * @author hongyuan.li
     * 时间 2015.8.10
     * 功能 部署id编辑
     */
	function cluster_del() {
		$device = new device($_REQUEST);
		$status = $device->getClusterStatus($_REQUEST['cluster_id'],'d_deployment_id');
		if($status == 'yes')
		{
			$msg = 0;
		}
		else
		{
			$res = $device->delCluster();
			echo $res;
		}
	}

    public function device_move_batch(){
            //企业批量迁移
            $ep = new enterprise();
            //获得当前所选设备的许可与所选企业的许可的比较
            $dev=new device(array("d_id"=>$_REQUEST['device_id']));
            $dev_info=$dev->getByid();
            $e_id_list = implode($_REQUEST['checkbox'],",");
            if($e_id_list==""){
                throw new Exception(L("没有企业可以迁移"), 1);
            }
            $allep_sure=$ep->get_allep_sure($e_id_list);
            if($_REQUEST['e_vcr_id']!=""){
                $res=$this->check_rs_rec(false);
                if($res==-1){
                    throw new Exception("{$_SESSION['ident']}-RS".L("可用并发数不足"), 1);  
                }
            }

            if($allep_sure['phone_sure']>$_REQUEST['diff_phone']){
                    throw new Exception("{$_SESSION['ident']}-Server".L("用户许可不足"), 1);
            }else if ($allep_sure['dispatch_sure']>$_REQUEST['diff_dispatch']) {
                    throw new Exception("{$_SESSION['ident']}-Server".L("用户许可不足"), 1);
            }else if ($allep_sure['gvs_sure']>$_REQUEST['diff_gvs']) {
                    throw new Exception("{$_SESSION['ident']}-Server".L("用户许可不足"), 1);
            }
            //获取企业的同源设备ID
            $list_ep=  $ep->get_allep_alldevice($e_id_list);
//            $mds_id_list=array();
            $vcr_id_list=array();
            $ss_id_list=array();
            foreach($list_ep as $key =>$value){
                if($value['e_vcr_id']!=""){
                    $vcr_id_list[]=$value['e_vcr_id'];
                }
               if($value['e_ss_id']!=""){
                    $ss_id_list[]=$value['e_ss_id'];
               }
            }
            array_unique($vcr_id_list);
            array_unique($ss_id_list);
            $array_vcr=array();
             foreach ($vcr_id_list as $val) {
                 $ep_list="";
                foreach ($list_ep as $key => $value) {
                        if($value['e_vcr_id']==$val){
                            if($value['e_status']!=0&&strpos($ep_list,$value['e_id']) === false){
                                $ep_list .=$value['e_id'].",";
                             }
                        }
                    }
                    $array_vcr[$val]=$ep_list;
            }
            $array_ss=array();
             foreach ($ss_id_list as $val) {
                 $ep_list="";
                foreach ($list_ep as $key => $value) {
                        if($value['e_ss_id']==$val){
                            if($value['e_status']!=0&&strpos($ep_list,$value['e_id']) === false){
                               $ep_list .=$value['e_id'].","; 
                            }                  
                        }
                    }
                    $array_ss[$val]=$ep_list;
            }
            $e_id_str="";
            foreach ($_REQUEST['checkbox'] as $key => $value) {
                    # code...
                    # //获取单个企业信息
                    $data['e_id']=$value;
                    $ep->set($data);
                    $ep_info=$ep->getByid(true);
                    if($ep_info['e_status']!=0){
                         $e_id_str .= $ep_info['e_id'].",";
                         $data['e_status']=7;
                     }else{
                         $data['e_status']=$ep_info['e_status'];
                     }
                            $data['e_mds_id']=$ep_info['e_mds_id']==""?NULL:$_REQUEST['e_mds_id'];
                            if($ep_info['e_vcr_id']==""){
                                $data['e_vcr_id']=NULL;
                            }else{
                                if($_REQUEST['e_vcr_id']==""){
                                   if($_REQUEST['d_deployment_id']==$dev_info['d_deployment_id']){
                                       $data['e_vcr_id']= $ep_info['e_vcr_id'];
                                   }else{
                                       $data['e_vcr_id']=NULL;
                                   }
                                }else{
                                  $data['e_vcr_id']= $_REQUEST['e_vcr_id']; 
                                }
                            }
                            $data['e_ss_id']=$ep_info['e_ss_id']==""?NULL:$_REQUEST['e_ss_id']==""?$ep_info['e_ss_id']:$_REQUEST['e_ss_id'];
                            // $data['e_area']=$ep_info['e_area']==""?NULL:$_REQUEST['e_area'];
                            $ep->set($data);
                            $ep->move_ep($value,$ep_info);
                    //}else{//企业为停用状态  向DBM发送消息
                   // }
            }
            //向DBM发送消息 1.SERVER  2.SS  3.RS
            
            try {
                //1.SERVER
                if($_REQUEST['device_id']!=$_REQUEST['e_mds_id']){
                    $this->tools->send("BatchMovedev", 'mds' . ' EIDLIST:' . trim($e_id_str,",") .' DevID:'.$_REQUEST['device_id'].','.$_REQUEST['e_mds_id']);
                }
                 
                //2.SS
                foreach ($array_ss as $key=>$value){
                     if($key!=$_REQUEST['e_ss_id']&&$_REQUEST['e_ss_id']!=""){
                        $this->tools->send("BatchMovedev", 'ss' . ' EIDLIST:' . $value .' DevID:'.$key.','.$_REQUEST['e_ss_id']);
                     }
                }
               //3.RS
                foreach ($array_rs as $key => $value) {
                     if($key!=$_REQUEST['e_vcr_id']&&$_REQUEST['e_vcr_id']!=""){
                        $this->tools->send("BatchMovedev", 'rs' . ' EIDLIST:' . $value .' DevID:'.$key.','.$_REQUEST['e_vcr_id']);
                     }
                }
                $msg['status']=0;
                $msg['msg']=L("设备迁移成功");
            } catch (Exception $exc) {
                $msg['status']=-1;
                $msg['msg']=L("设备迁移失败");
            }
            echo json_encode($msg);
    }
    
    public function rs_move_batch(){
            //企业批量迁移
            $ep = new enterprise();
            //获得当前所选设备的许可与所选企业的许可的比较

            $e_id_list = trim($_REQUEST['e_id_list'], ",");
            if($e_id_list==""){
                throw new Exception(L("没有企业可以迁移"), 1);
            }
            $allep_sure=$ep->get_allep_sure($e_id_list);

            if($allep_sure['rs_sure']>$_REQUEST['diff_rec']){
                    throw new Exception("{$_SESSION['ident']}-RS".L("用户许可不足"), 1);
            }
            $e_id_str="";
            foreach (explode(",", $e_id_list) as $key => $value) {
                    # code...
                    # //获取单个企业信息
                    $data['e_id']=$value;
                    $ep->set($data);
                    $ep_info=$ep->getByid(true);
                    if($ep_info['e_status']!=0){
                        $e_id_str .= $ep_info['e_id'].",";
                        $data['e_status']=7;
                     }else{
                         $data['e_status']=$ep_info['e_status'];
                     }
                    $data['e_mds_id']=$ep_info['e_mds_id']==""?NULL:$ep_info['e_mds_id'];
                    $data['e_vcr_id']=$ep_info['e_vcr_id']==""?NULL:$_REQUEST['e_vcr_id'];
                    $data['e_ss_id']=$ep_info['e_ss_id']==""?NULL:$ep_info['e_ss_id'];
                    $data['e_area']=$ep_info['e_area']==""?NULL:$ep_info['e_area'];

                    $ep->set($data);
                    $ep->move_ep($value,$ep_info);
            }
             try {
                  if($_REQUEST['device_id']!=$_REQUEST['e_vcr_id']&&$_REQUEST['e_vcr_id']!=""){
                    $this->tools->send("BatchMovedev", 'rs' . ' EIDLIST:' . trim($e_id_str,",") .' DevID:'.$_REQUEST['device_id'].','.$_REQUEST['e_vcr_id']);
                  }
                $msg['status']=0;
                $msg['msg']=L("RS设备迁移成功");
            } catch (Exception $exc) {
                $msg['status']=-1;
                $msg['msg']=L("RS设备迁移失败");
            }
            echo json_encode($msg);
    }
    public function ss_move_batch(){
            //企业批量迁移
            $ep = new enterprise();
            //获得当前所选设备的许可与所选企业的许可的比较

            $e_id_list = trim($_REQUEST['e_id_list'], ",");
            if($e_id_list==""){
                throw new Exception(L("没有企业可以迁移"), 1);
            }
            $e_id_str="";
            foreach (explode(",", $e_id_list) as $key => $value) {
                    # code...
                    # //获取单个企业信息
                    $data['e_id']=$value;
                    $ep->set($data);
                    $ep_info=$ep->getByid(true);
                     if($ep_info['e_status']!=0){
                         $e_id_str .= $ep_info['e_id'].",";
                        $data['e_status']=7;
                     }else{
                         $data['e_status']=$ep_info['e_status'];
                     }
                            $data['e_mds_id']=$ep_info['e_mds_id']==""?NULL:$ep_info['e_mds_id'];
                            $data['e_vcr_id']=$ep_info['e_vcr_id']==""?NULL:$ep_info['e_vcr_id'];
                            $data['e_ss_id']=$ep_info['e_ss_id']==""?NULL:$_REQUEST['e_ss_id'];
                            $data['e_area']=$ep_info['e_area']==""?NULL:$ep_info['e_area'];
                            $ep->set($data);
                            $ep->move_ep($value,$ep_info);
            }
             try {
                if($_REQUEST['device_id']!=$_REQUEST['e_ss_id']&&$_REQUEST['e_ss_id']!=""){
                    $this->tools->send("BatchMovedev", 'ss' . ' EIDLIST:' . trim($e_id_str,",") .' DevID:'.$_REQUEST['device_id'].','.$_REQUEST['e_ss_id']);
                }
                $msg['status']=0;
                $msg['msg']=L("SS设备迁移成功");
            } catch (Exception $exc) {
                $msg['status']=-1;
                $msg['msg']=L("SS设备迁移失败");
            }
            echo json_encode($msg);
               
    }
    
    public function check_rs_rec($stat=true){
        $ep=new enterprise();
        $device=new device(array("d_id"=>$_REQUEST['e_vcr_id']));
        $list_ep=get_str($_REQUEST['checkbox']);
        $ep_sum=$ep->get_eq_concurrent($list_ep);
        $ep_used_sum=$ep->get_device_concurrent($_REQUEST['e_vcr_id']);
        $dev=$device->getByid();
        if(($dev['d_recnum']-$ep_used_sum['sum'])>$ep_sum['sum']){
            if($stat){
                echo 1;
            }else{
                return 1;
            }
        }else{
            if($stat){
                echo -1;
            }else{
                return -1;
            }
        }
       
    }
}
