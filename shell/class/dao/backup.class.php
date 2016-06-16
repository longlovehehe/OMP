<?php
/**
 * 数据备份Model
 * @category 数据备份
 * @package 数据备份
 * @subpackage Model层
 * 
 */
class backup extends db
{

    public function __construct ( $data )
    {
        parent::__construct ();
        $this->data = $data;
    }

    public function get ()
    {
        return $this->data;
    }

    public function set ( $data )
    {
        $this->data = $data;
    }

    /**
     * 获取备份文件
     */
    public function getbackups()
    {   
        //如果备份文件夹不存在则创建
        if(!is_dir('/usr/local/omp/www/DBbackup')){
            mkdir('/usr/local/omp/www/DBbackup');
        }
        //获取本文件目录的文件夹地址
        $hostdir = '/usr/local/omp/www/DBbackup';
        //$hostdir = 'D:wamp\www\Project\omp\www\DBbackup';   //dirname(__FILE__)
        //获取文件夹里的文件列表
        $backups = scandir($hostdir);
        $array = array();
        $hostname = $_SERVER['HTTP_HOST'];
        foreach ($backups as $key => $value) {
            if(substr($value,-4) != '.bak'){
                unset($backups[$key]);
            }else{
                $time = strtotime(substr($value,0,14));
                $array[$key]['unix_time'] = $time;
                $array[$key]['create_time'] = date('Y-m-d H:i:s',$time);
                $array[$key]['name'] = $value;
                $array[$key]['file'] = 'http://'.$_SERVER['HTTP_HOST'].'/omp/DBbackup/'.$value;
                //获取备份文件大小
                @$size = filesize('/usr/local/omp/www/DBbackup/'.$value);
                @$math = round( intval($size)/1024 , 0 );
                @$array[$key]['size'] = $math.'KB';
            }
        }
        sort($array);
        $res = $this->sort_array($array);
        return $res;
    }

    /**
     * 备份文件二位数组根据UNIX时间倒序排序
     */
    public function sort_array($array){
        for( $i==0; $i < count($array)-1; $i++ ) {
            $next = $array[$i+1];
            if( $value['unix_time'] > $next['unix_time'] ){
                $array[$i+1] = $value;
                $array[$i] = $next;
            }
        }
        rsort($array);
        return $array;
    }

    /**
     * 备份操作
     */
    public function makebackup()
    {   
        //如果备份文件夹不存在则创建
        if(!is_dir('/usr/local/omp/www/DBbackup')){
            mkdir('/usr/local/omp/www/DBbackup');
        }
        $backups = $this->getbackups();
        if(count($backups)<10){
            //防止程序处理超时出错,设置较长的超时时长
            ini_set('max_execution_time', 3600);

            $backname = date('YmdHis',time()).'.bak';
            $command = "/usr/local/pgsql/bin/pg_dump -U postgres -Fc OMPDB > /usr/local/omp/www/DBbackup/".$backname." 2>&1";
            $sudo=system($command,$out);
            if($out!=1){
                return 'yes';
            }else{
                return 'no';
            }
        }else{
            return 'full';
        }
    }

    //删除对应备份的文件
    public function delbackup(){
        $name = $this->data['bname'];
        //$file = 'D:\wamp\www\Project\omp\www\DBbackup\\'.$name;
        $file = '/usr/local/omp/www/DBbackup/'.$name;
        $result = @unlink ($file);
        if($result == true){
            return  "yes";
        }else{
            return  "no";
        }
    }

    /**
     * 修改自动备份周期
     */
    public function changeBackupCycle(){
        $time = $this->data['cycletime']; //  WHERE g_iccid='{$iccid}'
        $sql="UPDATE \"T_Gloabals\" SET g_backup_cycle=:g_backup_cycle"; 
        $sth = $this->pdo->prepare ( $sql );
        $sth->bindValue ( ':g_backup_cycle' , $time );
        $res = $sth->execute();
        if($res){
            return 'yes';
        }else{
            return 'no';
        }
    }

    /**
     * 获取辈分周期时间
     */
    public function getCycleTime(){
        $time = $this->data['cycletime']; //  WHERE g_iccid='{$iccid}'
        $sql="SELECT * FROM \"T_Gloabals\""; 
        $sth = $this->pdo->prepare ( $sql );
        $sth->execute();
        $res=$sth->fetchAll(PDO::FETCH_ASSOC);
        return $res[0]['g_backup_cycle'];
    }
}
