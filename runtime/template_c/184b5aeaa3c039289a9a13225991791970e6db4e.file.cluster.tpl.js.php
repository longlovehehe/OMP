<?php /* Smarty version Smarty-3.1.11, created on 2016-05-31 10:25:40
         compiled from "..\static\script\modules\device\cluster.tpl.js" */ ?>
<?php /*%%SmartyHeaderCode:32191574cf624731548-00789616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '184b5aeaa3c039289a9a13225991791970e6db4e' => 
    array (
      0 => '..\\static\\script\\modules\\device\\cluster.tpl.js',
      1 => 1444720686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32191574cf624731548-00789616',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_574cf6247641d1_62590459',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_574cf6247641d1_62590459')) {function content_574cf6247641d1_62590459($_smarty_tpl) {?>function del_cluster(cluster_id){
    layer.confirm("<?php echo L('是否删除该部署ID?');?>
",{btn: ["<?php echo L('确定');?>
", "<?php echo L('取消');?>
"],title:"<?php echo L('删除');?>
"},function(){
        $.ajax({
        url:'?m=device&a=cluster_del',
        data:{cluster_id:cluster_id},
        success:function(msg){
            if(msg==0)
            {
            	layer.msg("<?php echo L('删除失败');?>
"); 
            }
            else
            {
                 layer.msg("<?php echo L('删除成功');?>
"); 
                window.location.reload(); 
            }
        }
    });
    });
    
}
<?php }} ?>