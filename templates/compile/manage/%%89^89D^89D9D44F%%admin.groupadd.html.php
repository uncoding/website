<?php /* Smarty version 2.6.14, created on 2014-04-22 13:34:38
         compiled from admin.groupadd.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'return_array_checked', 'admin.groupadd.html', 18, false),)), $this); ?>

<div class="pageContent">
	<form method="post" action="/b2wms.php?act=admin.groupadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<div class="pageFormContent" layoutH="56">
    	<input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
     	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
     	<input type='hidden' name="gid" value="<?php echo $_REQUEST['gid']; ?>
" />
     	<table class="searchContent" >
<tr>			
     <td> <label>分组名：</label>
		<input name="item.name" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['vinfo']['name']; ?>
"  />
		</td>
</tr>
<tr>			
     <td>
	  <table border="0" cellspacing="0" cellpadding="0"><tr>
		<?php $_from = $this->_tpl_vars['cout']['manage_rank']['limit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rank'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rank']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['rank']['iteration']++;
?>
		<td>　<input type="checkbox" name="rank[]" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php echo return_array_checked(array('arr' => $this->_tpl_vars['cout']['vinfo']['rank'],'sub' => $this->_tpl_vars['key']), $this);?>
 <?php if ($this->_tpl_vars['key'] == 'manage.nologin,manage.main'): ?>checked<?php endif; ?> >&nbsp;<?php echo $this->_tpl_vars['item']; ?>
</td>
		<?php if (!($this->_foreach['rank']['iteration'] % 4)): ?></tr>
		<tr><?php endif; ?>
		<?php endforeach; endif; unset($_from); ?></tr></table>
				
		
		</td>
</tr> 

</table> 
		</div>
		<div class="formBar">
		<label style="float:left"><input type="checkbox" class="checkboxCtrl" group="rank[]" />全选</label>
			<ul>
				<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="rank[]" selectType="invert">Invert</button></div></div></li>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>