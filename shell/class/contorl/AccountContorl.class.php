<?php
/**
 * 计费报表控制器
 * @category 业务统计
 * @package 计费报表
 * @subpackage  控制器层
 */
class AccountContorl extends contorl {
    
    public $enterprise;
    public $account;
    public $user;
    public $agents;

    /**
     * [计费报表的构造函数]
     * 用于初始化
     * @param [array] $data 初始化参数 
     */
    function __construct($data){
    	parent::__construct(); 
            $this->account = new account($_REQUEST);
            $this->enterprise = new enterprise($_REQUEST);
            $this->user = new users($_REQUEST);
            $this->agents = new agents($_REQUEST);
            $this->data=$data;
    }

    /**
     * 计费报表首页展示
     * 展示计费相关信息
     */
    public function index(){
            $res=$this->getjson_func();
            $date=date("Y-m",strtotime(date("Y-m",time()))-86400);
            $ep_id=$res['citylist'][0]['ag_number'];
            $this->smarty->assign("ep_id",$ep_id);
            $this->smarty->assign("date",$date);
            $this->render("modules/account/index.tpl",L("业务统计"));
    }
    /**
     * 先择代理商列表接口
     * 用于选择框中的参数
     */
    public function option(){
        $list=  $this->agents->getList_one();
        foreach ($list as $key => $value) {
            $list_arr[$key]['id']=$value['ar_number'];
            $list_arr[$key]['name']=$value['ar_name'];
        }
        $this->smarty->assign('list',$list_arr);
        $this->htmlrender("viewer/option.tpl");
    }
/**
 * 获得代理商层级列表
 * 此方法提供与前台Ajax 调用
 * 返回json格式
 */
    function getjson(){
    	$account=new account();
    	$result=$account->get_array();
    	$res['citylist']=$result;
    	echo json_encode($res);
    }
/**
 * 获得代理商层级列表
 * @return array 返回代理商层级关系数组
 */
    function getjson_func(){
    	$account=new account();
    	$result=$account->get_array();
    	$res['citylist']=$result;
                 return $res;
    }
 /**
    * 获得代理商所属企业列表
    * 此方法提供与前台Ajax 调用
    * 返回json格式
    */
    function getjson_ep(){
    	$ep=new enterprise(array('e_create_name'=>"0"));
    	$result=$ep->getList();
            foreach ($result as $key => $value) {
                $arr[$key]['ag_name']=$result[$key]['e_name'];
                $arr[$key]['ag_number']=$result[$key]['e_id'];
            }
    	$res['citylist']=$arr;
    	echo json_encode($res);
    }
/**
 * 某个代理商详细信息页面
 * 用于前端展示
 */
    function account_item(){
            $enterprise = new enterprise($_REQUEST);
            $ag = new agents(array("ar_number"=>$_REQUEST['ep_id'],"start"=>$_REQUEST['start']));
            //获得代理商下的所有企业
            $data=$ag->getByid_Record();
            if($data['status']==-1){
               echo json_encode($data['msg'],JSON_UNESCAPED_UNICODE);
               die;
           }
            $list=$enterprise->getList_record();
            //$list=$enterprise->getList_record();
           if($list['status']==-1){
               echo json_encode($list['msg'],JSON_UNESCAPED_UNICODE);
               die;
           }
            $total = 0;
            if($_REQUEST['ep_id']=="0"){
                $res = json_decode($list[0]['er_price'],true);
            }else{
                $res = json_decode($data['ar_price'],true);
            }

            
            $res_diff=$res;
            array_pop($res_diff);
            array_pop($res_diff);
            array_pop($res_diff);
            array_pop($res_diff);
            array_pop($res_diff);
            
            foreach ($list as $key=>$value) {
                $info_phone=0;
                $info_dispatch=0;
                $info_gvs=0;
                $users = new users(array("er_id"=>$value['er_id'],"start"=>$_REQUEST['start'],"end"=>$_REQUEST['end']));
                //$res=$this->account->get_product_val($value['er_id'],$value['er_create_name'], $_REQUEST['start'],  $_REQUEST['end']);
                
                $info_phone=$users->getUserType_record('手机用户');
                $info_dispatch=$users->getUserType_record('调度台用户');
                $info_gvs=$users->getUserType_record('GVS用户');

                $list[$key]['preson_total']=$info_phone+$info_dispatch+$info_gvs;
                $total +=$value['er_sum_money'];
                $list_er_id .=$value['er_id'].",";
            }
            $list_er_id=  trim($list_er_id,",");
             foreach($res_diff as $key=>$value){
                 if($list_er_id==""){
                     $res_diff[$key]['num'] = 0;
                 }else{
                     $res_diff[$key]['num'] = $this->account->get_basic_num($key,$list_er_id);
                 }
                
             }
            $max_days=date('t', strtotime($_REQUEST['start']))-1;
            $start_date=date('Y-m-d', strtotime($_REQUEST['start']));
            $max_date=date('Y-m-d', strtotime($_REQUEST['start'])+(86400*$max_days));
            $this->smarty->assign("info",$res_diff);
            $this->smarty->assign("price",$res);
            $this->smarty->assign("list",$list);
            $this->smarty->assign("total",$total);
            $this->smarty->assign("data",$data);
            $this->smarty->assign("start_date",$start_date);
            $this->smarty->assign("max_date",$max_date);
            $this->smarty->assign("da",$da);
            $this->smarty->assign("res",$_REQUEST);
            $this->htmlrender("modules/account/index_item.tpl");
    }  
    /**
     * 直属企业展示页面
     * 用户前端展示
     */
    public function show_ep_info_emp(){
        $info=$this->enterprise->getByid_Record();
        $mininav = array(
                array(
                        "url" => "?m=account&a=index",
                        "name" => "计费报表",
                        "next" => ">>",
                ),
                array(
                        "url" => "?m=account&a=show_ep_info_emp&er_id={$info['er_id']}&ep_id={$_REQUEST['ep_id']}&start={$_REQUEST['start']}",
                        "name" => $info["er_name"] . " - " . L("详情"),
                        "next" => "",
                ),
        );
        $this->smarty->assign('mininav', $mininav);
        
        //$list_fun = $this->account->get_product_val($_REQUEST['er_id'],$info['er_create_name'],$_REQUEST['start'],$_REQUEST['end']);//获得增值产品的
        $res=  json_decode($info['er_price'],true);//企业增值功能产品信息
        $res_diff=$res;
        array_pop($res_diff);
        array_pop($res_diff);
        array_pop($res_diff);
        array_pop($res_diff);
        array_pop($res_diff);
        foreach($res_diff as $key=>$value){
           $res_diff[$key]['num'] = $this->account->get_basic_num($key,$info['er_id']);
        }
        
        $total_price=0;
        foreach ($list_fun as $key => $value) {
                $total_price +=$value['sum'];
                if($value["basic_price"]!=null){
                    $da['basic_price'] = $value['basic_price'];
                }
                if($value["console_price"]!=null){
                     $da['console_price'] = $value['console_price'];                      
                }
        }
        $max_days=date('t', strtotime($_REQUEST['start']))-1;
        $start_date=date('Y-m-d', strtotime($_REQUEST['start']));
        $max_date=date('Y-m-d', strtotime($_REQUEST['start'])+(86400*$max_days));
        //$phone_user = $this->user->getusertotal(1);
        //$dispatch_user = $this->user->getusertotal(2);
        $info_phone=$this->user->getUserType_record('手机用户');
        $info_dispatch=$this->user->getUserType_record('调度台用户');
        $info_gvs=  $this->user->getUserType_record('GVS用户');
        $list = $this->user->getList_Record();
        foreach ($list as $key => $value) {
            $total_price+=$value['ur_sum_money'];
        }
        $this->smarty->assign("info_price",$res_diff);
        $this->smarty->assign("price",$res);
        $this->smarty->assign("info",$info);
        $this->smarty->assign("list",$list);
        //$this->smarty->assign("list",$list_fun);
        $this->smarty->assign("start_date",$start_date);
        $this->smarty->assign("max_date",$max_date);
        $this->smarty->assign("phone_user",$phone_user);
        $this->smarty->assign("dispatch_user",$dispatch_user);
        $this->smarty->assign("total_price",$total_price);
        $this->smarty->assign("da",$da);
        $this->render("modules/account/enterprise_info_emp.tpl",L("计费报表"));
    }
    /**
     * 一级代理商下的企业
     * 用户前端展示
     */
    public function show_ep_info_amp(){
        $info=$this->enterprise->getByid_Record();
        $_REQUEST['ar_number']=$_REQUEST['ep_id'];
        $this->agents->set($_REQUEST);
        $info_ag=$this->agents->getByid_Record();
        $mininav = array(
                array(
                        "url" => "?m=account&a=index",
                        "name" => "计费报表",
                        "next" => ">>",
                ),
                array(
                        "url" => "?m=account&a=show_ep_info_emp&er_id={$info['er_id']}&ep_id={$_REQUEST['ep_id']}&start={$_REQUEST['start']}",
                        "name" => $info["er_name"] . " - " . L("详情"),
                        "next" => "",
                ),
        );
        $this->smarty->assign('mininav', $mininav);
        //$list_fun = $this->account->get_product_val($_REQUEST['er_id'],$info['er_create_name'],$_REQUEST['start'],$_REQUEST['end']);//获得增值产品的
        $res=  json_decode($info_ag['ar_price'],true);//企业增值功能产品信息
        $res_diff=$res;
        array_pop($res_diff);
        array_pop($res_diff);
        array_pop($res_diff);
        array_pop($res_diff);
        array_pop($res_diff);
        foreach($res_diff as $key=>$value){
           $res_diff[$key]['num'] = $this->account->get_basic_num($key,$info['er_id']);
        }
        $total_price=0;
//        foreach ($list_fun as $key => $value) {
//                $total_price +=$value['sum'];
//                if($value["basic_price"]!=null){
//                    $da['basic_price'] = $value['basic_price'];
//                }
//                if($value["console_price"]!=null){
//                     $da['console_price'] = $value['console_price'];                      
//                }
//        }

        //$phone_user = $this->user->getusertotal(1);
        //$dispatch_user = $this->user->getusertotal(2);
        $info_phone=$this->user->getUserType_record('手机用户');
        $info_dispatch=$this->user->getUserType_record('调度台用户');
        $info_gvs=  $this->user->getUserType_record('GVS用户');
        $list = $this->user->getList_Record();
        foreach ($list as $key => $value) {
            $total_price+=$value['ur_sum_money'];
        }
        $max_days=date('t', strtotime($_REQUEST['start']))-1;
        $start_date=date('Y-m-d', strtotime($_REQUEST['start']));
        $max_date=date('Y-m-d', strtotime($_REQUEST['start'])+(86400*$max_days));
        //$count_res=$this->user->getList_Record(" AND ur_charg_ratio_omp = '0'");
        $this->smarty->assign("info_price",$res_diff);
        $this->smarty->assign("price",$res);
        $this->smarty->assign("info",$info);
        $this->smarty->assign("list",$list);
        $this->smarty->assign("start_date",$start_date);
        $this->smarty->assign("max_date",$max_date);
        //$this->smarty->assign("list",$list_fun);
        $this->smarty->assign("phone_user",$phone_user);
        $this->smarty->assign("dispatch_user",$dispatch_user);
        $this->smarty->assign("total_price",$total_price);
        $this->smarty->assign("da",$da);
        $this->render("modules/account/enterprise_info.tpl",L("计费报表"));
    }
    
