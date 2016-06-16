<?php
/**
 * 系统实体类，包含 登录，检查异地登录，注销，检查管理员权限，修改密码，显示公告
 * @package Common Model
 * @require {@see db}
 */
class system extends db {

    public function __construct($data = NULL) {
            parent::__construct();
            $this->data = $data;
    }

    public function login() {
            if (isset($_SESSION['om_id'])) {
                    echo $_SESSION['om_id'];
                    return 1;
            } else {
                    return 0;
            }
    }

    public function checkOtherLogin($own) {
            $sql = 'SELECT om_lastlogin_ip FROM "T_OperationManager" WHERE om_id = :om_id ';
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':om_id', $own["om_id"], PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetch();
            $sql3 = 'SELECT * FROM "T_LoginCheck" WHERE c_om_id = :c_om_id';
            $sth3 = $this->pdo->prepare($sql3);
            $sth3->bindValue(':c_om_id', $own["om_id"], PDO::PARAM_STR);
            $sth3->execute();
            $result1 = $sth3->fetch(PDO::FETCH_ASSOC);
                    if ($result === false) {
                            $info['msg'] = L('尚未登陆,请先登陆');
                            $this->log(sprintf(DL('尚未登陆,请先登陆'), $info['om_lastlogin_ip'], $info['db_om_lastlogin_ip']), 7, 1);
                            $info['id'] = TRUE;
                    } else {
                            $info['db_om_lastlogin_ip'] = $result['om_lastlogin_ip'];
                            $info['om_lastlogin_ip'] = $own['om_lastlogin_ip'];
                            if ($result1['c_sessionid'] == session_id()) {
                                    $info['status'] = FALSE;
                            } else {
                                    $info['msg'] = L('您的帐号已在别处登录');
                                    $this->log(sprintf(DL('该帐户已在其他地方登录 本地IP： 【%s】 异地IP： 【%s】'), $info['om_lastlogin_ip'], $info['db_om_lastlogin_ip']), 7, 1);
                                    $info['status'] = TRUE;
                            }
                    }

    return $info;
    }

    //验证登陆
    public function checkLogin() {
            $sql4 = 'SELECT * FROM "T_OperationManager" WHERE om_id = :username ';
            $sql3 = 'SELECT * FROM "T_LoginCheck" WHERE c_om_id = :c_om_id';
            $sth3 = $this->pdo->prepare($sql3);
            $sth3->bindValue(':c_om_id', $this->data["username"], PDO::PARAM_STR);
            $sth3->execute();
            $result3 = $sth3->fetch(PDO::FETCH_ASSOC);

            $sth4 = $this->pdo->prepare($sql4);
            $sth4->bindValue(':username', $this->data["username"], PDO::PARAM_STR);
            $sth4->execute();
            $result4 = $sth4->fetch(PDO::FETCH_ASSOC);

            if ($result4) {
                    if ($this->data["password"] !== $result4['om_pswd']) {
                            $this->log(DL('密码错误'), 7, 2, $result);
                            return -2;
                    } else {
                            $_SESSION['om_id'] = $result4["username"];
                            $result4['om_lastlogin_ip'] = $_SERVER["REMOTE_ADDR"];
                            $_SESSION['own'] = $result4;
                            $_SESSION['time']=time();
                            $_SESSION['own']['om_lastlogin_time']=date("Y-m-d H:i:s",  time());
							
                            $data['om_lastlogin_time'] = date('Y-m-d H:i:s');
                            $data['om_lastlogin_ip'] = $_SERVER["REMOTE_ADDR"];
                            $sessionid = session_id();
                            $c_om_id = $this->data["username"];
                            if ($result3 == false) {
                                    $sql1 = 'INSERT INTO "T_LoginCheck" ("c_om_id","c_sessionid") VALUES(:c_om_id,:c_sessionid)';
                                    $sth1 = $this->pdo->prepare($sql1);
                                    $sth1->bindValue(":c_om_id", $c_om_id, PDO::PARAM_STR);
                                    $sth1->bindValue(":c_sessionid", $sessionid, PDO::PARAM_STR);
                                    $sth1->execute();
                            } else {
                                    $sql2 = 'UPDATE "T_LoginCheck" SET c_sessionid=:c_sessionid WHERE  c_om_id=:c_om_id';
                                    $sth2 = $this->pdo->prepare($sql2);
                                    $sth2->bindValue(':c_om_id', $c_om_id);
                                    $sth2->bindValue(':c_sessionid', $sessionid);
                                    $sth2->execute();
                            }
                            $sql_upd = 'UPDATE "T_OperationManager"SET om_lastlogin_ip = :user_ip,om_lastlogin_time = :lastlogintime WHERE om_id = :username';
                            $sth = $this->pdo->prepare($sql_upd);
                            $sth->bindValue(':username', $this->data["username"], PDO::PARAM_STR);
                            $sth->bindValue(':user_ip', $data['om_lastlogin_ip'], PDO::PARAM_STR);
                            $sth->bindValue(':lastlogintime', $data['om_lastlogin_time'], PDO::PARAM_STR);
                            $data = $sth->execute();
                            $this->log(DL('登录成功') . '。 IP：' . $_SERVER["REMOTE_ADDR"], 7);
                            return 0;
                    }
            } else {
                    return -1;
            }
    }

//配置管理员信息
    public function superAdmin() {
            if ($this->data["pwd"] != $this->data["rpwd"]) {
                    return "pwd";
            } else {
                    $sql = 'INSERT INTO "public"."T_OperationManager" ("om_id", "om_pswd") VALUES (:user, :pwd)';
                    $sth = $this->pdo->prepare($sql);
                    $sth->bindValue(':user', $this->data["user"], PDO::PARAM_INT);
                    $sth->bindValue(':pwd', $this->data["pwd"], PDO::PARAM_STR);
                    $data = $sth->execute();
                    if ($data) {
                            return $this->data["user"];
                    }
            }
    }

