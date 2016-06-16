<?php

/**
 * 初始化类
 * @category OMP
 * @package Common
 * @require {@see contorl};
 */
class InitContorl extends contorl
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 初始化函数，检查private/config/db.json文件是否存在，不存在则，输出初始化页面
     */
    public function init_lang ()
    {
       /*
          if (!file_exists('../private/config/db.json'))
          {
          $_REQUEST['date'] = time();
          $this->htmlrender('_init.tpl');
          }
         */
        //选择语言
        if ( ! file_exists ( '../private/config/db.json' ) )
        {
            $_REQUEST['date'] = time ();
            $this->htmlrender ( '_language.tpl' );
        }
    }

    public function init ()
    {
        $this->htmlrender('_init.tpl');
    }

    /**
     * 初始化过程中的提示信息刷新
     * @param type $str
     * @param type $flag
     * @return type
     */
    public function info($str, $flag = FALSE)
    {
        $script = '<h2 class="none">%s</h2>';
        $script = sprintf ( $script , $str );
        $script .= '<script>$("h2.show").remove();$("h2.none").removeClass("none").addClass("show");</script>';
        if ( $flag )
        {
            return $script;
        }
        echo $script;
        ob_flush();
        flush();
    }

    /**
     * 校验初始化过程中提交的数据库端口，名称，用户，密码，模式等必填项是否都填写了。未填写抛出对应异常
     * @throws Exception
     */
    public function vaild()
    {
        if ($_REQUEST['dbport'] == "")
        {
            throw new Exception('dbport is null', -1);
        }
        if ($_REQUEST['dbname'] == "")
        {
            throw new Exception('dbname is null', -1);
        }
        if ($_REQUEST['dbuser'] == "")
        {
            throw new Exception('dbuser is null', -1);
        }
        if ($_REQUEST['dbpwd'] == "")
        {
            throw new Exception('dbpwd is null', -1);
        }
        if ($_REQUEST['debug'] == "")
        {
            throw new Exception('debug is null', -1);
        }
    }

    /**
     * 写入配置文件
     * @param type $path 文件路径
     * @param type $content 文件内容
     */
    public function write($path, $content)
    {
        $file = fopen($path, 'w');
        $this->info('打开了文件 文件句柄 ' . $file);

        if (fwrite($file, $content))
        {
            $this->info('写入文件 成功');
        } else
        {
            $this->info('写入文件 失败');
        }
        if (fflush($file))
        {
            $this->info('强制刷新文件 fflush 成功');
        } else
        {
            $this->info('强制刷新文件 fflush 失败');
        }
        if (fclose($file))
        {
            $this->info('关闭文件句柄 成功');
        } else
        {
            $this->info('关闭文件句柄 失败');
        }
    }

    /**
     * 创建INI文件
     */
    public function creatINI()
    {
        $this->info('正在校验各配置项');
        $this->vaild();
        $ini = array();
        $ini['data_base']['db_host'] = $_REQUEST['dbhost'];
        $ini['data_base']['db_port'] = $_REQUEST['dbport'];
        $ini['data_base']['db_name'] = $_REQUEST['dbname'];
        $ini['data_base']['db_user'] = $_REQUEST['dbuser'];
        $ini['data_base']['db_pwd'] = $_REQUEST['dbpwd'];
        //$ini['data_base']['language'] = $_REQUEST['language'];
        if ($_REQUEST['dbtype'] != 'remote')
        {
            $ini['data_base']['db_host'] = 'localhost';
        }

        $this->info('校验完成，正在编码数据');
        $str = json_encode($ini);
        $this->info('编码完成，正在写入数据');
        $this->write('../private/config/db.json', $str);
        $this->info('写入完成');
    }

    /**
     * 初始化SHELL执行窗口
     */
    public function initshell()
    {
        $doc = <<< DOC
<!DOCTYPE html>
<html>
                <head>
                        <meta charset="UTF-8">
                <script src="?m=loader&amp;a=s&amp;do=before"></script>
                <script src="script/libs.before.js"></script>
                <link href="style/init_shell.css" rel="stylesheet" type="text/css" />
                <head>
                <body>
DOC;
        echo $doc;
        $this->info ( L ( '请稍候。正在准备资源' ) );
        if ($_REQUEST['dbtype'] == 'remote')
        {
            $host = "host=" . $_REQUEST['dbhost'] . ";";
        }

        $url = "pgsql:"
                . $host
                . "port=%port;"
                . "dbname=%dbname;"
                . "user=%username;"
                . "password=%password;";
        $url = str_replace('%port', $_REQUEST['dbport'], $url);
        $url = str_replace('%dbname', $_REQUEST['dbname'], $url);
        $url = str_replace('%username', $_REQUEST['dbuser'], $url);
        $url = str_replace('%password', $_REQUEST['dbpwd'], $url);
        //$url = str_replace ( '%language' , $_REQUEST['language'] , $url );

        $this->info ( L ( '正在与数据库进行交互' ) );
        try
        {
            $pdo = new PDO($url);
            $this->info ( L ( '交互中' ) );
        } catch (Exception $ex)
        {
            $msg = '<h1>' . L ( '与数据库交互失败' ) . '</h1><div class=\'buttons\'><a class=\'login\'>' . L ( '重新填写' ) . '</a></div>';
            $this->info($msg);
            $script = <<<S
<script>
                $(".login").click(function(){
                        top.location.href = '?m';
                 });
</script>
S;
            $this->info($script);
            exit();
        }
        $this->info ( L ( '交互成功，存储配置数据' ) );

        try
        {
            $this->creatINI();
        } catch (Exception $ex)
        {
            $this->info("文件创建失败  " . $ex->getCode() . "  " . $ex->getMessage());
            exit;
        }
        $this->info('写入未出现异常');

        $this->info('与数据库建立连接');
        $pdo = new PDO($url);
        
        $this->info('设置客户端连接编码 UTF-8');
        $pdo->query("SET client_encoding = 'UTF-8';");
        $this->info('设置连接方式');
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->info('设置异常抛出模块');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->info('开始建立管理员帐号');
        $sql = 'INSERT INTO "T_OperationManager" ("om_id","om_mail","om_phone", "om_pswd", "om_type","om_area") VALUES (:om_id,:om_mail,:om_phone, :om_pswd, :om_type,:om_area)';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':om_id', 'admin');
        $sth->bindValue(':om_mail', 'admin@zed-3.com.cn');
        $sth->bindValue(':om_phone', '13100000000');
        $sth->bindValue(':om_pswd', $_REQUEST['usrpwd']);
        $sth->bindValue(':om_type', 1, PDO::PARAM_INT);
        $sth->bindValue(':om_area', '["#"]');
        try
        {
            $sth->execute();
            $this->info('管理员帐号创建成功');
        } catch (Exception $ex)
        {
            if ($ex->getCode() == 23505)
            {
                $this->info('系统中已经存在管理员帐号');
                $this->info('正在重置密码');
                $sql = 'UPDATE "T_OperationManager" SET om_pswd = :om_pswd,om_type = :om_type,om_area = :om_area WHERE om_id = :om_id';
                $sth = $pdo->prepare($sql);
                $sth->bindValue(':om_id', 'admin');
                $sth->bindValue(':om_pswd', $_REQUEST['usrpwd']);
                $sth->bindValue(':om_type', 1, PDO::PARAM_INT);
                $sth->bindValue(':om_area', '["#"]');
                $sth->execute();
                $this->info('重置成功');
            } else
            {
                $this->info('管理员创建失败。详细原因：' . $ex->getCode());
                exit;
            }
        }
