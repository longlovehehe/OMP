<?php

/**
 * 终端实体类
 * @category OMP
 * @package OMP_terminal_dao
 * @require {@see db}
 */
class terminal extends db {

    //public $user;
    
    public function __construct($data) {
            parent::__construct();
            $this->data = $data;
            //$this->user = new users($data);
    }
    
    public function getById_type(){
        $sql = <<<SQL
SELECT * FROM
        "T_TerminalType"
                WHERE tt_type='{$this->data['tt_type']}'
        ORDER BY tt_type
SQL;
        $sth = $this->pdo->query($sql);
        $result = $sth->fetch();
        return $result;
    }

    //判断imei 是否已存在
    public function getById_list(){
        $sql = <<<SQL
SELECT * FROM
        "T_MobileDevice"
                WHERE md_imei='{$this->data['md_imei']}'
SQL;
$sql1="SELECT * FROM \"T_User\" WHERE u_imei='{$this->data['md_imei']}'";
        $sth = $this->pdo->query($sql);
        $sth1 = $this->pdo->query($sql1);
        $result = $sth->fetch();
        $result1 = $sth1->fetch();

        if($result==false&&$result1==false){
            return true;
        }else{
            if($result1!=false){
                return false;
            }else{
                if($result!=false&&$result['md_id']==$this->data['md_id']||$result==false){
                    return true;
                }else{
                   return false; 
                }
            }
            
        }
    }

    //判断meid 是否已存在
    public function getById_list_meid(){
        $sql = <<<SQL
SELECT * FROM
        "T_MobileDevice"
                WHERE md_meid='{$this->data['md_meid']}'
SQL;
$sql1="SELECT * FROM \"T_User\" WHERE u_meid='{$this->data['md_meid']}'";
        $sth = $this->pdo->query($sql);
        $sth1 = $this->pdo->query($sql1);
        $result = $sth->fetch();
        $result1 = $sth1->fetch();

        if($result==false&&$result1==false){
            return true;
        }else{
            if($result1!=false){
                return false;
            }else{
                if($result!=false&&$result['md_id']==$this->data['md_id']||$result==false){
                    return true;
                }else{
                   return false; 
                }
            }
            
        }
    }