    //修改密码
    public function chgPwd() {
            if ($_SESSION['own']['om_pswd'] != $this->data['old_pwd']) {
                    $msg['status'] = -1;
                    $msg['msg'] = L('原密码不正确');
                    $this->log(DL($msg['msg']), 7, 0);
            } else if ($this->data['new_pwd'] !== $this->data['new_rpwd']) {
                    $msg['status'] = -1;
                    $msg['msg'] = L('新密码两次输入不一致');
                    $this->log(DL($msg['msg']), 7, 0);
            } else {
                    $om_id = $_SESSION['own']['om_id'];
                    $sql = 'UPDATE "T_OperationManager"SET om_pswd = :om_pwd WHERE om_id = :username';
                    $sth = $this->pdo->prepare($sql);
                    $sth->bindValue(':om_pwd', $this->data['new_pwd']);
                    $sth->bindValue(':username', $om_id);
                    $sth->execute();
                    $msg['status'] = 1;
                    $msg['msg'] = L('密码修改成功');
                    $this->log(DL($msg['msg']), 7, 0);
            }

            return $msg;
            /*
    $om_id = $_SESSION['own']['om_id'];
    $sql = 'SELECT* FROM "T_OperationManager" WHERE om_id = :username ';
    $sth = $this->pdo->prepare($sql);
    $sth->bindValue(':username', $om_id, PDO::PARAM_STR);
    $sth->execute();
    $result = $sth->fetch();
    if ($result) {
    if ($this->data["old_pwd"] != $result['om_pswd']) {
    $this->log($_SESSION['own']['om_id'] . '修改密码失败', 7, 1);
    return 0;
    } else {
    if ($this->data['new_pwd'] == $this->data['new_rpwd']) {
    $sql_upd = 'UPDATE "T_OperationManager"SET om_pswd = :om_pwd WHERE om_id = :username';
    $sth = $this->pdo->prepare($sql_upd);
    $sth->bindValue(':om_pwd', $this->data['new_pwd']);
    $sth->bindValue(':username', $om_id);
    $sth->execute();

    $this->log($_SESSION['own']['om_id'] . '修改密码成功', 7);
    return 1;
    } else {
    return 2;
    }
    }
    } else {

    }
     *
     */
    }

    function getWhere($order = false) {
            $where = " WHERE 1=1 ";
            $where .= "AND am_id  = " . "'" . $var . "'";
            if ($order) {
                    $where .= ' ORDER BY am_id desc ';
            }

            return $where;
    }

    //获取信息
    public function getList() {
            //@ 该函数即将过时 2014-09-16 10:47:19
            //return NULL;
            $om_id = $_SESSION['own']['om_id'];
            $sql = 'SELECT* FROM "T_OperationManager" WHERE om_id = :username ';
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':username', $om_id, PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetch();
            return $result;
    }

    private function getByArea($str) {
            // @即将过时 2014-09-16
            if (!empty($str)) {
                    $sql = 'SELECT "am_name" FROM "T_AreaManage" WHERE am_id in(' . $str . ')';
                    $sth = $this->pdo->query($sql);
                    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
                    $area = '';
                    foreach ($data as $item) {
                            $area .= $item['am_name'] . " ";
                    }
                    return $area;
            }
    }

    //公告列表
    public function getAnWhere($order = false) {
            $area = new area($_REQUEST);
            $where = " WHERE an_status = 1";
            $where .= $area->getAcl('an_area', $_SESSION['own']['om_area']);
            if ($order) {
                    $where .= "ORDER BY an_time DESC";
            }
            return $where;
    }

