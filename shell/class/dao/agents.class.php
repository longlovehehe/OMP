<?php
/**
 * 代理商相关Model
 * @category  账号管理
 * @package 代理商管理
 * @subpackage  Model层
 */
class agents extends db
{

    public function __construct ( $data )
    {
        parent::__construct ();
        $this->data = $data;
    }
    /**
     * [GET方法 获取私有属性的方法 ]
     * @var @see 获得参数
     * @Author   longfei.wang
     * @DateTime 2015-12-03T11:49:23+0800
     * @return   [array]                   [返回初始化类的参数值]
     */
    public function get ()
    {
        return $this->data;
    }
/**
     * [GET方法 初始化私有属性的方法 ]
     * @var @see 初始化参数
     * @Author   longfei.wang
     * @DateTime 2015-12-03T11:49:23+0800
     */
    public function set ( $data )
    {
        $this->data = $data;
    }

/**
 * [获得某个代理商的详细信息]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T11:54:04+0800
 * @param   [string]                  $ag_number [代理商ID]
 * @return   [array]                              [返回某一个代理商的详细信息]
 */
    public function getByid ($ag_number="")
    {
        if($ag_number==""){
            $ag_number=$this->data['ag_number'];
        }
        $sql = 'SELECT * FROM "T_Agents" WHERE ag_number=:ag_number';
        $sth = $this->pdo->prepare ( $sql );
        $sth->bindValue ( ':ag_number' , $ag_number);
        $sth->execute ();
        $result = $sth->fetch ();
        return $result;
    }
    /**
     * [获得某个月的某个代理商的详细信息]
     * @Author   longfei.wang
     * @DateTime 2015-12-03T11:55:29+0800
     * @param    [string]                   $ar_number [代理商ID]
     * @return   [Array]                     [返回某一个代理商的详细信息]
     */
    public function getByid_Record ($ar_number="")
    {
        if($ar_number==""){
            if($this->data['ar_number']=="0"){
                
            }else{
                $ar_number=$this->data['ar_number'];
                
                $sql = 'SELECT * FROM "T_Agents_Record_'.$this->data['start'].'" WHERE ar_number=:ar_number';
                $sth = $this->pdo->prepare ( $sql );
                $sth->bindValue ( ':ar_number' , $ar_number);
                try{
                    $sth->execute ();
                } catch (Exception $exc) {
                    if($exc->getCode()=="42P01"){
                       $result['msg']=L("该月份报表不存在")."。。。(；′⌒`)";
                       $result['status']=-1;
                       return $result;
                    }
                }
                $result = $sth->fetch();
                return $result;
            }
        }
       
    }
/**
 * [获得符合条件的所有代理商信息]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T11:56:55+0800
 * @param    string                   $limit [分条查询条件]
 * @return   [Array]                          [返回一个二维数组,存储所有代理商信息]
 */
    public function getList ( $limit = "" )
    {
        $sql = 'SELECT * FROM "T_Agents"';
        $sql = $sql . $this->getwhere ( true );
        $sql = $sql . $limit;
        $stat = $this->pdo->query ( $sql );
        $result = $stat->fetchAll ( PDO::FETCH_ASSOC );
        return $result;
    }
    /**
     * [获取某一个月的所有代理商信息]
     * @Author   longfei.wang
     * @DateTime 2015-12-03T11:58:31+0800
     * @param    string                   $limit [分条查询条件]
     * @return   [array]                          [返回一个二维数组,存储所有代理商信息]
     */
    public function getList_one ( $limit = "" )
    {
        $sql = "SELECT * FROM \"T_Agents_Record_{$this->data['start']}\" WHERE ar_parent_id='0' AND ar_level='0'";
        //$sql = $sql . $this->getwhere ( true );
        //$sql = $sql . $limit;
        $area = new area ( $_REQUEST );
        $where = $area->getAcl ( 'ar_area' , $_SESSION['own']['om_area'] );
        $sql .=$where;
        $stat = $this->pdo->query ( $sql );
        $result = $stat->fetchAll ( PDO::FETCH_ASSOC );
        return $result;
    }
    /**
     * 获取当前代理商下的所属下级代理
     * @param string $limit [分条查询条件]
     * @return array [返回一个二维数组,存储所有代理商信息]
     */
    public function getList_ag ( $limit = "" )
    {
        $sql = 'SELECT * FROM "T_Agents"';
        $sql = $sql . $this->getagwhere ( true );
        $sql = $sql . $limit;
        $stat = $this->pdo->query ( $sql );
        $result = $stat->fetchAll ( PDO::FETCH_ASSOC );
        return $result;
    }
    /*
    public function getagList ( $limit = "" )
    {
        $sql = 'SELECT * FROM "T_Agents"';
        $sql = $sql . $this->getagwhere ( true );
        $sql = $sql . $limit;
        $stat = $this->pdo->query ( $sql );
        $result = $stat->fetchAll ( PDO::FETCH_ASSOC );
        return $result;
    }*/

