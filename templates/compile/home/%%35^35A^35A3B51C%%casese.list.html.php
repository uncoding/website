<?php /* Smarty version 2.6.14, created on 2015-06-19 02:46:05
         compiled from default/casese.list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'page', 'default/casese.list.html', 35, false),)), $this); ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body  class="body_picture">
<!--Logo 开始-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/logo.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--Logo 结束--><!--导航条 开始-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/nav.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--导航条 结束--><!--幻灯片 开始-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/banner.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--幻灯片 结束-->
<div id="header_1"></div>
<!--当前位置开始-->

<!--当前位置结束-->
<div id="main">
<div class="picture">
  <div class="left_title">
    <h2><a href="" ><?php echo $this->_tpl_vars['cout']['casese_catatitle']; ?>
</a></h2>
  </div>
  <div class="left_body">
    <ul class="gridlist">
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
        	<li><a  href="/index.php?act=casese.info&id=<?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['id']; ?>
" >
		        <div class="InfoPicture"><img src="/html/upload/<?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['img_up']; ?>
" alt="<?php echo $this->_tpl_vars['cout']['seokeywords']; ?>
" title="<?php echo $this->_tpl_vars['cout']['seodescription']; ?>
" /></div>
		        <div class="InfoTitle"><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_title']; ?>
</div>
		        </a>
	    	</li>
      <?php endfor; endif; ?>
    </ul>
    <!-- 橱窗样式 列表结束-->
    <div class="clear"></div>
    <div class="page">
             <?php if ($this->_tpl_vars['cout']['info']['totalPageCount'] > 0):  echo ((is_array($_tmp=$this->_tpl_vars['cout']['info']['totalPageCount'])) ? $this->_run_mod_handler('page', true, $_tmp, $this->_tpl_vars['cout']['info']['size']) : page($_tmp, $this->_tpl_vars['cout']['info']['size'])); ?>

<?php else: ?>
无更多内容
<?php endif; ?> 
        </div>
  </div>
  <div class="left_bottom"></div>
</div>
</div>
<!--版权 开始-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/tool.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--版权 结束-->
</body>
</html>
