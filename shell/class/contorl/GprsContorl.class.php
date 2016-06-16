<?php

/**
 * GPRS控制器类
 * @category 业务管理
 * @package 流量卡
 * @subpackage 控制器层
 * @require {@see device} {@see enterprise} {@see area} {@see contorl} {@see page}
 */
class GprsContorl extends contorl
{   

    public $gprs;
    public $page;
    public $groups;
    public $ag;
    /**
     * 构造器，继承至contorl
     */
    public function __construct ()
    {
        parent::__construct ();
        $this->gprs = new gprs ( $_REQUEST );
        $this->page = new page ( $_REQUEST );
        $this->groups=new groups($_REQUEST);
        $this->ag=new agents($_REQUEST);
    }

   /*
    *流量卡列表页
    */
    public function index ()
    {
        //列表页分条数 选中的显示相应颜色
        if($_REQUEST['gprs_num']){
            unset($_SESSION['color']);
            $_SESSION['color'][$_REQUEST['gprs_num']] = 'style="background:#E5E5E5"';
        }elseif($_SESSION['gprs_page_num']){
            unset($_SESSION['color']);
            $_SESSION['color'][$_SESSION['gprs_page_num']] = 'style="background:#E5E5E5"';
        }else{
            unset($_SESSION['color']);
            $_SESSION['color'][10] = 'style="background:#E5E5E5"';
        }
        
        if($_SESSION['ident']=="VT"){
            $this->render ( 'modules/gprs/index_vt.tpl' , L('流量卡管理') );
        }else{
            $this->render ( 'modules/gprs/index.tpl' , L('流量卡管理') );
        }
        
    }

    /**
     * 流量卡列表内容页
     * @return html_table 流量卡列表
     */
    public function gprs_item ()
    {   
        //列表页分条数显示
        if($_REQUEST['gprs_num']){
            $_SESSION['gprs_page_num'] = $_REQUEST['gprs_num'];
        }
        if($_SESSION['gprs_page_num']){
            $_REQUEST['num'] = $_SESSION['gprs_page_num'];
            
        }
        //列表页分条数 选中的显示相应颜色
        if($_REQUEST['num']){
            unset($_SESSION['color']);
            $_SESSION['color'][$_REQUEST['num']] = 'style="background:#E5E5E5"';
        }else{
            unset($_SESSION['color']);
            $_SESSION['color'][10] = 'style="background:#E5E5E5"';
        }

        $page = new page ( $_REQUEST );
        $this->page = $page;
        $this->page->setTotal ( $this->gprs->getGprsTotal () );
        $numinfo = $this->page->getNumInfo ();
        $prev = $this->page->getPrev ();
        $next = $this->page->getNext ();
        $this->smarty->assign ( 'numinfo' , $numinfo );
        $this->smarty->assign ( 'prev' , $prev );
        $this->smarty->assign ( 'next' , $next );

        $list = $this->gprs->getList ( $this->page->getLimit () );
        //$agent = new agents ( $_REQUEST );
        //var_dump($list);
        //var_dump($_SESSION);
        $this->smarty->assign ( 'list' , $list );
         if($_SESSION['ident']=="VT"){
            $this->htmlrender ( 'modules/gprs/gprs_item_vt.tpl' );
        }else{
            $this->htmlrender ( 'modules/gprs/gprs_item.tpl' );
        }
        
    }

    /**
     * 所属企业option生成
     * 所有流量卡中出现过的企业ID
     */
    public function e_option(){
        $list=$this->gprs->get_alllist();
        foreach($list as $key=>$value){
            if($value['g_e_id']!=""){
                $arr[$key]['id']=$value['g_e_id'];
                $arr[$key]['name']=$value['e_name'];
            }
        }

        $arr=array_unique_fb($arr);
        $this->smarty->assign('list',$arr);
        $this->htmlrender("viewer/option.tpl");
    }

    /**
     * 流量卡历史记录页面
     */
    public function history_gprs(){
        $mininav = array(
            array(
                "url" => "?m=gprs&a=index",
                "name" => "流量卡管理",
                "next" => ">>",
            ),
            array(
                "url" => "#",
                "name" => "历史记录",
                "next" => "",
            ),
        );
        //获取终端信息
        $this->gprs->set(array('g_iccid'=>$_REQUEST['g_iccid'],'g_id'=>$_REQUEST['g_id']));
        $info=$this->gprs->getselect_list();
        $this->smarty->assign('mininav', $mininav);
        $this->smarty->assign('data', $info);
        $this->render("modules/gprs/gprs_history.tpl",L('历史记录'));
    }
    
     /**
     * l流量卡史记录列表页
     */
    public function history_item(){
        $this->page->setTotal($this->gprs->getTotal_history());
        $list = $this->gprs->getList_gprs_history($this->page->getLimit());
        //var_dump($list);die;
        $numinfo = $this->page->getNumInfo();
        $prev = $this->page->getPrev();
        $next = $this->page->getNext();
        $this->smarty->assign('list', $list);
        $this->smarty->assign('numinfo', $numinfo);
        $this->smarty->assign('prev', $prev);
        $this->smarty->assign('next', $next);
        $this->htmlrender("modules/gprs/gprs_history_item.tpl");
    }
    
    /**
     * 状态设置
     */
    public function set_stat(){
        $res=$this->gprs->set_stat();
        echo json_encode($res);
    }

    /**
     * 所属代理商option生成
     * 所有的一级代理商ID
     */
    public function ag_option(){
        $list=$this->gprs->getAllag();
        foreach($list as $key=>$value){
            $arr[$key]['id']=$value['ag_number'];
            $arr[$key]['name']=$value['ag_name'];
        }
        $arr=array_unique_fb($arr);
        $this->smarty->assign('list',$arr);
        $this->htmlrender("viewer/option.tpl");
    }
    /**
     * 编辑页面
     */
    public function gprs_edit ()
    {
        $mininav = array (
            array (
                "url" => "?m=gprs&a=index" ,
                "name" => "流量卡管理" ,
                "next" => ">>"
            ) ,
            array (
                "url" => "#" ,
                "name" => "编辑" ,
            )
        );
        $info = $this->gprs->getByid ();
        $this->smarty->assign ( 'mininav' , $mininav );
        $this->smarty->assign ( 'item' , $info );
        //var_dump($info);
        $this->render ( 'modules/gprs/gprs_edit.tpl' , '编辑流量卡' );
    }

    /**
   * 检测iccid,imsi,number是否已存在
   */
  public function check_edit(){
      $res = $this->gprs->getById_list();
      echo $res;
  }
  //保存流量卡的修改
  public function save_gprs(){
      $msg=$this->gprs->save_gprs();
      echo json_encode($msg);
  }
  //删除流量卡
  public function del_term(){
     $aRes=$this->tem->getById_list();
     if($aRes['md_binding'] == '1')
     {
         echo 2;
     }
     else 
     {
        $res=$this->tem->term_del();
        echo $res;
     }
     
  }