    /**
     * 获得所有一级代理商
     * @param string $limit [分条查询条件]
     * @return array [返回一个二维数组,存储所有代理商信息]
     */
    public function getAllag ()
    {
        $sql = 'SELECT * FROM "T_Agents"';
//        $sql = $sql . $this->getagwhere ( true );
//        $sql = $sql . $limit;
        $where = " WHERE ag_level = '0'";
        $sql.=$where;
        $stat = $this->pdo->query ( $sql );
        $result = $stat->fetchAll ( PDO::FETCH_ASSOC );
        return $result;
    }
/**
 * [返回 某一代理商层级关系的Where 筛选条件]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:25:08+0800
 * @param    boolean                  $order [是否排序]
 * @return   [string]                          [Where SQL 条件语句]
 */
    public function getagwhere ( $order = false )
    {
        //$where = " WHERE 1=1 AND ag_parent_id LIKE E'%" . $this->data['aggents_number'] . "%'";
        $where = " WHERE 1=1 AND ag_path LIKE E'%|{$this->data['aggents_number']}|%' AND ag_level > '{$this->data['ag_level']}'";
        if ( $this->data["ag_number"] != "" )
        {
            $where .= " AND ag_number LIKE E'%" . addslashes(trim ( $this->data["ag_number"] )) . "%'";
        }

        if ( $this->data["ag_name"] != "" )
        {
            $where .= " AND ag_name LIKE E'%" . addslashes(trim ( $this->data["ag_name"] )) . "%'";
        }
        if ( $this->data["ag_id"] != "" )
        {
            $where .= " AND ag_id LIKE E'%" . addslashes(trim ( $this->data["ag_id"] )) . "%'";
        }
        if ( $this->data["ag_phone"] != "" )
        {
            $where .= " AND ag_phone LIKE E'%" . addslashes(trim ( $this->data["ag_phone"] )) . "%'";
        }
        if ( $this->data["ag_mail"] != "" )
        {
            $where .= " AND ag_mail LIKE E'%" . addslashes(trim ( $this->data["ag_mail"] )) . "%'";
        }
        if ( $this->data["ag_admin_name"] != "" )
        {
            $where .= " AND ag_admin_name = '" . $this->data["ag_admin_name"] . "'";
        }
        if(!strstr($_SESSION['own']['om_area'], "#")){
            $area = new area();
            $where .= $area->getAcl('ag_area', $_SESSION['own']['om_area']);
            //$where .= " AND ag_area LIKE E'%" . addslashes($this->data["ag_admin_name"]) . "%'";
        }
        if ( $order )
        {
            $where .= ' ORDER BY ag_number';
        }

        return $where;
    }
    /**
     * [返回 一代理商层级关系的Where 筛选条件]
     * @Author   longfei.wang
     * @DateTime 2015-12-03T13:25:08+0800
     * @param    boolean                  $order [是否排序]
     * @return   [string]                          [Where SQL 条件语句]
     */
    public function getwhere ( $order = false )
    {
        //$where = " WHERE 1=1 AND ag_parent_id LIKE E'%" . $this->data['aggents_number'] . "%'";
        $where = " WHERE 1=1 AND ag_path LIKE E'%|0|%' AND ag_level >= '0'";
        if ( $this->data["ag_number"] != "" )
        {
            $where .= " AND ag_number LIKE E'%" . addslashes(trim ( $this->data["ag_number"] )) . "%'";
        }

        if ( $this->data["ag_name"] != "" )
        {
            $where .= " AND ag_name LIKE E'%" . addslashes(trim ( $this->data["ag_name"] )) . "%'";
        }
        if ( $this->data["ag_id"] != "" )
        {
            $where .= " AND ag_id LIKE E'%" . addslashes(trim ( $this->data["ag_id"] )) . "%'";
        }
        if ( $this->data["ag_phone"] != "" )
        {
            $where .= " AND ag_phone LIKE E'%" . addslashes(trim ( $this->data["ag_phone"] )) . "%'";
        }
        if ( $this->data["ag_mail"] != "" )
        {
            $where .= " AND ag_mail LIKE E'%" . addslashes(trim ( $this->data["ag_mail"] )) . "%'";
        }
        if ( $this->data["ag_admin_name"] != "" )
        {
            $where .= " AND ag_admin_name LIKE E'%" . addslashes($this->data["ag_admin_name"]) . "%'";
        }
        if(!strstr($_SESSION['own']['om_area'], "#")){
            $area = new area();
            $where .= $area->getAcl('ag_area', $_SESSION['own']['om_area']);
            //$where .= " AND ag_area LIKE E'%" . addslashes($this->data["ag_admin_name"]) . "%'";
        }
        $area = new area ( $_REQUEST );
        $where .= $area->getAcl ( 'ag_area' , $_SESSION['own']['om_area'] );
        if ( $order )
        {
            $where .= ' ORDER BY ag_number';
        }
        return $where;
    }
    /**
     * [返回 某一代理商父级(上一级)关系的Where 筛选条件]
     * @Author   longfei.wang
     * @DateTime 2015-12-03T13:25:08+0800
     * @param    boolean                  $order [是否排序]
     * @return   [string]                          [Where SQL 条件语句]
     */
    public function getwhere_ag ( $order = false )
    {
        //$where = " WHERE 1=1 AND ag_parent_id LIKE E'%" . $this->data['aggents_number'] . "%'";
        $where = " WHERE 1=1 AND ag_parent_id='{$this->data['aggents_number']}'";
        if ( $this->data["ag_number"] != "" )
        {
            $where .= " AND ag_number LIKE E'%" . addslashes(trim ( $this->data["ag_number"] )) . "%'";
        }

        if ( $this->data["ag_name"] != "" )
        {
            $where .= " AND ag_name LIKE E'%" . addslashes(trim ( $this->data["ag_name"] )) . "%'";
        }
        if ( $this->data["ag_id"] != "" )
        {
            $where .= " AND ag_id LIKE E'%" . addslashes(trim ( $this->data["ag_id"] )) . "%'";
        }
        if ( $this->data["ag_phone"] != "" )
        {
            $where .= " AND ag_phone LIKE E'%" . addslashes(trim ( $this->data["ag_phone"] )) . "%'";
        }
        if ( $this->data["ag_mail"] != "" )
        {
            $where .= " AND ag_mail LIKE E'%" . addslashes(trim ( $this->data["ag_mail"] )) . "%'";
        }
        if ( $this->data["ag_admin_name"] != "" )
        {
            $where .= " AND ag_admin_name = '" . $this->data["ag_admin_name"] . "'";
        }
        if ( $order )
        {
            $where .= ' ORDER BY ag_number';
        }

        return $where;
    }
/**
 * [获取 代理商的总数]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:33:53+0800
 * @return   [integer]                   [返回当前 所有代理商的个数]
 */
    public function getTotal ()
    {
        $sql = "SELECT COUNT(ag_number) AS total FROM \"T_Agents\"";
/*
        if ( $flag )
        {
            $sql = $sql . $this->getWhere ();
        }
        else
        {
            if ( $this->data["e_id"] != "" )
            {
                $sql = $sql . "WHERE u_e_id =" . $this->data["e_id"];
                $sql = $sql . $this->getWhere ();
            }
        }*/
        $sql = $sql . $this->getWhere ();
        $pdoStatement = $this->pdo->query ( $sql );
        $result = $pdoStatement->fetch ();
        
        return $result["total"];
    }

