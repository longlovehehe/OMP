<?php

error_reporting(E_ERROR);
ini_set('display_errors', '1');
date_default_timezone_set('PRC');
ini_set('date.timezone', 'Asia/Shanghai');

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, must-revalidate");
header("Pragma: no-cache");

require_once ROOT_ADDR.'/shell/class/com.php';
require_once (ROOT_ADDR."/shell/class/db.class.php");
require_once (ROOT_ADDR."/shell/class/sendmsg.class.php");
//require_once (ROOT_ADDR."/shell/class/function.class.php");
require_once (ROOT_ADDR."/private/libs/PHPExcel/PHPExcel.php");

/**
 * 计费报表生成接口
 * @package Common API
 * @author zed
 */
class create_records extends db{
       public function __construct() {
            parent::__construct();
            $this->data = '';
        }
    /**
     * 产生计费报表日期 年 月
     */
    public function getDate(){
        if($_REQUEST['start']!=""){
            $date=$_REQUEST['start'];
        }else{
              $date=date("Y-m",time());
              $date=date("Y-m",  strtotime($date)-86400);
        }
        return $date;
       // return "2015-07";
    }
    /**
     * 产生计费报表日期 年 月
     */
    public function get_preDate(){

            $date=$this->getDate();
            $date=date("Y-m",(strtotime($date)-86400));
             return $date;
    }
  /**
   * 获得企业表计费次数
   * @param type $table
   * @param type $name
   * @param type $id
   * @return type
   */
    public function get_pre_count($table,$name,$id){
        $sql='SELECT pre_count_number FROM "'.$table.'" WHERE '.$name.'=\''.$id.'\'';
        
        try {
            $stat=$this->pdo->query($sql);
        } catch (Exception $exc) {
            if($exc->getCode()=="42P01"){
                return substr($id, 0 ,6)."000001";
            }
        }
        $res=$stat->fetch();
        if($res['pre_count_number']==""){
            return substr($id, 0 ,6)."000001";
        }else{
            $pre_count_number= substr($res['pre_count_number'], 6,6);
            $pre_count_number=$this->autoInc($pre_count_number);
            return substr($id, 0 ,6).$pre_count_number;
        }
    }
    /**
     * 获得 计费比例
     * @param type $start_date  创建时间
     * @param type $ur_commercial_time  商用时间
     * @param type $ur_stop_time  停用时间
     * @param type $stat  用户分类 商用&测试
     * @return int
     */
    public function get_charg_ratio($create_date,$ur_commercial_time,$ur_stop_time,$stat,$ur_attr_type,$ep_info){
        //如果企业停用的话 企业用户也为停用
          if($ep_info['e_status']=="0" && $stat=="1"){
                $stat="0";
                $ur_stop_time=$ep_info['e_stop_time'];
            }
        
        //所有的比较是按照秒的单位也就是时间戳的比较
         if($_REQUEST['start']!=""){
            //var_dump(strtotime($_REQUEST['start'])-  strtotime(date("Y-m"),time())>=0);die;
            if(strtotime($_REQUEST['start'])-  strtotime(date("Y-m"),time())>=0){//超出计费报表时间范围
                echo json_encode(array("msg"=>"所选日期必须小于当前月"));die;
            }
            $now_date=$_REQUEST['start'];
        }else{
            $now_date=  $this->getDate();//计费月 精确到 年月 
        }
        
       // $now_date=  $this->getDate();
        $now_date_timestamp=strtotime($now_date);//计费时间 起始  2015-08-01
        $total_date= date("t", strtotime($now_date));
        $now_end_time_timestamp= (int)strtotime($now_date)+(int)($total_date-1)*86400; //计费时间 终止  2015-08-31
//        $now_start_time=  strtotime($now_date)+86400;
        $create_date_timestamp=  strtotime($create_date);//创建日期
        $ur_commercial_time_timestamp=  strtotime($ur_commercial_time);//商用日期
        $ur_stop_time_timestamp=  strtotime($ur_stop_time);//停用时间
        
        
        //$ur_start_time_copy=$ur_start_time;
        /*
         * omp
         * 1.根据创建时间&停用时间
         * 2. 启用 ①如果创建时间 小于生成计费报表月的2号 则本月收费  ②如果创建时间大于该月2号 则本月不收费
         * 3.关于停用 (如果 情况2 满足并且满足情况2中的①)->  ①如果用户停用时间 小于生成计费报表月的1号 本月不收费 ② 如果停用时间大于等于该月月初1号 并且小于该月月末最后一天的  收费
         */
                 if($create_date_timestamp<($now_date_timestamp+86400)){
                         if($stat=="0"){//停用
                            if($create_date_timestamp<($now_date_timestamp+86400)){

                                if($ur_stop_time_timestamp<$now_date_timestamp){
                                    $charg_ratio['omp']=0;
                                 }else{
                                    $charg_ratio['omp']=1;
                                }
                             }else if($create_date_timestamp>=($now_date_timestamp+86400)){
                                if($ur_stop_time_timestamp<$now_date_timestamp){
                                    $charg_ratio['omp']=0;
                                }else{
                                    $charg_ratio['omp']=1;
                                }
                            }
                        }else{
                            $charg_ratio['omp']=1;
                        }

                 }else if($create_date_timestamp>=($now_date_timestamp+86400)){
                        $charg_ratio['omp']=0;
                }
           
           
        /**
         * amp
         * 1.根据商用时间&停用时间
         * 2.停用状态  ① 如果停用时间 小于生成计费报表月的1号 则本月不收费 ② 如果停用时间大于等于生成计费报表月的1号  (若商用时间 小于等于该月1号 则该月按100%收费)(若商用时间大于该月1号 小于等于该月月末最后一天 则该月收费 比例为(商用时间到该月月末最后一天)/100)
         * 3.启用状态 ①如果商用时间 小于生成计费报表月的1号 则本月收费为100%整月② 如果商用时间  大于等于生成计费报表月的1号 并且小于等于该月月末最后一天  则本月收费 比例为(商用时间到该月月末最后一天)/100 
         *
         */
        if($ur_attr_type=="0"){
            if($stat=="0"){//停用
                if($ur_stop_time_timestamp<$now_date_timestamp){
                    $charg_ratio['amp']=0;
                }else if($ur_stop_time_timestamp>=$now_date_timestamp&&$ur_stop_time_timestamp<=$now_end_time_timestamp){
                    if($ur_commercial_time_timestamp<=$now_date_timestamp){
                        $charg_ratio['amp']=1;
                    }else if($ur_commercial_time_timestamp>$now_date_timestamp&&$ur_commercial_time_timestamp<=$now_end_time_timestamp){
                        $already_date= date("j" ,$ur_commercial_time_timestamp);
                        $charg_ratio['amp']=sprintf("%.2f", ($total_date-$already_date)/$total_date);
                    }
                }else  if($ur_stop_time_timestamp>=$now_date_timestamp&&$ur_stop_time_timestamp>$now_end_time_timestamp){
                    if($ur_commercial_time_timestamp>=$now_end_time_timestamp){
                        $charg_ratio['amp']=0;
                    }else{
                        $charg_ratio['amp']=1;
                    }
                    
                }
            }else{
                 if($ur_commercial_time_timestamp<=$now_date_timestamp){
                        $charg_ratio['amp']=1;
                    }else if($ur_commercial_time_timestamp>$now_date_timestamp&&$ur_commercial_time_timestamp<=$now_end_time_timestamp){
                        $already_date= date("j" ,$ur_commercial_time_timestamp);
                        $charg_ratio['amp']=sprintf("%.2f", ($total_date-$already_date)/$total_date);
                    }else if($ur_commercial_time_timestamp>$now_end_time_timestamp){
                        $charg_ratio['amp']=0;
                    }
            }
        }else{
            $charg_ratio['amp']=0;
        }
        return $charg_ratio;
    }


