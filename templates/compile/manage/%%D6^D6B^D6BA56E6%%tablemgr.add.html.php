<?php /* Smarty version 2.6.14, created on 2013-11-12 11:36:36
         compiled from tablemgr.add.html */ ?>
<!--修改样式2 p元素自适应宽度 start-->
<div class="pageContent">
    <form method="post" action="/b2wms.php?act=tablemgr.tableadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
<table class="searchContent" >
<tr>           
    <td> <label>显示名称</label></td>
    <td>
            <input name="item.shw_title" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_title']; ?>
"  />
          </td>
</tr>
<tr>           
    <td> <label>表名</label></td>
    <td>
            <input name="item.shw_table" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_table']; ?>
"  />
          </td>
</tr>
</table> 
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