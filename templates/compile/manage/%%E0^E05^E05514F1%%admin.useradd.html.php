<?php /* Smarty version 2.6.14, created on 2014-04-22 13:35:13
         compiled from admin.useradd.html */ ?>

<div class="pageContent">
	<form method="post" action="/b2wms.php?act=admin.usersadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<div class="pageFormContent" layoutH="56">
    	<input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
     	<input type="hidden" name="userId" value="<?php echo $this->_tpl_vars['cout']['sysUser']['userId']; ?>
">
     	<table class="searchContent" >
<tr>			
     <td> <label>全名：</label>
		<input name="item.userName" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['sysUser']['userName']; ?>
"  alt="统称不能为空"/>
		</td>
</tr>
<tr>			
     <td> <label>登录名：</label>
		<input name="item.loginId" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['sysUser']['loginId']; ?>
"  alt="帐号不能为空"/>
		</td>
</tr> 
<tr>			
     <td> <label>密码：</label>
		<input name="item.password" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['sysUser']['password']; ?>
"  alt="密码不能为空"/>
		</td>
</tr>
<tr>			
    
</tr>
</table> 
		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>