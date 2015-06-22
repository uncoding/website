<?php /* Smarty version 2.6.14, created on 2015-06-17 22:14:13
         compiled from admin.log.html */ ?>
  <div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" id="pagerForm" action="/b2wms.php?act=admin.loginfo" method="post">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="1000" />
	<input type="hidden" name="orderField" value="<?php echo $this->_tpl_vars['cout']['orderField']; ?>
" />
  <input type="hidden" name="orderDirection" value="<?php echo $this->_tpl_vars['cout']['orderDirection']; ?>
" />
	<div class="searchBar" >
         <table class="searchContent" >
         	<tr>
         	
        <td><label>选择用户：</label> 	         
      <select name="userid" >
      <option value="all">全部用户</option>   
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cout']['adminusers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          			<option value="<?php echo $this->_tpl_vars['cout']['adminusers'][$this->_sections['i']['index']]['userId']; ?>
"><?php echo $this->_tpl_vars['cout']['adminusers'][$this->_sections['i']['index']]['loginId']; ?>
</option>
				<?php endfor; endif; ?>
		
	</select></td>
	<td><label>操作模块：</label> 	 
      <select name="type">
      			<option value="all">全部模块</option>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cout']['authinfo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          	<option value="<?php echo $this->_tpl_vars['cout']['authinfo'][$this->_sections['i']['index']]['code']; ?>
"><?php echo $this->_tpl_vars['cout']['authinfo'][$this->_sections['i']['index']]['name']; ?>
</option>
				<?php endfor; endif; ?>
      	  </select></td>
				<td><label>开始日期：</label><input type="text" name="date1" class="date required textInput"   readonly="true" value="<?php echo $this->_tpl_vars['cout']['datepost1']; ?>
"/></td>
				<td><label>结束日期：</label><input type="text" name="date2" class="date required textInput"   readonly="true" value="<?php echo $this->_tpl_vars['cout']['datepost2']; ?>
"/></td>
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

<div class="tabs">
      <div class="tabsHeader">
           <div class="tabsHeaderContent">
                  <ul>
                       
                       
                  </ul>
            </div>
    </div>
       <div class="tabsContent" style="height:550px;">
            <div>
     
<div id="w_list_print">
	<table class="list" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="116">
		<thead>
			<tr id="merchantinfo">
				<th width="100" >用户</th>						
				<th width="100">操作模块</th>
				<th width="100">操作时间</th>
				<th width="100" >操作类型</th>					
				<th width="100" >描述</th>
				
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
    		
    		<?php $this->assign('admin_id', $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['staff_id']); ?>
    		<?php $this->assign('type', $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['code']); ?>
	
			<tr target="sid_user" >
				<td><?php echo $this->_tpl_vars['cout']['adminuserindex'][$this->_tpl_vars['admin_id']]; ?>
</td>	
				<td><?php echo $this->_tpl_vars['cout']['authinfoindex'][$this->_tpl_vars['type']]; ?>
</td>	
				<td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['log_date']; ?>
</td>					
				<td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['code']; ?>
</td>	
				<td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['log_content']; ?>
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
			
				<option value="1000" selected>1000</option>
				
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
</div>