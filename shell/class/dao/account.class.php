<?php
/**
 * 计费报表模型层
 *  @package 计费报表
 *  @subpackage Model层
 *  @author zed
 */
class account extends db {
    public $product;
    public $user;
    public $basic;
    function __construct($data){
    	parent::__construct();
            $this->product = new product($_REQUEST);
            $this->user = new users($_REQUEST);
            $this->basic = new basic($_REQUEST);
    	$this->data = $data;
    }

/**
 * [递归代理商层级数组组合]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T10:45:31+0800
 * @param    [integer]                  $id [所属代理ID]
 * @return     [array]                       [返回当前代理商的层级关系数组]
 */
function get_array($id=0){ 
    $sql = "SELECT ag_number,ag_name,ag_level FROM \"T_Agents\" WHERE ag_parent_id= '{$id}'"; 
 	$sth = $this->pdo->query ( $sql );
 	$sth->execute ();
    $arr = array(); 
    if($sth->execute () && $sth->rowCount()){//如果有子类 
        while($rows=$sth->fetch(PDO::FETCH_ASSOC)){ //循环记录集 
            $rows['list'] = $this->get_array($rows['ag_number']); //调用函数，传入参数，继续查询下级 
            $arr[]= $rows; //组合数组 
        } 
        return $arr; 
    } 
}
/**
 * 
 * [获得产品套餐价格及各项功能]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T10:47:32+0800
 * @param    [int]                   $e_id  [企业ID]
 * @param    [int]                   $ep_id [所属ID]
 * @param    [String]                   $start [起始时间]
 * @param    [String]                   $end   [结束时间]
 * @return    [array]                          [返回产品套餐价格及各项功能的关联数组]
 */
function get_product_val($e_id,$ep_id,$start,$end){
    $pi_codes=$this->product->getFunctionList(" pi_code!='gn_yyhy'");
    $price=$this->basic->get_price($ep_id);
    $basic_phone=$price['basic_price'];
    $basic_console=$price['console_price'];
    if($price['gn_dxx']==""||$price['gn_shpyw']==""||$price['gn_yythkt']==""||$price['gn_tppch']==""||$price['gn_gps']==""||$price['gn_djdtmsh']==""){
        $price=$this->basic->get_price("0");
    }

    foreach ($pi_codes as $key => $value) {
        $pi_codes[$key]['total']=$this->user->get_p_function($value['pi_code'],$e_id,$start,$end);
            $pi_codes[$key]['price']=$price[$value['pi_code']];
            $pi_codes[$key]['sum']=$pi_codes[$key]['price']*$pi_codes[$key]['total'];
        //$pi_codes[$key]['price']=$this->basic->get_price($value['pi_code'],  $this->data['ep_id']);
    }
    $pi_codes[]['basic_price']=$basic_phone;
    $pi_codes[]['console_price']=$basic_console;
    return $pi_codes;
}
/**
 *[获得增值功能所对应的用户个数]
 * @param [int] $type [用户类型]
 * @param [String] $ur_e_id [用户所属企业ID]
 * @return [int] [个数]
 */
public function get_basic_num($type,$ur_e_id){
    $arr=array('1'=>'gn_shpyw','2'=>'gn_yythkt','3'=>'gn_tppch','4'=>'gn_gps','5'=>'gn_djdtmsh','6'=>'gn_dxx');
    $key=array_search($type, $arr);
    if($ur_e_id!=""){
       $sql="SELECT count(ur_number) FROM \"T_User_Record_{$this->data['start']}\" WHERE ur_p_function LIKE '%$key%' AND ur_e_id IN( $ur_e_id )"; 
    }else{
        $sql="SELECT count(ur_number) FROM \"T_User_Record_{$this->data['start']}\" WHERE ur_p_function LIKE '%$key%' AND ur_e_id IN( NULL )"; 
    }
    $stat =$this->pdo->query($sql);
    $result=$stat->fetch();
    return $result['count'];
}
   
}