  //批量修改流量卡的状态
  public function change_gprs_status(){
     $this->gprs->set($_REQUEST);
     $res = $this->gprs->change_gprs_status();
     echo $res;
  }

    /**
     * 流量卡模板下载
     */
    public function gprs_export ()
    {
        $data = array ();
        //$data['e_id'] = filter_input ( INPUT_GET , 'e_id' );
        //获取所有一级代理商，并将代理商名称拼接成字符串
        $ag_list=$this->gprs->getAllag();
        $ag_str="OMP,";
        foreach ($ag_list as $key => $value) {
            $ag_str.=$value['ag_name'].",";
        }
        $ag_str= trim($ag_str,",");
        //echo $ag_str;die;
        $excel = new PHPExcel();
        $excel->getActiveSheet()->setTitle('Worksheet');
        $excel->getActiveSheet()->getColumnDimension("A")->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension("C")->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension("D")->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension("E")->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension("F")->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension("G")->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension("H")->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension("I")->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension("J")->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension("K")->setWidth(20);
        /** 设置表头 */
        $excel->getActiveSheet ()->setCellValue ( 'A1' , L('名称') );
        $excel->getActiveSheet ()->setCellValue ( 'B1' , L('号码') );
        $excel->getActiveSheet ()->setCellValue ( 'C1' , L('ICCID') );
        $excel->getActiveSheet ()->setCellValue ( 'D1' , L('IMSI') );
        $excel->getActiveSheet ()->setCellValue ( 'E1' , L('所属代理商') );
        $excel->getActiveSheet ()->setCellValue ( 'F1' , L('批次') );
        $excel->getActiveSheet ()->setCellValue ( 'G1' , L('开卡日期') );
        $excel->getActiveSheet ()->setCellValue ( 'H1' , L('备注').'1' );
        $excel->getActiveSheet ()->setCellValue ( 'I1' , L('入库日期') );
        $excel->getActiveSheet ()->setCellValue ( 'J1' , L('入库单号') );
        $excel->getActiveSheet ()->setCellValue ( 'K1' , L('备注').'2' );
        
        for ($i=2; $i < 203; $i++) { 
            $excel->getActiveSheet ()->setCellValueExplicit ( "A" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "B" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "C" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "D" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );

            //表格填充代理商列表，并判断传入字符串长度
            $str_len = strlen($ag_str);  

            if($str_len>=255){  
                $str_list_arr = explode(',', $ag_str);   
                if($str_list_arr)   
                      foreach($str_list_arr as $key =>$d){  
                             //$c = "V".($key+1); 
                            $c = $key+1;
                             //$excel->getActiveSheet($c,$d);
                             $excel->getActiveSheet()->setCellValueExplicit ( "V".$c , $d , PHPExcel_Cell_DataType::TYPE_STRING );   
                       }   
                 $endcell = $c;
                 $excel->getActiveSheet ()->getColumnDimension('V')->setVisible(false);   
            }
   
            if($str_len<255){
                $excel->getActiveSheet ()->getCell("E". $i)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                     -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                     -> setAllowBlank(false)
                     -> setShowInputMessage(true)
                     -> setShowErrorMessage(true)
                     -> setShowDropDown(true)
                     -> setErrorTitle(L('输入的值有误'))
                     -> setError(L('您输入的值不在下拉框列表内'))
                     -> setPromptTitle(L('所属代理商'))
                     ->setFormula1('"' . $ag_str . '"');   
            }else{
                $excel->getActiveSheet ()->getCell("E". $i)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                       -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                       -> setAllowBlank(false)
                       -> setShowInputMessage(true)
                       -> setShowErrorMessage(true)
                       -> setShowDropDown(true)
                       -> setErrorTitle(L('输入的值有误'))
                       -> setError(L('您输入的值不在下拉框列表内'))
                       -> setPromptTitle(L('所属代理商'))
                       //-> setFormula1("Worksheet!V1:{$endcell}");
                       -> setFormula1('$V$1:$V$'.$endcell."'");
            }  



            $excel->getActiveSheet ()->setCellValueExplicit ( "F" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "G" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "H" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "I" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "J" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "K" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
        }
        /* 导出 */
        coms::head ( 'excel' , $excel );

}
/**
     * 流量卡模板下载
     */
    public function gprs_export_vt ()
    {
        $data = array ();
        //$data['e_id'] = filter_input ( INPUT_GET , 'e_id' );
        //获取所有一级代理商，并将代理商名称拼接成字符串
        $ag_list=$this->gprs->getAllag();
        $ag_str="OMP,";
        foreach ($ag_list as $key => $value) {
            $ag_str.=$value['ag_name'].",";
        }
        $ag_str= trim($ag_str,",");

        $excel = new PHPExcel();
        $excel->getActiveSheet()->setTitle('Worksheet');
        $excel->getActiveSheet()->getColumnDimension("A")->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension("C")->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension("D")->setWidth(30);
        /** 设置表头 */
        $excel->getActiveSheet ()->setCellValue ( 'A1' , 'ICCID' );
        $excel->getActiveSheet ()->setCellValue ( 'B1' , 'IMSI' );
        $excel->getActiveSheet ()->setCellValue ( 'C1' , 'Number' );
        $excel->getActiveSheet ()->setCellValue ( 'D1' , L('所属代理商') );

        for ($i=2; $i < 203; $i++) { 
            $excel->getActiveSheet ()->setCellValueExplicit ( "A" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "B" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet ()->setCellValueExplicit ( "C" . $i , "" , PHPExcel_Cell_DataType::TYPE_STRING );

            //表格填充代理商列表，并判断传入字符串长度
            $str_len = strlen($ag_str);  

            if($str_len>=255){  
                $str_list_arr = explode(',', $ag_str);   
                if($str_list_arr)   
                      foreach($str_list_arr as $key =>$d){  
                             $c = $key+1;  
                             //$excel->getActiveSheet($c,$d);
                             $excel->getActiveSheet()->setCellValueExplicit ( "T".$c , $d , PHPExcel_Cell_DataType::TYPE_STRING );   
                       }   
                 $endcell = $c;
                 $excel->getActiveSheet ()->getColumnDimension('T')->setVisible(false);   
            }
   
            if($str_len<255){
                $excel->getActiveSheet ()->getCell("D". $i)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                     -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                     -> setAllowBlank(false)
                     -> setShowInputMessage(true)
                     -> setShowErrorMessage(true)
                     -> setShowDropDown(true)
                     -> setErrorTitle(L('输入的值有误'))
                     -> setError(L('您输入的值不在下拉框列表内'))
                     -> setPromptTitle(L('所属代理商'))
                     ->setFormula1('"' . $ag_str . '"');   
            }else{
                $excel->getActiveSheet ()->getCell("D". $i)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                       -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                       -> setAllowBlank(false)
                       -> setShowInputMessage(true)
                       -> setShowErrorMessage(true)
                       -> setShowDropDown(true)
                       -> setErrorTitle(L('输入的值有误'))
                       -> setError(L('您输入的值不在下拉框列表内'))
                       -> setPromptTitle(L('所属代理商'))
                       //-> setFormula1("Worksheet!V1:{$endcell}");
                       -> setFormula1('$T$1:$T$'.$endcell."'");
            } 

        }
        /* 导出 */
        coms::head ( 'excel' , $excel );

}

    /**
     * 流量卡导入
     */
    public function importShellICCID ()
    {
        $step = is_string ( $_REQUEST['step'] ) ? $_REQUEST['step'] : '';
        if ( $step === 'if' )
        {
            $msg = $this->importPTFile ();
            print "<script>parent.tm_if_callback(" . $msg . ")</script>";
            exit;
        }
        if ( $step === 'ic' )
        {
            try
            {
                if($_SESSION['ident']=="VT"){
                    $f = $this->importICCIDCheck_vt ();
                }else{
                   $f = $this->importICCIDCheck (); 
                }
                
               
                if ( count ( $this->error ) > 0 )
                {
                    $json['status'] = -1;
                    $json['msg'] = L('存在错误无法导入').'<br />';
                }
                else
                {
                    $json['status'] = 0;
                    $json['msg'] = L('无严重错误').'<br />';
                }
                $json['msg'].='<div class="show">';
                $json['msg'] .= implode ( '<br />' , $this->error );
                //$json['msg'] .= "<hr />";
                //$json['msg'] .= implode ( '<br />' , $this->warn );
                $json['msg'].='</div>';

                $json['data'] = $f;
                $msg = json_encode ( $json );
            }
            catch ( Exception $ex )
            {
                $json['status'] = -1;
                $json['msg'] = $ex->getMessage ();
                $msg = json_encode ( $json );
            }
            print "<script>parent.tm_ic_callback(" . $msg . ")</script>";
            exit;
        }
        if ( $step === 'i' )
        {
            try
            {
                if($_SESSION['ident']=="VT"){
                    $this->importPT_vt ();
                }else{
                    $this->importPT ();
                }
                

                if ( count ( $this->error ) > 0 )
                {
                    $json['status'] = -1;
                    $json['msg'] = L('存在错误');
                    $json['msg'].='<div class="show">';
                    $json['msg'] .= implode ( '<br />' , $this->error );
                    $json['msg'].='</div>';
                }
                else
                {
                    $json['status'] = 0;
                    //$json['msg'] = L('没有发现错误，导入完成');
                    $json['msg'] = $this->data['result'];
                }

                $msg = json_encode ( $json );
            }
            catch ( Exception $ex )
            {
                $json['status'] = -1;
                $json['msg'] = $ex->getMessage ();
                $msg = json_encode ( $json );
            }
            print "<script>parent.tm_i_callback(" . $msg . ")</script>";
            exit;
        }
    }

    /**
     * 流量卡导入检查
     * @return string
     * @throws Exception
     */
    private function importICCIDCheck ()
    {
        $f = filter_input ( INPUT_GET , 'f' );
        $e_id = filter_input ( INPUT_GET , 'e_id' );
        $file = $f . '.xls';
        $config = Cof::config ();
        $filePath = $config['system']['webroot'] . DIRECTORY_SEPARATOR . "runtime" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $file;
        $objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );

        $objPHPExcel = $objReader->load ( $filePath );
        $objWorksheet = $objPHPExcel->getSheet ( 0 );

        //$highestColumn = $objWorksheet->getHighestColumn();
        $highestRow = $objWorksheet->getHighestRow ();    //取得总行数
        $pttm = array ();
        $error = array ();
        $warn = array ();
        $ptnumber = array ();
        $wz = "";
        for ( $row = 2; $row <= $highestRow; $row ++ )
        {
            $tmpuser = array ();
            $tmpuser['g_name'] = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            $tmpuser['g_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 1 , $row )->getValue () );
            $tmpuser['g_iccid'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );
            $tmpuser['g_imsi'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
            $tmpuser['g_agents_id'] = trim ( $objWorksheet->getCellByColumnAndRow ( 4 , $row )->getValue () );
            $tmpuser['g_batch'] = trim ( $objWorksheet->getCellByColumnAndRow ( 5 , $row )->getValue () );
            $tmpuser['g_a_date'] = trim ( $objWorksheet->getCellByColumnAndRow ( 6 , $row )->getValue () );
            $tmpuser['g_one_remarks'] = trim ( $objWorksheet->getCellByColumnAndRow ( 7 , $row )->getValue () );
            $tmpuser['g_intime'] = trim ( $objWorksheet->getCellByColumnAndRow ( 8 , $row )->getValue () );
            $tmpuser['g_in_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 9 , $row )->getValue () );
            $tmpuser['g_two_remarks'] = trim ( $objWorksheet->getCellByColumnAndRow ( 10 , $row )->getValue () );
            $ptnumber[$row]=$tmpuser['g_iccid'];
             if($tmpuser['g_iccid']=='' && $tmpuser['g_imsi']=='' && $tmpuser['g_number']==''){
            }else{
                $wz = $tmpuser['g_iccid'];
                if ( ! Cof::re ( '/^[0-9a-zA-Z]{19}$|^[0-9a-zA-Z]{20}$/i' , $tmpuser['g_iccid'] ) )
                {
                    $error[] = sprintf(L("第 %d 行，%s iccid格式不对，为19或20位的数字或字母"),
                            $row,
                            $tmpuser['g_iccid']
                            );
                }
                if ( ! Cof::re ( '/^\s*$|^[0-9]{15}$/i' , $tmpuser['g_imsi'] ) )
                {
                    $error[] = sprintf(L("第 %d 行，%s g_imsi格式不对,为15位数字"),
                            $row,
                            $tmpuser['g_imsi']
                            );
                }
                
                if ( ! Cof::re ( ' /^\d+$/' , $tmpuser['g_number'] ) )
                {
                     $error[] = sprintf(L("第 %d 行，%s 手机号格式不对"),
                            $row,
                            $tmpuser['g_number']
                            );
                }

                //判断传来的所属代理商是否存在，并将代理商的名字转换为代理商的编号
                if($tmpuser['g_agents_id']!=""){
                     $info = $this->gprs->check_ag($tmpuser['g_agents_id']);
                     if(!$info){
                        //$tmpuser['g_agents_id'] = $info['ag_number'];
                     //}else{
                        $error[] = sprintf(L("第 %d 行，%s 填写的所属代理商不存在"),
                                $row,
                                $tmpuser['g_agents_id']
                                );
                     }
                }else{
                    $error[] = sprintf(L("第 %d 行，%s 请选择所属代理商"),
                                $row,
                                $tmpuser['g_agents_id']
                                );
                }

                if($tmpuser['g_batch']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['g_batch'] , 128 ) )
                    {
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['g_batch']
                                );
                    }
                }
                 if($tmpuser['g_a_date']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['g_a_date'] , 128 ) )
                    {
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['g_a_date']
                                );
                    }
                }
                 if($tmpuser['g_one_remarks']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['g_one_remarks'] , 128 ) )
                    {
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['g_one_remarks']
                                );
                    }
                }
                 if($tmpuser['g_intime']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['g_intime'] , 128 ) )
                    {
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['g_intime']
                                );
                    }
                }
                 if($tmpuser['g_in_number']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['g_in_number'] , 128 ) )
                    {
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['g_in_number']
                                );
                    }
                }
                 if($tmpuser['g_two_remarks']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['g_two_remarks'] , 128 ) )
                    {
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['g_two_remarks']
                                );
                    }
                }
                /*if($tmpuser['g_iccid'] != ''){
                    $info_iccid = $this->gprs->checkexcel($tmpuser['g_iccid'],'','');
                    if($info_iccid){
                         $error[] = sprintf(L("第 %d 行，%s iccid已存在"),
                            $row,
                            $tmpuser['g_iccid']
                            );
                    }
                }

                if($tmpuser['g_imsi'] != ''){
                    $info_imsi = $this->gprs->checkexcel('',$tmpuser['g_imsi'],'');
                    if($info_imsi){
                        $error[] = sprintf(L("第 %d 行，%s imsi已存在"),
                            $row,
                            $tmpuser['g_imsi']
                            );
                    }
                }

                if($tmpuser['g_number'] != ''){
                    $info_number = $this->gprs->checkexcel('','',$tmpuser['g_number']);
                    if($info_number){
                         $error[] = sprintf(L("第 %d 行，%s number手机号已存在"),
                            $row,
                            $tmpuser['g_number']
                            );
                    }
                }*/
                  $pttm[$wz][] = $tmpuser;
            }
        }

        if(count($pttm)==0){
            throw new Exception ( L("导入内容为空,请检查") );
        }else{
            /*$res=array_unique($ptnumber);
            $res_diff=array_diff_assoc($ptnumber,$res);

            $resuslt=array_intersect($res,$res_diff);
            $arr_final=array();
            foreach ($resuslt as $key => $value) {
                foreach ($res_diff as $k => $val) {
                    if($value==$val&&$val!=""){
                         $arr_final[]= sprintf(L("第 %d 行 与 第 %d 行 ICCID相同"),
                                $key,
                                $k
                                );
                    }
                }
            }
            if(count($arr_final)>=1){
                $this->warn = $arr_final;
            }else{
                $this->warn = $warn;
            }*/
        }
        $this->error = $error;
        return $f;
    }
    /**
     * 流量卡导入检查
     * @return string
     * @throws Exception
     */
    private function importICCIDCheck_vt ()
    {
        $f = filter_input ( INPUT_GET , 'f' );
        $e_id = filter_input ( INPUT_GET , 'e_id' );
        $file = $f . '.xls';
        $config = Cof::config ();
        $filePath = $config['system']['webroot'] . DIRECTORY_SEPARATOR . "runtime" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $file;
        $objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );

        $objPHPExcel = $objReader->load ( $filePath );
        $objWorksheet = $objPHPExcel->getSheet ( 0 );

        //$highestColumn = $objWorksheet->getHighestColumn();
        $highestRow = $objWorksheet->getHighestRow ();    //取得总行数
        $pttm = array ();
        $error = array ();
        $warn = array ();
        $ptnumber = array ();
        $wz = "";
        for ( $row = 2; $row <= $highestRow; $row ++ )
        {
            $tmpuser = array ();
            $tmpuser['g_iccid'] = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            $tmpuser['g_imsi'] = trim ( $objWorksheet->getCellByColumnAndRow ( 1 , $row )->getValue () );
            $tmpuser['g_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );
            $tmpuser['g_agents_id'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
    
             if($tmpuser['g_iccid']=='' && $tmpuser['g_imsi']=='' && $tmpuser['g_number']==''){
            }else{
                $wz = $tmpuser['g_iccid'];
                if ( ! Cof::re ( ' /^[0-9a-zA-Z]{19}$|^[0-9a-zA-Z]{20}$/i' , $tmpuser['g_iccid'] ) )
                {
                    $error[] = sprintf(L("第 %d 行，%s iccid格式不对，为19或20位的数字或字母"),
                            $row,
                            $tmpuser['g_iccid']
                            );
                }
                if ( ! Cof::re ( '/^\s*$|^[0-9]{15}$/i' , $tmpuser['g_imsi'] ) )
                {
                    $error[] = sprintf(L("第 %d 行，%s g_imsi格式不对,为15位数字"),
                            $row,
                            $tmpuser['g_imsi']
                            );
                }
                
                if ( ! Cof::re ( ' /^\d+$/' , $tmpuser['g_number'] ) )
                {
                     $error[] = sprintf(L("第 %d 行，%s 手机号格式不对"),
                            $row,
                            $tmpuser['g_number']
                            );
                }
            /*
                if($tmpuser['g_iccid'] != ''){
                    $info = $this->gprs->checkexcel($tmpuser['g_iccid'],'','');
                    if($info){
                         $error[] = sprintf(L("第 %d 行，%s iccid已存在"),
                            $row,
                            $tmpuser['g_iccid']
                            );
                    }
                }

                if($tmpuser['g_imsi'] != ''){
                    $info = $this->gprs->checkexcel('',$tmpuser['g_imsi'],'');
                    if($info){
                        $error[] = sprintf(L("第 %d 行，%s imsi已存在"),
                            $row,
                            $tmpuser['g_imsi']
                            );
                    }
                }

                if($tmpuser['g_number'] != ''){
                    $info = $this->gprs->checkexcel('','',$tmpuser['g_number']);
                    if($info){
                         $error[] = sprintf(L("第 %d 行，%s number手机号已存在"),
                            $row,
                            $tmpuser['g_number']
                            );
                    }
                }
            */              
                //判断传来的所属代理商是否存在，并将代理商的名字转换为代理商的编号
                if($tmpuser['g_agents_id']!=""){
                     $info = $this->gprs->check_ag($tmpuser['g_agents_id']);
                     if(!$info){
                        //$tmpuser['g_agents_id'] = $info['ag_number'];
                     //}else{
                        $error[] = sprintf(L("第 %d 行，%s 填写的代理商不存在"),
                                $row,
                                $tmpuser['g_agents_id']
                                );
                     }
                }else{
                    $error[] = sprintf(L("第 %d 行，%s 请选择所属代理商"),
                                $row,
                                $tmpuser['g_agents_id']
                                );
                }

                  $pttm[$wz][] = $tmpuser;
            }
        }
         if(count($pttm)==0){
            throw new Exception ( L("导入内容为空,请检查") );
        }else{
            /*$res=array_unique($ptnumber);
            $res_diff=array_diff_assoc($ptnumber,$res);

            $resuslt=array_intersect($res,$res_diff);
            $arr_final=array();
            foreach ($resuslt as $key => $value) {
                foreach ($res_diff as $k => $val) {
                    if($value==$val&&$val!=""){
                         $arr_final[]= sprintf(L("第 %d 行 与 第 %d 行 ICCID相同"),
                                $key,
                                $k
                                );
                    }
                }
            }
            if(count($arr_final)>=1){
                $this->warn = $arr_final;
            }else{
                $this->warn = $warn;
            }*/
            $this->error = $error;
            return $f;
        }
    }
    // 导入文件
    private function importPTFile ()
    {
        $json = array ();
        try
        {
            $file = Cof::upload ();
            $json['status'] = 0;
            $json['data'] = str_replace ( '.xls' , '' , $file ); //清除后缀信息
        }
        catch ( Exception $ex )
        {
            $json['status'] = -1;
            $json['msg'] = $ex->getMessage ();
        }
        return json_encode ( $json );
    }
  // 数据导入
    private function importPT_vt ()
    {
        $e_id = filter_input ( INPUT_GET , 'e_id' );
        $f = filter_input ( INPUT_GET , 'f' );
        $file = $f . '.xls';
        $config = Cof::config ();
        $filePath = $config['system']['webroot'] . DIRECTORY_SEPARATOR . "runtime" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $file;
        $objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );
        $objPHPExcel = $objReader->load ( $filePath );
        $objWorksheet = $objPHPExcel->getSheet ( 0 );

        $highestRow = $objWorksheet->getHighestRow ();    //取得总行数
        // 实际数据读取，数据导入
        $pttm = array ();
        $error = array ();
        $warn = array ();
        $ptnumber = array ();
        $excelres = array();
        $wz = "";
        $i=0;
        for ( $row = 2; $row <= $highestRow; $row ++ )
        {
            $tmpuser = array ();
            $tmpuser['g_iccid'] = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            $tmpuser['g_imsi'] = trim ( $objWorksheet->getCellByColumnAndRow ( 1 , $row )->getValue () );
            $tmpuser['g_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );
            $tmpuser['g_agents_id'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );

            if($tmpuser['g_iccid']!=''){
                //$pttm[$tmpuser['g_iccid']][] = $tmpuser;
                $excelres[$i] = $tmpuser;
                $i++;
            }
            
            $this->warn = $warn;
            $this->error = $error;
        }

        // 导入流量卡
        $gprs = new gprs ();
        $pgnumber = array ();
        //if(count($pttm)==0){
        if(count($excelres)==0){
            throw new Exception ( L("存在错误无法导入") );
        }else{
            $this->data['result']="<div class='base full' style='height:520px;overflow-y:scroll;'>
                                        <table class='base full'>
                                            <tr class='head'>
                                                <th width='100px'>".L("号码")."</th>
                                                <th width='150px'>ICCID</th>
                                                <th width='120px'>IMSI</th>
                                                <th width='120px'>".L("所属代理商")."</th>
                                                <th width='70px'>".L("结果")."</th>
                                            </tr>";
            //foreach ( $pttm as $key => $value )
            foreach ( $excelres as $key => $value )
            {
                $data = array ();
                $data['do'] = 'add';

                $data['g_iccid'] = $value['g_iccid'];
                //判断iccid是否已存在,存在则跳过,继续往下验证
                if($data['g_iccid'] != ''){
                    $info_iccid = $this->gprs->checkexcel($data['g_iccid'],'','');
                    if($info_iccid){
                        $g_iccid_check = false;
                    }else{
                        $g_iccid_check = true;
                    }
                }

                $data['g_imsi']=$value['g_imsi'];
                //判断imsi是否已存在,存在则跳过,继续往下验证
                if($data['g_imsi'] != ''){
                    $info_imsi = $this->gprs->checkexcel('',$data['g_imsi'],'');
                    if($info_imsi){
                        $g_imsi_check = false;
                    }else{
                        $g_imsi_check = true;
                    }
                }else{
                    $g_imsi_check = true;
                }

                $data['g_number']=$value['g_number'];
                //判断number是否已存在,存在则跳过,继续往下验证
                if($data['g_number'] != ''){
                    $info_number = $this->gprs->checkexcel('','',$data['g_number']);
                    if($info_number){
                        $g_number_check = false;
                    }else{
                        $g_number_check = true;
                    }
                }
                 
                //判断 iccid imsi number是否已存在  并拼接结果提示html
                if($g_iccid_check==true&&$g_imsi_check==true&&$g_number_check==true){
                    $this->data['result'].="<tr>
                        <td>{$data['g_number']}</td>
                        <td>{$data['g_iccid']}</td>
                        <td>{$data['g_imsi']}</td>
                        <td>{$value['g_agents_id']}</td>
                        <td style='color:green'>".L("成功")."</td>
                    </tr>";
                }else{
                    $this->data['result'].="<tr>
                        <td>{$data['g_number']}</td>
                        <td>{$data['g_iccid']}</td>
                        <td>{$data['g_imsi']}</td>
                        <td>{$value['g_agents_id']}</td>
                        <td style='color:red'>".L("失败")."</td>
                    </tr>";
                    continue;
                }

                $ag_info = $this->gprs->check_ag($value['g_agents_id']);
                $data['g_agents_id'] = $ag_info['ag_number'];
                //var_dump($data['g_agents_id']);die;
                $data['g_add_user']=$_SESSION['own']['om_id'];
                $data['g_binding']='0';
                $data['g_status']='2';
                $data['g_intime'] = date ( "Ymd" , time ());
                $gprs->set ( $data );
                try
                {
                    $gprs->save_gprs ();
                }
                catch ( Exception $exc )
                {
                    if ( $exc->getCode () == 23505 )
                    {
//                        throw new Exception ( L("所导入的ICCID已经存在,请检查") );
                    }
                }
            }
            $this->data['result'].="</table></div>";
        }
        $error = array ();
    }
    // 数据导入
    private function importPT ()
    {
        $e_id = filter_input ( INPUT_GET , 'e_id' );
        $f = filter_input ( INPUT_GET , 'f' );
        $file = $f . '.xls';
        $config = Cof::config ();
        $filePath = $config['system']['webroot'] . DIRECTORY_SEPARATOR . "runtime" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $file;
        $objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );
        $objPHPExcel = $objReader->load ( $filePath );
        $objWorksheet = $objPHPExcel->getSheet ( 0 );

        $highestRow = $objWorksheet->getHighestRow ();    //取得总行数
        // 实际数据读取，数据导入
        $pttm = array ();
        $error = array ();
        $warn = array ();
        $ptnumber = array ();
        $excelres = array();
        $wz = "";
        $i=0;
        for ( $row = 2; $row <= $highestRow; $row ++ )
        {
            $tmpuser = array ();
            $tmpuser['g_name'] = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            $tmpuser['g_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 1 , $row )->getValue () );
            $tmpuser['g_iccid'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );
            $tmpuser['g_imsi'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
            $tmpuser['g_agents_id'] = trim ( $objWorksheet->getCellByColumnAndRow ( 4 , $row )->getValue () );
            $tmpuser['g_batch'] = trim ( $objWorksheet->getCellByColumnAndRow ( 5 , $row )->getValue () );
            $tmpuser['g_a_date'] = trim ( $objWorksheet->getCellByColumnAndRow ( 6 , $row )->getValue () );
            $tmpuser['g_one_remarks'] = trim ( $objWorksheet->getCellByColumnAndRow ( 7 , $row )->getValue () );
            $tmpuser['g_intime'] = trim ( $objWorksheet->getCellByColumnAndRow ( 8 , $row )->getValue () );
            $tmpuser['g_in_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 9 , $row )->getValue () );
            $tmpuser['g_two_remarks'] = trim ( $objWorksheet->getCellByColumnAndRow ( 10 , $row )->getValue () );
            $ptnumber[$row]=$tmpuser['g_iccid'];
            if($tmpuser['g_iccid']!=''){
                //$pttm[$tmpuser['g_iccid']][] = $tmpuser;
                $excelres[$i] = $tmpuser;
                $i++;
            }
            //流量卡去重
            /*$res=array_unique($ptnumber);
            $res_diff=array_diff_assoc($ptnumber,$res);

            $resuslt=array_intersect($res,$res_diff);
            $arr_final=array();
            foreach ($resuslt as $key => $value) {
                foreach ($res_diff as $k => $val) {
                    if($value==$val&&$val!=""){
                         $arr_final[]= sprintf(L("第 %d 行 与 第 %d 行 ICCID相同"),
                                $key,
                                $k
                                );
                    }
                }
            }
            if(count($arr_final)>=1){
                $this->warn = $arr_final;
            }else{
                $this->warn = $warn;
            }*/

            $this->error = $error;
        }
       
        // 导入流量卡
        $gprs = new gprs ();
        $pgnumber = array ();
        //if(count($pttm)==0){
        if(count($excelres)==0){
            throw new Exception ( L("存在错误无法导入") );
        }else{
            $this->data['result']="<div class='base full' style='height:520px;overflow-y:scroll;'>
                                        <table class='base full'>
                                            <tr class='head'>
                                                <th width='100px'>".L("号码")."</th>
                                                <th width='150px'>ICCID</th>
                                                <th width='120px'>IMSI</th>
                                                <th width='120px'>".L("所属代理商")."</th>
                                                <th width='70px'>".L("结果")."</th>
                                            </tr>";
            //foreach ( $pttm as $key => $value )
            foreach ( $excelres as $key => $value )
            {
                $data = array ();
                $data['do'] = 'add';
                /*foreach ($value as $k => $v) {
                    if($k>0){
                        $this->data['result'].="<tr>
                            <td>{$v['g_number']}</td>
                            <td>{$v['g_iccid']}</td>
                            <td>{$v['g_imsi']}</td>
                            <td>{$v['g_agents_id']}</td>
                            <td style='color:red'>".L("失败")."</td>
                        </tr>";
                    }else{*/
                        $data['g_iccid'] = $value['g_iccid'];
                        //判断iccid是否已存在,存在则跳过,继续往下验证
                        if($data['g_iccid'] != ''){
                            $info_iccid = $this->gprs->checkexcel($data['g_iccid'],'','');
                            if($info_iccid){
                                $g_iccid_check = false;
                            }else{
                                $g_iccid_check = true;
                            }
                        }

                        $data['g_imsi']=$value['g_imsi'];
                        //判断imsi是否已存在,存在则跳过,继续往下验证
                        if($data['g_imsi'] != ''){
                            $info_imsi = $this->gprs->checkexcel('',$data['g_imsi'],'');
                            if($info_imsi){
                                $g_imsi_check = false;
                            }else{
                                $g_imsi_check = true;
                            }
                        }else{
                            $g_imsi_check = true;
                        }

                        $data['g_number']=$value['g_number'];
                        //判断number是否已存在,存在则跳过,继续往下验证
                        if($data['g_number'] != ''){
                            $info_number = $this->gprs->checkexcel('','',$data['g_number']);
                            if($info_number){
                                $g_number_check = false;
                            }else{
                                $g_number_check = true;
                            }
                        }
                 //   }
                //}
                //判断 iccid imsi number是否已存在  并拼接结果提示html
                if($g_iccid_check==true&&$g_imsi_check==true&&$g_number_check==true){
                    $this->data['result'].="<tr>
                        <td>{$data['g_number']}</td>
                        <td>{$data['g_iccid']}</td>
                        <td>{$data['g_imsi']}</td>
                        <td>{$value['g_agents_id']}</td>
                        <td style='color:green'>".L("成功")."</td>
                    </tr>";
                }else{
                    $this->data['result'].="<tr>
                        <td>{$data['g_number']}</td>
                        <td>{$data['g_iccid']}</td>
                        <td>{$data['g_imsi']}</td>
                        <td>{$value['g_agents_id']}</td>
                        <td style='color:red'>".L("失败")."</td>
                    </tr>";
                    continue;
                }
                
                $data['g_add_user']=$_SESSION['own']['om_id'];
                $data['g_binding']='0';
                $data['g_status']='2';
                $data['g_batch'] = $value['g_batch'];
                $data['g_a_date'] = $value['g_a_date'];
                $data['g_one_remarks'] = $value['g_one_remarks'];
                $data['g_intime'] = $value['g_intime'];
                $data['g_in_number'] = $value['g_in_number'];
                $data['g_two_remarks'] = $value['g_two_remarks'];
                $data['g_name'] = $value['g_name'];
                $ag_info = $this->gprs->check_ag($value['g_agents_id']);
                $data['g_agents_id'] = $ag_info['ag_number'];
                $gprs->set ( $data );
                try
                {
                    $save_res = $gprs->save_gprs ();
                }
                catch ( Exception $exc )
                {   
                    if ( $exc->getCode () == 23505 )
                    {   
                        //throw new Exception ( L("所导入的ICCID已经存在,请检查") );
                    }
                }
            }
            $this->data['result'].="</table></div>";
        }
        $error = array ();
    }

    public function gprs_item_v2 ()
    {
        $page = new page ( $_REQUEST );
        $this->page = $page;
        $this->page->setTotal ( $this->gprs->getGprsTotal () );
        $numinfo = $this->page->getNumInfo ();
        $prev = $this->page->getPrev ();
        $next = $this->page->getNext ();
        $this->smarty->assign ( 'numinfo' , $numinfo );
        $this->smarty->assign ( 'prev' , $prev );
        $this->smarty->assign ( 'next' , $next );


        $list = $this->gprs->getList_v2 ();
        $agent = new agents ( $_REQUEST );
        $aginfo = $agents->get;
        $this->smarty->assign ( 'list' , $list );
        $this->htmlrender ( 'modules/gprs/gprs_item_v2.tpl' );
    }

    /**
     * 入库页面
     */
    public function gprs_add ()
    {
        $mininav = array (
            array (
                "url" => "?m=gprs&a=index" ,
                "name" => "流量卡管理" ,
                "next" => ">>"
            ) ,
            array (
                "url" => "?m=gprs&a=gprs_add" ,
                "name" => "办理入库" ,
                "next" => ""
            )
        );
        $ag_list=$this->gprs->getAllag();
        $ag_str="OMP,";
        foreach ($ag_list as $key => $value) {
            $ag_str.=$value['ag_name'].",";
        }
        $ag_str= trim($ag_str,",");
        $ag_list=$this->gprs->getAllag();
        $this->smarty->assign ( 'mininav' , $mininav );
        if($_SESSION['ident']=="VT"){
            $this->render ( 'modules/gprs/gprs_add_vt.tpl' , L('办理入库') );
        }else{
            $this->render ( 'modules/gprs/gprs_add.tpl' , L('办理入库') );
        }
        
    }

    /**
     * 出库页面
     */
    public function gprs_out ()
    {
        $page = new page ( $_REQUEST );
        $this->page = $page;
        $this->page->setTotal ( $this->gprs->getGprsTotal () );
        $numinfo = $this->page->getNumInfo ();
        $prev = $this->page->getPrev ();
        $next = $this->page->getNext ();
        $this->smarty->assign ( 'numinfo' , $numinfo );
        $this->smarty->assign ( 'prev' , $prev );
        $this->smarty->assign ( 'next' , $next );


        $list = $this->gprs->getList ( $this->page->getLimit () );
        $this->smarty->assign ( 'list' , $list );
        $mininav = array (
            array (
                "url" => "?m=gprs&a=index" ,
                "name" => "流量卡管理" ,
                "next" => ">>"
            ) ,
            array (
                "url" => "?m=gprs&a=gprs_add" ,
                "name" => "流量卡出库" ,
                "next" => ""
            )
        );

        $this->smarty->assign ( 'mininav' , $mininav );
        $this->render ( 'modules/gprs/gprs_out.tpl' , '办理出库' );
    }

//流量卡出库{1.代理商2.企业}
    public function gprsshellout ()
    {
        if ( $_REQUEST['create_type'] == 'agents' )//1.代理商出库
        {
            foreach ( $_REQUEST["checkbox"] as $val )
            {
                $data['g_iccid'] = $val;
                $gprs = new gprs ( array ( 'g_iccid' => $val ) );
                //$agents = new agents ( array ( 'ag_number' => $_SESSION['ag']['ag_number'] ) );
                $info = $gprs->getByid ();
                // $ag_info = $agents->getByid ();
                $data['g_agents_id'] = $_REQUEST['g_ag_id'];
                $data['g_agents_assign'] = $info['g_agents_assign'] . "|" . $data['g_agents_id'] . "|";
                $data['g_outtime'] = date ( 'Y-m-d' , time () );
                $data['g_intime0'] = $data['g_outtime'];
                $data['g_final_user'] = $_REQUEST['g_final_user'];
                $data['g_stock_status'] = 2;
                $this->gprs->set ( $data );
                $this->gprs->gprsshellout ();
            }
        }
        else//2.企业出库
        {
            if ( $_REQUEST['g_ag_en_id'] == "" )
            {
                //1.创建企业,并设置管理员
                $ep = new enterprise ( $_REQUEST );
                $result = $ep->save ();
                $data['em_id'] = $result['e_id'];
                $data['em_pswd'] = $data['em_id'];
                $data['em_ent_id'] = $data['em_id'];
                $data['em_phone'] = $_REQUEST['em_phone'];
                $data['em_mail'] = $_REQUEST['em_mail'];
                $data['em_name'] = $_REQUEST['em_name'];
                $data['em_desc'] = "";
                $data['edit'] = '';
                $e_id = $result['e_id'];
                /*                 * **创建管理员*** */
                $admins = new admins ( $data );
                $admins->save ();

                $user = new users ( array ( 'e_id' => $result['e_id'] ) );
                $start_id = $user->getstartid ();
            }
            else//选择已有企业
            {
                /*                 * **批量创建手机用户并设置流量卡ICCID 自动登录*** */
                //①获得当前用户号码起始ID
                //初始化数据
                $user = new users ( array ( 'e_id' => $_REQUEST['g_ag_en_id'] ) );
                $start_id = $user->getstartid ();
                $e_id = $_REQUEST['g_ag_en_id'];
            }
            $start_num = substr ( $start_id[0] , 6 , 1 );
            $start_index = substr ( $start_id[0] , 0 , 1 );
            if ( $start_index == 1 )
            {
                $start_id = 70000;
            }
            else
            {
                if ( $start_num < 7 || count ( $start_id ) == 0 )
                {
                    $start_id = 70000;
                }
                else
                {
                    $start_id = $start_id[0] + 1;
                }
            }
            //②获取批量创建个数
            $sum = $_REQUEST['check_num'];
            //③创建用户,并分配流量卡ICCID 自动登录
            for ( $i = 0; $i < $sum; $i ++ )
            {
                $data['u_number'] = $start_id + $i;
                $data['u_passwd'] = $start_id + $i;
                $data['u_name'] = $start_id + $i;
                $data['u_iccid'] = $_REQUEST["checkbox"][$i];
                $data['u_auto_config'] = 1;
                $data['u_sex'] = "M";
                $data['e_id'] = $e_id;
                $data['u_sub_type'] = 1;
                $user->set ( $data );
                $user->save ();
            }
            /*             * ***** ********************************************** */
            //2.流量卡出库
            foreach ( $_REQUEST["checkbox"] as $val )
            {
                $data['g_iccid'] = $val;
                $gprs = new gprs ( array ( 'g_iccid' => $val ) );
                //$agents = new agents ( array ( 'ag_number' => $_SESSION['ag']['ag_number'] ) );
                $info = $gprs->getByid ();
                // $ag_info = $agents->getByid ();
                $data['g_agents_id'] = $_REQUEST['ag_number'];
                $data['g_agents_assign'] = $info['g_agents_assign'] . "|" . $data['g_agents_id'] . "|";
                $data['g_outtime'] = date ( 'Y-m-d' , time () );
                $data['g_intime0'] = $data['g_outtime'];
                $data['g_final_user'] = $_REQUEST['g_final_user'];
                $data['g_e_id'] = $e_id;
                $data['g_stock_status'] = 2;
                $this->gprs->set ( $data );
                $this->gprs->gprsshellout ();
            }
            /*             * ******************************** */
        }
        $this->tools->call ( "操作成功！" , 0 , true );
    }

//流量卡入库 OMP特有
    public function gprs_save ()
    {
        if ( $_REQUEST['do'] != "edit" )
        {
            //$_REQUEST['ag_number'] = $_REQUEST['g_final_user'];

            //$agents = new agents ( $_REQUEST );
            //$list = $agents->getByid ();
            $arr_iccid = array ();
            $arr_packages = array ();
            $arr_start_time = array ();
            $arr_intime = array ();
            $arr_belong = array ();
            foreach ( $_REQUEST as $key => $value )
            {
                if ( strstr ( $key , "g_iccid" ) )
                {
                   //$_REQUEST['g_iccid'] = array ();
                    array_push ( $arr_iccid , $value );
                }
                if ( strstr ( $key , "g_packages" ) )
                {
                    array_push ( $arr_packages , $value );
                }
                if ( strstr ( $key , "g_start_time" ) )
                {
                    //$_REQUEST['g_start_time'] = array ();
                    array_push ( $arr_start_time , $value );
                }
                if ( strstr ( $key , "g_intime" ) )
                {
                    //$_REQUEST['g_intime'] = array ();
                    array_push ( $arr_intime , $value );
                }
                if ( strstr ( $key , "g_belong" ) )
                {
                   //$_REQUEST['g_belong'] = array ();
                    array_push ( $arr_belong , $value );
                }
            }
            $_REQUEST['g_iccid'] = $arr_iccid;
            $_REQUEST['g_packages'] = $arr_packages;
            $_REQUEST['g_start_time'] = $arr_start_time;
            $_REQUEST['g_intime'] = $arr_intime;
            $_REQUEST['g_belong'] = $arr_belong;
            for ( $i = 0; $i < count ( $_REQUEST['g_iccid'] ); $i ++ )
            {
                $data['g_final_user'] = $_REQUEST['g_final_user'];
                $data['g_iccid'] = $_REQUEST['g_iccid'][$i];
                $data['g_packages'] = $_REQUEST['g_packages'][$i];
                $data['g_start_time'] = $_REQUEST['g_start_time'][$i];
                $data['g_intime'] = $_REQUEST['g_intime'][$i];
                $data['g_belong'] = $_REQUEST['g_belong'][$i];
                $data['g_agents_assign'] = "|0|";
                $data['g_agents_id'] = 0;
                $data['g_stock_status'] = 1;
                $data['g_recorder'] = $_REQUEST['g_final_user'];
                $data['do'] = $_REQUEST['do'];

                $this->gprs->set ( $data );
                if ( $data['g_iccid'] != "" && $data['g_belong'] != "" )
                {
                    $this->gprs->save_gprs ();
                }
            }
        }
        else
        {
            //$_REQUEST['ag_number'] = $_REQUEST['g_final_user'];
            $data['g_final_user'] = $_REQUEST['g_final_user'];
            $data['g_iccid'] = $_REQUEST['g_iccid'][0];
            $data['g_packages'] = $_REQUEST['g_packages'][0];
            $data['g_start_time'] = $_REQUEST['g_start_time'][0];
            $data['g_intime'] = $_REQUEST['g_intime'][0];
            $data['g_belong'] = $_REQUEST['g_belong'][0];
            $data['do'] = $_REQUEST['do'];
            $this->gprs->set ( $data );
            $this->gprs->save_gprs ();
        }
        $this->tools->call ( "操作成功" , 0 , true );
    }

    public function gprs_option ()
    {
        $gprs = new gprs ( $_REQUEST );
        $list = $gprs->getgprsList ();
        $this->smarty->assign ( 'list' , $list );
        $this->htmlrender ( 'modules/gprs/gprs_option_view.tpl' );
    }
    //流量卡入库
    public function batch_gprs_gqt(){
        $msg=$this->gprs->save_gprs();
        $this->tools->call($msg['msg'], $msg['status'], true);
  }
  
  //流量卡入库
    public function batch_gprs(){
        foreach ($_REQUEST["g_iccid"] as $key => $value) {
            $data['g_iccid']=$value;
            $data['g_imsi']=$_REQUEST['g_imsi'][$key];
            $data['g_number']=$_REQUEST['g_number'][$key];
            if($_REQUEST['g_agents_id'][$key]=='' || $_REQUEST['g_agents_id'][$key]=='0'){
                $data['g_agents_id']="0";
            }else{
                $data['g_agents_id']=$_REQUEST['g_agents_id'][$key];
            }
            
            $data['g_binding']='0';
            $data['g_status']='2';
            $data['g_add_user']=$_SESSION['own']['om_id'];
            $data['g_intime']=date('Y-m-d H:i:s',time());
            $this->gprs->set($data);
            $msg=$this->gprs->save_gprs();
        }
        $this->tools->call($msg['msg'], $msg['status'], true);
  }
    //批量删除流量卡
    public function batch_del_gprs(){
          $res=0;
          foreach ($_REQUEST['checkbox'] as $key => $value) {
              $data['g_id']=$value;
              $this->gprs->set($data);
              $aRes=$this->gprs->getselect_list();
              if($aRes['g_binding'] == '0') 
              {
                $this->gprs->gprs_del();
                $res++;
              }
              
          }
            echo $res;
    }
    //流量卡批量绑定代理商
    public function bind_gprs(){
        $res=0;
        $args = explode(',',rtrim($_REQUEST['g_ids'],','));
        $data['agents'] = $_REQUEST['agents'];
        foreach ($args as $key => $value) {
            $data['g_id']=$value;
            $this->gprs->set($data);
            $aRes=$this->gprs->getselect_list();
            if($aRes['g_binding'] == '0') 
            {
                $this->gprs->gprs_binds();
                $res++;
            }
        }
        echo $res;
    }

}
