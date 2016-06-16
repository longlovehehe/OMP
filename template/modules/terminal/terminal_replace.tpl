<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{""|L}</title>
        <link rel="icon" href="favicon.ico" mce_href="favicon.ico" type="image/x-icon" />
         <script src="script/jquery-1.11.1.min.js"></script>
         <script src="script/jquery.form.js"></script>
        <style>
            form.base label.title, .form label.title{
                width: 160px;
                display: inline-block;
                margin-bottom: 10px;
            }
            form.base input[type="text"], form.base input[type="password"] {
                border: 1px solid #CCC;
                padding: 5px 10px;
                width: 220px;
            }
            #zdll{
                position:relative;
                display:block;
                font-family:Microsoft YaHei;
                color:#fff;
                font-size:12px;
                text-decoration:none;
                width:70px;
                height:26px;
                background:#848589;
                /*    border:1px solid #999;*/
                text-align:center;
                line-height: 26px;
                float:left;
                cursor: pointer;
            }
            #fileSelector{
                position:absolute;
                left:0;
                top:0;
                width:80px;
                height:35px;
                z-index:999;
                background-color:transparent ;
                filter:alpha(opacity=0);
                -moz-opacity:0;
                opacity:0;
            }
            input.button{
                width:80px;
                padding: 8px 6px;
                background: #848589;
                color: #FFF;
                border: none;
            }
        </style>
    </head>
    <body>
        <form id="form" class="base mrbt10" name="work_form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="tt_type" value="{$list.tt_type}">
            <input type="hidden" name="do" value="{$list.do}">
            <br />
            <div class="block" style="height:35px;">
            <label style="float: left;" class="title" >{"图片上传"|L}: </label>
            {*<input id="fileSelector" type="file" name="soft_name" style="width:300px;" soft_name="true" onchange="getFiles(this);" value="">*}
            <div >
                &nbsp;&nbsp;&nbsp;<input type="text" name="path" value="{$list.p_file}" readonly style="width: 130px;">
                <a id="zdll" href="javascript:void(0);" >{"浏览"|L}
                    <input type="file" soft_name="true" name="fileToUpload" id="fileSelector"  onchange="getFiles(this);">
                </a>
            </div>
                    <br/>
            <div style="float:right;">
                <input type="button" value="{'保存'|L}" id="submit" name="button" class="button"/>&nbsp;&nbsp;&nbsp;
                <input type="button" value="{'关闭'|L}" id="closeIframe" name="button" class="button"/>&nbsp;&nbsp;&nbsp;
            </div>
        </div>
        </form>
    </body>
</html>
<script src="script/terminal_add.tpl.js"></script>