    /**
     * 获得该企业企业配置的价格信息
     * @param int $e_id 企业ID
     * @param string $e_create_name 企业创建者名称
     * @param string $start 起始时间
     * @param string $end 结束时间
     * @return type array  返回该企业企业配置的价格信息数组
     */
    function export_ep_info($e_id,$e_create_name,$start,$end){
        $enterprise = new enterprise(array("e_id"=>$e_id));
        $info=$enterprise->getByid();
        $list = $this->account->get_product_val($e_id,$e_create_name,$start,$end);
        $total_price=0;
        foreach ($list as $key => $value) {
            $total_price +=$value['sum'];
             if($value["basic_price"]!=null){
                $da['basic_price'] = $value['basic_price'];
            }
            if($value["console_price"]!=null){
                 $da['console_price'] = $value['console_price'];                      
            }
        }
        $user=new users(array('e_id'=>$e_id,'start'=>$_REQUEST['start'],'end'=>$_REQUEST['end']));
        $phone_user = $user->getusertotal(1);
        $dispatch_user = $user->getusertotal(2);
        
        $total_price+=$phone_user*$da['basic_price'];
        $total_price+=$dispatch_user*$da['console_price'];
        $arr=array("total_price"=>$total_price,"list"=>$list,"phone_user"=>$phone_user,"dispatch_user"=>$dispatch_user,"info"=>$info);
        return $arr;
    }
    /**
     * 返回实际使用的用户数
     * @param type $e_id 企业ID
     * @param type $start 开始时间
     * @return type 当前实际使用用户总数
     */
public function get_epuser_number_record($e_id,$start){
            $this->user->set(array('er_id'=>$e_id,'start'=>$start));
            $info_phone=$this->user->getUserType_record('手机用户');
            $info_dispatch=$this->user->getUserType_record('调度台用户');
            $info_gvs=$this->user->getUserType_record('GVS用户');
            $total=$info_phone+$info_dispatch+$info_gvs;
            return $total;
    }

