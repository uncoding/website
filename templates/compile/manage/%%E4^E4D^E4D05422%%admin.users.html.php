<?php /* Smarty version 2.6.14, created on 2015-06-17 23:18:00
         compiled from admin.users.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'return_array_value', 'admin.users.html', 48, false),)), $this); ?>
  <div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" id="pagerForm" action="/b2wms.php?act=admin.usersinfo" method="post">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="20" />	
	<div class="searchBar" >
         <table class="searchContent" >
         	<tr>
       		
<td><label>用户名：</label><input type="text" name="loginId"></td>
         	</tr>
         </table>  
		<div class="subBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit" id="choosedata">查询</button></div></div></li>
			</ul>
		</div>
	</div>
	</form>
</div>
<div class="pageContent" id="pagecontent">

	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="/b2wms.php?act=admin.usersadd&acttype=0" target="dialog" mask="true"><span>新增</span></a></li>
			
		</ul>
	</div>
	<div id="w_list_print">
	<table class="list" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="116">
		<thead>
			<tr id="merchantinfo">
				<th width="100">用户ID</th>
				<th width="100">用户名</th>
				<th width="100">姓名</th>
				<th width="100">分组</th>
				<th width="100">状态</th>
				<th width="100">操作</th>
				<th width="100">权限</th>
			</tr>
		</thead>
		<tbody>
		<?php $_from = $this->_tpl_vars['cout']['info']['result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['ret'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['ret']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ret']):
        $this->_foreach['ret']['iteration']++;
?>
			<tr target="sid_user" >
				<td><?php echo $this->_tpl_vars['ret']['userId']; ?>
</td>     
	          <td><?php echo $this->_tpl_vars['ret']['loginId']; ?>
</td>     
	          <td><?php echo $this->_tpl_vars['ret']['username']; ?>
</td>
	          <td ><?php echo $this->_tpl_vars['ret']['name']; ?>
</td>    
	          <td ><?php echo return_array_value(array('arr' => $this->_tpl_vars['cout']['status'],'sub' => $this->_tpl_vars['ret']['state']), $this);?>
</td>     
	          <td ><a target="dialog" mask="true"  href="b2wms.php?act=admin.edituser&id=<?php echo $this->_tpl_vars['ret']['userId']; ?>
">修改</a></td>  
	           <td ><a  target="dialog" mask="true"  href="b2wms.php?act=admin.rankuser&id=<?php echo $this->_tpl_vars['ret']['userId']; ?>
">用户权限管理</a></td>  
			</tr>
		<?php endforeach; endif; unset($_from); ?>
		</tbody>
	</table>
	</div>
	<div class="panelBar" >
		<div class="pages">
			<span>显示</span>
			<select name="numPerPage" onchange="navTabPageBreak(<?php echo '{numPerPage:this.value}'; ?>
)">
				
				<option value="50" <?php if ($this->_tpl_vars['cout']['info']['size'] == 50): ?>selected<?php endif; ?>>50</option>
				<option value="100" <?php if ($this->_tpl_vars['cout']['info']['size'] == 100): ?>selected<?php endif; ?>>100</option>
				<option value="200" <?php if ($this->_tpl_vars['cout']['info']['size'] == 200): ?>selected<?php endif; ?>>200</option>
				<?php if ($this->_tpl_vars['cout']['info']['size'] > 200): ?>
				<option value="$cout.info.size" selected><?php echo $this->_tpl_vars['cout']['info']['size']; ?>
</option>
				<?php endif; ?>
			</select>
			<span>条，共<?php echo $this->_tpl_vars['cout']['info']['totalCount']; ?>
条</span>
		</div>
		<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_tpl_vars['cout']['info']['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['cout']['info']['size']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['cout']['info']['nowPage']; ?>
"></div>

	</div>
</div>
