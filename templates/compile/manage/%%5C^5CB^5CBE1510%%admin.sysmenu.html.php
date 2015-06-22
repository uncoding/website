<?php /* Smarty version 2.6.14, created on 2015-06-15 23:41:56
         compiled from admin.sysmenu.html */ ?>
  <div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" id="pagerForm" action="/b2wms.php?act=admin.sysmenu" method="post">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['cout']['info']['size']; ?>
" />
	<input type="hidden" name="orderField" value="<?php echo $this->_tpl_vars['cout']['orderField']; ?>
" />
  <input type="hidden" name="orderDirection" value="<?php echo $this->_tpl_vars['cout']['orderDirection']; ?>
" />
	
	<div class="searchBar" >
         <table class="searchContent" >
         	<tr>
<td><label>模块名：</label><input type="text" name="modulename" value="<?php echo $this->_tpl_vars['cout']['modulename']; ?>
" /></td><td><label>节点key：</label><input type="text" name="nodekey" value="<?php echo $this->_tpl_vars['cout']['nodekey']; ?>
" /></td>
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
			<li><a class="add" href="/b2wms.php?act=admin.sysmenuadd&acttype=0" target="dialog" mask="true"><span>新增</span></a></li>
		</ul>
	</div>
	<div id="w_list_print">
	<table class="list" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="116">
		<thead>
			<tr id="merchantinfo">
				<th width="100">ID</th>
				<th width="100">节点key</th>
				<th width="100">模块名</th>
				<th width="100">菜单级别</th>
				<th width="100" orderField="displayorder" class="desc">显示顺序</th>
				<th width="100">是否可用</th> 
				<th width="100">操作</th> 
			</tr>
		</thead>
		<tbody>
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cout']['vlist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
			<tr target="sid_user" >
        <td width="100"><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['id']; ?>
</td>
				<td width="100"><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['nodekey']; ?>
</td>
				<td width="100"><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['modulename']; ?>
</td>
				<td width="100"><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['menulevel']; ?>
</td>
				<td width="100"><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['displayorder']; ?>
</td>				
				<td width="100"><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['isenable']; ?>
</td>
				<td width="100">
					<a target="dialog" mask="true" href="/b2wms.php?act=admin.sysmenuadd&acttype=1&id=<?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['id']; ?>
" class="btnEdit" >修改</a>  <a target="dialog" mask="true" href="/b2wms.php?act=admin.sysmenuadd&acttype=2&id=<?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['id']; ?>
" class="btnAttach" >另存为</a> <a warn="请选择内容项" title="你确定要删除吗？" target="ajaxTodo" href="/b2wms.php?act=admin.sysmenudel&id=<?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['id']; ?>
" class="btnDel"><span>删除</span></a>
				</td>
			</tr>
		<?php endfor; endif; ?>
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
