<?php /* Smarty version 2.6.14, created on 2015-06-18 06:44:23
         compiled from servermgr.add.html */ ?>
<!--修改样式2 p元素自适应宽度 start-->
<div class="pageContent">
    <form method="post" action="/b2wms.php?act=servermgr.serveradd" class="pageForm required-validate" enctype="multipart/form-data" onsubmit="return iframeCallback(this, dialogAjaxDone)">
    <input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
<div class="pageFormContent" layoutH="56">
<div style="clear:both;"> <label>分类</label>
            <select name="item.cid" class="combox">
        <?php $_from = $this->_tpl_vars['cout']['server_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['cout']['vinfo']['cid'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
      </select>
    </div>
<div style="clear:both;"> <label>标题</label>
            <input name="item.shw_title" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_title']; ?>
"  />
      </div>
<div style="clear:both;"> <label>图片上传</label>
            <?php if ($this->_tpl_vars['cout']['vinfo']['img_up'] != ''): ?><img src="/html/upload/100_100_<?php echo $this->_tpl_vars['cout']['vinfo']['img_up']; ?>
" height="40" border="0" /><?php endif; ?><input type="file" name="img_up" />
    </div>
<div style="clear:both;"> <label>内容</label>
            <textarea class="editor" name="item.shw_content" rows="15" cols="80" tools="full" pagetag upLinkUrl="/b2wms.php?act=manage.upload" upImgUrl="/b2wms.php?act=manage.upload" upFlashUrl="/b2wms.php?act=manage.upload" upMediaUrl="/b2wms.php?act=manage.upload" ><?php echo $this->_tpl_vars['cout']['vinfo']['shw_content']; ?>
</textarea>
      </div>
<div style="clear:both;"> <label>备注</label>
            <input name="item.shw_remark" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_remark']; ?>
"  />
      </div>
</div>
<div class="formBar">
<ul>
<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
<li>
     <div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
</li>
</ul>
</div>
</form>
</div>
<!--修改样式2 end-->