    /**
     * 创建计费日志表
     * @param type $date
     * @throws Exception
     */
    public function create_table_Records($date){
        $ur_sql=<<<ECHO
            CREATE TABLE "public"."T_User_Record_$date" (
                "ur_name" varchar(64),
                "ur_number" varchar(64) NOT NULL,
                "ur_sub_type" varchar(32),
                "ur_p_function" varchar(255),
                "ur_create_time" date,
                "ur_money" varchar(255),
                "ur_money_amp" varchar(255),
                "ur_stop_time" varchar(64),
                "ur_start_time" varchar(64),
                "ur_e_id" int4,
                "ur_attr_type" varchar(8),
                "ur_active_state" varchar(8),
                "ur_try_time" date,
                "ur_sum_money" varchar(255),
                "ur_sum_money_amp" varchar(255),
                "ur_charg_ratio_omp" varchar(32),
                "ur_charg_ratio_amp" varchar(32),
                "ur_commercial_time" varchar(32)
                )
                WITH (OIDS=FALSE)
                ;

            ALTER TABLE "public"."T_User_Record_$date" ADD PRIMARY KEY ("ur_number");
ECHO;
        $er_sql=<<<ECHO
            CREATE TABLE "public"."T_Enterprise_Record_$date" (
            "er_id" int8 DEFAULT nextval('"T_Enterprise_e_id_seq"'::regclass) NOT NULL,
            "er_bss_number" varchar(32),
            "er_status" int4 DEFAULT 0,
            "er_name" varchar(128),
            "er_area" varchar,
            "er_create_time" timestamp(6),
            "er_agents_id" varchar(32),
            "er_contact_surname" varchar(32),
            "er_contact_name" varchar(32),
            "er_contact_phone" varchar(32),
            "er_contact_fox" varchar(32),
            "er_addr" varchar,
            "er_industry" varchar(32),
            "er_contact_mail" varchar(32),
            "er_create_name" varchar(128),
            "er_ag_path" varchar(255),
            "er_regis_code" varchar(32),
            "er_sum_money" varchar(32),
            "er_sum_money_amp" varchar(32),
            "er_sum_money_p_function" varchar(32),
            "er_sum_money_p_function_amp" varchar(32),
            "er_price" varchar,
            "pre_count_number" varchar(32)
            )
            WITH (OIDS=FALSE)
            ;
            COMMENT ON TABLE "public"."T_Enterprise_Record_$date" IS '保存所有企业的信息';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_id" IS '企业ID';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_bss_number" IS '集团编号';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_status" IS '停用状态';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_name" IS '企业名称';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_area" IS '企业所在区域';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_create_time" IS '企业开户时间';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_contact_surname" IS '企业联系人姓';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_contact_name" IS '企业联系人名';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_contact_phone" IS '联系人电话';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_contact_fox" IS '联系传真';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_addr" IS '企业地址';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_industry" IS '行业';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_contact_mail" IS '联系人邮箱';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_create_name" IS '创建者';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_ag_path" IS '代理商关系';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_regis_code" IS '企业注册码';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_sum_money" IS '企业用户类型/总金额';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_sum_money" IS '企业用户类型/总金额(代理商平台)';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_sum_money_p_function" IS 'OMP企业增值功能/总金额';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_sum_money_p_function" IS 'AMP企业增值功能/总金额';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."er_price" IS '增值功能价格信息';
            COMMENT ON COLUMN "public"."T_Enterprise_Record_$date"."pre_count_number" IS '企业表计费次数';

ECHO;
        $er_sql.="CREATE UNIQUE INDEX \"er_name_$date"."_pk\" ON \"public\".\"T_Enterprise_Record_$date\" USING btree (er_name);
            ALTER TABLE \"public\".\"T_Enterprise_Record_$date\" ADD PRIMARY KEY (\"er_id\");";
        $ar_sql=<<<ECHO
            CREATE TABLE "public"."T_Agents_Record_$date" (
            "ar_number" varchar(32) NOT NULL,
            "ar_name" varchar(128) NOT NULL,
            "ar_parent_id" varchar(32),
            "ar_path" varchar(128),
            "ar_area" varchar,
            "ar_status" varchar(32),
            "ar_phone" varchar(32),
            "ar_admin_name" varchar(64),
            "ar_mail" varchar(128),
            "ar_level" varchar(32),
            "ar_addr" varchar,
            "ar_username" varchar(32),
            "ar_conname" varchar(32),
            "ar_fox" varchar(32),
            "ar_create_time" date,
            "ar_price" varchar,
            "ar_basic_price" varchar(64),
            "ar_console_price" varchar(64),
            "pre_count_number" varchar(32)
            )
            WITH (OIDS=FALSE)
            ;
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_number" IS '代理商编号';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_name" IS '代理商名字';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_parent_id" IS '上级代理商编号';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_path" IS '代理商路径';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_area" IS '代理商区域';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_status" IS '代理商状态';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_phone" IS '代理商管理员手机号';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_admin_name" IS '管理员名字';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_mail" IS '邮箱';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_level" IS '级别';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_addr" IS '代理商地址';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_username" IS '联系人姓氏';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_conname" IS '联系人名字';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_fox" IS '代理商传真';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_create_time" IS '代理商创建时间';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."ar_price" IS '代理商价格';
            COMMENT ON COLUMN "public"."T_Agents_Record_$date"."pre_count_number" IS '代理商计费次数';

ECHO;
        $ar_sql.="CREATE UNIQUE INDEX \"ar_name_$date"."_pk\" ON \"T_Agents_Record_$date\" USING btree (ar_name);
            ALTER TABLE \"T_Agents_Record_$date\" ADD PRIMARY KEY (\"ar_number\");";
        try {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->beginTransaction();
            $this->pdo->exec($ur_sql);
            
            $this->pdo->exec($er_sql);
            $this->pdo->exec($ar_sql);
            $this->pdo->commit();
        } catch (Exception $ex) {
            $this->pdo->rollBack();
            if($ex->getCode()=='42P07'){
                $msg['status']=-1;
                $msg['msg']="该月份报表已存在";
                //echo "该表已存在".$ex->getMessage();
                echo json_encode($msg);die;
            }
            throw new Exception("Create failure, data rollback" . $ex->getMessage(), -2);
            die;
        }
        $msg['status']=0;
        $msg['msg']="该月份报表生成成功";
         echo  json_encode($msg);
    }
    /**
     * 生成计费记录表
     */
    public function Generate_Billing_Records(){
        if($_REQUEST['start']!=""){
            //var_dump(strtotime($_REQUEST['start'])-  strtotime(date("Y-m"),time())>=0);die;
            if(strtotime($_REQUEST['start'])-  strtotime(date("Y-m"),time())>=0){//超出计费报表时间范围
                echo json_encode(array("msg"=>"所选日期必须小于当前月"));die;
            }
            $date=$_REQUEST['start'];
        }else{
            $date=  $this->getDate();
        }

        $predate=  $this->get_preDate();
        $this->create_table_Records($date);
        $ag_list=$this->getallAgents();
        array_unshift( $ag_list ,array('ag_number'=>"0"));
        $p_items=$this->getProduct();
        //获得所有代理商
        foreach ($ag_list as $key => $value) {
                $omp_bisic=0;
                $omp_console=0;
                $amp_bisic=0;
                $amp_console=0;
            //当前代理商的收费价格
//            $basic_price['console_price']=$price['console_price']==""?0:$price['console_price'];
//            $basic_price['basic_price']=$price['basic_price']==""?0:$price['basic_price'];
            
            //array_unshift( $price_info ,array('basic_price'=>array('price'=>$basic_price['basic_price'],'name'=>'基础功能费'),'console_price'=>array('price'=>$basic_price['console_price'],'name'=>'Console功能费')));
            //初始化要插入的数据
            if($value['ag_number']!="0"){
                 /* AMP价格配置 start*/
                $basic_price_amp=array();
                if($value['ag_parent_id']!="0"){
                    $basic_price_amp=$this->getPrice($value['ag_parent_id']);
                    $price_amp=$basic_price_amp;
                    $basic_price_amp_child=$this->getPrice($value['ag_number']);
//                    $basic_price_amp['basic_price']=$basic_price_amp_child['basic_price'];
//                    $basic_price_amp['console_price']=$basic_price_amp_child['console_price'];
                    $basic_price_amp['basic_price_amp']=$basic_price_amp_child['basic_price_amp'];
                    $basic_price_amp['console_price_amp']=$basic_price_amp_child['console_price_amp'];
                    
                    /**
                     * 基础功能价格是以一级代理商为准
                     */
                    //代理商企业再OMP中的计算价格
                    //①基础功能费
                    $omp_bisic=$price_amp['basic_price_amp'];
                    $omp_console=$price_amp['console_price_amp'];
                    //②增值功能费
                
                //代理商企业再AMP中的计算价格
                  //①基础功能费（上级代理给下级代理分配的价格）
                  $amp_bisic=$basic_price_amp['basic_price_amp'];
                  $amp_console=$basic_price_amp['console_price_amp'];
                  //②增值功能费
                    
                }else{
                    $basic_price_amp=$this->getPrice($value['ag_number']);
                    $price_amp=$basic_price_amp;
                    //代理商企业再OMP中的计算价格
                    //①基础功能费
                    $omp_bisic=$price_amp['basic_price_amp'];
                    $omp_console=$price_amp['console_price_amp'];
                    //②增值功能费
                
                //代理商企业再AMP中的计算价格
                  //①基础功能费（上级代理给下级代理分配的价格）
                  $amp_bisic=$basic_price_amp['basic_price'];
                  $amp_console=$basic_price_amp['console_price'];
                  //②增值功能费
                }
                        $price=array();
                        foreach ($p_items as $key => $v) {
                            foreach ($basic_price_amp as $k => $val) {
                                  if($v['pi_code']==$k){
                                      $price[$k]['price']=$basic_price_amp[$k];
                                      $price[$k]['name']=$v['pi_name'];
                                  }
                            }
                        }
                /* AMP价格配置 end*/
                $price['basic_price']=array('price'=>$basic_price_amp['basic_price'],'name'=>'基础功能费');
                $price['console_price']=array('price'=>$basic_price_amp['console_price'],'name'=>'Console功能费');
                $price['basic_price_amp']=array('price'=>$basic_price_amp['basic_price_amp'],'name'=>'基础功能费');
                $price['console_price_amp']=array('price'=>$basic_price_amp['console_price_amp'],'name'=>'Console功能费');
                $price['units_price']=array('price'=>$basic_price_amp['units_price'],'name'=>'单价');
                $ag_arr['ar_number'] = $value['ag_number'];
                $ag_arr['ar_name'] = $value['ag_name'];
                $ag_arr['ar_parent_id'] = $value['ag_level']=="0"?"0":$value['ag_parent_id'];
                $ag_arr['ar_path'] = $value['ag_path'];
                $ag_arr['ar_area'] = $value['ag_area'];
                $ag_arr['ar_status'] = $value['ag_status'];
                $ag_arr['ar_phone'] = $value['ag_phone'];
                $ag_arr['ar_admin_name'] = $value['ag_admin_name'];
                $ag_arr['ar_mail'] = $value['ag_mail'];
                $ag_arr['ar_level'] = $value['ag_level'];
                $ag_arr['ar_addr'] = $value['ag_addr'];
                $ag_arr['ar_username'] = $value['ag_username'];
                $ag_arr['ar_conname'] = $value['ag_conname'];
                $ag_arr['ar_fox'] = $value['ag_fox'];
                $ag_arr['ar_create_time'] = $value['ag_create_time'];
                $ag_arr['ar_price'] = json_encode($price);
                $this->insertAgents($date, $ag_arr);//插入所有代理商相关数据
            }else{
                    /* OMP价格配置 start*/ 
                    $basic_price=$this->getPrice('0');
                    $price_info=array();
                    foreach ($p_items as $key => $v) {
                        foreach ($basic_price as $k => $val) {
                              if($v['pi_code']==$k){
                                  $price_info[$k]['price']=$basic_price[$k];
                                  $price_info[$k]['name']=$v['pi_name'];
                              }
                        }
                    }
                    $price_info['basic_price']=array('price'=>$basic_price['basic_price'],'name'=>'基础功能费');
                    $price_info['console_price']=array('price'=>$basic_price['console_price'],'name'=>'Console功能费');
                    $price_info['basic_price_amp']=array('price'=>$basic_price['basic_price_amp'],'name'=>'基础功能费');
                    $price_info['console_price_amp']=array('price'=>$basic_price['console_price_amp'],'name'=>'Console功能费');
                    $price_info['units_price']=array('price'=>$basic_price['units_price'],'name'=>'单价');
                //OMP直属企业再OMP中的计算价格
                //①基础功能费
                $omp_bisic=$basic_price['basic_price'];
                $omp_console=$basic_price['console_price'];
                //②增值功能费
                
              //代理商企业再AMP中的计算价格
                //①基础功能费（上级代理给下级代理分配的价格）
                $amp_bisic=0;
                $amp_console=0;
                //②增值功能费
                
                    /* OMP价格配置 end*/
                    
                /**
                    * 根据企业 来确定当前企业所使用的价格
                    * 有四类价格
                    * ①基础功能价格-OMP
                    * ②基础功能价格-AMP
                    * ③增值功能费-AMP
                    */
                    if($value['ag_number']!=0){//代理商
                        $price_in=$basic_price_amp;
                    }else{//OMP所属企业
                       $price_in=$basic_price;
                    }
                    
            }
                  
             
                    

            foreach ($this->getallEnterprise($value['ag_number']) as $k => $val) {//企业遍历
                $ep_cost_p_function=0;
                $ep_cost_p_function_amp=0;
                $ep_cost=0;
                $ep_cost_amp=0;
                foreach ($this->getallUser($val['e_id']) as $kk => $v) {

//                     if($value['ag_number']!="0"){
////                        $cost_amp=$this->getsubtypemoney($v['u_sub_type'],$price_info);//amp用户类型价格
                        //$cost=$this->getsubtypemoney($v['u_sub_type'],$price_in);//用户类型价格(omp-amp)
//                     }else{
//                         $cost=$this->getsubtypemoney($v['u_sub_type'],$price_info);//omp用户类型价格
//                     }
                    if($v['u_sub_type']==1){
                        $cost['omp']=$omp_bisic;
                        $cost['amp']=$amp_bisic;
                    }else if($v['u_sub_type']==2){
                        $cost['omp']=$omp_console;
                        $cost['amp']=$amp_console;
                    }else if($v['u_sub_type']==3){
                        $cost['omp']=0;
                        $cost['amp']=0;
                    }
                    
                    
                     if($value['ag_number']!="0"){
                        $cost_p_function_amp=$this->getpfunctionmoney($v['u_p_function'],$basic_price_amp);
                        $cost_p_function=$this->getpfunctionmoney($v['u_p_function'],$basic_price);
                     }else{
                         $cost_p_function_amp=0;
                         $cost_p_function=$this->getpfunctionmoney($v['u_p_function'],$basic_price);
                     }
                     
                    $ur_charg_ratio=$this->get_charg_ratio($v['u_create_time'],$v['u_commercial_time'],$v['u_stop_time'],$v['u_active_state'],$v['u_attr_type'],$val);
                    //初始化企业用户的数据

                    $u_arr['ur_name'] = $v['u_name'];
                    $u_arr['ur_number'] = $v['u_number'];
                    $u_arr['ur_sub_type'] =$this->modtype($v['u_sub_type']);
                    $u_arr['ur_p_function'] = $this->getFunList($v['u_p_function']);
                    $u_arr['ur_create_time'] = $v['u_create_time'];
                    $u_arr['ur_money'] = round($cost_p_function*$ur_charg_ratio['omp'],2);
                    $u_arr['ur_money_amp'] = round($cost_p_function_amp*$ur_charg_ratio['amp'],2);
                    $u_arr['ur_stop_time'] = $v['u_stop_time'];
                    $u_arr['ur_start_time'] = $v['u_start_time'];
                    $u_arr['ur_e_id'] = $v['u_e_id'];
                    $u_arr['ur_attr_type'] = $v['u_attr_type'];
                    $u_arr['ur_active_state'] = $v['u_active_state']===""?1:$v['u_active_state'];
                    $u_arr['ur_try_time'] = $v['u_try_time'];
                    $u_arr['ur_sum_money'] = round($cost['omp']*$ur_charg_ratio['omp'],2);
                    $u_arr['ur_sum_money_amp'] = round($cost['amp']*$ur_charg_ratio['amp'],2);
                    $u_arr['ur_charg_ratio_omp'] = $ur_charg_ratio['omp'];
                    $u_arr['ur_charg_ratio_amp'] = $ur_charg_ratio['amp'];
                    $u_arr['ur_commercial_time'] = $v['u_commercial_time'];
                    $ep_cost+=$u_arr['ur_sum_money'];
                    $ep_cost_amp+=$u_arr['ur_sum_money_amp'];
                    $ep_cost_p_function+=$u_arr['ur_money'];
                    $ep_cost_p_function_amp+=$u_arr['ur_money_amp'];
                    $this->insertUsers($date, $u_arr);//插入用户数据
                }
                //初始化当前代理商下的企业的数据
                $e_arr['er_id'] = $val['e_id'];
                $e_arr['er_bss_number'] = $val['e_bss_number'];
                $e_arr['er_status'] = $val['e_status'];
                $e_arr['er_name'] = $val['e_name'];
                $e_arr['er_area'] = $val['e_area'];
                $e_arr['er_create_time'] = $val['e_create_time'];
                $e_arr['er_agents_id'] = $val['e_agents_id'];
                $e_arr['er_contact_surname'] = $val['e_contact_surname'];
                $e_arr['er_contact_name'] = $val['e_contact_name'];
                $e_arr['er_contact_phone'] = $val['e_contact_phone'];
                $e_arr['er_contact_fox'] = $val['e_contact_fox'];
                $e_arr['er_addr'] = $val['e_addr'];
                $e_arr['er_industry'] = $val['e_industry'];
                $e_arr['er_contact_mail'] = $val['e_contact_mail'];
                $e_arr['er_create_name'] = $val['e_create_name'];
                $e_arr['er_ag_path'] = $val['e_ag_path'];
                $e_arr['er_regis_code'] = $val['e_regis_code'];
                $e_arr['er_sum_money'] = $ep_cost;
                $e_arr['er_sum_money_amp'] = $ep_cost_amp;
                $e_arr['er_sum_money_p_function'] = $ep_cost_p_function;
                $e_arr['er_sum_money_p_function_amp'] = $ep_cost_p_function_amp;
                $e_arr['er_price'] = $price_info;
                
                $this->insertEnterprise($date, $e_arr);//插入企业相关数据
            }
        }
        
        
    }
    
