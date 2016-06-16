
<h2 class="title" >{"系统配置"|L}</h2>
<form id="form" action="?modules=system&action=setsystem" class="base mrbt10">
            
    <div class="block radio" value="{$sys_maintain}">
        <div class="line">
            <label class="title">{"开启维护模式"|L}：</label>
            <label class="radiotext">
                <input autocomplete="off"  value="1" name="sys_maintain" type="radio"  />
                <span>{"启用"|L}</span>
            </label>
            <label class="radiotext">
                <input autocomplete="off"  value="0" name="sys_maintain" type="radio" checked="checked"  />
                <span>{"停用"|L}</span>
            </label>
        </div>
    </div>
    <div class="buttons mrtop40">
        <a form="form" goto='?modules=system&action=sysconfig' class="ajaxpost button normal">{"修改"|L}</a>
    </div>
</form>