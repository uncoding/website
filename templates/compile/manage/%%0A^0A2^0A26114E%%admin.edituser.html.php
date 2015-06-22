<?php /* Smarty version 2.6.14, created on 2014-04-22 17:15:05
         compiled from admin.edituser.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin.edituser.html', 24, false),)), $this); ?>

<div class="pageContent">
	<form method="post" action="/b2wms.php?act=admin.edituserpost"  class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<div class="pageFormContent" layoutH="56">
    	
     	<input type="hidden" name="userId" value="<?php echo $this->_tpl_vars['cout']['vinfo']['userId']; ?>
">
     	<table class="searchContent" >
<tr>			
     <td> <label>用户名：</label>
		<?php echo $this->_tpl_vars['cout']['vinfo']['loginId']; ?>

		</td>
</tr>
<tr>			
     <td> <label>姓名：</label>
		<input name="username" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['vinfo']['username']; ?>
"  alt="帐号不能为空"/>
		</td>
</tr> 
<tr>			
     <td> <label>密码：</label>
		<input name="login_pass" type="password" class="required"  value="<?php echo $this->_tpl_vars['cout']['vinfo']['password']; ?>
"  alt="密码不能为空"/>
		</td>
		
		<td ><label>状态：</label>
       <select name="state"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cout']['status'],'selected' => $this->_tpl_vars['cout']['vinfo']['state']), $this);?>
 
        </select> </td>
    </tr>
<tr>			
     <td> <label>新密码：</label>
		<input name="newpwd" type="password"  value="" />
		</td>
</tr> 
</table> 
		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">修改</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>