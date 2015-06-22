<?php /* Smarty version 2.6.14, created on 2014-04-22 13:49:32
         compiled from admin.rankuser.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'return_array_checked', 'admin.rankuser.html', 28, false),)), $this); ?>

<div class="pageContent">
	<form method="post" action="/b2wms.php?act=admin.rankuserpost" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
		<div class="pageFormContent" layoutH="56">
    	<input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
     	<input type="hidden" name="userId" value="<?php echo $this->_tpl_vars['cout']['vinfo']['userId']; ?>
">
     	<table class="searchContent" >
<tr>			
     <td> <label>用户名：</label>
		<?php echo $this->_tpl_vars['cout']['vinfo']['loginId']; ?>

		</td>
</tr>
<tr>			
     <td> <label>用户分组：</label>
		<select name="group" id="group">
      	<option value=''>select</option>
      	<?php unset($this->_sections['group']);
$this->_sections['group']['name'] = 'group';
$this->_sections['group']['loop'] = is_array($_loop=$this->_tpl_vars['cout']['group']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['group']['show'] = true;
$this->_sections['group']['max'] = $this->_sections['group']['loop'];
$this->_sections['group']['step'] = 1;
$this->_sections['group']['start'] = $this->_sections['group']['step'] > 0 ? 0 : $this->_sections['group']['loop']-1;
if ($this->_sections['group']['show']) {
    $this->_sections['group']['total'] = $this->_sections['group']['loop'];
    if ($this->_sections['group']['total'] == 0)
        $this->_sections['group']['show'] = false;
} else
    $this->_sections['group']['total'] = 0;
if ($this->_sections['group']['show']):

            for ($this->_sections['group']['index'] = $this->_sections['group']['start'], $this->_sections['group']['iteration'] = 1;
                 $this->_sections['group']['iteration'] <= $this->_sections['group']['total'];
                 $this->_sections['group']['index'] += $this->_sections['group']['step'], $this->_sections['group']['iteration']++):
$this->_sections['group']['rownum'] = $this->_sections['group']['iteration'];
$this->_sections['group']['index_prev'] = $this->_sections['group']['index'] - $this->_sections['group']['step'];
$this->_sections['group']['index_next'] = $this->_sections['group']['index'] + $this->_sections['group']['step'];
$this->_sections['group']['first']      = ($this->_sections['group']['iteration'] == 1);
$this->_sections['group']['last']       = ($this->_sections['group']['iteration'] == $this->_sections['group']['total']);
?>
      	<option <?php if ($this->_tpl_vars['cout']['group'][$this->_sections['group']['index']]['id'] == $this->_tpl_vars['cout']['vinfo']['groupId']): ?>selected<?php endif; ?> value="<?php echo $this->_tpl_vars['cout']['group'][$this->_sections['group']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['cout']['group'][$this->_sections['group']['index']]['name']; ?>
</option>
      	<?php endfor; endif; ?>
      </select>
		</td>
</tr> 
  <tr > 
      <td >允许查看模块：
      
	  <table border="0" cellspacing="0" cellpadding="0"><tr>
		<?php $_from = $this->_tpl_vars['cout']['manage_rank']['limit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rank'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rank']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['rank']['iteration']++;
?>
		<td>　<input type="checkbox" name="rank[]"  id="<?php echo $this->_tpl_vars['item']['code']; ?>
" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php echo return_array_checked(array('arr' => $this->_tpl_vars['cout']['vinfo']['rank'],'sub' => $this->_tpl_vars['key']), $this);?>
 <?php if ($this->_tpl_vars['key'] == 'manage.nologin,manage.main'): ?>checked<?php endif; ?> >&nbsp;<?php echo $this->_tpl_vars['item']['name']; ?>
</td>
		<?php if (!($this->_foreach['rank']['iteration'] % 4)): ?></tr>
		<tr><?php endif; ?>
		<?php endforeach; endif; unset($_from); ?></tr></table>
	  </td>
    </tr>
 <script type="text/javascript">
    <?php echo '
    $(document).ready(function(){
   
    	$("#group").change(function(){
    		var id=$(this).val();
    		if(id){
    			$.ajax({ 
        			type: "GET",
        			url: "/b2wms.php?act=admin.getGroup",
        			cache:false,
        			data: {gid:id}, 
        			success: function(data){
        				$("input[type=checkbox]").attr("checked",false);
        				$.each(data,function (key, vals) {
        					$(\'#\'+vals).attr(\'checked\',true);
        				});
        			},
        			dataType:\'json\'
       			});
    		}else{
    			$(\'input[type=checkbox]\').attr(\'checked\',false);
    			return false;
    		}
    	})
    	$("input[type=checkbox]").change(function(){
    		$(\'#group\').val(\'\');
    	});
    	
    });
    '; ?>

   </script>

</table> 
		</div>
		<div class="formBar">
		<label style="float:left"><input type="checkbox" class="checkboxCtrl" group="rank[]" />全选</label>
		<ul>
			<li><div class="button"><div class="buttonContent"><button type="button" class="checkboxCtrl" group="rank[]" selectType="invert">反选</button></div></div></li>
			<li><div class="buttonActive"><div class="buttonContent"><button type="submit">修改用户</button></div></div></li>
			<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
		</ul>
	</div>
	</form>
</div>