<?php /* Smarty version 2.6.14, created on 2015-06-18 06:38:14
         compiled from default/inc/nav.html */ ?>
<style>
<?php echo '
#navigation{ overflow:hidden;zoom:1;background:#065751; }
#navigation li{ float:left; margin-bottom:2px; width:25%;  }
#navigation li a{ display:block; color:#FFF; padding:0px;}
#navigation li a:hover,#navigation li a.current{background-color:#fff;}

'; ?>

</style>
<div id="nav">
    <div id="navigation">
      <table cellspacing="1" cellpadding="0"  align="center">
        <?php $this->assign('nav', $this->_tpl_vars['cout']['nav_category']); ?>
        <?php $this->assign('nav2', $this->_tpl_vars['cout']['nav_category']); ?>
        <?php $this->assign('nav3', $this->_tpl_vars['cout']['nav_category']); ?>
        <?php $_from = $this->_tpl_vars['nav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ikey'] => $this->_tpl_vars['i']):
        $this->_foreach['foo']['iteration']++;
?>
        <?php if ($this->_tpl_vars['i']['lever'] == 1): ?>
        <li><a <?php if ($this->_tpl_vars['i']['isselect'] == 1): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['i']['link']; ?>
"><?php echo $this->_tpl_vars['i']['name']; ?>
</a>
        <?php if ($this->_tpl_vars['i']['sub'] > 0): ?>
          <ul class="subnav">
          <?php $_from = $this->_tpl_vars['nav2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['jkey'] => $this->_tpl_vars['j']):
?>
          <?php if ($this->_tpl_vars['j']['lever'] == 2 && $this->_tpl_vars['j']['pid'] == $this->_tpl_vars['i']['id']): ?><li><a href="<?php echo $this->_tpl_vars['j']['link']; ?>
"><?php echo $this->_tpl_vars['j']['name']; ?>
</a>
          <?php if ($this->_tpl_vars['j']['sub'] > 0): ?>
            <ul class="navlist2">
              <?php $_from = $this->_tpl_vars['nav3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['kkey'] => $this->_tpl_vars['k']):
?>
              <?php if ($this->_tpl_vars['k']['lever'] == 3 && $this->_tpl_vars['k']['pid'] == $this->_tpl_vars['j']['id']): ?><li><a href="<?php echo $this->_tpl_vars['k']['link']; ?>
"><?php echo $this->_tpl_vars['k']['name']; ?>
</a></li><?php endif; ?>
              <?php endforeach; endif; unset($_from); ?>
            </ul>
            <?php endif; ?>
          </li>
          <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
          </ul>
        <?php endif; ?>
        </li>
        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
      </table>
    </div>
</div>