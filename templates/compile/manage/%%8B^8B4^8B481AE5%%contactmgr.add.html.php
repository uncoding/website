<?php /* Smarty version 2.6.14, created on 2015-06-17 22:16:25
         compiled from contactmgr.add.html */ ?>
<!--修改样式2 p元素自适应宽度 start-->
<div class="pageContent">
    <form method="post" action="/b2wms.php?act=contactmgr.contactadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
<div class="pageFormContent" layoutH="56">
<div style="clear:both;"> <label>标题</label>
            <input name="item.shw_title" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_title']; ?>
"  />
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