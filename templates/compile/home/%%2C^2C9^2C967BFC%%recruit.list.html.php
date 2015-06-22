<?php /* Smarty version 2.6.14, created on 2015-06-19 02:45:51
         compiled from default/recruit.list.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="body_job">
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
<!--导航条 结束--><!--幻灯片 开始--><!--幻灯片 结束--><!--当前位置开始-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/banner.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--当前位置结束-->
<div id="main">
<div class="job">
  <ul class="wxlist">
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
	    <li>
	      <div class="JobName"><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_title']; ?>
</div>
	      <table cellpadding="0" cellspacing="0" border="0" class="job_table">
	        <tr>
	          <th>性别要求</th>
	          <td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_sex']; ?>
</td>
	          <th>年龄要求</th>
	          <td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_age']; ?>
</td>
	        </tr>
	        <tr>
	          <th>薪金待遇</th>
	          <td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_money']; ?>
</td>
	          <th>语言要求</th>
	          <td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_lage']; ?>
</td>
	        </tr>
	        <tr>
	          <th>招聘人数</th>
	          <td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_num']; ?>
</td>
	          <th>工作地点</th>
	          <td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_place']; ?>
</td>
	        </tr>
	        <tr>
	          <th>有效期至</th>
	          <td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_loger']; ?>
</td>
	          <th>学历要求</th>
	          <td><?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_orders']; ?>
</td>
	        </tr>
	        <tr>
	          <td colspan="4" align="left"><div class="cc_l"> 详细要求：</div>
	            <div class="cc_m" style="height: 100%"> <?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_content']; ?>
</div></td>
	        </tr>

	        <tr>
	          <td colspan="4" align="left"><div class="cc_l"> 职位要求：</div>
	            <div class="cc_m" style="height: 100%"> <?php echo $this->_tpl_vars['cout']['vlist'][$this->_sections['i']['index']]['shw_intro']; ?>
</div></td>
	        </tr>
	      </table>
	    </li>
    <?php endfor; endif; ?>
  </ul>
  <div class="clear"></div>
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