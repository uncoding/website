<?php /* Smarty version 2.6.14, created on 2014-04-22 14:39:12
         compiled from admin.sysmenuadd.html */ ?>
<script type="text/javascript">
    <?php echo '
    $(document).ready(function(){
   
     $("input").focus(function(){
          this.select();
     })
     $("textarea").focus(function(){
          this.select();
     })
    });
    '; ?>

   </script>
<div class="pageContent">
	<form method="post" action="/b2wms.php?act=admin.sysmenuadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<div class="pageFormContent" layoutH="56">
    	<input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
     	<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['info']['id']; ?>
">
     	<table class="searchContent" >
<tr>			
     <td> <label>节点key：</label>
		<input name="item.nodekey" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['info']['nodekey']; ?>
"  alt="节点key不能为空"/>
		</td>
</tr>
<tr>			
     <td> <label>模块名：</label>
		<input name="item.modulename" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['info']['modulename']; ?>
"  alt="模块名不能为空"/>
		</td>
</tr> 
<tr>			
     <td> <label>菜单级别：</label>
		<input name="item.menulevel" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['info']['menulevel']; ?>
"  alt="菜单级别不能为空"/>
		</td>
</tr>
<tr>			
     <td> <label>显示顺序：</label>
		<input name="item.displayorder" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['info']['displayorder']; ?>
"  alt="不能为空"/>
		</td>
</tr> 
<tr>			
     <td> <label>模块权限：</label>
		<textarea name="item.code" cols="30" id="code"><?php echo $this->_tpl_vars['cout']['info']['code']; ?>
</textarea>
		</td>
</tr> 
<tr>			
     <td> <label>模块JS：</label>
		<textarea name="item.jstext" cols="30" id="jstext"><?php echo $this->_tpl_vars['cout']['info']['jstext']; ?>
</textarea>
		</td>
</tr>
<tr>			
     <td> <label>是否可用：</label>
		<input name="item.isenable" type="text" class="required"  value="<?php echo $this->_tpl_vars['cout']['info']['isenable']; ?>
"  alt="不能为空"/>
		</td>
</tr>
</table> 
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