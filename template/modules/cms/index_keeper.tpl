{strip}
<h2 class="title">{"{$title}"|L}</h2>
<script src="script\plugins\baguetteBox.js"></script>
<div class="toolbar mactoolbar ">
    <a href="?m=cms&a=index" class="button">{"{$smarty.session.ident}"|L}</a>
    <a href="?m=cms&a=index_console" class="button">{"Console"|L}</a>
    <a href="?m=cms&a=index_keeper" class="button active">{"Keeper"|L}</a>
</div>
<div class="block">
    <label class="title" style="fimlay-font:微软雅黑;
           color:#535353; font-size:13px;font-weight:bold;" >{"Android软件包"|L} </label>
    <div class="t-android">
        <div class="nav_head">
        <div>
            <table class="keeper_apk">
                <tr>
                    <th width="335">{"文件名"|L}</th>
                    <th width="132">{"版本号"|L}</th>
                    <th width="100">{"最后修改时间"|L}</th>
                    <th width="76">{"操作"|L}</th>
                </tr>
                <tr title="{'文件名'|L}: 【{$info.p_file}】&#10;{'版本号'|L}: 【{$info.p_version}】&#10;{'最后修改时间'|L}: 【{$info.p_time}】" id="get_pid" p_id="{$infoa.p_id}" p_type="{$infoa.p_type}">
                    <td style="overflow:hidden; width:250px;">{$info.p_file|mbsubstr:45}</td>
                    <td style="overflow:hidden; width:64px; ">{$info.p_version}</td>
                    <td style="overflow:hidden; width:200px;" >{$info.p_time}</td>
                    <td style="overflow:hidden; width:64px;" ><a id="edit_keeper" class="link edit" href="javascript:void(0);">{"编辑"|L}</a></td>
                </tr>
            </table>
        </div>
            <br />
        </div>
        {*<div class="page none_select">
            <div class="num">{$numinfoa}</div>
            <div class="turn">
                <a page="{$preva}" class="prev">{"上一页"|L}</a>
                <a page="{$nexta}" class="next">{"下一页"|L}</a>
            </div>
        </div>*}

        <div class="fk">

            {*<a class="button"  href = "javascript:void(0)" onclick = "new_creat();">{"新建"|L}</a>
            <a class="button"  href = "javascript:void(0)" onclick = "edit_android_dir();">{"修改"|L}</a>
            <a class="button"  href = "javascript:void(0)" onclick = "del_android_dir();">{"删除"|L}</a>
            <a class="button"  href = "javascript:void(0)" onclick = "empty_android_dir();">{"清空"|L}</a>*}
        </div>
    </div>
</div>
<br />

<div class="block none"><!--  -->
    <label class="title" style="fimlay-font:微软雅黑;
           color:#535353; font-size:13px;font-weight:bold;" >{"IOS软件包"|L}</label>
    <div class="t-android">
        <div class="nav_head">
            <table>
                <tr>
                    <th width="45%">{"目录"|L}</th>

                    <th width="11%">{"版本号"|L}</th>

                    <th width="45%">{"文件名"|L}</th>
                </tr>
            </table>
            </table>
        </div>
        <div class="control">
            <table id="ios-table">
                {foreach name=list item=infoi from=$ios_info}
                <tr title="目录: {$infoi.p_dir}, 版本号: {$infoi.p_version}, 文件名: {$infoi.p_file}" onClick="do_select(this, 2);"  p_id="{$infoi.p_id}" p_type="{$infoi.p_type}">
                    <td  style="overflow:hidden; width:262px;" >{$infoi.p_dir}</td>
                    <td style="overflow:hidden; width:64px;">{$infoi.p_version}</td>
                    <td style="overflow:hidden;width:250px; ">{$infoi.p_file}</td>
                </tr>
                {/foreach}
            </table>
            <br />
        </div>
        {*<div class="page none_select">
            <div class="num">{$numinfoa}</div>
            <div class="turn">
                <a page="{$preva}" class="prev">{"上一页"|L}</a>
                <a page="{$nexta}" class="next">{"下一页"|L}</a>
            </div>
        </div>*}

        <div class="fk">

            <a class="button"  href = "javascript:void(0)" onclick = "new_creat1();">{"新建"|L}</a>
            <a class="button"  href = "javascript:void(0)" onclick = "edit_ios_dir();">{"修改"|L}</a>
            <a class="button" id="del" class="mrlf5 link" href = "javascript:void(0)" onclick = "del_ios_dir();">{"删除"|L}</a>
            <a class="button"  href = "javascript:void(0)" onclick = "empty_ios_dir();">{"清空"|L}</a>
        </div>
    </div>
