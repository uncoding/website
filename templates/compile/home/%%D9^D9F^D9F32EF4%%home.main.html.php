<?php /* Smarty version 2.6.14, created on 2015-06-18 06:38:14
         compiled from default/home.main.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="body_index">
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
<!--幻灯片 结束--><!--当前位置开始--><!--当前位置结束-->
<div class="index">
<div id="leftpic">
  <div class="left_title">
    <h2><a href="/index.php?act=casese.casese&cid=5" >经典案例</a></h2>
    <span class="more"><a href="/index.php?act=casese.casese&cid=5" >更多...</a></span></div>
  <div class="left_body">
    <ul class="gridlist" >
      <!--循环开始-->
      <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cout']['indxCas']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      		<li><a href="<?php echo $this->_tpl_vars['cout']['indxCas'][$this->_sections['i']['index']]['shw_link']; ?>
">
	        <div class="InfoPicture"><img src="/html/upload/<?php echo $this->_tpl_vars['cout']['indxCas'][$this->_sections['i']['index']]['img_up']; ?>
" alt="<?php echo $this->_tpl_vars['cout']['seokeywords']; ?>
" title="<?php echo $this->_tpl_vars['cout']['seodescription']; ?>
" /></div>
	        <div class="InfoTitle"><?php echo $this->_tpl_vars['cout']['indxCas'][$this->_sections['i']['index']]['shw_title']; ?>
</div>
	        </a></li>
      <?php endfor; endif; ?>
      <!--循环结束-->
    </ul>
  </div>
    <div class="left_bottom"></div>
</div>  

 <div id="leftext">
      <div class="left_title">
        <h2><a href="/index.php?act=news.news&cid=3" >最新动态</a></h2>
        <span class="more"><a href="/index.php?act=news.news&cid=3" >更多...</a></span></div>
      <div class="left_body">
        <ul class="textlist" >
          <!--循环开始-->
          <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cout']['indxNews']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          	<li><a href="<?php echo $this->_tpl_vars['cout']['indxNews'][$this->_sections['i']['index']]['shw_link']; ?>
" ><?php echo $this->_tpl_vars['cout']['indxNews'][$this->_sections['i']['index']]['shw_title']; ?>
</a></li>
          <?php endfor; endif; ?>
          <!--循环结束-->
        </ul>
      </div>
      <div class="left_bottom"></div>
</div>


	<div id="rightpic">     
	      <div class="left_title">
	        <h2><a href="/index.php?act=server.server&cid=4" >服务项目</a></h2>
	        <span class="more"><a href="/index.php?act=server.server&cid=4" >更多...</a></span></div>
	      <div class="left_body">
	        <ul class="gridlist" >
	          <!--循环开始-->
	          <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cout']['indxSer']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	          		<li><a href="<?php echo $this->_tpl_vars['cout']['indxSer'][$this->_sections['i']['index']]['shw_link']; ?>
">
			            <div class="InfoPicture"><img src="/html/upload/<?php echo $this->_tpl_vars['cout']['indxSer'][$this->_sections['i']['index']]['img_up']; ?>
" alt="<?php echo $this->_tpl_vars['cout']['seokeywords']; ?>
" title="<?php echo $this->_tpl_vars['cout']['seodescription']; ?>
" /></div>
			            <div class="InfoTitle"><?php echo $this->_tpl_vars['cout']['indxSer'][$this->_sections['i']['index']]['shw_title']; ?>
 </div>
			            </a>
			        </li>
	          <?php endfor; endif; ?>
	          <!--循环结束-->
	        </ul>
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