<?php
/**
 * 数据报表控制器
 * @category 业务统计
 * @package 数据统计
 * @subpackage  控制器层
 */
class ReportContorl extends contorl {
    public $report;
    public $fd;
    public $line_chart;
    public $histogram;
    public $term;
    function __construct($data){
        parent::__construct(); 
        $this->report = new report($_REQUEST);
        $this->term = new terminal($_REQUEST);
        $this->fd = new formatdate();
        $this->data=$data;
        $this->line_chart = array('already_open','_commercial','_livesum','_intercom_recording','_speaking_time');
        $this->histogram = array('_live','_users','_type','_validity','_livenum','_call_record','_call_time','_video_record','_video_time');
    }

    //默认首页
    public function index(){
        $user_list=$this->get_item_list();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=(int)$value['user_num'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->render("modules/report/index.tpl");
    }
    /**
     * 激活用户
     */
    public function act(){
        $user_list=$this->get_item_list();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=(int)$value['user_num'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->render("modules/report/index_act.tpl");
    }

    function getjson(){
    	$report=new report();
    	$result=$report->get_array();
    	$res['citylist']=$result;
    	echo json_encode($res);
    }
    function getagep(){
    	$report=new report();
    	$result=$report->get_array();
//    	$res['citylist']=$result;
        $this->smarty->assign("list",$result);
        $this->htmlrender("modules/report/ag_lv.tpl");
    }

    function report_item(){
        $user_list=$this->get_item_list();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=(int)$value['user_num'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/index_item.tpl");
        //$this->htmlrender("viewer/report.tpl");
    }
    
    public function get_report_pic(){
        $user_list=$this->get_item_list();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=$value['user_num'];
            $arr[$key]['week']=$value['week'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("viewer/report.tpl");
    }

    /**
     * 新增用户个数统计
     */
    function add_newuser(){
        
    }
    
    /**
     * 获得相对应时间的用户数
     */
    public function get_item_list(){
        $list_str="";
        if($_REQUEST['ep_id']!="" && strlen($_REQUEST['ep_id'])==6){
            $list_str="'".$_REQUEST['ep_id']."'";
        }else{
            $list=$this->report->getall_ep($_REQUEST['ep_id']);
                if(count($list)>=1){
                    foreach ($list as $value) {
                        $list_str.="'{$value['e_id']}'".",";
                    }
                    $list_str=  trim($list_str, ",");
                }else{
                    $list_str="'".$_REQUEST['ep_id']."'";
                }
        }
        $user_list=array();
        if($_REQUEST['date_type']=="week"){
            //var_dump($_REQUEST);
             if($_REQUEST['start']=="" && $_REQUEST['end']==""){
                //1天是86400秒
                $_REQUEST['start']=date("Y-m-d",time()-604800);
                $_REQUEST['end']=date("Y-m-d",time());
            }
           $week_info=$this->fd->get_weeks($_REQUEST['start'],$_REQUEST['end']);
           for($i=0;$i < count($week_info); $i++){
               if($i==0){
                   $startdate=$_REQUEST['start'];
                   $enddate=$week_info[$i]['w_end'];
               }else if($i==(count($week_info)-1)){
                   $startdate=$week_info[$i]['w_start'];
                   $enddate=$_REQUEST['end'];
               }else{
                   $startdate=$week_info[$i]['w_start'];
                   $enddate=$week_info[$i]['w_end'];
               }
               
                $start=strtotime($startdate);
                $end=strtotime($enddate);
//                $len=($end-$start)/86400;
                $sum=0;
//                for($j=0;$j<=$len;$j++){
                    $_REQUEST['u_create_time']=date("Y-m-d",$end);
                    $this->report->set($_REQUEST);
                    $res=$this->report->getall_user($list_str);

                    $sum +=(int)$res['user_num'];
                    //$res['create_time']= $_REQUEST['u_create_time'];
                    //$user_list[]=$res;
//                }
               //$this->report->set(array("start"=>$start,"end"=>$end));
               //$res=$this->report->getall_user($list_str);
               $res['user_num']=$sum;
               $res['create_time']="第". ($i+1) ."周";
               $res['week']=$startdate."~".$enddate;
               $user_list[]=$res;
           }
        }else if($_REQUEST['date_type']=="month"){
                   //var_dump($_REQUEST);
             if($_REQUEST['start']=="" && $_REQUEST['end']==""){
                //1天是86400秒
                $_REQUEST['start']=date("Y-m-d",time()-604800);
                $_REQUEST['end']=date("Y-m-d",time());
            }
           $month_info=$this->fd->get_months($_REQUEST['start'],$_REQUEST['end']);
           for($i=0;$i < count($month_info); $i++){
               if($i==0){
                   $startdate=$_REQUEST['start'];
                   $enddate=$month_info[$i]['m_end'];
               }else if((count($month_info)-1)==$i){
                   $startdate=$month_info[$i]['m_start'];
                   $enddate=$_REQUEST['end'];
               }else{
                   $startdate=$month_info[$i]['m_start'];
                   $enddate=$month_info[$i]['m_end'];
               }
               
                $start=strtotime($startdate);
                $end=strtotime($enddate);
                //$len=($end-$start)/86400;
                $sum=0;
                //for($j=0;$j<=$len;$j++){
                    $_REQUEST['u_create_time']=date("Y-m-d",$end);
                    $this->report->set($_REQUEST);
                    $res=$this->report->getall_user($list_str);

                    $sum +=(int)$res['user_num'];
                    //$res['create_time']= $_REQUEST['u_create_time'];
                    //$user_list[]=$res;
               // }
               $res['user_num']=$sum;
               $res['create_time']= date("Y",$start)."年". date("m",$start) ."月";
               $res['month']=$startdate."~".$enddate;
               $user_list[]=$res;
           }
        }else{
            if($_REQUEST['start']=="" && $_REQUEST['end']==""){
                //1天是86400秒
                //$_REQUEST['start']=date("Y-m-d",time()-604800);
                //$_REQUEST['end']=date("Y-m-d",time());
                
                for($i=7;$i>=0;$i--){
                    $_REQUEST['u_create_time']=date("Y-m-d",time()-(86400*$i));
                    $this->report->set($_REQUEST);
                    $res=$this->report->getall_user($list_str);
                    $res['create_time']=$_REQUEST['u_create_time'];
                    $user_list[]=$res;
                }
            }else{
                $start=strtotime($_REQUEST['start']);
                $end=strtotime($_REQUEST['end']);
                $len=($end-$start)/86400;
                $user_list=array();
                for($i=0;$i<=$len;$i++){
                    $_REQUEST['u_create_time']=date("Y-m-d",$start+(86400*$i));
                    $this->report->set($_REQUEST);
                    $res=$this->report->getall_user($list_str);

                    $res['create_time']= $_REQUEST['u_create_time'];
                    $user_list[]=$res;
                }

            }
        }
        return $user_list;
    }
    
    public function get_list_histogram(){
        $list_str="";
        if($_REQUEST['ep_id']!="" && strlen($_REQUEST['ep_id'])==6){
            $list_str="'".$_REQUEST['ep_id']."'";
        }else{
            $list=$this->report->getall_ep($_REQUEST['ep_id']);
                if(count($list)>=1){
                    foreach ($list as $value) {
                        $list_str.="'{$value['e_id']}'".",";
                    }
                    $list_str=  trim($list_str, ",");
                }else{
                    $list_str="'".$_REQUEST['ep_id']."'";
                }
        }
        $user_list=array();
        if($_REQUEST['date_type']=="week"){
            //var_dump($_REQUEST);
             if($_REQUEST['start']=="" && $_REQUEST['end']==""){
                //1天是86400秒
                $_REQUEST['start']=date("Y-m-d",time()-604800);
                $_REQUEST['end']=date("Y-m-d",time());
            }
           $week_info=$this->fd->get_weeks($_REQUEST['start'],$_REQUEST['end']);
           for($i=0;$i < count($week_info); $i++){
               if($i==0){
                   $startdate=$_REQUEST['start'];
                   $enddate=$week_info[$i]['w_end'];
               }else{
                   $startdate=$week_info[$i]['w_start'];
                   $enddate=$week_info[$i]['w_end'];
               }
               
                $start=strtotime($startdate);
                $end=strtotime($enddate);
                $len=($end-$start)/86400;
                $sum=0;
                $sum1=0;
                $sum2=0;
                $sum3=0;
                for($j=0;$j<=$len;$j++){
                    $_REQUEST['u_create_time']=date("Y-m-d",$start+(86400*$j));
                    $this->report->set($_REQUEST);
     
                    $pargam1=$this->report->getall_for_histogram($list_str,"1");
                    $pargam2=$this->report->getall_for_histogram($list_str,"2");
                    $pargam3=$this->report->getall_for_histogram($list_str,"3");
                    $res['pargam1']=$pargam1['user_num'];
                    $res['pargam2']=$pargam2['user_num'];
                    $res['pargam3']=$pargam3['user_num'];

                    $sum +=(int)($res['pargam1']+$res['pargam2']+$res['pargam3']);
                    $sum1 +=(int)$res['pargam1'];
                    $sum2 +=(int)$res['pargam2'];
                    $sum3 +=(int)$res['pargam3'];
                    //$res['create_time']= $_REQUEST['u_create_time'];
                    //$user_list[]=$res;
                }
               //$this->report->set(array("start"=>$start,"end"=>$end));
               //$res=$this->report->getall_user($list_str);
               $res['pargam1']=$sum1;
               $res['pargam2']=$sum2;
               $res['total']=$sum;
               $res['create_time']="第". ($i+1) ."周";
               $res['week']=$startdate."~".$enddate;
               $user_list[]=$res;
           }
        }else if($_REQUEST['date_type']=="month"){
                   //var_dump($_REQUEST);
             if($_REQUEST['start']=="" && $_REQUEST['end']==""){
                //1天是86400秒
                $_REQUEST['start']=date("Y-m-d",time()-604800);
                $_REQUEST['end']=date("Y-m-d",time());
            }
           $month_info=$this->fd->get_months($_REQUEST['start'],$_REQUEST['end']);
           for($i=0;$i < count($month_info); $i++){
               if($i==0){
                   $startdate=$_REQUEST['start'];
                   $enddate=$month_info[$i]['m_end'];
               }else if((count($month_info)-1)==$i){
                   $startdate=$month_info[$i]['m_start'];
                   $enddate=$_REQUEST['end'];
               }else{
                   $startdate=$month_info[$i]['m_start'];
                   $enddate=$month_info[$i]['m_end'];
               }
               
                $start=strtotime($startdate);
                $end=strtotime($enddate);
                $len=($end-$start)/86400;
                $sum=0;
                $sum1=0;
                $sum2=0;
                for($j=0;$j<=$len;$j++){
                    $_REQUEST['u_create_time']=date("Y-m-d",$start+(86400*$j));
                    $this->report->set($_REQUEST);
                    $pargam1=$this->report->getall_for_histogram($list_str,"1");
                    $pargam2=$this->report->getall_for_histogram($list_str,"2");
                    $pargam3=$this->report->getall_for_histogram($list_str,"3");
                    $res['pargam1']=$pargam1['user_num'];
                    $res['pargam2']=$pargam2['user_num'];
                    $res['pargam3']=$pargam3['user_num'];

                    $sum +=(int)($res['pargam1']+$res['pargam2']+$res['pargam3']);
                    $sum1 +=(int)$res['pargam1'];
                    $sum2 +=(int)$res['pargam2'];
                    $sum3 +=(int)$res['pargam3'];
                    //$res['create_time']= $_REQUEST['u_create_time'];
                    //$user_list[]=$res;
                }
               //$this->report->set(array("start"=>$start,"end"=>$end));
               //$res=$this->report->getall_user($list_str);
               $res['pargam1']=$sum1;
               $res['pargam2']=$sum2;
               $res['total']=$sum;
               $res['create_time']= date("Y",$start)."年". date("m",$start) ."月";
               $res['month']=$startdate."~".$enddate;
               $user_list[]=$res;
           }
           // var_dump($this->fd->get_months($_REQUEST['start'],$_REQUEST['end']));
        }else{

            if($_REQUEST['start']=="" && $_REQUEST['end']==""){
                //1天是86400秒
                //$_REQUEST['start']=date("Y-m-d",time()-604800);
                //$_REQUEST['end']=date("Y-m-d",time());
                $sum=0;
                for($i=7;$i>=0;$i--){
                    $_REQUEST['u_create_time']=date("Y-m-d",time()-(86400*$i));
                    $this->report->set($_REQUEST);
                    $pargam1=$this->report->getall_for_histogram($list_str,"1");
                    $pargam2=$this->report->getall_for_histogram($list_str,"2");
                    $pargam3=$this->report->getall_for_histogram($list_str,"3");
                    $res['pargam1']=$pargam1['user_num'];
                    $res['pargam2']=$pargam2['user_num'];
                    $res['pargam3']=$pargam3['user_num'];

                    $sum +=(int)($res['pargam1']+$res['pargam2']+$res['pargam3']);
                    $res['create_time']= $_REQUEST['u_create_time'];
                    $res['total']= $sum;
                    $user_list[]=$res;
                }
            }else{
                $start=strtotime($_REQUEST['start']);
                $end=strtotime($_REQUEST['end']);
                $len=($end-$start)/86400;
                $user_list=array();
                for($i=0;$i<=$len;$i++){
                    $sum=0;
                    $_REQUEST['u_create_time']=date("Y-m-d",$start+(86400*$i));
                    $this->report->set($_REQUEST);
                    $pargam1=$this->report->getall_for_histogram($list_str,"1");
                    $pargam2=$this->report->getall_for_histogram($list_str,"2");
                    $pargam3=$this->report->getall_for_histogram($list_str,"3");
                    $res['pargam1']=$pargam1['user_num'];
                    $res['pargam2']=$pargam2['user_num'];
                    $res['pargam3']=$pargam3['user_num'];

                    $sum +=(int)($res['pargam1']+$res['pargam2']+$res['pargam3']);
                    $res['create_time']= $_REQUEST['u_create_time'];
                    $res['total']= $sum;
                    $user_list[]=$res;
                }

            }
        }
        return $user_list;
        
    }
    
    public function get_data(){

    }
    
//    public function get_already_users(){
//         $user_list=$this->get_item_list();
//        $arr=array();
//        foreach ($user_list as $key=>$value) {
//            $arr[$key]['date']=$value['create_time'];
//            $arr[$key]['expenses']=(int)$value['user_num'];
//            $arr[$key]['week']=$value['week'];
//        }
//        $json=  json_encode($arr);
//        $this->smarty->assign("list",$user_list);
//        $this->smarty->assign("json",$json);
//        $this->htmlrender("modules/report/already_users_table.tpl");
//    }
    public function get_commercial_users(){

       $user_list=$this->get_item_list();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=(int)$value['user_num'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/opendata/commercial_users.tpl");
    }
    public function get_live_ratio(){
         $user_list=$this->get_list_histogram();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/opendata/live_ratio.tpl");
    }
    public function get_users(){
        $user_list=$this->get_list_histogram();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/opendata/users.tpl");
    }
    public function get_users_type(){
       $user_list=$this->get_list_histogram();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['pargam3']=(int)$value['pargam3'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/opendata/users_type.tpl");
    }

    public function get_users_validity(){
       $user_list=$this->get_list_histogram();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/opendata/users_validity.tpl");
    }
    public function get_live_num(){

       $user_list=$this->get_list_histogram();
        $arr=array();
        foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/livenessdata/live_num.tpl");
    }
    public function get_live_sum(){

       $user_list=$this->get_item_list();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=(int)$value['user_num'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/livenessdata/live_sum.tpl");
    }
    public function get_liveness(){

       $user_list=$this->get_item_list();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=(int)$value['user_num'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/livenessdata/liveness_level.tpl");
    }
    public function get_intercom_recording(){

       $user_list=$this->get_item_list();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=(int)$value['user_num'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/bissnessdata/intercom_recording.tpl");
    }
    public function get_speaking_time(){
       $user_list=$this->get_item_list();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['expenses']=(int)$value['user_num'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/bissnessdata/speaking_time.tpl");
    }
    public function get_call_record(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
           $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/bissnessdata/call_record.tpl");
    }
    public function get_call_time(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/bissnessdata/call_time.tpl");
    }
    public function get_video_record(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
           $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/bissnessdata/video_record.tpl");
    }
    public function get_video_time(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/bissnessdata/video_time.tpl");
    }
    public function get_term_type(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/terminaldata/term_type.tpl");
    }
    public function get_term_type_data(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        echo json_encode($arr);
       
    }
     public function get_term_agents(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/terminaldata/term_agents.tpl");
    }
    public function get_gprs_type(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/gprsdata/gprs_type.tpl");
    }
    public function get_gprs_type_data(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        echo json_encode($arr);
       
    }
     public function get_gprs_agents(){

       $user_list=$this->get_list_histogram();
        $arr=array();
       foreach ($user_list as $key=>$value) {
            $arr[$key]['date']=$value['create_time'];
            $arr[$key]['pargam1']=(int)$value['pargam1'];
            $arr[$key]['pargam2']=(int)$value['pargam2'];
            $arr[$key]['total']=(int)$value['total'];
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->htmlrender("modules/report/gprsdata/gprs_agents.tpl");
    }
    
    /**
     * 数据获取接口
     */
    //折线图
    /**
     * 单位:日
     */
    public function get_day_info(){
         if(in_array($_REQUEST['data_type'],$this->histogram)){
            $user_list=$this->get_list_histogram();
            $arr=array();
            foreach ($user_list as $key=>$value) {
                $arr[$key]['date']=$value['create_time'];
                $arr[$key]['pargam1']=(int)$value['pargam1'];
                $arr[$key]['pargam2']=(int)$value['pargam2'];
                if($_REQUEST['data_type']=="_type"){
                    $arr[$key]['pargam3']=(int)$value['pargam3'];
                }
                $arr[$key]['total']=(int)$value['total'];
            }
        }else{
            $user_list=$this->get_item_list();
            $arr=array();
            foreach ($user_list as $key=>$value) {
                $arr[$key]['date']=$value['create_time'];
                $arr[$key]['expenses']=(int)$value['user_num'];
            }
        }
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->smarty->assign("data_type",$_REQUEST['data_type']);
        $this->smarty->assign("table_type",$_REQUEST['table_type']);
        $this->smarty->assign("index",$_REQUEST['index']);
        $this->smarty->assign("title",$_REQUEST['title']);
        $this->smarty->assign("res",$_REQUEST);
        if(in_array($_REQUEST['data_type'],$this->histogram)){
            $this->htmlrender("modules/report/get_histogram.tpl");    //柱状图
        }else{
            $this->htmlrender("modules/report/get_charts.tpl");    //折线图
        }

    }
    /**
     * 单位:周
     */
    public function get_week_info(){
        if(in_array($_REQUEST['data_type'],$this->histogram)){
            $user_list=$this->get_list_histogram();
            $arr=array();
            foreach ($user_list as $key=>$value) {
                $arr[$key]['date']=$value['create_time'];
                $arr[$key]['pargam1']=(int)$value['pargam1'];
                $arr[$key]['pargam2']=(int)$value['pargam2'];
                if($_REQUEST['data_type']=="_type"){
                    $arr[$key]['pargam3']=(int)$value['pargam3'];
                }
                $arr[$key]['total']=(int)$value['total'];
                $arr[$key]['week']=$value['week'];
            }
        }else{
            $user_list=$this->get_item_list();
            $arr=array();
            foreach ($user_list as $key=>$value) {
                $arr[$key]['date']=$value['create_time'];
                $arr[$key]['expenses']=(int)$value['user_num'];
                $arr[$key]['week']=$value['week'];
            }
        }
        
        $json=  json_encode($arr);
        $url=http_build_query(
                array(
                    'm'=>'report'
                    ,'a'=>'next_info_histogram'
                    ,'date_type'=>'day'
                    ,'data_type'=>$_REQUEST['data_type']
                    ,'table_type'=>$_REQUEST['table_type']
                    ,'index'=>$_REQUEST['index']
                    ,'stackType'=>$_REQUEST['stackType']
                    ,'start'=>$_REQUEST['start']
                    ,'end'=>$_REQUEST['end']
                    ,'title'=>$_REQUEST['title']
                ));
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->smarty->assign("data_type",$_REQUEST['data_type']);
        $this->smarty->assign("table_type",$_REQUEST['table_type']);
        $this->smarty->assign("index",$_REQUEST['index']);
        $this->smarty->assign("title",$_REQUEST['title']);
        $this->smarty->assign("res",$_REQUEST);
        $this->smarty->assign("url",$url);
        if(in_array($_REQUEST['data_type'],$this->histogram)){
            $this->htmlrender("modules/report/get_histogram_week.tpl");    //柱状图
        }else{
            $this->htmlrender("modules/report/get_charts_week.tpl");    //折线图
        }
        
    }
    /**
     * 单位:月
     */
    public function get_month_info(){
         if(in_array($_REQUEST['data_type'],$this->histogram)){
            $user_list=$this->get_list_histogram();
            $arr=array();
            foreach ($user_list as $key=>$value) {
                $arr[$key]['date']=$value['create_time'];
                $arr[$key]['pargam1']=(int)$value['pargam1'];
                $arr[$key]['pargam2']=(int)$value['pargam2'];
                if($_REQUEST['data_type']=="_type"){
                    $arr[$key]['pargam3']=(int)$value['pargam3'];
                }
                $arr[$key]['total']=(int)$value['total'];
                $arr[$key]['month']=$value['month'];
            }
            $url=http_build_query(
                array(
                    'm'=>'report'
                    ,'a'=>'next_info_histogram'
                    ,'date_type'=>'day'
                    ,'data_type'=>$_REQUEST['data_type']
                    ,'table_type'=>$_REQUEST['table_type']
                    ,'index'=>$_REQUEST['index']
                    ,'stackType'=>$_REQUEST['stackType']
//                    ,'start'=>$_REQUEST['start']
//                    ,'end'=>$_REQUEST['end']
                    ,'title'=>$_REQUEST['title']
                ));
        }else{
            $user_list=$this->get_item_list();
            $arr=array();
            foreach ($user_list as $key=>$value) {
                $arr[$key]['date']=$value['create_time'];
                $arr[$key]['expenses']=(int)$value['user_num'];
                $arr[$key]['month']=$value['month'];
            }
        }
        
        $json=  json_encode($arr);

        
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->smarty->assign("data_type",$_REQUEST['data_type']);
        $this->smarty->assign("table_type",$_REQUEST['table_type']);
        $this->smarty->assign("index",$_REQUEST['index']);
        $this->smarty->assign("title",$_REQUEST['title']);
        $this->smarty->assign("res",$_REQUEST);
        $this->smarty->assign("url",$url);
        if(in_array($_REQUEST['data_type'],$this->histogram)){
            $this->htmlrender("modules/report/get_histogram_month.tpl");    //柱状图
        }else{
            $this->htmlrender("modules/report/get_charts_month.tpl");    //折线图
        }
        
    }
    
    public function next_info_charts() {
            $user_list=$this->get_item_list();
            $arr=array();
            foreach ($user_list as $key=>$value) {
                $arr[$key]['date']=$value['create_time'];
                $arr[$key]['expenses']=(int)$value['user_num'];
            }
        
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->smarty->assign("data_type",$_REQUEST['data_type']);
        $this->smarty->assign("table_type",$_REQUEST['table_type']);
        $this->smarty->assign("index",$_REQUEST['index']);
        $this->smarty->assign("title",$_REQUEST['title']);
        $this->smarty->assign("res",$_REQUEST);
        $this->htmlrender("modules/report/next_info_charts.tpl");    //折线图
    }
    public function next_info_histogram() {
             $user_list=$this->get_list_histogram();
            $arr=array();
            foreach ($user_list as $key=>$value) {
                $arr[$key]['date']=$value['create_time'];
                $arr[$key]['pargam1']=(int)$value['pargam1'];
                $arr[$key]['pargam2']=(int)$value['pargam2'];
                if($_REQUEST['data_type']=="_type"){
                    $arr[$key]['pargam3']=(int)$value['pargam3'];
                }
                $arr[$key]['total']=(int)$value['total'];
                //$arr[$key]['month']=$value['month'];
            }
        
        $json=  json_encode($arr);
        $this->smarty->assign("list",$user_list);
        $this->smarty->assign("json",$json);
        $this->smarty->assign("data_type",$_REQUEST['data_type']);
        $this->smarty->assign("table_type",$_REQUEST['table_type']);
        $this->smarty->assign("index",$_REQUEST['index']);
        $this->smarty->assign("title",$_REQUEST['title']);
        $this->smarty->assign("res",$_REQUEST);
        $this->htmlrender("modules/report/next_info_histogram.tpl");    //柱状图
    }
}