</div>
<br />

<div style="clear: both;"></div>
<br />
<br />
<br />

<form id="form" action="?m=cms&a=upload_soft" method="post" name="work_form" enctype="multipart/form-data">
    <div  id="light" class="white_content">
        <input type="hidden" name="an_or_ios" value="">
        <input type="hidden" name="flag" value="save">
        <input type="hidden" id="" name="pid" value="">
        <input type="hidden" id="ptype" name="ptype" value="">
        <input type="hidden" name="browsversion" value="">

        <div style="background-color:#DCE0E1;"><div style="float:left;width: 20px;">&nbsp;</div><div class="c_dir">{"新建目录"|L}</div></div>
        <div class="conhei"></div>
        <div class="block"  style="height:35px;">
            <label class="title">{"目录名称"|L}: </label>
            <input type="text" id="ptt_soft" name="dir_name" value="" style="width:260px;" dir_name="true" autocomplete="off" required="true" >
        </div>
        <div class="block" style="height:35px;">
            <label style="float: left;" class="title" >{"软件包"|L}: </label>
            {*<input id="fileSelector" type="file" name="soft_name" style="width:300px;" soft_name="true" onchange="getFiles(this);" value="">*}
            <div class="block" style="height:35px;">
                &nbsp;&nbsp;&nbsp;<input type="text" name="path" readonly style="width: 165px;">
                <a id="zdll" href="javascript:void(0);" >{"浏览"|L}
                    <input type="file" soft_name="true" name="soft_name" id="fileSelector"  onchange="getFiles(this);">
                </a>
            </div>
        </div>
        <div class="block" style="height:35px;">
            <label class="title">{"软件版本"|L}: </label>
            <input type="text" name="ptt_version" ptt_version="true" autocomplete="off" required="true" >
        </div>

        <div class="conhei"></div>
        <div class="block" style="float:right">
            {*                            <a class=" button" onclick="up_soft();" >{"保存"|L}</a>*}
            <input type="button" value="{'保存'|L}" name="button" class="button" onclick="do_set();"/>&nbsp;&nbsp;&nbsp;
            <a class="button" href = "javascript:void(0)" onclick = "closed();">{"关闭"|L}</a>
        </div>
    </div>
</form>
{*<div class="content"></div>*}
<div id="dialog-confirm" class="hide" title="删除选中项？">
    <p>{"确定要删除该产品吗"|L}？</p>
</div>
{*图片上传*}
<div class="block">
    <label class="title" style="color: #535353;font-size: 13px;font-weight: bold;">{"Banner图"|L}: </label>
    <div style="border:1px solid #ccc;margin-left: 100px; padding: 80px 20px;height: 165px;">
       <form class="" id="fileupdate" name="fileupdate" method="post" action="?m=cms&a=upload_img"  enctype="multipart/form-data" target="hidden_frame">
        <div style="float:left; width: 150px;margin-left: 30px;">
            <div class="baguetteBoxThree " id="imgdiv"><a href="./files/pic/banner1.jpg"><img id="imgShow" src="./files/pic/banner1.jpg" width="100" height="100" /></a></div>

             <div class="block" style="height:35px;">
                <a id="zdll" href="javascript:void(0);" >{"浏览"|L}
                    <input type="file" name="fileToUpload" id="up_img"  onchange="getFiles(this);">
                </a>
            </div>
        </div>
        <div style="float:left;width: 150px;margin-left: 30px;">
            <div class="baguetteBoxThree" id="imgdiv1"><a href="./files/pic/banner2.jpg"><img id="imgShow1" src="./files/pic/banner2.jpg" width="100" height="100" /></a></div>
             <div class="block" style="height:35px;">
                <a id="zdll" href="javascript:void(0);" >{"浏览"|L}
                    <input type="file" name="fileToUpload1" id="up_img1"  onchange="getFiles(this);">
                </a>
            </div>
        </div>
        <div style="float:left;width: 150px;margin-left: 30px;">
            <div class="baguetteBoxThree" id="imgdiv2"><a href="./files/pic/banner3.jpg"><img id="imgShow2" src="./files/pic/banner3.jpg" width="100" height="100" /></a></div>
             <div class="block" style="height:35px;">
                <a id="zdll" href="javascript:void(0);" >{"浏览"|L}
                    <input type="file" name="fileToUpload2" id="up_img2"  onchange="getFiles(this);">
                </a>
            </div>
        </div>
           <input id='uppic' type="submit" style="float:right;" class="button"  value="{'上传'|L}" />
       </form>
           <div style="clear:both;padding: 20px 0px 0px 0px;"><span style="font-size:12px;color:#A83A3A">{"注释:图片格式为: jpg,大小限制不超过3MB"|L}</span></div>
           <div style="clear:both;padding: 10px 0px 0px 0px;"><span style="font-size:12px;color:#A83A3A">{"为达到最优展示效果，Banner图的宽高比最好为2:1"|L}</span></div>
    </div>
    
