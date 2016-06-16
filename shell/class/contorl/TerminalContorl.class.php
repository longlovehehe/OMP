<?php
/**
 * 终端管理控制器类
 * @category 业务管理
 * @package 终端管理
 * @subpackage 控制器层
 * @require {@see device} {@see enterprise} {@see area} {@see contorl} {@see page}
 */
class TerminalContorl extends contorl{
    /**
     * 终端模板下载
     */
    public function terminal_export_vt ()
    {
        $data = array ();

        //获得类型参数
        $res=$this->tem->getList();
        
        $type_model="";
        foreach ($res as $key => $value) {
            $type_model.=$value['tt_type'].",";
        }
       $type_model= trim($type_model,",");
       //获取所有一级代理商，并将代理商名称拼接成字符串
        $ag_list=$this->gprs->getAllag();
        $ag_str="OMP,";
        foreach ($ag_list as $key => $value) {
            $ag_str.=$value['ag_name'].",";
        }
        $ag_str= trim($ag_str,",");

        $excel = new PHPExcel();
        $excel->getActiveSheet()->setTitle('Worksheet');
         $excel->getActiveSheet()->getColumnDimension(1)->setAutoSize(true);
         $excel->getActiveSheet()->getColumnDimension(2)->setAutoSize(true);
         $excel->getActiveSheet()->getColumnDimension(3)->setAutoSize(true);
         $excel->getActiveSheet()->getColumnDimension(4)->setAutoSize(true);
        /** 设置表头 */
        $excel->getActiveSheet ()->setCellValue ( 'A1' , 'IMEI' );
        $excel->getActiveSheet ()->setCellValue ( 'B1' , L('终端型号') );
        $excel->getActiveSheet ()->setCellValue ( 'C1' , L('序列号') );
        $excel->getActiveSheet ()->setCellValue ( 'D1' , L('所属代理商') );
        
        $excel->getActiveSheet ()->setCellValueExplicit ( "A" . 2 , '123456789012345' , PHPExcel_Cell_DataType::TYPE_STRING );

        $excel->getActiveSheet ()->getCell("B". 2)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
           -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
           -> setAllowBlank(false)
           -> setShowInputMessage(true)
           -> setShowErrorMessage(true)
           -> setShowDropDown(true)
           -> setErrorTitle(L('输入的值有误'))
           -> setError(L('您输入的值不在下拉框列表内'))
           -> setPromptTitle(L('设备类型'))
           -> setFormula1('"'.$type_model.'"');
        $excel->getActiveSheet ()->setCellValueExplicit ( "C" . 2 , '123asd' , PHPExcel_Cell_DataType::TYPE_STRING );

        //表格填充代理商列表，并判断传入字符串长度
        $str_len = strlen($ag_str);  

        if($str_len>=255){  
            $str_list_arr = explode(',', $ag_str);   
            if($str_list_arr)   
                  foreach($str_list_arr as $i =>$d){  
                         $c = $i+1;  
                         //$excel->getActiveSheet($c,$d);
                         $excel->getActiveSheet()->setCellValueExplicit ( "T".$c , $d , PHPExcel_Cell_DataType::TYPE_STRING );   
                   }   
             $endcell = $c;
             $excel->getActiveSheet ()->getColumnDimension('T')->setVisible(false);   
        }
   
        if($str_len<255){
            $excel->getActiveSheet ()->getCell("D". 2)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
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
            $excel->getActiveSheet ()->getCell("D". 2)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                   -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                   -> setAllowBlank(false)
                   -> setShowInputMessage(true)
                   -> setShowErrorMessage(true)
                   -> setShowDropDown(true)
                   -> setErrorTitle(L('输入的值有误'))
                   -> setError(L('您输入的值不在下拉框列表内'))
                   -> setPromptTitle(L('所属代理商'))
                   //-> setFormula1('$T$1:$T${$endcell}');
                   -> setFormula1('$T$1:$T$'.$endcell."'");
        }  

        
        $excel->getActiveSheet ()->setCellValueExplicit ( "A" . 3 , '123456789012346' , PHPExcel_Cell_DataType::TYPE_STRING );

        $excel->getActiveSheet ()->getCell("B". 3)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
           -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
           -> setAllowBlank(false)
           -> setShowInputMessage(true)
           -> setShowErrorMessage(true)
           -> setShowDropDown(true)
           -> setErrorTitle(L('输入的值有误'))
           -> setError(L('您输入的值不在下拉框列表内'))
           -> setPromptTitle(L('设备类型'))
           -> setFormula1('"'.$type_model.'"');
        $excel->getActiveSheet ()->setCellValueExplicit ( "C" . 3 , '123asd6666' , PHPExcel_Cell_DataType::TYPE_STRING );
   
        if($str_len<255){
            $excel->getActiveSheet ()->getCell("D". 3)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
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
            $excel->getActiveSheet ()->getCell("D". 3)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                   -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                   -> setAllowBlank(false)
                   -> setShowInputMessage(true)
                   -> setShowErrorMessage(true)
                   -> setShowDropDown(true)
                   -> setErrorTitle(L('输入的值有误'))
                   -> setError(L('您输入的值不在下拉框列表内'))
                   -> setPromptTitle(L('所属代理商'))
                   //-> setFormula1("Worksheet!T1:{$endcell}");
                   //-> setFormula1('$T$1:$T${$endcell}');
                   -> setFormula1('$T$1:$T$'.$endcell."'");
        }  

        /* 导出 */
        coms::head ( 'excel' , $excel );

}
 /**
     * 终端模板下载
     */
    public function terminal_export ()
    {
        $data = array ();
        //获得类型参数
        $res=$this->tem->getList();
        $type_model="";
        foreach ($res as $key => $value) {
            $type_model.=$value['tt_type'].",";
        }
       $type_model= trim($type_model,",");

       //获取所有一级代理商，并将代理商名称拼接成字符串
        $ag_list=$this->gprs->getAllag();
        $ag_str="OMP,";
        foreach ($ag_list as $key => $value) {
            $ag_str.=$value['ag_name'].",";
        }
        $ag_str= trim($ag_str,",");
        
        $excel = new PHPExcel();
        $excel->getActiveSheet()->setTitle('Worksheet');
        $excel->getActiveSheet()->getColumnDimension(1)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension(2)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension(3)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension(4)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension(5)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension(6)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension(7)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension(8)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension(9)->setAutoSize(true);
        $excel->getActiveSheet()->getColumnDimension("I")->setWidth(25);
        /** 设置表头 */
        $excel->getActiveSheet ()->setCellValue ( 'A1' , L('终端名称') );
        $excel->getActiveSheet ()->setCellValue ( 'B1' , L('终端型号') );
        $excel->getActiveSheet ()->setCellValue ( 'C1' , L('IMEI') );
        $excel->getActiveSheet ()->setCellValue ( 'D1' , L('序列号') );
        $excel->getActiveSheet ()->setCellValue ( 'E1' , L('批次') );
        $excel->getActiveSheet ()->setCellValue ( 'F1' , L('入库日期') );
        $excel->getActiveSheet ()->setCellValue ( 'G1' , L('入库单号') );
        $excel->getActiveSheet ()->setCellValue ( 'H1' , L('备注') );
        $excel->getActiveSheet ()->setCellValue ( 'I1' , L('所属代理商') );
        $excel->getActiveSheet ()->setCellValue ( 'J1' , L('MEID') );

        $excel->getActiveSheet ()->setCellValueExplicit ( "A" . 2 , '有屏' , PHPExcel_Cell_DataType::TYPE_STRING );

        $excel->getActiveSheet ()->getCell("B". 2)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
           -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
           -> setAllowBlank(false)
           -> setShowInputMessage(true)
           -> setShowErrorMessage(true)
           -> setShowDropDown(true)
           -> setErrorTitle(L('输入的值有误'))
           -> setError(L('您输入的值不在下拉框列表内'))
           -> setPromptTitle(L('设备类型'))
           -> setFormula1('"'.$type_model.'"');
        $excel->getActiveSheet ()->setCellValueExplicit ( "C" . 2 , '123456789012346' , PHPExcel_Cell_DataType::TYPE_STRING );
        $excel->getActiveSheet ()->setCellValueExplicit ( "D" . 2 , "123asd" , PHPExcel_Cell_DataType::TYPE_STRING2 );
        $excel->getActiveSheet ()->setCellValueExplicit ( "E" . 2 , '00000000001' , PHPExcel_Cell_DataType::TYPE_STRING );
        $excel->getActiveSheet ()->setCellValueExplicit ( "F" . 2 , '20151125' , PHPExcel_Cell_DataType::TYPE_STRING );
        $excel->getActiveSheet ()->setCellValueExplicit ( "G" . 2 , '2015112521555200001' , PHPExcel_Cell_DataType::TYPE_STRING );
        $excel->getActiveSheet ()->setCellValueExplicit ( "H" . 2 , '内容填写' , PHPExcel_Cell_DataType::TYPE_STRING );

        //表格填充代理商列表，并判断传入字符串长度
        $str_len = strlen($ag_str);  

        if($str_len>=255){  
            $str_list_arr = explode(',', $ag_str);   
            if($str_list_arr)   
                  foreach($str_list_arr as $i =>$d){  
                         //$c = "T".($i+1); 
                         $c = $i+1;
                         //$excel->getActiveSheet($c,$d);
                         $excel->getActiveSheet()->setCellValueExplicit ( "T".$c , $d , PHPExcel_Cell_DataType::TYPE_STRING );   
                   }   
             $endcell = $c;
             $excel->getActiveSheet ()->getColumnDimension('T')->setVisible(false);   
        }
   
        if($str_len<255){
            $excel->getActiveSheet ()->getCell("I". 2)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
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
            $excel->getActiveSheet ()->getCell("I". 2)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                   -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                   -> setAllowBlank(false)
                   -> setShowInputMessage(true)
                   -> setShowErrorMessage(true)
                   -> setShowDropDown(true)
                   -> setErrorTitle(L('输入的值有误'))
                   -> setError(L('您输入的值不在下拉框列表内'))
                   -> setPromptTitle(L('所属代理商'))
                   //-> setFormula1("Worksheet!T1:{$endcell}");
                   //-> setFormula1('$T$1:$T${$endcell}');
                   -> setFormula1('$T$1:$T$'.$endcell."'");

        }   
        $excel->getActiveSheet ()->setCellValueExplicit ( "J" . 2 , '222222aaa22222' , PHPExcel_Cell_DataType::TYPE_STRING );
        
        
        $excel->getActiveSheet ()->setCellValueExplicit ( "A" . 3 , '无屏' , PHPExcel_Cell_DataType::TYPE_STRING );

        $excel->getActiveSheet ()->getCell("B". 3)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
           -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
           -> setAllowBlank(false)
           -> setShowInputMessage(true)
           -> setShowErrorMessage(true)
           -> setShowDropDown(true)
           -> setErrorTitle(L('输入的值有误'))
           -> setError(L('您输入的值不在下拉框列表内'))
           -> setPromptTitle(L('设备类型'))
           -> setFormula1('"'.$type_model.'"');
        $excel->getActiveSheet ()->setCellValueExplicit ( "C" . 3 , '123456789012347' , PHPExcel_Cell_DataType::TYPE_STRING );
        $excel->getActiveSheet ()->setCellValueExplicit ( "D" . 3 , "123asd22" , PHPExcel_Cell_DataType::TYPE_STRING2 );
        $excel->getActiveSheet ()->setCellValueExplicit ( "E" . 3 , '00000000001' , PHPExcel_Cell_DataType::TYPE_STRING );
        $excel->getActiveSheet ()->setCellValueExplicit ( "F" . 3 , '20151125' , PHPExcel_Cell_DataType::TYPE_STRING );
        $excel->getActiveSheet ()->setCellValueExplicit ( "G" . 3 , '2015112521555200001' , PHPExcel_Cell_DataType::TYPE_STRING );
        $excel->getActiveSheet ()->setCellValueExplicit ( "H" . 3 , '内容填写2' , PHPExcel_Cell_DataType::TYPE_STRING );
   
        if($str_len<255){
            $excel->getActiveSheet ()->getCell("I". 3)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
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
            $excel->getActiveSheet ()->getCell("I". 3)->getDataValidation()-> setType(PHPExcel_Cell_DataValidation::TYPE_LIST)
                   -> setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION)
                   -> setAllowBlank(false)
                   -> setShowInputMessage(true)
                   -> setShowErrorMessage(true)
                   -> setShowDropDown(true)
                   -> setErrorTitle(L('输入的值有误'))
                   -> setError(L('您输入的值不在下拉框列表内'))
                   -> setPromptTitle(L('所属代理商'))
                   //-> setFormula1('$T$1:$T${$endcell}');
                   -> setFormula1('$T$1:$T$'.$endcell."'");

        }  
        $excel->getActiveSheet ()->setCellValueExplicit ( "J" . 3 , '111111aaa11111' , PHPExcel_Cell_DataType::TYPE_STRING );
        /* 导出 */
        coms::head ( 'excel' , $excel );

}

    /**
     * 终端入库导入
     */
    public function importShellIMEI ()
    {
        $step = is_string ( $_REQUEST['step'] ) ? $_REQUEST['step'] : '';
        if ( $step === 'if' )
        {
            $msg = $this->importMTFile ();
            print "<script>parent.tm_if_callback(" . $msg . ")</script>";
            exit;
        }
        if ( $step === 'ic' )
        {
            try
            {
                if($_SESSION['ident']=="VT"){
                   $f = $this->importIMEICheck_vt (); 
                }else{
                  $f = $this->importIMEICheck ();  
                }
                if ( count ( $this->error ) > 0 ||count ( $this->warn ) > 0 )
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
                $json['msg'] .= "<hr />";
                $json['msg'] .= implode ( '<br />' , $this->warn );
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
                if($_SESSION["ident"]=="VT"){
                    $this->importMT_vt ();   
                }else{
                    $this->importMT ();                    
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
     * 终端导入检查
     * @return string
     * @throws Exception
     */
    private function importIMEICheck_vt ()
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
        $highestRow = $objWorksheet->getHighestRow ("A");//取得总行数
        $mttm = array ();
        $error = array ();
        $warn = array ();
        $mtnumber = array ();
        $wz = "";
        $term=new terminal();
        $info=$term->getList();
        $info_str="";
        foreach($info as $key=>$value){
            $info_str.=",".$value['tt_type'].",";
        }
        for ( $row = 2; $row <= $highestRow; $row ++ )
        {
            //$tmpName = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
           /*
            if ( $tmpName !== '' )
            {
                $wz = $tmpName;

                if ( ! Cof::re ( ' /^\d{19,20}$/' , $tmpName , 64 ) )
                {
                    $error[] = "第 $row 行，$tmpName 不符合规则";
                }
            }*/
            $tmpuser = array ();
            $tmpuser['md_imei'] = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            $tmpuser['md_type'] = trim ( $objWorksheet->getCellByColumnAndRow ( 1 , $row )->getValue () );
            $tmpuser['md_serial_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );
            $tmpuser['md_parent_ag'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
            $mtnumber[$row]=$tmpuser['md_imei'];
             if ( $tmpuser['md_imei'] !== '' )
            {
                $wz = $tmpuser['md_imei'];
                if ( ! Cof::re ( '/^[0-9a-zA-Z]{15}$/' , $tmpuser['md_imei'] , 64 ) )
                {
                    //$error[] = "第 %d 行，%d 不是IMEI号";
                    $error[] = sprintf(L("第 %d 行，%s imei格式不对，必须为15位数字或字母"),
                            $row,
                            $tmpuser['md_imei']
                            );
                }
                if($tmpuser['md_type']!=""){
                    if(!strpos($info_str,$tmpuser['md_type'])){
                         $error[] = sprintf(L("第 %d 行，%s 终端类型不存在"),
                                $row,
                                $tmpuser['md_type']
                                );
                    }
                }else{
                     $error[] = sprintf(L("第 %d 行，%s 终端类型不存在"),
                                $row,
                                $tmpuser['md_type']
                                );
                }
                if($tmpuser['md_serial_number']!=""){
                    if ( ! Cof::re ( ' /^([^\s\\s]|[a-zA-Z0-9]+)$/' , $tmpuser['md_serial_number'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不是终端序列号"),
                                $row,
                                $tmpuser['md_serial_number']
                                );
                    }
                }

                //判断传来的所属代理商是否存在，并将代理商的名字转换为代理商的编号
                if($tmpuser['md_parent_ag']!=""){
                     $info = $this->gprs->check_ag($tmpuser['md_parent_ag']);
                     if(!$info){
                        //$tmpuser['md_parent_ag'] = $info['ag_number'];
                     //}else{
                        $error[] = sprintf(L("第 %d 行，%s 填写的所属代理商不存在"),
                                $row,
                                $tmpuser['md_parent_ag']
                                );
                     }
                }else{
                    $error[] = sprintf(L("第 %d 行，%s 请选择所属代理商"),
                                $row,
                                $tmpuser['md_parent_ag']
                                );
                }
                
//                 if($this->check_imei_im($tmpuser['md_imei'])==false){
//                //$error[] = "第 %d 行，%d 已存在";
//                $warn[] = sprintf(L("第 %d 行，%s IMEI已存在"),
//                            $row,
//                            $tmpuser['md_imei']
//                            );
//                }
           
           
//            $tmpuser['md_serial_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
            //var_dump ( Cof::re ( '/[0-9]/' , $tmpuser['g_iccid'] ) );
             /*
            if ( ! Cof::re ( '/^[\d]+$/' , $tmpuser['md_imei'] ) )
            {
                $error[] = "第 $row 行，" . $tmpuser['md_imei'] . "IMEI不是数字";
            }
           
            if ( ! Cof::re ( '/^[\d]+$/' , $tmpuser['g_start_time'] ) )
            {
                $warn[] = "警告 第 $row 行，开卡日期" . $tmpuser['g_start_time'] . " 不符合规范。（如:20150203）";
            }
             */
            $mttm[$wz][] = $tmpuser;
             }
        }
        if(count($mttm)==0){
            throw new Exception ( L("导入内容为空,请检查") );
        }else{
            /*$res=array_unique($mtnumber);
            $res_diff=array_diff_assoc($mtnumber,$res);

            $resuslt=array_intersect($res,$res_diff);
            $arr_final=array();
            foreach ($resuslt as $key => $value) {
                foreach ($res_diff as $k => $val) {
                    if($value==$val&&$val!=""){
                         $arr_final[]= sprintf(L("第 %d 行 与 第 %d 行 IMEI相同"),
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
     * 终端导入检查
     * @return string
     * @throws Exception
     */
    private function importIMEICheck ()
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
        $highestRow = $objWorksheet->getHighestRow ("C");//取得总行数
        $mttm = array ();
        $error = array ();
        $warn = array ();
        $mtnumber = array ();
        $wz = "";
        $term=new terminal();
        $info=$term->getList();
        $info_str="";
        foreach($info as $key=>$value){
            $info_str.=",".$value['tt_type'].",";
        }
        for ( $row = 2; $row <= $highestRow; $row ++ )
        {
            //$tmpName = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
           /*
            if ( $tmpName !== '' )
            {
                $wz = $tmpName;

                if ( ! Cof::re ( ' /^\d{19,20}$/' , $tmpName , 64 ) )
                {
                    $error[] = "第 $row 行，$tmpName 不符合规则";
                }
            }*/
            $tmpuser = array ();
            $tmpuser['md_name'] = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            $tmpuser['md_type'] = trim ( $objWorksheet->getCellByColumnAndRow ( 1 , $row )->getValue () );
            $tmpuser['md_imei'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );
            $tmpuser['md_serial_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
            $tmpuser['md_batch'] = trim ( $objWorksheet->getCellByColumnAndRow ( 4 , $row )->getValue () );
            $tmpuser['md_time'] = trim ( $objWorksheet->getCellByColumnAndRow ( 5 , $row )->getValue () );
            $tmpuser['md_in_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 6 , $row )->getValue () );
            $tmpuser['md_remarks'] = trim ( $objWorksheet->getCellByColumnAndRow ( 7 , $row )->getValue () );
            $tmpuser['md_parent_ag'] = trim ( $objWorksheet->getCellByColumnAndRow ( 8 , $row )->getValue () );
            $tmpuser['md_meid'] = trim ( $objWorksheet->getCellByColumnAndRow ( 9 , $row )->getValue () );
            $mtnumber[$row]=$tmpuser['md_imei'];
             if ( $tmpuser['md_imei'] !== '' )
            {
                $wz = $tmpuser['md_imei'];
                if ( ! Cof::re ( '/^[0-9a-zA-Z]{15}$/' , $tmpuser['md_imei'] , 64 ) )
                {
                    //$error[] = "第 %d 行，%d 不是IMEI号";
                    $error[] = sprintf(L("第 %d 行，%s imei格式不对，必须为15位数字或字母"),
                            $row,
                            $tmpuser['md_imei']
                            );
                }

                if ( ! Cof::re ( '/^\s*$|^[0-9a-zA-Z]{14}$/' , $tmpuser['md_meid'] , 64 ) )
                {
                    $error[] = sprintf(L("第 %d 行，%s meid格式不对，必须为14位数字或字母"),
                            $row,
                            $tmpuser['md_meid']
                            );
                }

                if($tmpuser['md_type']!=""){
                    if(!strpos($info_str,$tmpuser['md_type'])){
                         $error[] = sprintf(L("第 %d 行，%s 终端类型不存在"),
                                $row,
                                $tmpuser['md_type']
                                );
                    }
                }else{
                     $error[] = sprintf(L("第 %d 行，%s 终端类型不存在"),
                                $row,
                                $tmpuser['md_type']
                                );
                }
                
                if($tmpuser['md_serial_number']!=""){
                    if ( ! Cof::re ( ' /^([^\s\\s]|[a-zA-Z0-9]+)$/' , $tmpuser['md_serial_number'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不是终端序列号"),
                                $row,
                                $tmpuser['md_serial_number']
                                );
                    }
                }
                if($tmpuser['md_batch']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['md_batch'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['md_batch']
                                );
                    }
                }
                if($tmpuser['md_in_number']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['md_in_number'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['md_in_number']
                                );
                    }
                } 
                if($tmpuser['md_remarks']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['md_remarks'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['md_remarks']
                                );
                    }
                }
                if($tmpuser['md_time']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['md_time'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['md_time']
                                );
                    }
                }

                //判断传来的所属代理商是否存在，并将代理商的名字转换为代理商的编号
                if($tmpuser['md_parent_ag']!=""){
                     $info = $this->gprs->check_ag($tmpuser['md_parent_ag']);
                     if(!$info){
                        //$tmpuser['md_parent_ag'] = $info['ag_number'];
                     //}else{
                        $error[] = sprintf(L("第 %d 行，%s 填写的所属代理商不存在"),
                                $row,
                                $tmpuser['md_parent_ag']
                                );
                     }
                }else{
                    $error[] = sprintf(L("第 %d 行，%s 请选择所属代理商"),
                                $row,
                                $tmpuser['md_parent_ag']
                                );
                }
                /* if($this->check_imei_im($tmpuser['md_imei'])==false){
                //$error[] = "第 %d 行，%d 已存在";
                $error[] = sprintf(L("第 %d 行，%s IMEI已存在"),
                            $row,
                            $tmpuser['md_imei']
                            );
                }*/
           
           
            
//            $tmpuser['md_serial_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
            //var_dump ( Cof::re ( '/[0-9]/' , $tmpuser['g_iccid'] ) );
             /*
            if ( ! Cof::re ( '/^[\d]+$/' , $tmpuser['md_imei'] ) )
            {
                $error[] = "第 $row 行，" . $tmpuser['md_imei'] . "IMEI不是数字";
            }
           
            if ( ! Cof::re ( '/^[\d]+$/' , $tmpuser['g_start_time'] ) )
            {
                $warn[] = "警告 第 $row 行，开卡日期" . $tmpuser['g_start_time'] . " 不符合规范。（如:20150203）";
            }
             */
            $mttm[$wz][] = $tmpuser;
             }
        }
        if(count($mttm)==0){
            throw new Exception ( L("导入内容为空,请检查") );
        }else{
            /*$res=array_unique($mtnumber);
            $res_diff=array_diff_assoc($mtnumber,$res);

            $resuslt=array_intersect($res,$res_diff);
            $arr_final=array();
            foreach ($resuslt as $key => $value) {
                foreach ($res_diff as $k => $val) {
                    if($value==$val&&$val!=""){
                         $arr_final[]= sprintf(L("第 %d 行 与 第 %d 行 IMEI相同"),
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
    
    // 导入文件
    private function importMTFile ()
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
    private function importMT_vt ()
    {
        $e_id = filter_input ( INPUT_GET , 'e_id' );
        $f = filter_input ( INPUT_GET , 'f' );
        $file = $f . '.xls';
        $config = Cof::config ();
        $filePath = $config['system']['webroot'] . DIRECTORY_SEPARATOR . "runtime" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $file;
        $objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );

        $objPHPExcel = $objReader->load ( $filePath );
        $objWorksheet = $objPHPExcel->getSheet ( 0 );

        $highestRow = $objWorksheet->getHighestRow ("A");    //取得总行数
        // 实际数据读取，数据导入
        $mttm = array ();
        $error = array ();
        $warn = array ();
        $mtnumber = array ();
        $wz = "";
        //导入结果显示html代码生成
        $this->data['result']="<div class='base full' style='height:520px;overflow-y:scroll;'>
                                    <table class='base full'>
                                        <tr class='head'>
                                            <th width='100px'>".L("终端类型")."</th>
                                            <th width='150px'>IMEI</th>
                                            <th width='150px'>".L("所属代理商")."</th>
                                            <th width='70px'>".L("结果")."</th>
                                        </tr>";
        for ( $row = 2; $row <= $highestRow; $row ++ )
        {
            //$tmpName = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            /*
            if ( $tmpName !== '' )
            {
                $wz = $tmpName;

                if ( ! Cof::re ( ' /^1\d{10}$/' , $tmpName , 64 ) )
                {
                    $error[] = "第 $row 行，$tmpName 不是手机号";
                }
            }*/
            $tmpuser = array ();
            $tmpuser['md_imei'] = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            $tmpuser['md_type'] = trim ( $objWorksheet->getCellByColumnAndRow ( 1 , $row )->getValue () );
            $tmpuser['md_serial_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );
            $tmpuser['md_parent_ag'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
            $mtnumber[$row]=$tmpuser['md_imei'];
            if ( $tmpuser['md_imei'] !== '' )
            {
                $wz = $tmpuser['md_imei'];

                if ( ! Cof::re ( ' /^[0-9a-zA-Z]{15}$/' , $tmpuser['md_imei'] , 64 ) )
                {
                    $error[] = sprintf(L("第 %d 行，%s imei格式不对，必须为15位数字或字母"),
                            $row,
                            $tmpuser['md_imei']
                            );
                }
            if($tmpuser['md_serial_number']!=""){
                    if ( ! Cof::re ( ' /^([^\s\\s]|[a-zA-Z0-9]+)$/' , $tmpuser['md_serial_number'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不是终端序列号"),
                                $row,
                                $tmpuser['md_serial_number']
                                );
                    }
                }
             if($tmpuser['md_type']==""){
                        $error[] = sprintf(L("第 %d 行，%s 不是终端型号"),
                                $row,
                                $tmpuser['md_type']
                                );
                }
            //判断传来的所属代理商是否存在，并将代理商的名字转换为代理商的编号
            if($tmpuser['md_parent_ag']!=""){
                 $info = $this->gprs->check_ag($tmpuser['md_parent_ag']);
                 if(!$info){
                    //$tmpuser['md_parent_ag'] = $info['ag_number'];
                 //}else{
                    $error[] = sprintf(L("第 %d 行，%s 填写的所属代理商不存在"),
                            $row,
                            $tmpuser['md_parent_ag']
                            );
                 }
            }else{
                $error[] = sprintf(L("第 %d 行，%s 请选择所属代理商"),
                            $row,
                            $tmpuser['md_parent_ag']
                            );
            }

                //查询imei是否已存在
                $temm = new terminal(array('md_imei'=>$tmpuser['md_imei']));
                $temm_info=$temm->getselect_list();
                //判断批量里的imei是否重复并拼接结果html
                if($temm_info){
                      $this->data['result'].="<tr>
                          <td>{$tmpuser['md_type']}</td>
                          <td>{$tmpuser['md_imei']}</td>
                          <td>{$tmpuser['md_parent_ag']}</td>
                          <td style='color:red'>".L("失败")."</td>
                      </tr>";
                }else{
                     if(isset($mttm[$tmpuser['md_imei']]) && !empty($mttm[$tmpuser['md_imei']])){
                          $this->data['result'].="<tr>
                              <td>{$tmpuser['md_type']}</td>
                              <td>{$tmpuser['md_imei']}</td>
                              <td>{$tmpuser['md_parent_ag']}</td>
                              <td style='color:red'>".L("失败")."</td>
                          </tr>";
                      }else{
                          $this->data['result'].="<tr>
                              <td>{$tmpuser['md_type']}</td>
                              <td>{$tmpuser['md_imei']}</td>
                              <td>{$tmpuser['md_parent_ag']}</td>
                              <td style='color:green'>".L("成功")."</td>
                          </tr>";
                      } 
                }

                $mttm[$wz][] = $tmpuser;
            }
           
//            $tmpuser['md_serial_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );


            /*$res=array_unique($mtnumber);
        $res_diff=array_diff_assoc($mtnumber,$res);
        
        $resuslt=array_intersect($res,$res_diff);
        $arr_final=array();
        foreach ($resuslt as $key => $value) {
            foreach ($res_diff as $k => $val) {
                if($value==$val){
                     $arr_final[]= sprintf(L("第 %d 行 与 第 %d 行 IMEI相同"),
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
        $this->data['result'].="</table></div>";
        // 导入终端设备
        $term = new terminal ();
        foreach ( $mttm as $key => $value )
        {
            $data = array ();
            $data['do'] = 'add';
            //$data['tl_id']=$term->get_tlid();
            $data['md_imei'] = $value[0]['md_imei'];
            $data['md_type'] = $value[0]['md_type'];
            $data['md_serial_number'] = $value[0]['md_serial_number'];
            $ag_info = $this->gprs->check_ag($value[0]['md_parent_ag']);
            $data['md_parent_ag'] = $ag_info['ag_number'];
            $term->set ( $data );
            try
            {
                $term->batch_save ();
            }
            catch ( Exception $exc )
            {
                if ( $exc->getCode () == 23505 )
                {
//                    throw new Exception ( L("所导入的IMEI已经存在,请检查") );
                }
            }
        //if ( $msg['status'] == '0' )
            // {
            //    $pgnumber[$key] = $e_id . sprintf ( "%05d" , $tmppgnumber );
            // }
        }

        $error = array ();
    }
    
     // 数据导入
    private function importMT ()
    {
        $e_id = filter_input ( INPUT_GET , 'e_id' );
        $f = filter_input ( INPUT_GET , 'f' );
        $file = $f . '.xls';
        $config = Cof::config ();
        $filePath = $config['system']['webroot'] . DIRECTORY_SEPARATOR . "runtime" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . $file;
        $objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );

        $objPHPExcel = $objReader->load ( $filePath );
        $objWorksheet = $objPHPExcel->getSheet ( 0 );

        $highestRow = $objWorksheet->getHighestRow ("C");    //取得总行数
        // 实际数据读取，数据导入
        $mttm = array ();
        $error = array ();
        $warn = array ();
        $mtnumber = array ();
        $excelres = array();
        $wz = "";
        $i=0;
  
        for ( $row = 2; $row <= $highestRow; $row ++ )
        {
            //$tmpName = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            /*
            if ( $tmpName !== '' )
            {
                $wz = $tmpName;

                if ( ! Cof::re ( ' /^1\d{10}$/' , $tmpName , 64 ) )
                {
                    $error[] = "第 $row 行，$tmpName 不是手机号";
                }
            }*/
            $tmpuser = array ();
            $tmpuser['md_name'] = trim ( $objWorksheet->getCellByColumnAndRow ( 0 , $row )->getValue () );
            $tmpuser['md_type'] = trim ( $objWorksheet->getCellByColumnAndRow ( 1 , $row )->getValue () );
            $tmpuser['md_imei'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );
            $tmpuser['md_serial_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 3 , $row )->getValue () );
            $tmpuser['md_batch'] = trim ( $objWorksheet->getCellByColumnAndRow ( 4 , $row )->getValue () );
            $tmpuser['md_time'] = trim ( $objWorksheet->getCellByColumnAndRow ( 5 , $row )->getValue () );
            $tmpuser['md_in_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 6 , $row )->getValue () );
            $tmpuser['md_remarks'] = trim ( $objWorksheet->getCellByColumnAndRow ( 7 , $row )->getValue () );
            $tmpuser['md_parent_ag'] = trim ( $objWorksheet->getCellByColumnAndRow ( 8 , $row )->getValue () );
            $tmpuser['md_meid'] = trim ( $objWorksheet->getCellByColumnAndRow ( 9 , $row )->getValue () );
            $mtnumber[$row]=$tmpuser['md_imei'];
            if ( $tmpuser['md_imei'] !== '' )
            {
                $wz = $tmpuser['md_imei'];

                if ( ! Cof::re ( ' /^[0-9a-zA-Z]{15}$/' , $tmpuser['md_imei'] , 64 ) )
                {
                    $error[] = sprintf(L("第 %d 行，%s imei格式不对，必须为15位数字或字母"),
                            $row,
                            $tmpuser['md_imei']
                            );
                }

                if ( ! Cof::re ( '/^\s*$|^[0-9a-zA-Z]{14}$/' , $tmpuser['md_meid'] , 64 ) )
                {
                    $error[] = sprintf(L("第 %d 行，%s meid格式不对，必须为14位数字或字母"),
                            $row,
                            $tmpuser['md_meid']
                            );
                }

                if($tmpuser['md_serial_number']!=""){
                  if ( ! Cof::re ( '/^([^\s\\s]|[a-zA-Z0-9]+)$/' , $tmpuser['md_serial_number'] , 64 ) )
                      {
                          //$error[] = "第 %d 行，%d 不是IMEI号";
                          $error[] = sprintf(L("第 %d 行，%s 不是终端序列号"),
                                  $row,
                                  $tmpuser['md_serial_number']
                                  );
                      }
                }
                if($tmpuser['md_batch']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['md_batch'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['md_batch']
                                );
                    }
                }
                if($tmpuser['md_in_number']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['md_in_number'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['md_in_number']
                                );
                    }
                } 
                if($tmpuser['md_remarks']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['md_remarks'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['md_remarks']
                                );
                    }
                }
                if($tmpuser['md_time']!=""){
                     if ( ! Cof::re ( ' /[^\s\\s]|(\S{1,128})$/' , $tmpuser['md_time'] , 64 ) )
                    {
                        //$error[] = "第 %d 行，%d 不是IMEI号";
                        $error[] = sprintf(L("第 %d 行，%s 不符合导入规范，长度过长"),
                                $row,
                                $tmpuser['md_time']
                                );
                    }
                }

                //判断传来的所属代理商是否存在，并将代理商的名字转换为代理商的编号
                if($tmpuser['md_parent_ag']!=""){
                     $info = $this->gprs->check_ag($tmpuser['md_parent_ag']);
                     if(!$info){
                        //$tmpuser['md_parent_ag'] = $info['ag_number'];
                     //}else{
                        $error[] = sprintf(L("第 %d 行，%s 填写的所属代理商不存在"),
                                $row,
                                $tmpuser['md_parent_ag']
                                );
                     }
                }else{
                    $error[] = sprintf(L("第 %d 行，%s 请选择所属代理商"),
                                $row,
                                $tmpuser['md_parent_ag']
                                );
                }
                /*//查询imei是否已存在
                $temm = new terminal(array('md_imei'=>$tmpuser['md_imei']));
                $temm_info=$temm->getselect_list();
                //判断批量里的imei是否重复并拼接结果html
                if($temm_info){
                      $this->data['result'].="<tr>
                          <td>{$tmpuser['md_type']}</td>
                          <td>{$tmpuser['md_imei']}</td>
                          <td>{$tmpuser['md_parent_ag']}</td>
                          <td style='color:red'>".L("失败")."</td>
                      </tr>";
                }else{
                     if(isset($mttm[$tmpuser['md_imei']]) && !empty($mttm[$tmpuser['md_imei']])){
                          $this->data['result'].="<tr>
                              <td>{$tmpuser['md_type']}</td>
                              <td>{$tmpuser['md_imei']}</td>
                              <td>{$tmpuser['md_parent_ag']}</td>
                              <td style='color:red'>".L("失败")."</td>
                          </tr>";
                      }else{
                          $this->data['result'].="<tr>
                              <td>{$tmpuser['md_type']}</td>
                              <td>{$tmpuser['md_imei']}</td>
                              <td>{$tmpuser['md_parent_ag']}</td>
                              <td style='color:green'>".L("成功")."</td>
                          </tr>";
                      } 
                }*/
                
                $mttm[$wz][] = $tmpuser;
                $excelres[$i] = $tmpuser;
                $i++;
            }

//            $tmpuser['md_serial_number'] = trim ( $objWorksheet->getCellByColumnAndRow ( 2 , $row )->getValue () );

            /*$res=array_unique($mtnumber);
            $res_diff=array_diff_assoc($mtnumber,$res);
            
            $resuslt=array_intersect($res,$res_diff);
            $arr_final=array();
            foreach ($resuslt as $key => $value) {
                foreach ($res_diff as $k => $val) {
                    if($value==$val){
                         $arr_final[]= sprintf(L("第 %d 行 与 第 %d 行 IMEI相同"),
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
        //$this->data['result'].="</table>";

        //导入结果显示html代码生成
        $this->data['result']="<div class='base full' style='height:520px;overflow-y:scroll;'>
                                    <table class='base full'>
                                        <tr class='head'>
                                            <th width='100px'>".L("终端类型")."</th>
                                            <th width='150px'>IMEI</th>
                                            <th width='150px'>".L("所属代理商")."</th>
                                            <th width='70px'>".L("结果")."</th>
                                        </tr>";
        // 导入终端设备
        $term = new terminal ();
        //foreach ( $mttm as $key => $value )
        foreach ( $excelres as $key => $value )
        {
            $data = array ();
            $data['do'] = 'add';
            //$data['tl_id']=$term->get_tlid();
            /*$data['md_imei'] = $value[0]['md_imei'];
            $data['md_type'] = $value[0]['md_type'];
            $data['md_serial_number'] = $value[0]['md_serial_number'];
            $data['md_name'] = $value[0]['md_name'];
            $data['md_in_number'] = $value[0]['md_in_number'];
            $data['md_batch'] = $value[0]['md_batch'];
            $data['md_time'] = $value[0]['md_time'];
            $data['md_remarks'] = $value[0]['md_remarks'];
            $ag_info = $this->gprs->check_ag($value[0]['md_parent_ag']);
            $data['md_parent_ag'] = $ag_info['ag_number'];*/
            
            //判断imei是否已存在,存在则跳过,继续往下验证
            $data['md_imei'] = $value['md_imei'];
            if($data['md_imei'] != ''){
                $info_imei = $term->checkexcel_imei($data['md_imei']);
                if($info_imei){
                    $imei_check = false;
                }else{
                    $imei_check = true;
                }
            }else{
                $imei_check = false;
            }
            
            //判断meid是否已存在,存在则跳过,继续往下验证
            $data['md_meid']=$value['md_meid'];
            if($data['md_meid'] != ''){
                $info_meid = $term->checkexcel_meid($data['md_meid']);
                if($info_meid){
                    $meid_check = false;
                }else{
                    $meid_check = true;
                }
            }else{
                $meid_check = true;
            }
            
            //判断 imei meid是否已存在  并拼接结果提示html
            if( $imei_check==true && $meid_check==true )
            {
                $this->data['result'].="<tr>
                    <td>{$value['md_type']}</td>
                    <td>{$value['md_imei']}</td>
                    <td>{$value['md_parent_ag']}</td>
                    <td style='color:green'>".L("成功")."</td>
                </tr>";
            }else{
                $this->data['result'].="<tr>
                    <td>{$value['md_type']}</td>
                    <td>{$value['md_imei']}</td>
                    <td>{$value['md_parent_ag']}</td>
                    <td style='color:red'>".L("失败")."</td>
                </tr>";
                continue;
            }
            
            
            $data['md_type'] = $value['md_type'];
            $data['md_serial_number'] = $value['md_serial_number'];
            $data['md_name'] = $value['md_name'];
            $data['md_in_number'] = $value['md_in_number'];
            $data['md_batch'] = $value['md_batch'];
            $data['md_time'] = $value['md_time'];
            $data['md_remarks'] = $value['md_remarks'];
            $ag_info = $this->gprs->check_ag($value['md_parent_ag']);
            $data['md_parent_ag'] = $ag_info['ag_number'];
            //var_dump($data);
            $term->set ( $data );
            try
            {
                $term->batch_save ();
            }
            catch ( Exception $exc )
            {
                /*if ( $exc->getCode () == 23505 )
                {
                    throw new Exception ( L("所导入的IMEI已经存在,请检查") );
                }*/
            }
            /*if ( $msg['status'] == '0' )
            {
                $pgnumber[$key] = $e_id . sprintf ( "%05d" , $tmppgnumber );
            }*/
        }
        $this->data['result'].="</table></div>";
        $error = array ();
    }
    //put your code here
    public $tem;
    public $page;
    public $groups;
    public $ag;
    public function __construct() {
        parent::__construct();
        $this->groups=new groups($_REQUEST);
        $this->gprs=new gprs($_REQUEST);
        $this->ag=new agents($_REQUEST);
        //列表页分条数显示
        if($_REQUEST['ter_num']){
            $_SESSION['ter_page_num'] = $_REQUEST['ter_num'];
        }
        if($_SESSION['ter_page_num']){
            $_REQUEST['num'] = $_SESSION['ter_page_num'];
        }
        $this->tem=new terminal($_REQUEST);
        $this->page=new page($_REQUEST);
    }
    
   public function index_type(){
       $this->render("modules/terminal/index_type.tpl",L('终端类型'));
   }
    public function index_list(){
        //列表页分条数 选中的显示相应颜色
        if($_REQUEST['ter_num']){
            unset($_SESSION['color']);
            $_SESSION['color'][$_REQUEST['ter_num']] = 'style="background:#E5E5E5"';
        }elseif($_SESSION['ter_page_num']){
            unset($_SESSION['color']);
            $_SESSION['color'][$_SESSION['ter_page_num']] = 'style="background:#E5E5E5"';
        }else{
            unset($_SESSION['color']);
            $_SESSION['color'][10] = 'style="background:#E5E5E5"';
        }

        if($_SESSION['ident']=="VT"){
            $this->render("modules/terminal/index_list_vt.tpl",L('终端管理'));
        }else{
            $this->render("modules/terminal/index_list.tpl",L('终端管理'));
        }
   }
   public function terminal_in(){
        $mininav = array(
                         array(
                                 "url" => "?m=terminal&a=index_list",
                                 "name" => "终端管理",
                                 "next" => ">>",
                         ),
                         array(
                                 "url" => "#",
                                 "name" => "终端入库",
                                 "next" => "",
                         ),
                 );
        $this->smarty->assign('mininav', $mininav);
        if($_SESSION['ident']=="VT"){
            $this->render("modules/terminal/terminal_in_vt.tpl",L('终端入库'));
        }else{
            $this->render("modules/terminal/terminal_in.tpl",L('终端入库'));
        }
        
   }

   public function term_edit(){
        $mininav = array(
                         array(
                                 "url" => "?m=terminal&a=index_list",
                                 "name" => "终端管理",
                                 "next" => ">>",
                         ),
                         array(
                                 "url" => "#",
                                 "name" => "编辑",
                                 "next" => "",
                         ),
                 );
        $this->smarty->assign('mininav', $mininav);
       
       $info=$this->tem->getselect_list();
       $this->smarty->assign('item', $info);
        $this->render("modules/terminal/term_edit.tpl",L('终端编辑'));
   }
   
   public function save_in_terminal(){
       $this->tem->save_in_terminal();
   }
   public function index_list_item(){
       $this->page->setTotal($this->tem->getlistTotal());
       $list = $this->tem->getlistList($this->page->getLimit());
       $numinfo = $this->page->getNumInfo();
        $prev = $this->page->getPrev();
        $next = $this->page->getNext();
        $this->smarty->assign('list', $list);
        $this->smarty->assign('numinfo', $numinfo);
        $this->smarty->assign('prev', $prev);
        $this->smarty->assign('next', $next);
       $this->smarty->assign('title', "终端类型列表");
       $this->smarty->assign('list', $list);
        if($_SESSION['ident']=="VT"){
            $this->htmlrender("modules/terminal/index_list_item_vt.tpl");
        }else{
            $this->htmlrender("modules/terminal/index_list_item.tpl");
        }
       
   }
   public function index_type_item(){
       $this->page->setTotal($this->tem->getTotal());
       $list = $this->tem->getList($this->page->getLimit());
       $numinfo = $this->page->getNumInfo();
        $prev = $this->page->getPrev();
        $next = $this->page->getNext();
        $this->smarty->assign('list', $list);
        $this->smarty->assign('numinfo', $numinfo);
        $this->smarty->assign('prev', $prev);
        $this->smarty->assign('next', $next);
       $this->smarty->assign('title', "终端类型列表");
       $this->smarty->assign('list', $list);
       $this->htmlrender("modules/terminal/index_type_item.tpl");
   }
   /**
    * frame 页面加载 添加终端类型
    */
   public function terminal_add(){
       if($_REQUEST['do']=="replace"){
            $info=$this->tem->getById_type();
            $this->smarty->assign('list',$info);
            $this->smarty->assign('data',$_REQUEST);
       }
           $this->htmlrender("modules/terminal/terminal_add.tpl");
   }
   public function terminal_replace(){
       $this->smarty->assign("list",$_REQUEST);
       $this->htmlrender("modules/terminal/terminal_replace.tpl");
   }
    /**
     * 终端页面
     */
    public function history(){
        $mininav = array(
            array(
                "url" => "?m=terminal&a=index_list",
                "name" => "终端管理",
                "next" => ">>",
            ),
            array(
                "url" => "?m=terminal&a=index_list",
                "name" => "终端列表",
                "next" => ">>",
            ),
            array(
                "url" => "#",
                "name" => "历史记录",
                "next" => "",
            ),
        );
        //获取终端信息
        $this->tem->set(array('md_imei'=>$_REQUEST['th_imei']));
        $info=$this->tem->getselect_list();
        $this->smarty->assign('mininav', $mininav);
        $this->smarty->assign('data', $info);
        $this->render("modules/terminal/terminal_history.tpl",L('历史记录'));
    }
    /**
     * 终端历史记录列表页
     */
    public function history_item(){
        $this->page->setTotal($this->tem->getTotal_history());
        $list = $this->tem->getList_term_history($this->page->getLimit());
        //var_dump($list);die;
        $numinfo = $this->page->getNumInfo();
        $prev = $this->page->getPrev();
        $next = $this->page->getNext();
        $this->smarty->assign('list', $list);
        $this->smarty->assign('numinfo', $numinfo);
        $this->smarty->assign('prev', $prev);
        $this->smarty->assign('next', $next);
        $this->htmlrender("modules/terminal/terminal_history_item.tpl");
    }
   public function terminal_upload(){
       $tem=new terminal($_REQUEST);
       $res=$tem->term_upload();
       if($res['status']===0){
            echo 1;
        }else{
            echo 2;
        }
   }
   public function check_type_name(){
       $res=$this->tem->check_type_name();
       if($res){
           echo 0;
       }else{
           echo 1;
       }
   }
           function show_pic() {
          $pic = new pic($_REQUEST);
          $pic->show_terminal();
  }
  public function option(){
      $res=$this->tem->getList();
      foreach ($res as $key => $value) {
          $list[$key]['id']=$value['tt_type'];
          $list[$key]['name']=$value['tt_type'];
      }
      $this->smarty->assign('list',$list);
      $this->htmlrender("viewer/option.tpl");
  }
  public function batch_terminal(){
      foreach ($_REQUEST["md_imei"] as $key => $value) {
          $data['md_imei']=$value;
          $data['md_type']=$_REQUEST['md_type'][$key];
          $data['md_serial_number']=trim($_REQUEST['md_serial_number'][$key]);
          //$data['tl_system_num']=$_REQUEST['tl_system_num'][$key];
          $data['md_time']=$_REQUEST['md_time'][$key];
          $data['md_parent_ag']=$_REQUEST['md_parent_ag'][$key];
          $this->tem->set($data);
          $this->tem->batch_save();
      }
      
      $this->tools->call(L("操作成功"), 0, true);
  }
//  public function save_in_terminal(){
//        $this->tem->batch_save();
//        $this->tools->call(L("操作成功"), 0, true);
//  }
  public function save_terminal(){
      $aRes=$this->tem->getById_list();
      if($aRes['md_binding'] == '1')
      {
          $msg['status']=-1;
          $msg['msg']=L("终端被绑定不能修改");
          echo json_encode($msg);
      }
      else 
      {
          $msg=$this->tem->batch_save();
          echo json_encode($msg);
      }
      
  }
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
  public function batch_del_term(){
      $res=0;
      foreach ($_REQUEST['checkbox'] as $key => $value) {
          $data['md_imei']=$value;
          $this->tem->set($data);
          $aRes=$this->tem->getselect_list();
          if($aRes['md_binding'] == '0') //未绑定 删除
          {
            $this->tem->term_del();
            $res++;
          }
          
      }
        
        echo $res;
    }
    /**
     * 批量启用终端
     */
  public function term_allstart(){
      $res=0;
      foreach ($_REQUEST['checkbox'] as $key => $value) {
          $data['md_imei']=$value;
          $this->tem->set($data);
          $aRes=$this->tem->getselect_list();
          $data['md_status']=1;
          if($aRes['md_binding'] == '1' && ($aRes['md_status'] == '0' || $aRes['md_status'] == NULL)) // 绑定且状态为0（停用）
          {
              $this->tem->set($data);
              $this->tem->set_stat();
              $res++;
          }

      }

      echo $res;
  }
    /**
     * 批量停用终端
     */
    public function term_allstop(){
        $res=0;
        foreach ($_REQUEST['checkbox'] as $key => $value) {
            $data['md_imei']=$value;
            $this->tem->set($data);
            $aRes=$this->tem->getselect_list();
            $data['md_status']=0;
            if($aRes['md_binding'] == '1' && $aRes['md_status'] == '1') // 绑定且状态为1（启用）
            {
                $this->tem->set($data);
                $this->tem->set_stat();
                $res++;
            }

        }

        echo $res;
    }
  public function del_term_type(){
      $res=$this->tem->term_del_type();
      if($res!=0){
          $pic=new pic(array('p_file'=>$_REQUEST['tt_type']));
          $info=$pic->del_pic();
      }
      echo $res;
  }
  
  /**
   * 检测imei是否已存在
   */
  public function check_imei(){
      $res = $this->tem->getById_list();
      if($res==false){
          echo 1;
      }else{
          echo 0;
      }
  }
  /**
   * 检测meid是否已存在
   */
  public function check_meid(){
      if($_REQUEST['md_meid']!=''){
          $res = $this->tem->getById_list_meid();
          if($res==false){
              echo 1;
          }else{
              echo 0;
          }
      }
  }
  /**
   * 检测imei是否已存在
   */
  public function check_imei_im($imei){
      $this->tem->set(array('md_imei'=>$imei));
      $res=  $this->tem->getById_list();
      if($res==false){
          return false;
      }else{
          return true;
      }
  }
  
  /**
   * 批量修改类型接口
   */
  public function term_batch(){
      foreach ($_REQUEST['checkbox'] as $k=>$v){
          $data['md_type']=$_REQUEST['md_type'];
          $data['md_parent_ag']=$_REQUEST['md_parent_ag'];
          $data['md_imei']=$v;
          $this->tem->set($data);
          $aRes=$this->tem->getselect_list();
          if($_REQUEST['md_type']=="%"){
              $data['md_type']=$aRes['md_type'];
              $this->tem->set($data);
          }
          if($_REQUEST['md_parent_ag']=="%"){
              $data['md_parent_ag']=$aRes['md_parent_ag'];
              $this->tem->set($data);
          }
          
          if($aRes['md_binding'] == '0')
          {
              $this->tem->save_term_type();
          }
          
      }
  }
  
  /*
   * 作者 hongyuan.li
   * 时间 2015.7.27
   * 功能 keeper管理页
   */
  public function keeper_list()
  {
      $this->render("modules/terminal/keeper_list.tpl",L('Keeper管理'));
  }
    /*
   * 作者 hongyuan.li
   * 时间 2015.7.27
   * 功能 keeper管理页列表
   */
  public function keeper_list_item()
  {
      $this->page->setTotal($this->tem->getKeeperTotal());
      $list = $this->tem->getkeeperList($this->page->getLimit());
      $numinfo = $this->page->getNumInfo();
      $prev = $this->page->getPrev();
      $next = $this->page->getNext();
      $page = $this->page->getPage();
      $this->smarty->assign('page', $page);
      $this->smarty->assign('list', $list);
      $this->smarty->assign('numinfo', $numinfo);
      $this->smarty->assign('prev', $prev);
      $this->smarty->assign('next', $next);
      $this->smarty->assign('title', "keeper列表");
      $this->htmlrender("modules/terminal/keeper_list_item.tpl");
  }
  /*
   * 作者 hongyuan.li
   * 时间 2015.7.28
   * 功能 keeper详情页
   */
  public function keeper_detail_list()
  {
      $aResult = $this->tem->getKeeper();
      $this->smarty->assign('aResult', $aResult);
      $this->render("modules/terminal/keeper_detail_list.tpl");
  }
    /*
   * 作者 hongyuan.li
   * 时间 2015.7.28
   * 功能 keeper详情页列表
   */
  public function keeper_detail_list_item()
  {
      $this->page->setTotal($this->tem->getKeeperDetailTotal());
      $list = $this->tem->getkeeperdetailList($this->page->getLimit());
      foreach ($list as $key => $value) {
          $aGroups = $this->groups->getuserPgname($value['u_number']);
          $group = array();
          if(!empty($aGroups))
          {
              foreach ($aGroups as $k => $val) {
                  array_push($group, $val['pg_name']);
              }
          }
          $list[$key]['groups']=$group;
          array_push($list[$key], $group);

      }
      $numinfo = $this->page->getNumInfo();
      $prev = $this->page->getPrev();
      $next = $this->page->getNext();
      $page = $this->page->getPage();
      $this->smarty->assign('page', $page);
      $this->smarty->assign('list', $list);
      $this->smarty->assign('numinfo', $numinfo);
      $this->smarty->assign('prev', $prev);
      $this->smarty->assign('next', $next);
      $this->smarty->assign('title', "keeper列表");
      $this->htmlrender("modules/terminal/keeper_detail_list_item.tpl");
  }
    /**
     * 所属代理商option生成
     * 所有终端设备中出现过的代理商ID
     */
    public function ag_option(){
        $list=$this->ag->getAllag();
        foreach($list as $key=>$value){
            $arr[$key]['id']=$value['ag_number'];
            $arr[$key]['name']=$value['ag_name'];
        }
        $arr=array_unique_fb($arr);
        $this->smarty->assign('list',$arr);
        $this->htmlrender("viewer/option.tpl");
    }
    /**
     * 所属企业option生成
     * 所有终端设备中出现过的代理商ID
     */
    public function e_option(){
        $list=$this->tem->get_md_alllist();
        foreach($list as $key=>$value){
            if($value['md_ent_id']!=""){
                $arr[$key]['id']=$value['md_ent_id'];
                $arr[$key]['name']=$value['e_name'];
            }
        }

        $arr=array_unique_fb($arr);
        $this->smarty->assign('list',$arr);
        $this->htmlrender("viewer/option.tpl");
    }
    /**
     * 状态设置
     */
    public function set_stat(){
        $res=$this->tem->set_stat();
        echo json_encode($res);
    }
    
     /**
     * 获取对应的imei信息
     */
    public function getById_foruser(){
        $Res=$this->tem->getselect_list();
        echo json_encode($Res);
    }
    /**
     * MEID
     */
    public function getById_foruser_meid(){
        $Res=$this->tem->checkexcel_meid($_REQUEST['md_meid']);
        echo json_encode($Res);
    }
}
