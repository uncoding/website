<?php /* Smarty version 2.6.14, created on 2013-11-25 10:50:36
         compiled from admin.changepwd1.html */ ?>
<div class="page">
	<div class="pageContent">
	
	<form method="post" action="/b2wms.php?act=admin.changepwdasubmit" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['uid']; ?>
">
		<div class="pageFormContent" layoutH="58">
			
			<div class="unit">
				<label>Old Password</label>
				<input type="password" class="required" name="old_pwd">
			</div>
			
			<div class="unit">
				<label>New Password</label>
				<input type="password" class="required" name="new_pwd">
			</div>
			
			<div class="unit">
				<label>Confim Password</label>
				<input type="password" class="required" name="re_new_pwd">
			</div>
		
		</div>
		
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">Submit</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">Cancel</button></div></div></li>
			</ul>
		</div>
	</form>
	
	</div>
</div>