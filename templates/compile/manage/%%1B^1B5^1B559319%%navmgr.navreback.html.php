<?php /* Smarty version 2.6.14, created on 2015-06-15 23:40:26
         compiled from navmgr.navreback.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'navmgr.navreback.html', 26, false),)), $this); ?>

<!--显示列表样式1 start-->
<div class="pageContent" id="pagecontent">
     <div id="w_list_print">
     <table class="list" width="100%" targetType="navTab" asc="asc" desc="desc" layoutH="26">
          <thead>
<tr id="nav">
<th width="100">导航标题</th>
<th width="100">导航简介</th>
<th width="100">导航图片上传</th>
<th width="100">导航链接地址</th>
<th width="100">所属分类</th>
<th width="100">排序值</th>
<th width="100">录入人</th>
<th width="100">添加时间</th>
<th width="30">状态</th>
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
 $this->assign('cid', $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['cid']);  $this->assign('mgrstatus', $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['mgr_status']); ?>
<tr target="sid_user" >
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, '') : smarty_modifier_truncate($_tmp, 20, '')); ?>
</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_intro'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, '') : smarty_modifier_truncate($_tmp, 20, '')); ?>
</td>
<td><?php if ($this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['img_up'] != ''): ?><a class="edit" href="/b2wms.php?act=manage.clipimages&i=<?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['img_up']; ?>
&r=<?php echo $this->_tpl_vars['cout']['nav_ratio'][$this->_tpl_vars['cid']]; ?>
" target="_blank"><img src="/html/upload/100_100_<?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['img_up']; ?>
" height="40" border="0" /></a><?php endif; ?></td>
<td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_link']; ?>
</td>
<td><?php if ($this->_tpl_vars['cid'] == 0): ?>一级分类<?php else:  echo $this->_tpl_vars['cout']['nav_category'][$this->_tpl_vars['cid']];  endif; ?></td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['mgr_sort'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, '') : smarty_modifier_truncate($_tmp, 20, '')); ?>
</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['log_user'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, '') : smarty_modifier_truncate($_tmp, 20, '')); ?>
</td>
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['log_time'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, '') : smarty_modifier_truncate($_tmp, 20, '')); ?>
</td>
<td><?php echo $this->_tpl_vars['cout']['mgr_status'][$this->_tpl_vars['mgrstatus']]; ?>
</td>
 
<td width="100">
<a target="ajaxTodo" href="/b2wms.php?act=navmgr.navaddback&acttype=3&id=<?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['id']; ?>
" class="btnEdit" >修改</a>
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
                    <option value="20" <?php if ($this->_tpl_vars['cout']['info']['size'] == 20): ?>selected<?php endif; ?>>20</option>
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
<!--显示列表样式1 end-->