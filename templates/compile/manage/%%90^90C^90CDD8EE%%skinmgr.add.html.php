<?php /* Smarty version 2.6.14, created on 2013-11-12 11:05:45
         compiled from skinmgr.add.html */ ?>
<!--修改样式2 p元素自适应宽度 start-->
<div class="pageContent">
    <form method="post" action="/b2wms.php?act=skinmgr.skinadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
<table class="searchContent" >
<tr>           
    <td> <label>皮肤路径</label></td>
    <td>
            <input name="item.shw_skin" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_skin']; ?>
"  />
          </td>
</tr>
<tr>           
    <td> <label>前台显示</label></td>
    <td>
            <input name="item.shw_url" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_url']; ?>
"  />
          </td>
</tr>
<tr>           
    <td> <label>是否启用</label></td>
    <td>
          <select name="item.mgr_status" class="combox">
        <?php $_from = $this->_tpl_vars['cout']['mgr_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['cout']['vinfo']['mgr_status'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
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