//        
//        $this->info('检查程序更新...');
//         $date=date("Y-m-d",  strtotime(date("Y-m",time())));//升级月的1号
//        /**
//         * 检查用户老数据，用户创建时间 以及停启用
//         * 1. 企业的创建时间为省级OMP的当月1号
//         * 2. 用户的创建时间为升级OMP 当月的1号
//         * 3. 用户【测试】或【商用】维持原样， 如果为【商用】那【商用时间】则为升级OMP当天
//         * 4. 用户状态全部为【启用】
//         */
//        $this->info('检查企业，更新创建时间');
//        $sql="SELECT e_id,e_create_time FROM \"T_Enterprise\" WHERE e_create_time IS NULL  AND e_id!=999999";
//        $sth=$pdo->query($sql);
//        $res_user=$sth->fetchAll(PDO::FETCH_ASSOC);
//
//        if(count($res_user)>0){
//            foreach ($res_user as $key => $value) {
//                $e_id=$value['e_id'];
//                $update_user="UPDATE \"T_Enterprise\" SET e_create_time='$date' WHERE e_id='$e_id'";
//                try {
//                   $pdo->query($update_user); 
//                } catch (Exception $exc) {
//                    echo $exc->getMessage();
//                }
//            }
//        }
//        $this->info('检查企业，更新升级内容');
//        $sql="SELECT e_id,e_create_name,e_ag_path FROM \"T_Enterprise\" WHERE e_ag_path IS NULL   AND e_id!=999999";
//        $sth=$pdo->query($sql);
//        $res_user=$sth->fetchAll(PDO::FETCH_ASSOC);
//
//        if(count($res_user)>0){
//            foreach ($res_user as $key => $value) {
//                $e_id=$value['e_id'];
//                $update_user="UPDATE \"T_Enterprise\" SET e_ag_path='|0|',e_create_name='0' WHERE e_id='$e_id'";
//                try {
//                   $pdo->query($update_user); 
//                } catch (Exception $exc) {
//                    echo $exc->getMessage();
//                }
//            }
//        }
//        $this->info('检查用户，更新创建时间');
//        //当前时间
//       
//        $sql="SELECT u_number,u_create_time FROM \"T_User\" WHERE u_create_time IS NULL OR \"length\"(u_create_time)=0";
//        $sth=$pdo->query($sql);
//        $res_user=$sth->fetchAll(PDO::FETCH_ASSOC);
//
//        if(count($res_user)>0){
//            foreach ($res_user as $key => $value) {
//                $u_number=$value['u_number'];
//                $update_user="UPDATE \"T_User\" SET u_create_time='$date' WHERE u_number='$u_number'";
//                try {
//                   $pdo->query($update_user); 
//                } catch (Exception $exc) {
//                    echo $exc->getMessage();
//                }
//
//            }
//        }
//
//        $this->info('检查用户，更新用户类型');
//        $sql="SELECT u_number,u_attr_type FROM \"T_User\" WHERE u_attr_type IS NULL OR \"length\"(u_attr_type)=0";
//        $sth=$pdo->query($sql);
//        $res_user=$sth->fetchAll(PDO::FETCH_ASSOC);
//        if(count($res_user)!=0){
//            foreach ($res_user as $key => $value) {
//                $u_number=$value['u_number'];
//                $update_user="UPDATE \"T_User\" SET u_attr_type='0',u_commercial_time='$date' WHERE u_number='$u_number'";
//                $pdo->query($update_user);
//            }
//        }
//        $this->info('检查用户，更新停启用状态');
//        $sql="SELECT u_number,u_active_state FROM \"T_User\" WHERE u_active_state IS NULL OR \"length\"(u_active_state)=0";
//        $sth=$pdo->query($sql);
//        $res_user=$sth->fetchAll(PDO::FETCH_ASSOC);
//        if(count($res_user)!=0){
//            foreach ($res_user as $key => $value) {
//                $u_number=$value['u_number'];
//                $update_user="UPDATE \"T_User\" SET u_active_state='1',u_start_time='$date' WHERE u_number='$u_number'";
//                try {
//                    $pdo->query($update_user);
//                } catch (Exception $exc) {
//                    echo $exc->getTraceAsString();
//                }
//
//                
//            }
//        }
//
//        $this->info('检查终端，更新停启用状态');
//        $sql="SELECT md_imei,md_binding,md_status FROM \"T_MobileDevice\" WHERE md_binding=1 AND md_status IS NULL";
//        $sth=$pdo->query($sql);
//        $res_md=$sth->fetchAll(PDO::FETCH_ASSOC);
//        if(count($res_md)!=0){
//            foreach ($res_md as $key => $value) {
//                $md_imei=$value['md_imei'];
//                $update_md="UPDATE \"T_MobileDevice\" SET md_status=1 WHERE md_imei='$md_imei'";
//                try {
//                    $pdo->query($update_md);
//                } catch (Exception $exc) {
//                    echo $exc->getTraceAsString();
//                }
//            }
//        }
//        $sql="SELECT md_imei FROM \"T_MobileDevice\" WHERE md_parent_ag IS NULL OR \"length\"(md_parent_ag)=0";
//        $sth=$pdo->query($sql);
//        $res_md=$sth->fetchAll(PDO::FETCH_ASSOC);
//        if(count($res_md)!=0){
//            foreach ($res_md as $key => $value) {
//                $md_imei=$value['md_imei'];
//                $update_md="UPDATE \"T_MobileDevice\" SET md_parent_ag=0 WHERE md_imei='$md_imei'";
//                try {
//                    $pdo->query($update_md);
//                } catch (Exception $exc) {
//                    echo $exc->getTraceAsString();
//                }
//            }
//        }
        $this->info ( '<h1>' . L ( '开始使用' ) . '</h1><div class = \'buttons \'><a class="login" href=\'?m=login\' target="_parent">' . L ( '立即登录' ) . '</a></div>' );
    }

}
