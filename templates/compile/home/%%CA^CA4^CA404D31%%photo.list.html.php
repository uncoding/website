<?php /* Smarty version 2.6.14, created on 2015-06-18 06:39:18
         compiled from default/photo.list.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body  class="body_product">
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
<div class="product">

	<?php $_from = $this->_tpl_vars['cout']['phoCls']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['item1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ikey'] => $this->_tpl_vars['item1']):
        $this->_foreach['item1']['iteration']++;
?>  
	  <div class="left_title"><span class="more"><a href="/index.php?act=photo.photo&cid=<?php echo $this->_tpl_vars['item1']['id']; ?>
" ><img src="/<?php echo $this->_tpl_vars['cout']['skin']; ?>
/images/more.gif" alt="<?php echo $this->_tpl_vars['cout']['seokeywords']; ?>
" title="<?php echo $this->_tpl_vars['cout']['seodescription']; ?>
" ></a></span>
	    <h2><img src="/<?php echo $this->_tpl_vars['cout']['skin']; ?>
/images/left_title_h2.jpg" alt="<?php echo $this->_tpl_vars['cout']['seokeywords']; ?>
" title="<?php echo $this->_tpl_vars['cout']['seodescription']; ?>
"><a href="/index.php?act=photo.photo&cid=<?php echo $this->_tpl_vars['item1']['id']; ?>
" ><?php echo $this->_tpl_vars['item1']['shw_title']; ?>
</a></h2>
	  </div>
	  <div class="left_body">
	    <ul class="gridlist">
	        <?php $_from = $this->_tpl_vars['cout']['cms_cass']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['item2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item2']):
        $this->_foreach['item2']['iteration']++;
?>
	        <?php $_from = $this->_tpl_vars['item2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['x'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['x']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['jkey'] => $this->_tpl_vars['item3']):
        $this->_foreach['x']['iteration']++;
?> 
	            <?php if ($this->_tpl_vars['item1']['id'] == $this->_tpl_vars['item3']['cid']): ?>
	          		<li><a  href="/index.php?act=photo.info&id=<?php echo $this->_tpl_vars['item3']['id']; ?>
">
			        <div class="InfoPicture"><img src="/html/upload/<?php echo $this->_tpl_vars['item3']['img_up']; ?>
" alt="<?php echo $this->_tpl_vars['cout']['seokeywords']; ?>
" title="<?php echo $this->_tpl_vars['cout']['seodescription']; ?>
" /></div>
			        <div class="InfoTitle"><?php echo $this->_tpl_vars['item3']['shw_title']; ?>
</div>
			        </a></li>
	            <?php endif; ?>
	        <?php endforeach; endif; unset($_from); ?>
	        <?php endforeach; endif; unset($_from); ?>
			</ul>
	    <div class="clear"></div>
	  </div>
	  <div class="left_bottom"></div>
	<?php endforeach; endif; unset($_from); ?>

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
