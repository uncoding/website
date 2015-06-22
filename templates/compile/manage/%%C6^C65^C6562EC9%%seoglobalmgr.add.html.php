<?php /* Smarty version 2.6.14, created on 2015-06-17 23:14:25
         compiled from seoglobalmgr.add.html */ ?>
<!--修改样式2 p元素自适应宽度 start-->
<div class="pageContent">
    <form method="post" action="/b2wms.php?act=seoglobalmgr.seoglobaladd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
<div class="pageFormContent" layoutH="56">
<div style="clear:both;"> <label>SEO关键词</label>
            <input name="item.shw_keyword" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_keyword']; ?>
"  />
      </div>
<div style="clear:both;"> <label>网站描述</label>
            <input name="item.shw_desc" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_desc']; ?>
"  />
      </div>
<div style="clear:both;"> <label>SEO静态站的访问域名</label>
            <input name="item.shw_host" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_host']; ?>
"  />
      </div>
<div style="clear:both;"> <label>网站名称</label>
            <input name="item.shw_sitename" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_sitename']; ?>
"  />
      </div>
<div style="clear:both;"> <label>静态页后缀名</label>
            <input name="item.shw_html" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_html']; ?>
"  />
      </div>
</div>
<div class="formBar">
<ul>
<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
<li>
     <div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
</li>
</ul>
</div>
</form>
</div>
<!--修改样式2 end-->