    /**
     * 设置当月生效的产品/功能
     * @param type $type
     * @param type $price
     * @return type
     */
    public function set_product_function(){
        //获得当前的平台版本 VT or GQT 
        //获得 用户新增产品不为空
        $arr= parse_ini_file ( ROOT_ADDR.'/private/config/language.ini' , true );
        $version=$arr['language']['ident'];
        if($version=="VT"){
            $sql=<<<echo
        SELECT
	u_number,u_e_id,u_p_function,u_p_function_new
        FROM
	"T_User"
        WHERE
	u_p_function_new IS NOT NULL AND "length"(u_p_function_new)!=0
echo;
             $sql_up=<<<echo
        UPDATE "T_User" SET 
            u_p_function=:u_p_function,
            u_p_function_new=:u_p_function_new
        WHERE
	u_number=:u_number
echo;
        }else if($version=="GQT"){
               $sql=<<<echo
        SELECT
	u_number,u_product_id,u_product_id_new
        FROM
	"T_User"
        WHERE
	u_product_id_new IS NOT NULL AND "length"(u_product_id_new)!=0
echo;
        $sql_up=<<<echo
        UPDATE "T_User" SET 
            u_product_id=:u_product_id,
            u_product_id_new=:u_product_id_new
        WHERE
	u_number=:u_number
echo;
        }else{//GQT
               $sql=<<<echo
        SELECT
	u_number,u_product_id,u_product_id_new
        FROM
	"T_User"
        WHERE
	u_product_id_new IS NOT NULL AND "length"(u_product_id_new)!=0
echo;
               $sql_up=<<<echo
        UPDATE "T_User" SET 
            u_product_id=:u_product_id,
            u_product_id_new=:u_product_id_new
        WHERE
	u_number=:u_number
echo;
               
        }
        $sth=$this->pdo->query($sql);
        $list=$sth->fetchAll(PDO::FETCH_ASSOC);
        $e_id_arr=array();
        foreach ($list as $key => $value) {
            if(!in_array($value['u_e_id'], $e_id_arr)){
                $e_id_array[]=$value['u_e_id'];
            }
            if($version=="VT"){
                if($value['u_p_function_new']=="noselected"){
                    $sth=$this->pdo->prepare($sql_up);
                    $sth->bindValue("u_p_function",NULL);
                    $sth->bindValue("u_p_function_new",NULL);
                }else{
                    $sth=$this->pdo->prepare($sql_up);
                    $sth->bindValue("u_p_function",$value['u_p_function_new']);
                    $sth->bindValue("u_p_function_new",NULL);
                }
            }else{
                 if($value['u_product_id_new']=="noselected"){
                    $sth=$this->pdo->prepare($sql_up);
                    $sth->bindValue("u_product_id",NULL);
                    $sth->bindValue("u_product_id_new",NULL);
                }else{
                    $sth=$this->pdo->prepare($sql_up);
                    $sth->bindValue("u_product_id",$value['u_product_id_new']);
                    $sth->bindValue("u_product_id_new",NULL);
                }
            }
            $sth->bindValue("u_number",$value['u_number']);
            $sth->execute();
        }
        return $e_id_array;
        //获得 用户新增产品不为空
        
    }
    /**
     * 获得用户类型的基础功能价格
     * @param type $type
     * @param type $price
     * @return type
     */
    public function getsubtypemoney($type,$price){
        if($type==1){
            $cost['omp']=$price['basic_price']==""?0:$price['basic_price'];
            $cost['amp']=$price['basic_price_amp']==""?0:$price['basic_price_amp'];
        }else if ($type==2) {
            $cost['omp']=$price['console_price']==""?0:$price['console_price'];
            $cost['amp']=$price['console_price_amp']==""?0:$price['console_price_amp'];
        }else{
            $cost['omp']=0;
            $cost['amp']=0;  
        }
        return $cost;
    }
    public function getpfunctionmoney($type,$price){
        $cost=0;
        foreach ($price as $key => $value) {
            if(is_int(strpos($type, $key))){
                $cost+=$price[$key];
            }
        }
        return $cost;
    }
    
