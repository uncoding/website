<?php /* Smarty version 2.6.14, created on 2014-04-17 15:53:38
         compiled from seomgr.add.html */ ?>
<!--修改样式2 p元素自适应宽度 start-->
<div class="pageContent">
    <form method="post" action="/b2wms.php?act=seomgr.seoadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
<div class="pageFormContent" layoutH="56">
<div style="clear:both;"> <label>动态URL</label>
            <input name="item.shw_url" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_url']; ?>
" size=100 />
      </div>
<div style="clear:both;"> <label>SEO文件名</label>
            <input name="item.shw_filename" type="text" class="alphanumeric" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_filename']; ?>
" size=100 />
      </div>
<div style="clear:both;"> <label>SEO文字标题</label>
            <input name="item.shw_title" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_title']; ?>
" size=100 />
      </div>
<div style="clear:both;"> <label>SEO专用ALT属性</label>
            <input name="item.shw_alt" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_alt']; ?>
" size=100  />
      </div>
<div style="clear:both;"> <label>状态</label>
          <select name="item.mgr_status" class="combox">
        <?php $_from = $this->_tpl_vars['cout']['mgr_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['cout']['vinfo']['mgr_status'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
      </div>
<div style="clear:both;"> <label>SEO路径</label>
            <input name="item.shw_path" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_path']; ?>
" size=100  />
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