</div>
       <iframe name="hidden_frame" id="hidden_frame" class="hidden_frame"></iframe>
 {*图片上传 显示处理*}
 <style>


.gallery:after {
    content: '';
    display: block;
    height: 2px;
    margin: .5em 0 1.4em;
    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(77,77,77,1) 50%, rgba(0, 0, 0, 0) 100%);
    background: linear-gradient(to right, rgba(0, 0, 0, 0) 0%, rgba(77,77,77,1) 50%, rgba(0, 0, 0, 0) 100%);
}

.gallery img {
    height: 100%;
}

.gallery a {
    width: 240px;
    height: 180px;
    max-width: 100px;
    max-height:100px;
    display: inline-block;
    overflow: hidden;
    margin: 4px 6px;
    box-shadow: 0 0 4px -1px #000;
}
.hljs-comment{
    color:#969896;
}
.hljs-tag{
    color:#f8f8f2;
}
.css .hljs-class,.css .hljs-id,.css .hljs-pseudo,.hljs-attribute,.hljs-regexp,.hljs-title,.hljs-variable,.html .hljs-doctype,.ruby .hljs-constant,.xml .hljs-doctype,.xml .hljs-pi,.xml .hljs-tag .hljs-title{
    color:#c66;
}
.hljs-built_in,.hljs-constant,.hljs-literal,.hljs-number,.hljs-params,.hljs-pragma,.hljs-preprocessor{
    color:#de935f;
}.css .hljs-rules .hljs-attribute,.ruby .hljs-class .hljs-title{
    color:#f0c674;
}.hljs-header,.hljs-inheritance,.hljs-string,.hljs-value,.ruby .hljs-symbol,.xml .hljs-cdata{
    color:#b5bd68;
}.css .hljs-hexcolor{
    color:#8abeb7;
}.coffeescript .hljs-title,.hljs-function,.javascript .hljs-title,.perl .hljs-sub,.python .hljs-decorator,.python .hljs-title,.ruby .hljs-function .hljs-title,.ruby .hljs-title .hljs-keyword{
    color:#81a2be;
}.hljs-keyword,.javascript .hljs-function{
    color:#b294bb;}.hljs{
        display:block;overflow-x:auto;background:#35383C;color:#c5c8c6;padding:.8em
    }.coffeescript .javascript,.javascript .xml,.tex .hljs-formula,.xml .css,.xml .hljs-cdata,.xml .javascript,.xml .vbscript{
        opacity:.5;
    }
 </style>

<div class="content">

</div>    
{/strip}
<script  {"type='ready'"}>
    window.onload = function() {
            new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow",callback:function(){
                    
        } });
            new uploadPreview({ UpBtn: "up_img1", DivShow: "imgdiv1", ImgShow: "imgShow1",callback:function(){
                   
        } });
            new uploadPreview({ UpBtn: "up_img2", DivShow: "imgdiv2", ImgShow: "imgShow2",callback:function(){
                    
        } });
    if(typeof oldIE === 'undefined' && Object.keys)
        hljs.initHighlighting();
        baguetteBox.run('.baguetteBoxOne');
        baguetteBox.run('.baguetteBoxTwo');
        baguetteBox.run('.baguetteBoxThree', {
            animation: 'fadeIn'
        });
        baguetteBox.run('.baguetteBoxFour', {
            buttons: false
        });
        baguetteBox.run('.baguetteBoxFive', {
            captions: function(element) {
                // `this` == Array of current gallery items
                return element.getElementsByTagName('img')[0].alt;
            }
        });
    };
    
</script>