    public function getProduct(){
        $sql="SELECT * FROM \"T_ProductItems\" WHERE pi_code!='gn_yyhy'";
        $sth=$this->pdo->query($sql);
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    /**
     * 获得某代理商的价格
     * @param type $ag_number
     * @return type
     */
    public function getPrice($ag_number){
        $sql="SELECT * FROM \"T_Price\" WHERE id='{$ag_number}'";
        $sth=$this->pdo->query($sql);
        $res=$sth->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    
    /**
     * 获得全部的代理商
     * @return type
     */
    public function getallAgents(){
        $sql='SELECT * FROM "T_Agents"';
        $sth=$this->pdo->query($sql);
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    /**
     * 某代理商下的企业
     * @param type $parent_id
     * @return type
     */
    public function getallEnterprise($parent_id){
         $where=<<<echo
                WHERE e_agents_id ='$parent_id'
echo;
        $sql='SELECT * FROM "T_Enterprise" '.$where;
        $sth=$this->pdo->query($sql);
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    /**
     * 获得所有的企业
     * @param type $parent_id
     * @return type
     */
    public function getallEnterprise_omp(){
        $where=<<<echo
                WHERE e_ag_path LIKE '%|0|%'
echo;
        $sql='SELECT * FROM "T_Enterprise" '.$where;
        $sth=$this->pdo->query($sql);
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    public function getallUser($e_id){
        
        $sql="SELECT * FROM \"T_User\" WHERE u_e_id='$e_id'";
        $sth=$this->pdo->query($sql);
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    
    /**
     * 代理商计费表插入语句
     */
    public function insertAgents($date,$data){
        $sql=<<<echo
                INSERT INTO "T_Agents_Record_$date" 
                    (ar_number,
                        ar_name,
                        ar_parent_id,
                        ar_path,
                        ar_area,
                        ar_status,
                        ar_phone,
                        ar_admin_name,
                        ar_mail,
                        ar_level,
                        ar_addr,
                        ar_username,
                        ar_conname,
                        ar_fox,
                        ar_create_time,
                        ar_price,
                        ar_basic_price,
                        ar_console_price,
                        pre_count_number
                    )VALUES(
                        :ar_number,
                        :ar_name,
                        :ar_parent_id,
                        :ar_path,
                        :ar_area,
                        :ar_status,
                        :ar_phone,
                        :ar_admin_name,
                        :ar_mail,
                        :ar_level,
                        :ar_addr,
                        :ar_username,
                        :ar_conname,
                        :ar_fox,
                        :ar_create_time,
                        :ar_price,
                        :ar_basic_price,
                        :ar_console_price,
                        :pre_count_number
                    )
echo;
            $sth=  $this->pdo->prepare($sql);
            $sth->bindValue(':ar_number',$data['ar_number']);
            $sth->bindValue(':ar_name',$data['ar_name']);
            $sth->bindValue(':ar_parent_id',$data['ar_parent_id']);
            $sth->bindValue(':ar_path',$data['ar_path']);
            $sth->bindValue(':ar_area',$data['ar_area']);
            $sth->bindValue(':ar_status',$data['ar_status']);
            $sth->bindValue(':ar_phone',$data['ar_phone']);
            $sth->bindValue(':ar_admin_name',$data['ar_admin_name']);
            $sth->bindValue(':ar_mail',$data['ar_mail']);
            $sth->bindValue(':ar_level',$data['ar_level']);
            $sth->bindValue(':ar_addr',$data['ar_addr']);
            $sth->bindValue(':ar_username',$data['ar_username']);
            $sth->bindValue(':ar_conname',$data['ar_conname']);
            $sth->bindValue(':ar_fox',$data['ar_fox']);
            $sth->bindValue(':ar_create_time',$data['ar_create_time']);
            $sth->bindValue(':ar_price',$data['ar_price']);
            $sth->bindValue(':ar_basic_price',$data['basic_price']);
            $sth->bindValue(':ar_console_price',$data['console_price']);
            $sth->bindValue(':pre_count_number',$data['console_price']);
            $sth->bindValue(':pre_count_number',  $this->get_pre_count("T_Agents_Record_".$this->get_preDate(), "ar_number",$data['ar_number']));
            try {
                $sth->execute();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
       }
    /**
     * 企业计费表插入语句
     */
    public function insertEnterprise($date,$data){
         $sql=<<<echo
                INSERT INTO "T_Enterprise_Record_$date" 
                    (er_id,
                        er_bss_number,
                        er_status,
                        er_name,
                        er_area,
                        er_create_time,
                        er_agents_id,
                        er_contact_surname,
                        er_contact_name,
                        er_contact_phone,
                        er_contact_fox,
                        er_addr,
                        er_industry,
                        er_contact_mail,
                        er_create_name,
                        er_ag_path,
                        er_regis_code,
                        er_sum_money,
                        er_sum_money_amp,
                        er_sum_money_p_function,
                        er_sum_money_p_function_amp,
                        er_price,
                        pre_count_number
                    )VALUES(
                        :er_id,
                        :er_bss_number,
                        :er_status,
                        :er_name,
                        :er_area,
                        :er_create_time,
                        :er_agents_id,
                        :er_contact_surname,
                        :er_contact_name,
                        :er_contact_phone,
                        :er_contact_fox,
                        :er_addr,
                        :er_industry,
                        :er_contact_mail,
                        :er_create_name,
                        :er_ag_path,
                        :er_regis_code,
                        :er_sum_money,
                        :er_sum_money_amp,
                        :er_sum_money_p_function,
                        :er_sum_money_p_function_amp,
                        :er_price,
                        :pre_count_number
                    )
echo;
        $sth=  $this->pdo->prepare($sql);
        $sth->bindValue(':er_id',$data['er_id']);
        $sth->bindValue(':er_bss_number',$data['er_bss_number']);
        $sth->bindValue(':er_status',$data['er_status']);
        $sth->bindValue(':er_name',$data['er_name']);
        $sth->bindValue(':er_area',$data['er_area']);
        $sth->bindValue(':er_create_time',$data['er_create_time']);
        $sth->bindValue(':er_agents_id',$data['er_agents_id']);
        $sth->bindValue(':er_contact_surname',$data['er_contact_surname']);
        $sth->bindValue(':er_contact_name',$data['er_contact_name']);
        $sth->bindValue(':er_contact_phone',$data['er_contact_phone']);
        $sth->bindValue(':er_contact_fox',$data['er_contact_fox']);
        $sth->bindValue(':er_addr',$data['er_addr']);
        $sth->bindValue(':er_industry',$data['er_industry']);
        $sth->bindValue(':er_contact_mail',$data['er_contact_mail']);
        $sth->bindValue(':er_create_name',$data['er_create_name']);
        $sth->bindValue(':er_ag_path',$data['er_ag_path']);
        $sth->bindValue(':er_regis_code',$data['er_regis_code']);
        $sth->bindValue(':er_sum_money',$data['er_sum_money']);
        $sth->bindValue(':er_sum_money_amp',$data['er_sum_money_amp']);
        $sth->bindValue(':er_sum_money_p_function',$data['er_sum_money_p_function']);
        $sth->bindValue(':er_sum_money_p_function_amp',$data['er_sum_money_p_function_amp']);
        $json = json_encode($data['er_price']);
        //$json='["id":"0","console_price":"2","basic_price":"1","gn_dxx":"3","gn_yythkt":"4","gn_yyhy":"","gn_tppch":"5","gn_gps":"6","gn_djdtmsh":"7","gn_shpyw":"8","units_price":"CNY"]';
        $sth->bindValue(':er_price',$json);
        
        $sth->bindValue(':pre_count_number',  $this->get_pre_count("T_Enterprise_Record_".$this->get_preDate(),"er_id" ,$data['er_id']));
        
         try {
                $sth->execute();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
    }
    /**
     * 用户计费表插入语句
     */
    public function insertUsers($date,$data){
         $sql=<<<echo
                INSERT INTO "T_User_Record_$date" 
                    (ur_name,
                        ur_number,
                        ur_sub_type,
                        ur_p_function,
                        ur_create_time,
                        ur_money,
                        ur_money_amp,
                        ur_stop_time,
                        ur_start_time,
                        ur_e_id,
                        ur_attr_type,
                        ur_active_state,
                        ur_try_time,
                        ur_sum_money,
                        ur_sum_money_amp,
                        ur_charg_ratio_omp,
                        ur_charg_ratio_amp,
                        ur_commercial_time
                    )VALUES(
                        :ur_name,
                        :ur_number,
                        :ur_sub_type,
                        :ur_p_function,
                        :ur_create_time,
                        :ur_money,
                        :ur_money_amp,
                        :ur_stop_time,
                        :ur_start_time,
                        :ur_e_id,
                        :ur_attr_type,
                        :ur_active_state,
                        :ur_try_time,
                        :ur_sum_money,
                        :ur_sum_money_amp,
                        :ur_charg_ratio_omp,
                        :ur_charg_ratio_amp,
                        :ur_commercial_time
                    )
echo;
        $sth=  $this->pdo->prepare($sql);
        $sth->bindValue(':ur_name',$data['ur_name']);
        $sth->bindValue(':ur_number',$data['ur_number']);
        $sth->bindValue(':ur_sub_type',$data['ur_sub_type']);
        $sth->bindValue(':ur_p_function',$data['ur_p_function']);
        $sth->bindValue(':ur_create_time',$data['ur_create_time']);
        $sth->bindValue(':ur_money',$data['ur_money']);
        $sth->bindValue(':ur_money_amp',$data['ur_money_amp']);
        $sth->bindValue(':ur_stop_time',$data['ur_stop_time']);
        $sth->bindValue(':ur_start_time',$data['ur_start_time']);
        $sth->bindValue(':ur_e_id',$data['ur_e_id']);
        $sth->bindValue(':ur_attr_type',$data['ur_attr_type']);
        $sth->bindValue(':ur_active_state',$data['ur_active_state']);
        $sth->bindValue(':ur_try_time',$data['ur_try_time']);
        $sth->bindValue(':ur_sum_money',$data['ur_sum_money']);
        $sth->bindValue(':ur_sum_money_amp',$data['ur_sum_money_amp']);
        $sth->bindValue(':ur_charg_ratio_omp',$data['ur_charg_ratio_omp']);
        $sth->bindValue(':ur_charg_ratio_amp',$data['ur_charg_ratio_amp']);
        $sth->bindValue(':ur_commercial_time',$data['ur_commercial_time']);
        
         try {
                $sth->execute();
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
    }

    public function set_user_attrtype(){
        //获得用户属性为测试的所有用户
        $sql=<<<echo
            SELECT
	u_number,
	u_attr_type,
	u_create_time,
	u_commercial_time
            FROM
	"T_User"
            WHERE
                u_attr_type ='1' AND
                    (u_commercial_time IS NULL
                OR 
                    "length" (u_commercial_time)=0)
echo;
        $sth=  $this->pdo->query($sql);
        $list=$sth->fetchAll(PDO::FETCH_ASSOC);
        $time=2592000;//30天的秒数
        $now = date("Y-m-d",time());
        //var_dump((strtotime($now)-strtotime($value['u_create_time'])));die;
        $arr= parse_ini_file ( ROOT_ADDR.'/private/config/language.ini' , true );
        $version=$arr['language']['ident'];
        if($version=="VT")
        {
            foreach ($list as $key => $value) {
                if((strtotime($now)-strtotime($value['u_create_time'])) >=  $time){//用户大于等于30天时 更改用户类型
                $sql=<<<echo
                UPDATE "T_User" SET u_attr_type='0',u_commercial_time=:u_commercial_time  WHERE u_number =:u_number
echo;
                $sth=  $this->pdo->prepare($sql);
                $sth->bindValue(':u_commercial_time',date("Y-m-d",time()));
                $sth->bindValue(':u_number',$value['u_number']);
                $sth->execute();
                }
            }
        }
        
    }
    
    /**
 * 用户类别修正器
 * @package OMP_Common_Function_mod
 * @param type $str
 * @return string 手机用户|调度台用户|GVS用户|未知
 */
public function modtype($str) {
    switch ($str) {
            case "1":
                    return "手机用户";
            case "2":
                    return "调度台用户";
            case "3":
                    return "GVS用户";
            case "4":
                    return "流量卡用户";
            default:
                    return "未知";
    }
}
function getFunList($data){
    $arr=array('1'=>'gn_shpyw','2'=>'gn_yythkt','3'=>'gn_tppch','4'=>'gn_gps','5'=>'gn_djdtmsh','6'=>'gn_dxx');
    $json_arr= json_decode($data);
    if($json_arr==""){
        $json_arr=array();
    }
    $str="";
    foreach($arr as $key=>$value){
        if(in_array($value, $json_arr)){
            $str.=$key.",";
        }
    }
    return trim($str, ",");
}

function autoInc($num,$step=1){
        $count=count(str_split($num));
        $num_new=intval($num)+$step;
        if($num_new>pow(10,$count-1)){
            return $num_new;
        }
        else{
            return str_pad($num_new,$count,'0',STR_PAD_LEFT);
        }
    }
/**
 * 向DBM 发送 需要数据同步的企业
 * @param array $e_id_array 所有需要同步的企业ID
 */
function sync_enterprise($e_id_array){
    $sendmsg = new sendmsg();
    if(count($e_id_array)>0){
        foreach ($e_id_array as $value) {
            $sendmsg->send(1,15,$value." ". 28);
        }
    }
}
}
