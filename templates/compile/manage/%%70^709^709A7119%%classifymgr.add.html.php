<?php /* Smarty version 2.6.14, created on 2014-04-29 18:30:33
         compiled from classifymgr.add.html */ ?>
<!--修改样式2 p元素自适应宽度 start-->
<div class="pageContent">
    <form method="post" action="/b2wms.php?act=classifymgr.classifyadd" class="pageForm required-validate" enctype="multipart/form-data" onsubmit="return iframeCallback(this, dialogAjaxDone)">
    <input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
<table class="searchContent" >
<tr>           
    <td> <label>分类标题</label></td>
    <td>
            <input name="item.shw_title" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_title']; ?>
"  />
          </td>
</tr>
<tr>           
    <td> <label>所属父分类</label></td>
    <td>
            <select name="item.cid" class="combox">
        <?php $_from = $this->_tpl_vars['cout']['classify_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['cout']['vinfo']['cid'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
      </select>
        </td>
</tr>
<tr>           
    <td> <label>排序值</label></td>
    <td>
            <input name="item.mgr_sort" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['mgr_sort']; ?>
"  />
          </td>
</tr>
<tr>           
    <td> <label>顶级分类所属数据表</label></td>
    <td>
<select name="item.mgr_table" class="combox">
<?php $_from = $this->_tpl_vars['cout']['classify_table']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['cout']['vinfo']['mgr_table'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['item']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
          </td>
</tr>
<tr>           
    <td> <label>状态 0:禁用,1:启用</label></td>
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
<tr>           
    <td> <label>封面</label></td>
    <td>
            <?php if ($this->_tpl_vars['cout']['vinfo']['img_up'] != ''): ?><img src="/html/upload/100_100_<?php echo $this->_tpl_vars['cout']['vinfo']['img_up']; ?>
" height="40" border="0" /><?php endif; ?><input type="file" name="img_up" />
          </td>
</tr>
<tr>           
    <td> <label>别名</label></td>
    <td>
            <input name="item.shw_other" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_other']; ?>
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