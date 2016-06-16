<?php
require_once ROOT_ADDR.'/shell/class/create_records.class.php';
$api=new create_records();
/**
 * 生成计费报表
 */
if($_REQUEST['type']=="records"){
    try{
        $api->Generate_Billing_Records();
    } catch (Exception $ex){

    }
/**
 * 指定当月生效的产品/增值共功能 计费报表之后
 */
    $e_id_array=$api->set_product_function();

/**
 * 扫描用户属性类型 测试 OR 商用
 */
}else if($_REQUEST['type']=="attr"){
    //$api->set_user_attrtype();
}else{
    header('Content-type: text/html;charset:"UTF8"');
    echo "<script> alert(参数错误,请检查单数是否正确......);</script>";
}

/**
 * 进行企业数据同步(全部 包括通讯录)
 */
$api->sync_enterprise($e_id_array);