    public function getAnList($limit) {
            $sql = 'SELECT * FROM "T_Announcement"';
            $sql .= $this->getAnWhere(TRUE);
            $sql .= $limit;
            $sth = $this->pdo->query($sql);
            $result = $sth->fetchAll();

            return $result;
            // @以下将过时
            $om_id = $_SESSION['own']['om_id'];
            $sql = 'SELECT* FROM "T_OperationManager" WHERE om_id = :username ';
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':username', $om_id, PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetchAll();

            foreach ($result as &$item) {
                    $areaid = str_replace('|', ',', trim($item['om_area'], '|'));
                    $item['om_area'] = $item['om_area'] == 0 ? 全部 : $areaid;
            }
            if ($result[0]['om_area'] == "全部") {
                    $sql = 'SELECT * FROM"public"."T_Announcement" WHERE  an_status = 1';
            } else {
                    $sql = 'SELECT * FROM "T_Announcement" WHERE an_area_id in(' . $areaid . ') AND an_status = 1';
            }

            $sql = $sql . $limit;
            $pdoStatement = $this->pdo->query($sql);
            $result = $pdoStatement->fetchAll();
            return $result;
    }

    public function getAnTotal() {
            $sql = 'SELECT COUNT(an_id) AS total FROM "T_Announcement"';
            $sql .= $this->getAnWhere();

            $sth = $this->pdo->query($sql);
            $result = $sth->fetch();

            return $result["total"];
    }

//统计条数
    public function getTotal() {
            $om_id = $_SESSION['own']['om_id'];
            $sql = 'SELECT* FROM "T_OperationManager" WHERE om_id = :username';
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':username', $om_id, PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetchAll();
            //重组变量
            foreach ($result as &$item) {
                    $areaid = str_replace('|', ',', trim($item['om_area'], '|'));
                    $item['om_area'] = $item['om_area'] == 0 ? 全部 : $areaid;
            }
            if ($result[0]['om_area'] == "全部") {
                    $sql = 'SELECT COUNT(an_id)AS total FROM"public"."T_Announcement" WHERE  an_status = 1';
            } else {
                    $sql = 'SELECT COUNT(an_id)AS total FROM"public"."T_Announcement"WHERE an_area_id in(' . $areaid . ') AND an_status =1';
            }
            $pdoStatement = $this->pdo->query($sql);
            $result = $pdoStatement->fetch();
            return $result["total"];
    }

//查询有多少设备。
    public function getDevice() {
            $om_id = $_SESSION['own']['om_id'];
            $sql = 'SELECT* FROM "T_OperationManager" WHERE om_id = :username ';
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':username', $om_id, PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetchAll();
            //重组变量
            foreach ($result as &$item) {
                    $areaid = str_replace('|', ',', trim($item['om_area'], '|'));
                    $item['om_area'] = $item['om_area'] == 0 ? 全部 : $areaid;
            }
            if ($result[0]['om_area'] == "全部") {
                    $sql = 'SELECT COUNT(d_id)AS total FROM"public"."T_Device"';
            } else {
                    $sql = 'SELECT COUNT(d_id)AS total FROM "T_Device" WHERE d_area in(' . $areaid . ')';
            }
            //重组变量
            $pdoStatement = $this->pdo->query($sql);
            $result = $pdoStatement->fetch();
            return $result["total"];
    }

    //查询有多少企业。
    public function getEn() {
            $om_id = $_SESSION['own']['om_id'];
            $sql = 'SELECT* FROM "T_OperationManager" WHERE om_id = :username ';
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':username', $om_id, PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetchAll();
            //重组变量
            foreach ($result as &$item) {
                    $areaid = str_replace('|', ',', trim($item['om_area'], '|'));
                    $item['om_area'] = $item['om_area'] == 0 ? 全部 : $areaid;
            }
            if ($result[0]['om_area'] == "全部") {
                    $sql = 'SELECT COUNT(e_id)AS total FROM"public"."T_Enterprise"';
            } else {
                    $sql = 'SELECT COUNT(e_id)AS total FROM "T_Enterprise" WHERE e_area in(' . $areaid . ')';
            }
            //重组变量
            $pdoStatement = $this->pdo->query($sql);
            $result = $pdoStatement->fetch();
            return $result["total"];
    }

    //公告详情页
    public function pro_details() {
            $sql = 'SELECT* FROM "T_Announcement" WHERE an_id = :an_id';
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':an_id', $this->data["an_id"], PDO::PARAM_INT);
            $sth->execute();
            $data = $sth->fetch();

            return $data;
    }
    public function setsystem(){
        $tools=new tools();
        $res=$tools->ini_file ( '../private/config/config.ini' , "config" , "maintain" , $this->data['sys_maintain']=="0"?"FALSE":"TRUE" );
        if($res==false){
            $msg['status']=-1;
            $msg['msg']=L("设置失败");
        }else{
            $msg['status']=-0;
            $msg['msg']=L("设置成功");
        }
        return $msg;
    }
}