    /**
      public function getagNum ()
      {
      $sql = 'SELECT nextval(\'"T_Agents_ag_number_seq"\'::regclass)';
      $sth = $this->pdo->query ( $sql );
      $result = $sth->fetch ();
      return $result["nextval"];
      }
     */
    /**
     * [获得 当前代理商ID号(有大到小)]
     * @Author   longfei.wang
     * @DateTime 2015-12-03T13:35:49+0800
     * @return   [array]                   [当前代理商ID号(有大到小)数组]
     */
    public function getagNum ()
    {
        $sql = "SELECT ag_number FROM \"T_Agents\" WHERE ag_level='0' ORDER BY  ag_number desc";
        $sth = $this->pdo->query ( $sql );
        $result = $sth->fetchALL ( PDO::FETCH_ASSOC );
        return $result;
    }
/**
 * [代理商 保存(新建,编辑)]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:37:23+0800
 * @return   [array]                   [返回的 操作结果]
 */
    public function save ()
    {
        if ( $this->data["do"] == 'edit' )
        {
            $sql = <<<ECHO
                    UPDATE "T_Agents"
                        SET
                        ag_name=:ag_name,
                        ag_pswd=:ag_pswd,
                        ag_user_num=:ag_user_num,
                        ag_phone_num=:ag_phone_num,
                        ag_dispatch_num=:ag_dispatch_num,
                        ag_gvs_num=:ag_gvs_num,
                        ag_path=:ag_path,
                        ag_area=:ag_area,
                        ag_phone=:ag_phone,
                        ag_admin_name=:ag_admin_name,
                        ag_mail=:ag_mail,
                        ag_lastlogin_time=:ag_lastlogin_time,
                        ag_logo=:ag_logo,
                        ag_addr=:ag_addr,
                        ag_username=:ag_username,
                        ag_conname=:ag_conname,
                        ag_fox=:ag_fox,
                        ag_remark=:ag_remark
                    WHERE ag_number=:ag_number
ECHO;
            $sth = $this->pdo->prepare ( $sql );
            $sth->bindValue ( ':ag_number' , $this->data['ag_number'] );
            //$sth->bindValue ( ':ag_id' , $this->data['ag_id'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_name' , $this->data['ag_name'] );
            $sth->bindValue ( ':ag_pswd' , $this->data['ag_pswd'] );
            $sth->bindValue ( ':ag_user_num' , $this->data['ag_user_num'] , PDO::PARAM_INT );
            $sth->bindValue ( ':ag_phone_num' , $this->data['ag_phone_num'] , PDO::PARAM_INT );
            $sth->bindValue ( ':ag_dispatch_num' , $this->data['ag_dispatch_num'] , PDO::PARAM_INT );
            $sth->bindValue ( ':ag_gvs_num' , $this->data['ag_gvs_num'] , PDO::PARAM_INT );
//            $sth->bindValue ( ':ag_parent_id' , $this->data['ag_parent_id'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_path' , $this->data['ag_path'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_area' , $this->data['ag_area'] );
            $sth->bindValue ( ':ag_phone' , $this->data['ag_phone'] );
            $sth->bindValue ( ':ag_admin_name' , $this->data['ag_username'].$this->data['ag_conname'] );
            $sth->bindValue ( ':ag_mail' , $this->data['ag_mail'] );
            $sth->bindValue ( ':ag_lastlogin_time' , date ( "Y-m-d H:i:s" , time () ) );
            $sth->bindValue ( ':ag_logo' , $this->data['ag_logo'] );
            //$sth->bindValue ( ':ag_level' , $this->data['ag_level'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_addr' , $this->data['ag_addr'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_username' , $this->data['ag_username'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_conname' , $this->data['ag_conname'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_fox' , $this->data['ag_fox'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_remark' , $this->data['ag_remark'] , PDO::PARAM_STR );
            
             try {
             $sth->execute ();
            } catch (Exception $exc) {
                            $log = DL('编辑代理商【%s】%s 失败');
                $log = sprintf ( $log
                          ,$this->data['ag_name']
                          , $this->data['ag_number']
                  );
                  $this->log ( $log , 9 , 0 );
                   $msg['msg'] = L('编辑代理商【%s】%s 失败');
                    $msg['msg'] = sprintf ( $msg['msg']
                           ,$this->data['ag_name']
                           , $this->data['ag_number']
                   );
                    if($exc->getCode()==23505){
                        $msg['msg'] .= " ".L('原因:帐号重复');
                    }
                    $msg['status']=-1;
                    return $msg;
            }
            $log = DL('编辑代理商【%s】%s 成功');
            $log = sprintf ( $log
                      ,$this->data['ag_name']
                      , $this->data['ag_number']
              );
          $this->log ( $log , 9 , 0 );
           $msg['msg'] = L('编辑代理商【%s】%s 成功');
                    $msg['msg'] = sprintf ( $msg['msg']
                           ,$this->data['ag_name']
                           , $this->data['ag_number']
                   );
           $msg['status']=0;
                    return $msg;
        }
        else
        {
            $sql = <<<ECHO
INSERT INTO "T_Agents" (
        "ag_number",
        "ag_name",
        "ag_pswd",
        "ag_user_num",
        "ag_phone_num",
        "ag_dispatch_num",
        "ag_gvs_num",
        "ag_parent_id",
        "ag_path",
        "ag_area",
        "ag_status",
        "ag_phone",
        "ag_admin_name",
        "ag_mail",
        "ag_lastlogin_time",
        "ag_logo",
        "ag_level",
        "ag_addr",
        "ag_username",
        "ag_conname",
        "ag_fox",
        "ag_log_stat",
        "ag_create_time",
        "ag_remark"
            )
VALUES (
    :ag_number,
                :ag_name,
                :ag_pswd,
                :ag_user_num,
                :ag_phone_num,
                :ag_dispatch_num,
                :ag_gvs_num,
                :ag_parent_id,
                :ag_path,
                :ag_area,
                :ag_status,
                :ag_phone,
                :ag_admin_name,
                :ag_mail,
                :ag_lastlogin_time,
                :ag_logo,
                :ag_level,
                :ag_addr,
                :ag_username,
                :ag_conname,
                :ag_fox,
                :ag_log_stat,
                :ag_create_time,
                :ag_remark
                    );
ECHO;
            if ( $this->data['ag_path'] == "" )
            {
                $this->data['ag_path'] = "|0|" . "|" . $this->data['ag_number'] . "|";
            }
            else
            {
                $this->data['ag_path'] = $this->data['ag_path'] . "|" . $this->data['ag_number'] . "|";
            }
            if ( $this->data['ag_level'] == "" )
            {
                $this->data['ag_level'] = 0;
            }
            if ( $this->data['ag_fox'] == "" )
            {
                $this->data['ag_fox'] = null;
            }
            if ( $this->data['ag_user_num'] == "" )
            {
                $this->data['ag_user_num'] = null;
            }
            $this->data['ag_area'] = "[\"" . $this->data['ag_area'] . "\"]";
            $sth = $this->pdo->prepare ( $sql );
            $sth->bindValue ( ':ag_number' , $this->data['ag_number'] );
            //$sth->bindValue ( ':ag_id' , $this->data['ag_id'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_name' , $this->data['ag_name'] );
            $sth->bindValue ( ':ag_pswd' , $this->data['ag_pswd'] );
            $sth->bindValue ( ':ag_user_num' , $this->data['ag_user_num'] , PDO::PARAM_INT );
            $sth->bindValue ( ':ag_phone_num' , $this->data['ag_phone_num'] , PDO::PARAM_INT );
            $sth->bindValue ( ':ag_dispatch_num' , $this->data['ag_dispatch_num'] , PDO::PARAM_INT );
            $sth->bindValue ( ':ag_gvs_num' , $this->data['ag_gvs_num'] , PDO::PARAM_INT );
            $sth->bindValue ( ':ag_parent_id' , $_SESSION['own']['om_id'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_path' , $this->data['ag_path'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_area' , $this->data['ag_area'] );
            $sth->bindValue ( ':ag_status' , "0" , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_phone' , $this->data['ag_phone'] );
            $sth->bindValue ( ':ag_admin_name' , $this->data['ag_username'].$this->data['ag_conname'] );
            $sth->bindValue ( ':ag_mail' , $this->data['ag_mail'] );
            $sth->bindValue ( ':ag_lastlogin_time' , date ( "Y-m-d H:i:s" , time () ) );
            $sth->bindValue ( ':ag_logo' , $this->data['ag_logo'] );
            $sth->bindValue ( ':ag_level' , $this->data['ag_level'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_addr' , $this->data['ag_addr'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_username' , $this->data['ag_username'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_conname' , $this->data['ag_conname'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_fox' , $this->data['ag_fox'] , PDO::PARAM_STR );
            $sth->bindValue ( ':ag_log_stat' , 1 , PDO::PARAM_INT );
            $sth->bindValue ( ':ag_create_time' , date ( "Y-m-d" , time () ) );
            $sth->bindValue ( ':ag_remark' , $this->data['ag_remark'] , PDO::PARAM_STR );
            
            try {
                    $sth->execute ();
                } catch (Exception $exc) {
                    $log = DL('新增代理商【%s】%s 失败');
                                        $log = sprintf ( $log
                              ,$this->data['ag_name']
                              , $this->data['ag_number']
                      );
                    $this->log ( $log , 9 , 0 );
                    $msg['msg'] = L('新增代理商【%s】%s 失败');
                    $msg['msg'] = sprintf ( $msg['msg']
                           ,$this->data['ag_name']
                           , $this->data['ag_number']
                   );
                    if($exc->getCode()==23505){
                        $msg['msg'] .= " ".L('原因:帐号重复');
                    }
                    $msg['status']=-1;
                    return $msg;
                }
                $this->initlog();
                $log = DL('新增代理商【%s】%s 成功');
                $log = sprintf ( $log
                          ,$this->data['ag_name']
                          , $this->data['ag_number']
                  );
          $this->log ( $log , 9 , 0 );
          $msg['msg'] = L('新增代理商【%s】%s 成功');
                    $msg['msg'] = sprintf ( $msg['msg']
                           ,$this->data['ag_name']
                           , $this->data['ag_number']
                   );
           $msg['status']=0;
                    return $msg;
        }
        //$data['ag_number'] = $this->getagNum ();
       
    }

    /**
      public function delList ( $list )
      {

      $list = str_replace ( "," , "','" , "'" . $list );
      $list = rtrim ( $list , ",'" );
      $list .= "'";
      $sql = 'DELETE FROM "T_Agents" WHERE "T_Agents".ag_number IN (' . $list . ')';
      $count = $this->pdo->exec ( $sql );
      $log = '删除了企业管理员【%s】企业ID【%s】';
      $listarr = explode ( $log , $list );
      foreach ( $listarr as $value )
      {
      $log = sprintf ( $log
      , str_replace ( "'" , '' , $value )
      , $_REQUEST['e_id']
      );
      }
      $this->log ( $log , 1 , 1 );
      return $count;
      }
     */
    /**
     * [代理商的批量删除 接口<br />用于Ajax 交互]
     * @Author   longfei.wang
     * @DateTime 2015-12-03T13:39:02+0800
     * @param    [array]                   $list [代理商ID 数组]
     * @return   [integer]                         [返回成功删除的总个数]
     */
    public function delList ( $list )
    {

        $count = 0;
        foreach ( $list as $value )
        {
            $this->data['ag_number'] = $value;
            $result = $this->delAgents ();
            $count += $result['u'];
        }
        return $count;
    }
    
    /**
     * 判断当前代理商时候有子代理已及创建的企业
     * @return integer 返回已有 子代理和自建企业的个数
     */
    public function getchild($ag_id){
        $sql="SELECT COUNT(ag_number) FROM \"T_Agents\" WHERE ag_parent_id='{$ag_id}'";
        $sth = $this->pdo->query ( $sql );
        $result = $sth->fetch ( PDO::FETCH_ASSOC );

        $sql1="SELECT COUNT(e_id) FROM \"T_Enterprise\" WHERE e_create_name='{$ag_id}'";
        $sth1 = $this->pdo->query ( $sql1 );
        $result1 = $sth1->fetchALL ( PDO::FETCH_ASSOC );
        $res=$result['count']+$result1['count'];
        return $res;
    }
/**
 * [代理商的实际删除]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:42:39+0800
 * @return   [array]                   [实际删除结果]
 */
    public function delAgents ()
    {
        $ag_name=  $this->getByid($this->data['ag_number']);
        $count = array ();
        $sql = 'DELETE FROM "%s" WHERE ag_number = %s';
        $sql = sprintf ( $sql , 'T_Agents' , sprintf ( "'%s'" , $this->data['ag_number'] ) );
        // $sql = sprintf ( "'%s'" , $this->data['ag_number'] );
        try {
           $count['u'] = $this->pdo->exec ( $sql ); 
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        $log = DL('删除代理商【%s】%s 成功');
        $log = sprintf ( $log
                  ,$ag_name['ag_name']
                  , $this->data['ag_number']
          );
          $this->log ( $log , db::USER , db::INFO );
        return $count;
        
        
        /*
          $sql = 'DELETE FROM "%s" WHERE pm_number = %s';
          $sql = sprintf ( $sql , 'T_PttMember_' . $this->data['e_id'] , sprintf ( "'%s'" , $this->data['u_number'] ) );
          $count['p'] = $this->pdo->exec ( $sql );
         *
         */
       
    }
/**
 * [获得 所有代理商的信息 以及它们的许可权限]
 * @Author   longfei.wang
 * @DateTime 2015-12-03T13:44:08+0800
 * @return   [array]                   [返回所有代理商 以及其许可权限的数组]
 */
    public function getoptionlist ()
    {
        $this->data['ag_number'] = 0;
        $sql = 'SELECT * FROM "T_Agents" WHERE ag_parent_id = \'' . $this->data['ag_number'] . '\'';
        $stat = $this->pdo->query ( $sql );
        $result = $stat->fetchAll ( PDO::FETCH_ASSOC );
        foreach ( $result as $key => $val )
        {
            //获取当前代理商所有企业对应的用户数
            $ep = new enterprise ( array ( 'ag_number' => $val['ag_number'] ) );
            $info = $ep->getList_ag ();
            $phone_num = 0;
            $dispatch_num = 0;
            $gvs_num = 0;
            foreach ( $info as $k => $v )
            {
                $phone_num +=$v['e_mds_phone'];
                $dispatch_num +=$v['e_mds_dispatch'];
                $gvs_num +=$v['e_mds_gvs'];
            }
            //获取当前代理商所有下级代理对应的用户数
            // $agents = new agents ( array ( 'aggents_number' => $val['ag_number'] , 'ag_level' => $val['ag_level'] ) );
            $this->set(array ( 'aggents_number' => $val['ag_number'] , 'ag_level' => $val['ag_level'] ) );
            $info_ag = $this->getList_ag ();
            foreach ( $info_ag as $kk => $vv )
            {
                $phone_num +=$vv['ag_phone_num'];
                $dispatch_num +=$vv['ag_dispatch_num'];
                $gvs_num +=$vv['ag_gvs_num'];
            }


            $result[$key]['ag_e_phone'] = $phone_num;
            $result[$key]['ag_e_dispatch'] = $dispatch_num;
            $result[$key]['ag_e_gvs'] = $gvs_num;
        }

        return $result;
    }
    /**
     * [创建代理商副表 代理商日志]
     * @Author   longfei.wang
     * @DateTime 2015-12-03T13:47:13+0800
     * @param    string                   $ag_number [代理商ID]
     * @return   [Array]                              [返回操作结果]
     */
    public function initlog($ag_number=""){
        if ($ag_number == "") {
               $ag_number=$this->data['ag_number'];
        }
        if ($ag_number == "") {
                throw new Exception("Incorrect agents Numbers", -1);
        }
        
        $dc_elsql = '
            DROP TABLE
            IF EXISTS "public"."T_EventLog_:ag_number";

            CREATE TABLE "public"."T_EventLog_:ag_number" (
            "el_id" serial NOT NULL,
            "el_type" varchar(16),
            "el_level" int4,
            "el_time" timestamp(6),
            "el_content" varchar(1024),
            "el_user" varchar(64)
            )
            WITH (OIDS=FALSE)
            ;';
        $dc_elsql = str_replace(":ag_number", $ag_number, $dc_elsql);
        try
            {
//开启一个事务
                    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->pdo->beginTransaction();
                    //$this->pdo->exec($dc_usql);
                    $this->pdo->exec($dc_elsql);
                    $this->pdo->commit();
            } catch (Exception $ex) {
                    $this->pdo->rollBack();
                    throw new Exception("Create failure, data rollback" . $ex->getMessage(), -2);
            }

            $msg["status"] = 0;
            $msg["msg"] = L("初始化成功");
            return $msg;
}

 public function get_can_name(){
            $sql="SELECT * FROM \"T_Agents\" WHERE ag_number = '{$this->data['name']}' OR ag_name='{$this->data['name']}'";
            $sql1="SELECT * FROM \"T_Agentsub\" WHERE as_account_id = '{$this->data['name']}'";
            $stat=$this->pdo->query($sql);
            $stat1=$this->pdo->query($sql1);
            $result = $stat->fetchAll ();
            $result1 = $stat1->fetchAll ();
            if(count($result)==0 && count($result1)==0 || $this->data['ag_number']==$result[0]['ag_number']){
                return true;
            }else{
                return FALSE;
            }
//            if($result)
        }

}