    public function getmdinfo($md_imei){
         $sql = <<<SQL
SELECT md_type,
            md_mode,
            md_binding,
            md_binding_user,
            md_ent_id,
            md_gis_mode,
            md_imei,
            md_desc,
            md_time,
            md_serial_number,
            md_id,
            md_parent_ag,
            md_status,
            md_name,
            md_batch,
            md_in_number,
            md_remarks,
            md_meid,
            ag_name,
            e_name 
    FROM
        "T_MobileDevice"
            LEFT JOIN "T_Agents" ON ag_number=md_parent_ag
            LEFT JOIN "T_Enterprise" ON e_id=md_ent_id
        WHERE md_imei='$md_imei'
SQL;
         $sth = $this->pdo->query($sql);
         $result = $sth->fetch();
         return $result;
    }
    public function getselect_list(){
        $sql = <<<SQL
SELECT * FROM
        "T_MobileDevice"
                WHERE md_imei='{$this->data['md_imei']}'
SQL;
        $sth = $this->pdo->query($sql);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //批量导入时验证IMEI是否存在
    public function checkexcel_imei($imei){
        $sql = 'SELECT * FROM "T_MobileDevice" WHERE md_imei=\'' . $imei . '\'';
        $sth = $this->pdo->query ( $sql );
        return $sth->fetch ( PDO::FETCH_ASSOC );
    }

    //批量导入时验证MEID是否存在
    public function checkexcel_meid($meid){
        $sql = 'SELECT * FROM "T_MobileDevice" WHERE md_meid=\'' . $meid . '\'';
        $sth = $this->pdo->query ( $sql );
        return $sth->fetch ( PDO::FETCH_ASSOC );
    }

    public function getList($limit=""){
       $sql = <<<SQL
SELECT * FROM
        "T_TerminalType"
         ORDER BY tt_type
SQL;
       $sql.=$limit;
       $sth = $this->pdo->query($sql);
        $result = $sth->fetchAll();
        return $result;
    }
     public function getlistList($limit=""){
       $sql = <<<SQL
SELECT md_type,
            md_mode,
            md_binding,
            md_binding_user,
            md_ent_id,
            md_gis_mode,
            md_imei,
            md_desc,
            md_time,
            md_serial_number,
            md_id,
            md_parent_ag,
            md_status,
            md_name,
            md_batch,
            md_in_number,
            md_remarks,
            md_meid,
            u_number,
            ag_name,
            e_name
                FROM
        "T_MobileDevice"
               LEFT JOIN "T_User" ON u_imei=md_imei 
               LEFT JOIN "T_Agents" ON ag_number=md_parent_ag
               LEFT JOIN "T_Enterprise" ON e_id=md_ent_id
SQL;
       $sql.=$this->getwhere(true);
       $sql.=$limit;
       $sth = $this->pdo->query($sql);
        $result = $sth->fetchAll();
        return $result;
    }
    public function getwhere($order=false){
        $where=" WHERE 1=1 ";
        if($this->data['md_type']!=""){
            $where.="AND md_type ='".$this->data['md_type']."'";
        }
        if($this->data['md_imei']!=""){
            $where.="AND md_imei LIKE E'%".addslashes($this->data['md_imei'])."%'";
        }
        if($this->data['md_meid']!=""){
            $where.="AND md_meid LIKE E'%".addslashes($this->data['md_meid'])."%'";
        }
        if($this->data['md_serial_number']!=""){
            $where.="AND md_serial_number LIKE E'%".addslashes($this->data['md_serial_number'])."%'";
        }
        if($this->data['md_binding_user']!=""){
            $where.="AND u_number LIKE E'%".addslashes($this->data['md_binding_user'])."%'";
        }
        if($this->data['md_name']!=""){
            $where.="AND md_name LIKE E'%".addslashes($this->data['md_name'])."%'";
        }
        if($this->data['md_batch']!=""){
            $where.="AND md_batch LIKE E'%".addslashes($this->data['md_batch'])."%'";
        }
        if($this->data['md_in_number']!=""){
            $where.="AND md_in_number LIKE E'%".addslashes($this->data['md_in_number'])."%'";
        }
        if($this->data['md_time']!=""){
            $where.="AND md_time LIKE E'%".addslashes($this->data['md_time'])."%'";
        }
        if($this->data['md_ent_id']!=""){
            $where.="AND md_ent_id =".$this->data['md_ent_id'];
        }
        if($this->data['md_parent_ag']!=""){
            $where.="AND md_parent_ag ='".$this->data['md_parent_ag']."'";
        }
        if($this->data['md_status']!=""){
            if($this->data['md_status']=="2"){
                $where.="AND md_binding = 0 ";
            }else if($this->data['md_status']=="0"){
                $where.="AND md_binding = 1 AND md_status ='".$this->data['md_status']."'";
            }else{
                $where.="AND md_status ='".$this->data['md_status']."'";
            }
        }
//        if ( $this->data["start"] != "" || $this->data["end"] != "" )
//        {
//            $where .= 'AND md_time ' . getDateRange ( $this->data["start"] , $this->data["end"] );
//        }
        if($order){
            $where.="ORDER BY md_imei";
        }
        return $where;
    }

    public function term_upload(){
        $pic=new pic($this->data);
        //if($this->data['tt_pic']==""){
        if($this->data['d']!="replace"||$this->data['path']!=""){
            $tt_pic=$pic->getId_terminal($this->data['tt_type'],  $this->data['d']);
        }
        //更改终端设备类型
        if($this->data['old_tt_type']!=$this->data['tt_type']&&$this->data['old_tt_type']!=""){
            $this->up_md_type();
        }
       // }
        $tt_id=$this->get_ttid();
        if($this->data['d']=="replace"){
            //$pic->up_tem_pic();
            $sql = <<<SQL
UPDATE
        "T_TerminalType" SET
           tt_time=:tt_time,tt_type=:tt_type WHERE  tt_pic=:tt_pic
SQL;
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue('tt_type',  $this->data['tt_type']);
        $sth->bindValue('tt_pic',  $this->data['tt_pic']);
        $sth->bindValue('tt_time',date("Y-m-d H:i:s",time()),PDO::PARAM_INT);  
        }else if($this->data['d']=="del"){
          $sql = <<<SQL
DELETE
        "T_TerminalType" SET
            "tt_id"=:tt_id,"tt_type"=:tt_type,"tt_pic"=:tt_pic,"tt_time"=:tt_time
SQL;
        }else{
        $sql = <<<SQL
INSERT INTO
        "T_TerminalType"("tt_id","tt_type","tt_pic","tt_time")
VALUES(:tt_id,:tt_type,:tt_pic,:tt_time)
SQL;
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue('tt_id',$tt_id);
        $sth->bindValue('tt_type',  $this->data['tt_type']);
        $sth->bindValue('tt_pic',$tt_pic);
        $sth->bindValue('tt_time',date("Y-m-d H:i:s",time()),PDO::PARAM_INT);
        }
      

    try {
                 $sth->execute();
             } catch (Exception $ex) {
                     $msg["status"] = -1;
                     return $msg;
             }
             $msg["status"] = 0;

             if ($edit) {
                     $log = DL('版本文件修改成功');
                     $msg["msg"] = L('版本文件修改成功');
             } else {
                     $log = DL('版本文件上传成功');
                     $msg["msg"] = L('版本文件上传成功');
             }

             $this->log($log, 3, 0);
             return $msg;
 }
    
    public function get_ttid(){
        $sql = 'SELECT nextval(\'"T_TerminalType_tt_id_seq"\'::regclass)';

           //$sql = str_replace(':e_id', $e_id, $sql);
           $sth = $this->pdo->query($sql);
           $result = $sth->fetch();
           return $result["nextval"];
    }
//获取设备类型总数
    public function getTotal($flag = TRUE) {
            $sql = "SELECT COUNT(tt_type) AS total FROM \"T_TerminalType\"";

            $pdoStatement = $this->pdo->query($sql);
            $result = $pdoStatement->fetch();

            return $result["total"];
    }
//获取设备历史纪录总数
    public function getTotal_history($flag = TRUE) {
            $sql = "SELECT COUNT(th_imei) AS total FROM \"T_TerminalHistory\" WHERE th_imei='{$this->data['th_imei']}'";

            $pdoStatement = $this->pdo->query($sql);
            $result = $pdoStatement->fetch();

            return $result["total"];
    }
//获取设备总数
    public function getlistTotal($flag = TRUE) {
            $sql = "SELECT COUNT(md_imei) AS total FROM \"T_MobileDevice\" LEFT JOIN \"T_User\" ON u_imei=md_imei ";
            $sql.=$this->getwhere();
            $pdoStatement = $this->pdo->query($sql);
            $result = $pdoStatement->fetch();

            return $result["total"];
    }
    
    public function batch_save() {
        if($this->data['do']=="edit"){
           $sql=<<<SQL
UPDATE "T_MobileDevice" SET "md_imei"=:md_imei,"md_type"=:md_type,"md_parent_ag"=:md_parent_ag,"md_time"=:md_time,"md_serial_number"=:md_serial_number,"md_batch"=:md_batch,"md_in_number"=:md_in_number,"md_name"=:md_name,"md_remarks"=:md_remarks,"md_meid"=:md_meid WHERE
md_id=:md_id
SQL;
            $sth=$this->pdo->prepare($sql);
            $sth->bindValue(':md_id',  $this->data['md_id'],PDO::PARAM_INT);
        }else{
        $md_id=$this->get_tlid();
        $sql=<<<SQL
INSERT INTO "T_MobileDevice" ("md_id","md_imei","md_type","md_time","md_serial_number","md_parent_ag","md_status","md_batch","md_in_number","md_name","md_remarks","md_meid")
  VALUES(:md_id,:md_imei,:md_type,:md_time,:md_serial_number,:md_parent_ag,:md_status,:md_batch,:md_in_number,:md_name,:md_remarks,:md_meid)
SQL;
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(':md_id',$md_id,PDO::PARAM_INT);
//        $sth->bindValue(':md_time',date("Y-m-d H:i:s",time()),PDO::PARAM_INT);
        $sth->bindValue(':md_status',0,PDO::PARAM_INT);
        }
        //var_dump($this->data);die;
        if($_SESSION['ident']=="VT"){
            $sth->bindValue(':md_time',date("Y-m-d H:i:s",  time()),PDO::PARAM_INT);
        }else{
            $sth->bindValue(':md_time',$this->data['md_time'],PDO::PARAM_INT);
        }
        $sth->bindValue(':md_imei',  $this->data['md_imei']);
        $sth->bindValue(':md_type',  $this->data['md_type']);
        $sth->bindValue(':md_serial_number', trim($this->data['md_serial_number']));
        $sth->bindValue(':md_name',$this->data['md_name']);
        $sth->bindValue(':md_remarks',$this->data['md_remarks']);
        $sth->bindValue(':md_meid',$this->data['md_meid']);
        $sth->bindValue(':md_batch',$this->data['md_batch']);
        $sth->bindValue(':md_parent_ag',$this->data['md_parent_ag']);
        $sth->bindValue(':md_in_number',$this->data['md_in_number']);
        try {
            $sth->execute();
        } catch (Exception $exc) {
           if($exc->getCode()==23505){
               $msg['status']=-1;
               $msg['msg']=L("IMEI已存在");
                return $msg;
           }
           echo $exc->getMessage();die;
        }
        $msg['status']=0;
        $msg['msg']=L("操作成功");
        $msg['info']=  $this->getmdinfo($this->data['md_imei']);
        
        return $msg;
    }
    /**
     * 更新用户列表 终端类型
     * @return type
     */
    public function up_md_type(){
        $list=$this->get_mdlist();
        $list_str="'0',";
        foreach($list as $v){
            $list_str.="'".$v['md_id']."'".",";
        }
        $list_str=  trim($list_str,",");
        $sql=<<<SQL
UPDATE "T_MobileDevice" SET "md_type"=:md_type WHERE md_id IN ($list_str)
SQL;
         $sth=$this->pdo->prepare($sql);
        $sth->bindValue(':md_type',  $this->data['tt_type']);
        $sth->execute();
    }
    /**
     * 获得所有终端类型为$this->data['old_tt_type'] 的用户ID
     * @return type
     */
    public function get_mdlist(){
        $sql=<<<SQL
SELECT md_id FROM "T_MobileDevice"  WHERE md_type=:md_type
SQL;
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(':md_type',  $this->data['old_tt_type']);
        $sth->execute();
        $list=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }
    
    public function get_tlid(){
        $sql = 'SELECT nextval(\'"T_MobileDevice_md_id_seq"\'::regclass)';
        $sth = $this->pdo->query($sql);
        $result = $sth->fetch();
        return $result["nextval"];
    }
    public function get_thid(){
        $sql = 'SELECT nextval(\'"T_TerminalHistory_th_id_seq"\'::regclass)';
        $sth = $this->pdo->query($sql);
        $result = $sth->fetch();
        return $result["nextval"];
    }
    
    public function term_del(){
        $sql="DELETE FROM \"T_MobileDevice\" WHERE md_imei='{$this->data['md_imei']}'";
        $res=$this->pdo->exec($sql);
        return $res;
    }
     
    public function batch_del_term(){
        $sql="DELETE FROM \"T_MobileDevice\" WHERE md_imei='{$this->data['md_imei']}'";
        $res=$this->pdo->exec($sql);
        return $res;
    }
    public function term_del_type(){
        $sql="DELETE FROM \"T_TerminalType\" WHERE tt_type='{$this->data['tt_type']}'";
        $res=$this->pdo->exec($sql);
        return $res;
    }
    
    /**
     * 判断终端类型是否被使用
     * @return type
     */
    public function get_type_used($md_type){
        $sql="SELECT COUNT(md_id) as total FROM \"T_MobileDevice\" WHERE md_type=:md_type";
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(':md_type',  $md_type);
        $sth->execute();
        $list=$sth->fetch(PDO::FETCH_ASSOC);
        return $list['total'];
    }
    /**
     * 批量修改终端类型接口
     * @return type
     */
    public function save_term_type(){
        $sql=<<<SQL
UPDATE "T_MobileDevice" SET "md_type"=:md_type,"md_parent_ag"=:md_parent_ag WHERE md_imei=:md_imei
SQL;
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(':md_type',  $this->data['md_type']);
        $sth->bindValue(':md_parent_ag',  $this->data['md_parent_ag']);
        $sth->bindValue(':md_imei',  $this->data['md_imei']);
        $sth->execute();
    }

    //迁移企业所属时更改终端绑定的代理商
    public function move_enterprise_term_bind(){
        $imei = $this->data['md_imei'];
        $agent_id = $this->data['md_parent_ag'];
        $sql="UPDATE \"T_MobileDevice\" SET md_parent_ag='{$agent_id}'  WHERE md_imei='{$imei}'";
        $res=$this->pdo->exec($sql);
    }
    
    /**
     * 检查终端类型名称是否重复
     * @return type
     */
    public function check_type_name(){
        $sql="SELECT * FROM \"T_TerminalType\" WHERE tt_type=:tt_type";
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(':tt_type', $this->data['tt_type']);
        $sth->execute();
        $list=$sth->fetch(PDO::FETCH_ASSOC);
        return $list;
    }
    
    public function get() {
            return $this->data;
    }

    public function set($data) {
            $this->data = $data;
    }
    
    /*
     * 作者 hongyuan.li
     * 时间 2015.7.27
     * 功能 keeper列表查询条件
     */
    public function getkeeperwhere($order=false)
    {
        $where="WHERE 1=1 ";
        if($this->data['rm_id']!=""){
            $where.="AND rm_id LIKE E'%".addslashes($this->data['rm_id'])."%'";
        }
        if($this->data['rm_nickname']!=""){
            $where.="AND rm_nickname LIKE E'%".addslashes($this->data['rm_nickname'])."%'";
        }
        
        if($order){
            $where.="ORDER BY rm_id desc";
        }
        return $where;
    }
    /*
   * 作者 hongyuan.li
   * 时间 2015.7.27
   * 功能 keeper管理页列表总数
   */
  public function getKeeperTotal()
  {
      $sql = "SELECT COUNT(rm_id) AS total FROM \"T_RetailManager\" ";
      $sql.=$this->getkeeperwhere();
      $pdoStatement = $this->pdo->query($sql);
      $result = $pdoStatement->fetch();

      return $result["total"];
  }
  /*
   * 作者 hongyuan.li
   * 时间 2015.7.27
   * 功能 keeper管理列表
   */
  public function getkeeperList($limit="")
  {
      $sql = <<<SQL
        SELECT rm_id, rm_nickname,devicesum
        FROM  "T_RetailManager"
        LEFT JOIN (
                        select u_mobile_phone,count(u_number) as devicesum 
                        from "T_User" 
                        where u_e_id = '999999'  
                        GROUP BY u_mobile_phone
        ) AS tuser ON u_mobile_phone=rm_id             
SQL;

       $sql.=$this->getkeeperwhere(true);
       $sql.=$limit;
       $sth = $this->pdo->query($sql);
        $result = $sth->fetchAll();
        return $result;
  }
  /*
   * 作者 hongyuan.li
   * 时间 2015.7.28
   * 功能 获取keeper账号信息
   */
      public function getKeeper()
      {      
        $sql = <<<SQL
            SELECT * 
            FROM   "T_RetailManager"
            WHERE rm_id='{$this->data['rm_id']}'
SQL;
        $sth = $this->pdo->query($sql);
        $result = $sth->fetch();
        return $result;
    }
        /*
     * 作者 hongyuan.li
     * 时间 2015.7.28
     * 功能 keeper详情页列表查询条件
     */
    public function getkeeperdetailwhere($order=false)
    {
        if($this->data['u_name']!=""){
            $where.="AND u_name LIKE E'%".addslashes($this->data['u_name'])."%'";
        }
        if($this->data['u_terminal_type']!=""){
            $where.="AND u_terminal_type = '".$this->data['u_terminal_type']."'";
        }
        if($this->data['u_number']!=""){
            $where.="AND u_number LIKE E'%".addslashes($this->data['u_number'])."%'";
        }
        if($this->data['u_imei']!=""){
            $where.="AND u_imei LIKE E'%".addslashes($this->data['u_imei'])."%'";
        }
        if($order){
            $where.="ORDER BY u_number desc";
        }
        return $where;
    }
  /*
   * 作者 hongyuan.li
   * 时间 2015.7.28
   * 功能 keeper详情页列表总数
   */
  public function getKeeperDetailTotal()
  {
      $sql = "SELECT count(u_number) AS total
        FROM  \"T_User\"
        Where u_e_id = '999999' and u_mobile_phone =  '{$this->data['rm_id']}'";
      $sql.=$this->getkeeperdetailwhere();
      $pdoStatement = $this->pdo->query($sql);
      $result = $pdoStatement->fetch();

      return $result["total"];
  }
  /*
   * 作者 hongyuan.li
   * 时间 2015.7.28
   * 功能 keeper详情列表
   */
  public function getkeeperdetailList($limit="")
  {
      $sql = <<<SQL
        SELECT u_name,u_imei,u_number,md_type
        FROM  "T_User"
        LEFT JOIN "T_MobileDevice" ON u_imei = md_imei
        Where u_e_id = '999999' and u_mobile_phone =  '{$this->data['rm_id']}'         
SQL;
       $sql.=$this->getkeeperdetailwhere(true);
       $sql.=$limit;
       $sth = $this->pdo->query($sql);
        $result = $sth->fetchAll();
        return $result;
  }
  
    public function get_md_alllist(){
        $sql="SELECT md_parent_ag,ag_name,md_ent_id,e_name FROM \"T_MobileDevice\" LEFT JOIN \"T_Agents\" ON ag_number=md_parent_ag LEFT JOIN \"T_Enterprise\" ON e_id=md_ent_id WHERE md_parent_ag is not null";
        $sth=$this->pdo->prepare($sql);
        $sth->execute();
        $list=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $list;
    }
    public function set_stat(){
        $sql=<<<echo
        UPDATE "T_MobileDevice" SET md_status=:md_status WHERE md_imei=:md_imei
echo;
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(":md_status",$this->data['md_status'],PDO::PARAM_INT);
        $sth->bindValue(":md_imei",$this->data['md_imei']);
        
        try{
            if($this->data['md_status']=="1"){
                $status="start";
            }else{
                $status="stop";
            }
            $sth->execute();
            $msg['status']=0;
            $msg['msg']=L("修改成功");            
            $info=$this->ter_historyById($this->data['md_imei']);
            $data['th_imei']=$this->data['md_imei'];
            $data['th_e_id']=$info['e_id'];
            $data['th_e_name']=$info['e_name'];
            $data['th_u_number']=$info['u_number'];
            $data['th_u_name']=$info['u_name'];
            $data['th_u_iccid']=$info['u_iccid'];
            $data['th_u_imsi']=$info['u_imsi'];
            $data['th_md_type']=$info['md_type'];
            $data['th_md_serial_number']=$info['md_serial_number'];
            $data['th_u_mobile_phone']=$info['u_mobile_phone'];
            $data['th_meid']=$this->data['md_meid'];
            $this->set($data);
            $this->create_terminal_history($status,1);
            
            //$user_data['u_number']=
            $user=new users();
            //$this->user->set($info);
            //$res=$this->user->getById_history();
            /**流量卡听启用状态判断*/
            if($info['g_status']=="0"){
                $g_status="stop";
            }else if($info['g_status']=="1"){
                $g_status="start";
            }else{
                $g_status="";
            }
            $user_data['uh_md_imei']=$data['th_imei'];
            $user_data['uh_md_type']=$data['th_md_type'];
            $user_data['uh_md_status']=$status;
            $user_data['uh_gp_iccid']=$info['u_iccid'];
            $user_data['uh_gp_imsi']=$info['u_imsi'];
            $user_data['uh_gp_mobile']=$info['u_mobile_phone'];
            $user_data['uh_gp_status']=$g_status;
            //$user_data['uh_user_status']=$info['u_active_state'];
            $user_data['uh_u_name']=$data['th_u_name'];
            $user_data['uh_u_number']=$data['th_u_number'];
            $user_data['uh_md_meid']=$data['th_meid'];
           // var_dump($user_data);die;
            $user->set($user_data);
            $user->set_user_history($info['u_active_state']==0?"stop":"start", 1);
        }catch (Exception $ex){
            $msg['status']=-1;
            $msg['msg']=L("修改失败");
        }
        $log=DL("终端 IMEI:【%s】状态修改为 %s");
        $log=sprintf($log,$data['th_imei'],$status);
        $this->log($log,10);

        return $msg;

    }
 /**
     * 终端解除绑定
     * @return type
     */
    public function releaseBound(){
        $sql=<<<SQL
            UPDATE "T_MobileDevice" SET
                "md_binding"=:md_binding,
                "md_binding_user"=:md_binding_user,
                "md_ent_id"=:md_ent_id,
                "md_status"=:md_status,
                "md_gis_mode"=:md_gis_mode,
                "md_binding_time"=:md_binding_time
            WHERE
                    md_imei=:md_imei
SQL;
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(':md_binding', 0,PDO::PARAM_INT);
        $sth->bindValue(':md_binding_user', NULL);
        $sth->bindValue(':md_ent_id', NULL);
        $sth->bindValue(':md_status', 0,PDO::PARAM_INT);
        $sth->bindValue(':md_gis_mode', 0,PDO::PARAM_INT);
        $sth->bindValue(':md_binding_time', NULL);
        $sth->bindValue(':md_imei', $this->data['md_imei']);

        try{
            $sth->execute();
            $msg['status']=0;
            $msg['msg']=L('终端解除绑定 , 成功');
        }  catch (Exception $ex){
            $msg['status']=-1;
            $msg['msg']=L('终端解除绑定 , 失败');
            echo $ex->getMessage();
        }

        return $msg;
    }
    /**
     * 终端绑定
     * @return type
     */
    public function terminalBound(){
        $sql=<<<SQL
            UPDATE "T_MobileDevice" SET
                "md_binding"=:md_binding,
                "md_binding_user"=:md_binding_user,
                "md_ent_id"=:md_ent_id,
                "md_status"=:md_status,
                "md_gis_mode"=:md_gis_mode,
                "md_binding_time"=:md_binding_time
            WHERE
                    md_imei=:md_imei
SQL;
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(':md_binding', 1 ,PDO::PARAM_INT);
        $sth->bindValue(':md_binding_user', $this->data['md_binding_user']);
        $sth->bindValue(':md_ent_id', $this->data['md_ent_id'],PDO::PARAM_INT);
        $sth->bindValue(':md_gis_mode',  $this->data['md_gis_mode'],PDO::PARAM_INT);
        $sth->bindValue(':md_binding_time',  date('Y-m-d',time()),PDO::PARAM_INT);
        $sth->bindValue(':md_status', 1,PDO::PARAM_INT);
        $sth->bindValue(':md_imei', $this->data['md_imei']);

        try{
            $sth->execute();
            $msg['status']=0;
            $msg['msg']=L('终端绑定 , 成功');
        }  catch (Exception $ex){
            $msg['status']=-1;
            $msg['msg']=L('终端绑定 , 失败');
        }

        return $msg;
    }

    /**
     * 生成终端历史记录
     * @param $info
     */
    public function create_terminal_history($info,$stat){
        $th_id=$this->get_thid();
        $sql=<<<echo
        INSERT INTO "T_TerminalHistory" (
            "th_id",
            "th_imei",
            "th_e_id",
            "th_e_name",
            "th_u_number",
            "th_u_name",
            "th_u_iccid",
            "th_u_imsi",
            "th_status",
            "th_change_time",
            "th_md_type",
            "th_md_serial_number",
            "th_stat",
            "th_u_mobile_phone",
            "th_meid"
        ) VALUES(
            :th_id,
            :th_imei,
            :th_e_id,
            :th_e_name,
            :th_u_number,
            :th_u_name,
            :th_u_iccid,
            :th_u_imsi,
            :th_status,
            :th_change_time,
            :th_md_type,
            :th_md_serial_number,
            :th_stat,
            :th_u_mobile_phone,
            :th_meid
        )
echo;
        $sth=$this->pdo->prepare($sql);
        $sth->bindValue(":th_id",$th_id,PDO::PARAM_INT);
        $sth->bindValue(":th_imei",$this->data['th_imei']);
        $sth->bindValue(":th_e_id",$this->data['th_e_id'],PDO::PARAM_INT);
        $sth->bindValue(":th_e_name",$this->data['th_e_name']);
        $sth->bindValue(":th_u_number",$this->data['th_u_number']);
        $sth->bindValue(":th_u_name",$this->data['th_u_name']);
        $sth->bindValue(":th_u_iccid",$this->data['th_u_iccid']);
        $sth->bindValue(":th_u_imsi",$this->data['th_u_imsi']);
        $sth->bindValue(":th_status",$info);
        $sth->bindValue(":th_change_time",time());
        $sth->bindValue(":th_md_type",$this->data['th_md_type']);
        $sth->bindValue(":th_md_serial_number",$this->data['th_md_serial_number']);
        $sth->bindValue(":th_stat",$stat,PDO::PARAM_INT);
        $sth->bindValue(":th_u_mobile_phone",$this->data['th_u_mobile_phone']);
        $sth->bindValue(":th_meid",$this->data['th_meid']);
        $sth->execute();

    }

    /**
     * 终端历史记录 ID
     * @param $imei
     * @return mixed
     */
    public function ter_historyById($imei){
        $sql=<<<echo
       SELECT * FROM "T_MobileDevice" WHERE md_imei='$imei'
echo;
        $sth=$this->pdo->query($sql);
        $res=$sth->fetch();
        $user_id=$res['md_binding_user'];
        $users=new users(array('u_number'=>$user_id));
        $info=$users->getById_history();

        return $info;
    }
    /**
     * 删除终端历史记录
     */
    public function delete_term_history(){
        $sql="DELETE FROM \"T_TerminalHistory\" WHERE th_imei='{$this->data['th_imei']}'";
        $sth=$this->pdo->prepare($sql);
        $sth->execute();
    }

    public function getList_term_history($limit=""){
        $sql=<<<ECHO
    SELECT * FROM "T_TerminalHistory"
ECHO;
        $sql.=$this->getWhere_th();
        $sql.=$limit;
        //$sth=$this->pdo->prepare($sql);
        $sth=$this->pdo->query($sql);
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function getWhere_th($order=true){
        $where=" WHERE 1=1";
        if($this->data['th_imei']!=""){
            $where.=" AND th_imei='".$this->data['th_imei']."'";
        }
        if($order){
            $where.=" ORDER BY th_change_time DESC";
        }
        return $where;
    }
    
    public function set_term_history($res,$info=""){
            $data['th_imei']=$res['md_imei'];
            $data['th_e_id']=$res['e_id'];
            $data['th_e_name']=$res['e_name'];
            $data['th_u_number']=$res['u_number'];
            $data['th_u_name']=$res['u_name'];
            $data['th_u_iccid']=$res['g_iccid'];
            $data['th_u_imsi']=$res['g_imsi'];
            $data['th_md_type']=$res['md_type'];
            $data['th_md_serial_number']=$res['md_serial_number'];
            $data['th_u_mobile_phone']=$res['g_number'];
            $data['th_meid']=$res['th_meid'];
            if($info==""){
                $info=$res['md_status']=="0"?"stop":"start";
            }
            $this->set($data);
            $this->create_terminal_history($info,1);
            
    }
    
    public function get_term_type_for_charts($data){
        $sql="SELECT count(u_number) FROM \"T_User\" ";
        $where = "WHERE 1=1 ";
        if($this->data['u_attr_type']!=""){
            if($this->data['u_attr_type']=="com&text"){
                $where .= " AND u_terminal_type IS NOT NULL  OR \"length\"(u_terminal_type)!=0";
            }else if($this->data['u_attr_type']=="com"){
                $where .= " AND u_terminal_type = 0";
            }else if($this->data['u_attr_type']=="test"){
                $where .= " AND u_terminal_type = 1";
            }
        }else{
            $where .= " AND u_terminal_type = $data";
        }
        
        
    }
}
