<?php
/**
 * 数据统计Model
 * @category 业务统计
 * @package 数据统计
 * @subpackage  Model层
 */
class report extends db {

    function __construct($data){
    	parent::__construct(); 
    	$this->data = $data;
    }

    /**
     * 获得当选择代理商下的所有企业
     */
    public function getall_ep($e_agents_id="0"){
        $sql=<<<ECHO
                SELECT e_id FROM "T_Enterprise" WHERE e_id!=999999
ECHO;
        if($this->data['ep_id']!=""){
            $sql .=" AND e_ag_path LIKE  '%|{$e_agents_id}|%'";
        }
    $sth = $this->pdo->query ( $sql );
    $sth->execute ();
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
    return $res;
    }
    /**
     * 获得选择企业的所有用户
     */
    public function getall_user($list_id){
        $sql=<<<ECHO
                SELECT COUNT(u_number) AS user_num FROM "T_User"
ECHO;
        $sql.=$this->getwhere(false);
        $sql.=" AND u_e_id IN ({$list_id}) ";
        $sth = $this->pdo->query ( $sql );
        $sth->execute ();
        $res=$sth->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    /**
     * 获得选择企业的所有用户
     */
    public function getall_for_histogram($list_id,$parm){
        $sql=<<<ECHO
                SELECT COUNT(u_number) AS user_num FROM "T_User"
ECHO;
        $sql.=$this->getwhere(false,$parm);
        $sql.=" AND u_e_id IN ({$list_id}) ";
        $sth = $this->pdo->query ( $sql );
        $sth->execute ();
        $res=$sth->fetch(PDO::FETCH_ASSOC);
        return $res;
    }
    
    
/**
 * 递归代理商层级数组组合
 */
function get_array($id=0){ 
    $sql = "SELECT ag_number,ag_name,ag_level FROM \"T_Agents\" WHERE ag_parent_id= '{$id}'"; 
    $sth = $this->pdo->query ( $sql );
        $arr = array(); 
        if($sth->execute() && $sth->rowCount()){//如果有子类 
            while($rows=$sth->fetch(PDO::FETCH_ASSOC)){ //循环记录集 
                if(!$this->get_array($rows['ag_number'])){
                    $res=$this->get_ep($rows['ag_number']);
                    $arr_ep=array();
                    foreach($res as $v){
                        $row['ag_number']=$v['e_id'];
                        $row['ag_name']=$v['e_name'];
                        $arr_ep[]=$row;
                    }
                    $rows['list']=$arr_ep;
                }else{
                    $rows['list'] = $this->get_array($rows['ag_number']);
                
                } //调用函数，传入参数，继续查询下级
                $arr[]= $rows; //组合数组 
            }
                //$rows['e_id'] = $this->get_ep($rows['ag_number']); //调用函数，传入参数，继续查询下级 
                $res=$this->get_ep($id);
                foreach($res as $v){
                    $row['ag_number']=$v['e_id'];
                    $row['ag_name']=$v['e_name'];
                    $arr[]=$row;
                }
            return $arr; 
        }
}
/*
 *获得某个代理商下的所有企业
 */
public function get_ep($ag_number="0"){
    $sql="SELECT e_id,e_name FROM \"T_Enterprise\" WHERE e_agents_id='{$ag_number}'";
    $sth = $this->pdo->prepare ( $sql );
    $sth->execute ();
    $res=$sth->fetchAll(PDO::FETCH_ASSOC);
   
    return $res;
}
/**
 * 获取某日新增人员个数
 */
/*
function getListnum(){
    $sql='SELECT
	*, (
		SELECT
			COUNT (u_number)
		FROM
			"T_User"
		WHERE
                        u_e_id = e_id '.$this->childwhere().' 
	) AS user_num

FROM
	"T_Agents"
LEFT JOIN "T_Enterprise" ON ag_number = e_agents_id';
    $sql=$sql.$this->getwhere();
    var_dump($sql);
    $sth=  $this->pdo->prepare($sql);
    //$sth->bindValue ( ':ag_number' , $ag_number);
    $sth->execute ();
    $result = $sth->fetchAll();
    var_dump($result);die;
    return $result;
}
*/
function childwhere(){
    $where='';
    /*
    if ( $this->data["start"] != "" || $this->data["end"] != "" )
        {
            $where .= 'AND u_create_time ' . getDateRange ( $this->data["start"] , $this->data["end"] );
        }else{
            $start=date("Y-m-d H:i:s",time());
            $where .= "AND u_create_time BETWEEN to_timestamp('{$start}', 'yyyy-mm-dd HH24:MI:SS') AND to_timestamp('{$end}', 'yyyy-mm-dd HH24:MI:SS')";
        }
     * *
     */

    if($this->data["u_create_time"]!=""){
         $where .="AND u_create_time=".$this->data['u_create_time'];
    }

    if($this->data["u_active_state"]){
        $where .=" AND u_active_state=".$this->data['u_active_state'];
    }
    return $where;
}
/*
function getwhere($order=false){
    $where=" WHERE 1=1 ";
    if($this->data['id']!=""){
        $where .="AND e_id=".$this->data['e_id'];
    }
    if($this->data['lv1']!=""&&$this->data['lv2']==""){
        $where .=" AND e_ag_path LIKE E'%|".$this->data['lv1']."|%'";
    }else if($this->data['lv1']!=""&&$this->data['lv2']!=""&&$this->data['lv3']==""){
         $where .=" AND e_ag_path LIKE E'%|".$this->data['lv2']."|%'";
    }else if($this->data['lv1']!=""&&$this->data['lv2']!=""&&$this->data['lv3']!=""){
        $where .=" AND e_ag_path LIKE E'%|".$this->data['lv3']."|%'";
    }else{
        
    }
    return $where;
}
 * 
 */
function getwhere($order=false,$parm){
    $where=" WHERE 1=1 ";
    if($this->data['date_type']=="day"){
        if($this->data['data_type']=="_commercial"){
            $where .=" AND u_commercial_time<='".$this->data['u_create_time']."' AND u_attr_type='0' ";
        }else if($this->data['data_type']=="_type"){
            $where .=" AND u_sub_type =".$parm;
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time='".$this->data['u_create_time']."'";
            }
        }else if($this->data['data_type']=="_validity"){
            if($parm=="2"){
                $parm="0";
            }
             $where .=" AND u_active_state ='".$parm."'";
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time='".$this->data['u_create_time']."'";
            }
        }else{
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time<='".$this->data['u_create_time']."'";
            }
    //        if($this->data['status']=="act"){
    //            $this->data["u_active_state"]=1;
    //            $where .=" AND u_active_state='".$this->data['u_active_state']."'";
    //        }else if($this->data['status']=="loss"){
    //            $this->data["u_active_state"]=2;
    //            $where .=" AND u_active_state='".$this->data['u_active_state']."'";
    //        }
        }
    }else if($this->data['date_type']=="week"){
         if($this->data['data_type']=="_commercial"){
            $where .=" AND u_commercial_time<='".$this->data['u_create_time']."' AND u_attr_type='0' ";
        }else if($this->data['data_type']=="_type"){
            $where .=" AND u_sub_type =".$parm;
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time='".$this->data['u_create_time']."'";
            }
        }else if($this->data['data_type']=="_validity"){
            if($parm=="2"){
                $parm="0";
            }
             $where .=" AND u_active_state ='".$parm."'";
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time='".$this->data['u_create_time']."'";
            }
        }else{
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time<='".$this->data['u_create_time']."'";
            }
    //        if($this->data['status']=="act"){
    //            $this->data["u_active_state"]=1;
    //            $where .=" AND u_active_state='".$this->data['u_active_state']."'";
    //        }else if($this->data['status']=="loss"){
    //            $this->data["u_active_state"]=2;
    //            $where .=" AND u_active_state='".$this->data['u_active_state']."'";
    //        }
        }
    }else if($this->data['date_type']=="month"){
          if($this->data['data_type']=="_commercial"){
            $where .=" AND u_commercial_time<='".$this->data['u_create_time']."' AND u_attr_type='0' ";
        }else if($this->data['data_type']=="_type"){
            $where .=" AND u_sub_type =".$parm;
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time='".$this->data['u_create_time']."'";
            }
        }else if($this->data['data_type']=="_validity"){
            if($parm=="2"){
                $parm="0";
            }
             $where .=" AND u_active_state ='".$parm."'";
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time='".$this->data['u_create_time']."'";
            }
        }else{
            if($this->data["u_create_time"]!=""){
                 $where .=" AND u_create_time<='".$this->data['u_create_time']."'";
            }
    //        if($this->data['status']=="act"){
    //            $this->data["u_active_state"]=1;
    //            $where .=" AND u_active_state='".$this->data['u_active_state']."'";
    //        }else if($this->data['status']=="loss"){
    //            $this->data["u_active_state"]=2;
    //            $where .=" AND u_active_state='".$this->data['u_active_state']."'";
    //        }
        }
    }else{
        
    }
    return $where;
}
 public function get ()
    {
        return $this->data;
    }

    public function set ( $data )
    {
        $this->data = $data;
    }
   
}