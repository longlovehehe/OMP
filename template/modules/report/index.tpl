{strip}
<!--代理商企业三级联动-->
<form id="form" action="?m=report&a=report_item" method="post">
    <input autocomplete="off"  name="modules" value="report" type="hidden" />
    <input autocomplete="off"  name="action" value="report_item" type="hidden" />
    <input autocomplete="off"  name="page" value="0" type="hidden" />
    <input autocomplete="off"  name="ep_id" value="" type="hidden" />
    <input autocomplete="off"  name="status" value="" type="hidden" />
	<div id="main">
		<div class="demo">
			<div id="city_5">
				<select name="lv1" class="prov" style="width:200px;height:28px;margin:5px 10px"></select>
				<select name="lv2" class="city" style="width:200px;height:28px;margin:5px 10px" disabled="disabled"></select>
				<select name="lv3" class="dist" style="width:200px;height:28px;margin:5px 10px" disabled="disabled"></select>
			</div>
		</div>
	</div>			
	</div>
	<!--选择条件-->
	<div class="toolbar mactoolbar ">
	&nbsp;
		<a href="javascript:void(0);" class="button add active" style="min-width: 80px;">新增</a>
		<a href="javascript:void(0);" class="button act" style="min-width: 80px;">激活</a>
		<a href="javascript:void(0);" class="button loss" style="min-width: 80px;">遗失</a>
		<a href="javascript:void(0);" class="button all" style="min-width: 80px;">总用户</a>

        <label>选择时间：</label>
        <input autocomplete="off" style="height:24px;" class="datepickerreport start" name="start" type="text" datatime='true' />
        <span>-</span>
        <input autocomplete="off" style="height:24px;" class="datepickerreport end" name="end" type="text" datatime="true" />
	</div>
	<div class="buttons right">
            <a form="form" class="button submit" >查询</a>
    </div>
</form>
          {*          <style>
                    @font-face {
                      font-family: 'Covered By Your Grace';
                      font-style: normal;
                      font-weight: 400;
                      src: local('Covered By Your Grace'), local('CoveredByYourGrace'), url(images/6ozZp4BPlrbDRWPe3EBGAzcaOoGrwtJRci4wjFnSRpA.woff) format('woff');
                    }
            </style>
        <div id="chartdiv1" style="width: 600px; height: 400px;"></div>
<div id="chartdiv2" style="width: 600px; height: 400px;"></div>*}
<div class="content"></div>
{/strip}