    public function create_record(){
                $this->render("modules/account/create_record.tpl");
    }
    /**
     * 导出一级代理商下的所有企业的计费统计列表 exls
     * <pre>
     * 1.判断当前是一级代理商还是直属企业
     * 2.根据判断导出符合规范的excel 文件
     * </pre>
     */
    public function export_amp(){
        $pdo = Cof::db();//连接PDO数据库连接池
        $excel = new PHPExcel();//实例化PHPexcel对象
        /*样式设置 开始*/
        $max_days=date('t', strtotime($_REQUEST['start']))-1;
        $start_date=date('Y-m-d', strtotime($_REQUEST['start']));
        $max_date=date('Y-m-d', strtotime($_REQUEST['start'])+(86400*$max_days));
        $styleArray1 = array(
                'font' => array(
                  'bold' => true,
                  'size'=>20,
                  'color'=>array(
                    'argb' => '00000000',
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
              );
            $styleArray2 = array(
                'font' => array(
                  'bold' => true,
                  'size'=>12,
                  'color'=>array(
                    'argb' => '00000000',//黑色
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
              );
            $styleArrayred = array(
                'font' => array(
                  'bold' => true,
                  'size'=>12,
                  'color'=>array(
                    'argb' => 'FFFF0000',//红色
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
              );
            $styleArrayblue = array(
                'font' => array(
                  'bold' => true,
                  'size'=>12,
                  'color'=>array(
                    'argb' => 'FF008EFF',//蓝色
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
              );
               //$phpExcel->getActiveSheet()->getCell('A1')->setValue('Some text');
               //$phpExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
                // 将A1单元格设置为加粗
               // $excel->getActiveSheet(1)->getStyle('A1')->applyFromArray($styleArray1);
               // $excel->getActiveSheet(1)->getStyle('B1')->getFont()->setBold(true);
            $styleThinBlackBorderOutline = array(
                    'borders' => array (
                       'outline' => array (
                          'style' => PHPExcel_Style_Border::BORDER_THIN,  //设置border样式
                          //'style' => PHPExcel_Style_Border::BORDER_THICK, 另一种样式
                          'color' => array ('argb' => 'FF000000'),     //设置border颜色
                      ),
                   ),
                );
          /*样式设置 结束*/
            $excel->getActiveSheet()->setTitle("Subtotal");
          $excel->getActiveSheet()->getColumnDimension('A')->setWidth(14);  
        //获取当前代理商下的所有企业
        $enterprise = new enterprise(array("ag_number"=>$_REQUEST['ep_id'],'start'=>$_REQUEST['start']));
        $ag = new agents(array("ar_number"=>$_REQUEST['ep_id'],'start'=>$_REQUEST['start']));
        
        $k=2;
        $data=$ag->getByid_Record();//获得当前代理商的信息
        $list=$enterprise->getList_record();        //获得代理商下的所有企业
        $excel->getActiveSheet()->setTitle("BillingReport".$data['ag_number']);
        $excel->getActiveSheet()->getColumnDimension('A' .$k)->setAutoSize(true);
        $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("选择代理商"), PHPExcel_Cell_DataType::TYPE_STRING);
        $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
        $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $_REQUEST['ep_id']=="0"?DL("直属企业"):$data['ar_name'], PHPExcel_Cell_DataType::TYPE_STRING);
        $excel->getActiveSheet()->getColumnDimension('E'.$k)->setAutoSize(true);
        $excel->getActiveSheet()->setCellValueExplicit('E'.$k , DL("选择时间"), PHPExcel_Cell_DataType::TYPE_STRING);
        $excel->getActiveSheet()->getColumnDimension('F'.$k)->setAutoSize(true);
        $excel->getActiveSheet()->setCellValueExplicit('F'.$k , $_REQUEST['start'], PHPExcel_Cell_DataType::TYPE_STRING);
        $k++;
        if($_REQUEST['ep_id']!="0"){
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("账单日期"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k ,date("Y-m-d H:i:s",time()), PHPExcel_Cell_DataType::TYPE_STRING); 
            $k++;
           $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("帐户号码"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $data['ar_number'], PHPExcel_Cell_DataType::TYPE_STRING); 
            $k++;
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("账单号码"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $data['pre_count_number'], PHPExcel_Cell_DataType::TYPE_STRING); 
            $k++;
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("客户名称"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $data['ar_name'], PHPExcel_Cell_DataType::TYPE_STRING); 
            $k++;
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("计费日期"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $start_date."--".$max_date, PHPExcel_Cell_DataType::TYPE_STRING); 
            $k++;
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("客户地址"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $data['ar_addr'], PHPExcel_Cell_DataType::TYPE_STRING); 
            $k++;
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("开户日期"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $data['ar_create_time'], PHPExcel_Cell_DataType::TYPE_STRING); 
            $k++;
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("开户银行"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $_REQUEST['open_bank'], PHPExcel_Cell_DataType::TYPE_STRING);
            $k++;
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("开户行账号"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->getColumnDimension('B'.$k)->setAutoSize(true);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$k , $_REQUEST['open_bank_account'], PHPExcel_Cell_DataType::TYPE_STRING);
            $k++;
            $price = json_decode($data['ar_price'],true);
        }else{
            $data['ar_number']="00000000000";
            $price = json_decode($list[0]['er_price'],true);
        }
            $excel->getActiveSheet()->getColumnDimension('A'.$k)->setAutoSize(true);
            //$excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleThinBlackBorderOutline);
//            $excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleArray2);
            $excel->getActiveSheet()->getStyle("A".$k)->getFont()->setBold(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$k , DL("增值功能统计").":", PHPExcel_Cell_DataType::TYPE_STRING);
            $k++;
            //费用
            foreach ($list as $key => $value) {
                $list_er_id .=$value['er_id'].",";
            }
            $list_er_id=  trim($list_er_id,",");
            foreach($price as $key=>$value){
                $price[$key]['num'] = $this->account->get_basic_num($key,$list_er_id);
            }
            $diff_price=$price;
            array_pop($diff_price);
            array_pop($diff_price);
            array_pop($diff_price);
            array_pop($diff_price);
            array_pop($diff_price);
            $num=count($price);
            $page=  ceil(count($price)/3);
            $n=1;
            $nn=$k;
            $c=0;//起始列
            //$col1 = PHPExcel_Cell::stringFromColumnIndex($c);
           $nnn=$nn;
            foreach ($diff_price as $key => $value) {
                if($c%3==0&&$c!=0){
                    $nn++;
                    $c=0;
                }
                $col = PHPExcel_Cell::stringFromColumnIndex($c);
                $excel->getActiveSheet()->setCellValueExplicit($col.$nn , $n.",".DL($value['name']), PHPExcel_Cell_DataType::TYPE_STRING);
                $c++;
                $col = PHPExcel_Cell::stringFromColumnIndex($c);
                $excel->getActiveSheet()->setCellValueExplicit($col.$nn , $value['num'], PHPExcel_Cell_DataType::TYPE_STRING);
                $n++;
                $c++;
            }
            $col1 = PHPExcel_Cell::stringFromColumnIndex($c);
            $excel->getActiveSheet()->getStyle("A".$nnn.":".$col1.$nn)->applyFromArray($styleThinBlackBorderOutline);
            $nn++;
            $excel->getActiveSheet()->getColumnDimension('A'.$nn)->setAutoSize(true);
            //$excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleThinBlackBorderOutline);
//            $excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleArray2);
            $excel->getActiveSheet()->getStyle("A".$nn)->getFont()->setBold(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("费用详情").":", PHPExcel_Cell_DataType::TYPE_STRING);
            
            $nn++;
            $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("基础功能费"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$nn ,$_REQUEST['ep_id']!="0"?$price['basic_price_amp']['price']:$price['basic_price']['price'], PHPExcel_Cell_DataType::TYPE_STRING);
            
            $excel->getActiveSheet()->setCellValueExplicit('E'.$nn , DL("Console功能费"), PHPExcel_Cell_DataType::TYPE_STRING);
           
            $excel->getActiveSheet()->setCellValueExplicit('F'.$nn ,  $_REQUEST['ep_id']!="0"?$price['console_price_amp']['price']:$price['console_price']['price'], PHPExcel_Cell_DataType::TYPE_STRING);

           //table列表
            $nn++;
            $nn++;
            $excel->getActiveSheet()->getStyle("A".$nn.":".'H'.$nn)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $excel->getActiveSheet()->getStyle("A".$nn.":".'H'.$nn)->getFill()->getStartColor()->setARGB('FF808080');
            $excel->getActiveSheet()->getStyle("A".$nn.":".'H'.$nn)->applyFromArray($styleThinBlackBorderOutline);
            $excel->getActiveSheet()->getStyle("A".$nn.":".'H'.$nn)->applyFromArray($styleArray2);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("编号"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , DL("企业名称"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('C'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('D'.$nn , DL("帐户号码"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('E'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('F'.$nn , DL("企业用户数"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('G'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('H'.$nn , DL("合计"), PHPExcel_Cell_DataType::TYPE_STRING);
            $nn++;
            $i=1;
            $total=0;
            foreach ($list as $key => $value) {
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , $i, PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , $value['er_name'], PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('C'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('D'.$nn , $value['er_id'], PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('E'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('F'.$nn , $this->get_epuser_number_record($value['er_id'],$_REQUEST['start']), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('G'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('H'.$nn , round($value['er_sum_money'],2), PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $nn++;

                $total+=$value['er_sum_money'];
            }
            $nn++;
//            $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , "注:Phone类型的用户的费用包含基础功能费+增值功能费", PHPExcel_Cell_DataType::TYPE_STRING);
             $excel->getActiveSheet()->setCellValueExplicit('G'.$nn , "Total:" , PHPExcel_Cell_DataType::TYPE_STRING);
             $excel->getActiveSheet()->setCellValueExplicit('H'.$nn , round($total,2) , PHPExcel_Cell_DataType::TYPE_STRING);
            
            $nn++;
            $excel->getActiveSheet()->setCellValueExplicit('G'.$nn , DL("企业数").":" , PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('H'.$nn , --$i , PHPExcel_Cell_DataType::TYPE_STRING);
            $nn++;
            if($_REQUEST['ep_id']!="0"){
               
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("其他费用"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , $_REQUEST['other_price']==""?0:$_REQUEST['other_price'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $kk=$nn;
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("备注"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , $_REQUEST['remarks'], PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("税前费用合计"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , ($total+$_REQUEST['other_price']==""?0:$total+$_REQUEST['other_price'])*($_REQUEST['pte']==""?1:$_REQUEST['pte']), PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $k2=$nn;
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("税率"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , $_REQUEST['pte']==""?0:$_REQUEST['pte'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $excel->getActiveSheet()->setCellValueExplicit('C'.$nn , "%", PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('F'.$nn , DL("税后合计")."： ", PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('G'.$nn , "=ROUND(PRODUCT(B$k2,SUM(B".++$k2."/100+1)),2)", PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                
            }
            
        
        
        //针对每个企业创建Sheet
        $i=1;
        foreach ($list as $key => $value) {
            $j=1;
             //设置excel sheet标题
            $excel->createSheet();
            $excel->setActiveSheetIndex($i);
            $length=strlen($value['er_name']);
            if($length>25){
                $er_name=  mb_substr($value['er_name'], 0, 25)."...";
            }else{
                $er_name=$value['er_name'];
            }
            
            $excel->getActiveSheet($i)->setTitle("$er_name");
            /* 企业信息 开始  */
             $excel->getActiveSheet()->getColumnDimension('A')->setWidth(12);  
            //$excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);  
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
            $excel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
            $excel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
            if($_REQUEST['ep_id']=="0"){
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("账单日期"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , date("Y-m-d H:i:s",  time()), PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("帐户号码"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['er_create_name']==0?"000000".$value['er_id']:  substr($value['er_create_name'], 0,6).$value['er_id'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("账单号码"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['pre_count_number'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("客户名称"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['er_name'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("计费日期"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $start_date."~".$max_date, PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("企业地址"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['er_addr'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("开户日期"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['er_create_time'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("开户银行"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , "", PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("开户行账号"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , "", PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
               
            }else{
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("帐户号码"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['er_create_name']==0?"000000".$value['er_id']:  substr($value['er_create_name'], 0,6).$value['er_id'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("企业名称"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['er_name'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("计费日期"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $start_date."~".$max_date, PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("企业地址"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['er_addr'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A' . $j , DL("开户日期"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B' . $j , $value['er_create_time'], PHPExcel_Cell_DataType::TYPE_STRING);
                $j++;
            }
            
            /* 企业信息 结束  */
            /* 企业费用详情 start*/
             $excel->getActiveSheet($i)->getColumnDimension('A'.$j)->setAutoSize(true);
            //$excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleThinBlackBorderOutline);
//            $excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleArray2);
            $excel->getActiveSheet($i)->getStyle("A".$j)->getFont()->setBold(true);
            $excel->getActiveSheet($i)->setCellValueExplicit('A'.$j , DL("增值功能统计").":", PHPExcel_Cell_DataType::TYPE_STRING);
            $j++;
            //费用
            //$price = json_decode($list[0]['er_price'],true);
             foreach($price as $key=>$val){
                $price[$key]['num'] = $this->account->get_basic_num($key,$value['er_id']);
            }
            $diff_price=$price;
            array_pop($diff_price);
            array_pop($diff_price);
            array_pop($diff_price);
            array_pop($diff_price);
            array_pop($diff_price);
           
            
            $num=count($price);
            $page=  ceil(count($price)/3);
            $n=1;
            $nn=$j;
            $c=0;//起始列
            //$col1 = PHPExcel_Cell::stringFromColumnIndex($c);
           $nnn=$nn;
            foreach ($diff_price as $key => $val) {
                if($c%3==0&&$c!=0){
                    $nn++;
                    $c=0;
                }
                $col = PHPExcel_Cell::stringFromColumnIndex($c);
                $excel->getActiveSheet($i)->setCellValueExplicit($col.$nn , $n.",".DL($val['name']), PHPExcel_Cell_DataType::TYPE_STRING);
                $c++;
                $col = PHPExcel_Cell::stringFromColumnIndex($c);
                $excel->getActiveSheet($i)->setCellValueExplicit($col.$nn , $val['num'], PHPExcel_Cell_DataType::TYPE_STRING);
                $n++;
                $c++;
            }
            $col1 = PHPExcel_Cell::stringFromColumnIndex($c);
            $excel->getActiveSheet($i)->getStyle("A".$nnn.":".$col1.$nn)->applyFromArray($styleThinBlackBorderOutline);
            
            $nn++;
            $excel->getActiveSheet($i)->getColumnDimension('A'.$nn)->setAutoSize(true);
            //$excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleThinBlackBorderOutline);
//            $excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleArray2);
            $excel->getActiveSheet($i)->getStyle("A".$nn)->getFont()->setBold(true);
            $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , DL("费用详情").":", PHPExcel_Cell_DataType::TYPE_STRING);
            
            $nn++;
            $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , DL("基础功能费"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('B'.$nn , $_REQUEST['ep_id']!="0"?$price['basic_price_amp']['price']:$price['basic_price']['price'], PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('E'.$nn , DL("Console功能费"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('F'.$nn ,$_REQUEST['ep_id']!="0"?$price['console_price_amp']['price']:$price['console_price']['price'], PHPExcel_Cell_DataType::TYPE_STRING);
    /* 企业费用详情 end*/
            
            /* 企业用户 table start*/
            $user=new users(array('er_id'=>$value['er_id'],'start'=>$_REQUEST['start']));
            $users_list=$user->getList_Record();
            $nn++;
            $excel->getActiveSheet($i)->getStyle("A".$nn.":".'I'.$nn)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $excel->getActiveSheet($i)->getStyle("A".$nn.":".'I'.$nn)->getFill()->getStartColor()->setARGB('FF808080');
            $excel->getActiveSheet($i)->getStyle("A".$nn.":".'I'.$nn)->applyFromArray($styleThinBlackBorderOutline);
            $excel->getActiveSheet($i)->getStyle("A".$nn.":".'I'.$nn)->applyFromArray($styleArray2);
            $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , DL("编号"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('B'.$nn , DL("用户名称"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('C'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('D'.$nn , DL("用户ID"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('E'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('F'.$nn , DL("用户类型"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('G'.$nn , DL("增值功能"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('H'.$nn , DL("开户日期"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('I'.$nn , DL("金额"), PHPExcel_Cell_DataType::TYPE_STRING);
            $nn++;
            $ii=1;
            $total=0;
            foreach ($users_list as $kk => $vv) {
                if($ii==$vv['count']){
                    $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , $ii, PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('B'.$nn , $vv['ur_name'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('C'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('D'.$nn , $vv['ur_number'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('E'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('F'.$nn , DL($vv['ur_sub_type']), PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('G'.$nn , $vv['ur_p_function'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('H'.$nn , $vv['ur_create_time'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('I' . $nn , round($vv['ur_sum_money'],2), PHPExcel_Cell_DataType::TYPE_STRING);
                    $nn++;
                    $excel->getActiveSheet($i)->getRowDimension($nn)->setRowHeight(5);
                }else{
                    $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , $ii, PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('B'.$nn , $vv['ur_name'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('C'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('D'.$nn , $vv['ur_number'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('E'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('F'.$nn , DL($vv['ur_sub_type']), PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('G'.$nn , $vv['ur_p_function'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('H'.$nn , $vv['ur_create_time'], PHPExcel_Cell_DataType::TYPE_STRING);
                    $excel->getActiveSheet($i)->setCellValueExplicit('I' . $nn , round($vv['ur_sum_money'],2), PHPExcel_Cell_DataType::TYPE_STRING);
                }
                $ii++;
                $nn++;
                $total+=$vv['ur_sum_money'];
                
            }
//            $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , "注:Phone类型的用户的费用包含基础功能费+增值功能费", PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('H'.$nn , "Total:" , PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('I'.$nn , round($total,2) , PHPExcel_Cell_DataType::TYPE_STRING);
            $nn++;
            $excel->getActiveSheet($i)->setCellValueExplicit('H'.$nn , DL("企业用户数") , PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet($i)->setCellValueExplicit('I'.$nn , --$ii , PHPExcel_Cell_DataType::TYPE_STRING);
            /* 企业用户 table end*/
            $nn++;
            if($_REQUEST['ep_id']=="0"){
                $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , DL("其他费用"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B'.$nn , "", PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $kk=$nn;
                $nn++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , DL("备注"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , DL("税前费用合计"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B'.$nn ,($total+$_REQUEST['other_price']==""?0:$total+$_REQUEST['other_price'])*($_REQUEST['pte']==""?1:$_REQUEST['pte']), PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $k1=$nn;
                $nn++;
                $excel->getActiveSheet($i)->setCellValueExplicit('A'.$nn , DL("税率"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('B'.$nn , "0", PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $excel->getActiveSheet($i)->setCellValueExplicit('C'.$nn , "%", PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                $excel->getActiveSheet($i)->setCellValueExplicit('F'.$nn , DL("税后合计")."： ", PHPExcel_Cell_DataType::TYPE_STRING);
//                $excel->getActiveSheet($i)->setCellValueExplicit('G'.$nn , "=SUM(B$k1+"."PRODUCT(B$k1,B".++$k1.")+B$kk)", PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet($i)->setCellValueExplicit('G'.$nn , "=ROUND(PRODUCT(B$k1,SUM(B".++$k1."/100+1)),2)", PHPExcel_Cell_DataType::TYPE_STRING);
                
            }
            $i++;
        }
        
        //excel输出
        $output = new PHPExcel_Writer_Excel5($excel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check = 0, pre-check = 0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename="' . "BillingReport".$data['ar_number']. '.xls"');
        header("Content-Transfer-Encoding:binary");
        $output->save('php://output');
    }
    /**
     * /**
     * 导出某个企业的计费统计列表 exls
     * <pre>
     * 1.判断当前是一级代理商还是直属企业
     * 2.根据判断导出符合规范的excel 文件
     * </pre>
     */
    public function export_emp(){
        $pdo = Cof::db();//连接PDO数据库连接池
        $excel = new PHPExcel();//实例化PHPexcel对象
        /*样式设置 开始*/
        $max_days=date('t', strtotime($_REQUEST['start']))-1;
        $start_date=date('Y-m-d', strtotime($_REQUEST['start']));
        $max_date=date('Y-m-d', strtotime($_REQUEST['start'])+(86400*$max_days));
        $styleArray1 = array(
                'font' => array(
                  'bold' => true,
                  'size'=>20,
                  'color'=>array(
                    'argb' => '00000000',
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
              );
            $styleArray2 = array(
                'font' => array(
                  'bold' => true,
                  'size'=>12,
                  'color'=>array(
                    'argb' => '00000000',//黑色
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
              );
            $styleArrayred = array(
                'font' => array(
                  'bold' => true,
                  'size'=>12,
                  'color'=>array(
                    'argb' => 'FFFF0000',//红色
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
              );
            $styleArrayblue = array(
                'font' => array(
                  'bold' => true,
                  'size'=>12,
                  'color'=>array(
                    'argb' => 'FF008EFF',//蓝色
                  ),
                ),
                'alignment' => array(
                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                ),
              );
               //$phpExcel->getActiveSheet()->getCell('A1')->setValue('Some text');
               //$phpExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
                // 将A1单元格设置为加粗
               // $excel->getActiveSheet(1)->getStyle('A1')->applyFromArray($styleArray1);
               // $excel->getActiveSheet(1)->getStyle('B1')->getFont()->setBold(true);
            $styleThinBlackBorderOutline = array(
                    'borders' => array (
                       'outline' => array (
                          'style' => PHPExcel_Style_Border::BORDER_THIN,  //设置border样式
                          //'style' => PHPExcel_Style_Border::BORDER_THICK, 另一种样式
                          'color' => array ('argb' => 'FF000000'),     //设置border颜色
                      ),
                   ),
                );
          /*样式设置 结束*/
          $excel->getActiveSheet()->getColumnDimension('A')->setWidth(12);  
          //$excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);  
          $excel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
          $excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
          $excel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
          $excel->getActiveSheet()->getColumnDimension('G')->setWidth(14);
          $excel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
        //获取当前代理商下的所有企业
        $enterprise = new enterprise($_REQUEST);

        //$ag = new agents(array("ar_number"=>$_REQUEST['ep_id'],'start'=>$_REQUEST['start']));
        
        
        $data=$enterprise->getByid_Record();//获得当前代理商的信息
        //$list=$enterprise->getList_record();        //获得代理商下的所有企业
        
        //针对每个企业创建Sheet
            $i=2;
             //设置excel sheet标题
            //$excel->createSheet();
            //$excel->setActiveSheetIndex($i);
            $length=strlen($data['er_name']);
            if($length>25){
                $er_name=  mb_substr($data['er_name'], 0, 25)."...";
            }else{
                $er_name=$data['er_name'];
            }
           $excel->getActiveSheet()->setTitle("$er_name");
            /* 企业信息 开始  */
            
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("账单日期"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , date("Y-m-d H:i:s",  time()), PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("帐户号码"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , $data['er_create_name']==0?"000000".$data['er_id']:  substr($data['er_create_name'], 0 ,6).$data['er_id'], PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("账单号码"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , $data['pre_count_number'], PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("客户名称"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , $data['er_name'], PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("计费日期"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , $start_date."~".$max_date, PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("企业地址"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , $data['er_addr'], PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("开户日期"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , $data['er_create_time'], PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("开户银行"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , $_REQUEST['open_bank'], PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
                $excel->getActiveSheet()->setCellValueExplicit('A' . $i , DL("开户行账号"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B' . $i , $_REQUEST['open_bank_account'], PHPExcel_Cell_DataType::TYPE_STRING);
                $i++;
            /* 企业信息 结束  */
            /* 企业费用详情 start*/
            $price = json_decode($data['er_price'],true);
            
             $excel->getActiveSheet()->getColumnDimension('A'.$i)->setAutoSize(true);
            //$excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleThinBlackBorderOutline);
//            $excel->getActiveSheet()->getStyle("A12")->applyFromArray($styleArray2);
            $excel->getActiveSheet()->getStyle("A".$i)->getFont()->setBold(true);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$i , DL("增值功能统计").":", PHPExcel_Cell_DataType::TYPE_STRING);
            $i++;
            foreach($price as $key=>$val){
                $price[$key]['num'] = $this->account->get_basic_num($key,$data['er_id']);
            }
            $price_diff=$price;
            array_pop($price_diff);
            array_pop($price_diff);
            array_pop($price_diff);
            array_pop($price_diff);
            array_pop($price_diff);
            $num=count($price_diff);
            $page=  ceil(count($price_diff)/3);
            $n=1;
            $nn=$i;
            $c=0;//起始列
           $nnn=$nn;
            foreach ($price_diff as $k => $val) {
                if($c%3==0&&$c!=0){
                    $nn++;
                    $c=0;
                }
                $col = PHPExcel_Cell::stringFromColumnIndex($c);
                $excel->getActiveSheet()->setCellValueExplicit($col.$nn , $n.",".DL($val['name']), PHPExcel_Cell_DataType::TYPE_STRING);
                $c++;
                $col = PHPExcel_Cell::stringFromColumnIndex($c);
                $excel->getActiveSheet()->setCellValueExplicit($col.$nn , $val['num'], PHPExcel_Cell_DataType::TYPE_STRING);
                $n++;
                $c++;
            }

            $excel->getActiveSheet()->getStyle("A".$nnn.":I".$nn)->applyFromArray($styleThinBlackBorderOutline);
    /* 企业费用详情 end*/
            $nn++;
            $excel->getActiveSheet()->getColumnDimension('A'. $nn)->setAutoSize(true);
            //$excel->getActiveSheet()->getStyle('A'. $i)->applyFromArray($styleThinBlackBorderOutline);
//            $excel->getActiveSheet()->getStyle(A9)->applyFromArray($styleArray2);
            $excel->getActiveSheet()->getStyle('A'. $nn)->getFont()->setBold(true);
            $excel->getActiveSheet()->setCellValueExplicit('A' . $nn , DL("费用详情").":", PHPExcel_Cell_DataType::TYPE_STRING);
            $nn++;

            $excel->getActiveSheet()->setCellValueExplicit('A' . $nn , DL("基础功能费"), PHPExcel_Cell_DataType::TYPE_STRING);
            
            $excel->getActiveSheet()->setCellValueExplicit('B' . $nn , $price['basic_price']['price'], PHPExcel_Cell_DataType::TYPE_STRING);

            $excel->getActiveSheet()->setCellValueExplicit('E' . $nn , DL("Console功能费"), PHPExcel_Cell_DataType::TYPE_STRING);

            $excel->getActiveSheet()->setCellValueExplicit('F' . $nn ,$price['console_price']['price'], PHPExcel_Cell_DataType::TYPE_STRING);
            $nn++;
            /* 企业用户 table start*/
            $user=new users(array('er_id'=>$_REQUEST['er_id'],'start'=>$_REQUEST['start']));
            $users_list=$user->getList_Record();
            $nn++;
            $excel->getActiveSheet()->getStyle("A".$nn.":".'I'.$nn)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $excel->getActiveSheet()->getStyle("A".$nn.":".'I'.$nn)->getFill()->getStartColor()->setARGB('FF808080');
            $excel->getActiveSheet()->getStyle("A".$nn.":".'I'.$nn)->applyFromArray($styleThinBlackBorderOutline);
            $excel->getActiveSheet()->getStyle("A".$nn.":".'I'.$nn)->applyFromArray($styleArray2);
            $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("编号"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , DL("用户名称"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('C'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('D'.$nn , DL("用户ID"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('E'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('F'.$nn , DL("用户类型"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('G'.$nn , DL("增值功能"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('H'.$nn , DL("开户日期"), PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->setCellValueExplicit('I'.$nn , DL("金额"), PHPExcel_Cell_DataType::TYPE_STRING);
            $nn++;
            $ii=1;
            $total=0;
            foreach ($users_list as $kk => $vv) {
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , $ii, PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , $vv['ur_name'], PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('C'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('D'.$nn , $vv['ur_number'], PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('E'.$nn , "", PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('F'.$nn , DL($vv['ur_sub_type']), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('G'.$nn , $vv['ur_p_function'], PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('H'.$nn , $vv['ur_create_time'], PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('I' . $nn , round($vv['ur_sum_money'],2), PHPExcel_Cell_DataType::TYPE_STRING);
                $ii++;
                $nn++;
                $total+=round($vv['ur_sum_money'],2);
                
            }
//            $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , "注:Phone类型的用户的费用包含基础功能费+增值功能费", PHPExcel_Cell_DataType::TYPE_STRING);
             $nn++;
            /* 企业用户 table end*/
            
//            if($_REQUEST['type']!="emp"){
//                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , "注:Phone类型的用户的费用包含基础功能费+增值功能费", PHPExcel_Cell_DataType::TYPE_STRING);
//                $excel->getActiveSheet()->setCellValueExplicit('I'.$nn , "Total:" , PHPExcel_Cell_DataType::TYPE_STRING);
//                $excel->getActiveSheet()->setCellValueExplicit('J'.$nn , $total , PHPExcel_Cell_DataType::TYPE_STRING);
//                $nn++;
//                $excel->getActiveSheet()->setCellValueExplicit('I'.$nn , "企业用户数:" , PHPExcel_Cell_DataType::TYPE_STRING);
//                $excel->getActiveSheet()->setCellValueExplicit('J'.$nn , --$ii , PHPExcel_Cell_DataType::TYPE_STRING);
//            }else{
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("注:Phone类型的用户的费用包含基础功能费+增值功能费"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('I'.$nn , "Total:" , PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('J'.$nn , round($total,2) , PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('I'.$nn , DL("企业用户数").":" , PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('J'.$nn , --$ii , PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("其他费用"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , $_REQUEST['other_price']==""?0:$_REQUEST['other_price'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $kk=$nn;
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("备注"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , $_REQUEST['remarks'], PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("税前费用合计"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn ,($total+$_REQUEST['other_price']==""?0:$total+$_REQUEST['other_price'])*($_REQUEST['pte']==""?1:$_REQUEST['pte']), PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $k1=$nn;
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('A'.$nn , DL("税率"), PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('B'.$nn , $_REQUEST['pte']==""?0:$_REQUEST['pte'], PHPExcel_Cell_DataType::TYPE_NUMERIC);
                $excel->getActiveSheet()->setCellValueExplicit('C'.$nn , "%", PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
                $excel->getActiveSheet()->setCellValueExplicit('F'.$nn , DL("税后合计")."： ", PHPExcel_Cell_DataType::TYPE_STRING);
                $excel->getActiveSheet()->setCellValueExplicit('G'.$nn , "=ROUND(PRODUCT(B$k1,SUM(B".++$k1."/100+1)),2)", PHPExcel_Cell_DataType::TYPE_STRING);
                $nn++;
//            }
                $filename=$data['er_create_name']==0?"000000".$data['er_id']:  substr($data['er_create_name'], 0 ,6).$data['er_id'];
        //excel输出
        $output = new PHPExcel_Writer_Excel5($excel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check = 0, pre-check = 0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");
        header('Content-Disposition:attachment;filename="' . "BillingReport".$filename. '.xls"');
        header("Content-Transfer-Encoding:binary");
        $output->save('php://output');
    }

}