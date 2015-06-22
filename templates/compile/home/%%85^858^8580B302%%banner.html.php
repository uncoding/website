<?php /* Smarty version 2.6.14, created on 2015-06-18 06:38:14
         compiled from default/inc/banner.html */ ?>
<div id="banner">
	<script type="text/javascript" src="/<?php echo $this->_tpl_vars['cout']['skin']; ?>
/js/jquery.flexslider-min.js"></script><script type="text/javascript"><?php echo '          $(document).ready(function() {
    
                    $(\'.flexslider\').flexslider({
    
                            controlNav: true, 
    
                            directionNav: false,
    
                            animation: "slide",
    
                            //manualControls: ".myflexslider .slidenav"
    
                        });
    
              });
    
            '; ?>
</script>
      <div class="flexslider" >
        <ul class="slides">
          <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['cout']['banner']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <li><img src="/html/upload/<?php echo $this->_tpl_vars['cout']['banner'][$this->_sections['i']['index']]['img_up']; ?>
" alt="<?php echo $this->_tpl_vars['cout']['seokeywords']; ?>
" title="<?php echo $this->_tpl_vars['cout']['seodescription']; ?>
"  /></li>
        <?php endfor; endif; ?>
        </ul>
      </div>
</div>