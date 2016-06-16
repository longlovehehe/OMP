<?php
/**
 * 数据备份控制器类
 * @category 其他
 * @package 数据备份
 * @subpackage 控制器层
 * @require {@see device} {@see enterprise} {@see area} {@see contorl} {@see page}
 */
class BackupContorl extends contorl
{   
    public $backup;
    /**
     * 构造器，继承至contorl
     */
    public function __construct()
    {
        parent::__construct();
        $this->backup = new backup ( $_REQUEST );
    }

   /**
    * 数据备份列表页
    */
    public function index()
    {
        $mininav = array(
                array(
                        "url" => "?m=backup&a=index",
                        "name" => "备份",
                        "next" => ">>",
                ),
                array(
                        "url" => "?m=backup&a=index",
                        "name" => "备份",
                        "next" => "",
                ),
        );
        //备份周期时间选择下拉框
        $selectArr = array(0=>5,1=>10,2=>15,3=>20,4=>25,5=>30);

        //获取当前设置的备份周期时间
        $CycleTime = $this->backup->getCycleTime();

        $this->smarty->assign('ctime', $CycleTime);
        $this->smarty->assign('mininav', $mininav);
        $this->smarty->assign('selectArr', $selectArr);
        $this->render ( 'modules/backup/index.tpl' , L('数据备份') );
    }

    /**
     * 备份文件列表
     */
    public function backup_item()
    {
        $list = $this->backup->getbackups();
        $this->smarty->assign('list', $list);
        //var_dump($list);
        $this->htmlrender( 'modules/backup/backup_item.tpl' );
    }

    /**
     * 备份操作
     */
    public function makebackup()
    {
        $res = $this->backup->makebackup();
        echo $res;
    }

    /**
     * 删除对应备份
     */
    public function delbackup(){
        $res = $this->backup->delbackup();
        echo $res;
    }

    /**
     * 修改自动备份周期
     */
    public function changeBackupCycle(){
        $res = $this->backup->changeBackupCycle();
        echo $res;
    }
}