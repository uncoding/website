<?php /* Smarty version 2.6.14, created on 2015-06-17 22:16:35
         compiled from recruitmgr.add.html */ ?>
<!--修改样式2 p元素自适应宽度 start-->
<div class="pageContent">
    <form method="post" action="/b2wms.php?act=recruitmgr.recruitadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
    <input type="hidden" name="acttype" value="<?php echo $this->_tpl_vars['cout']['acttype']; ?>
">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['cout']['vinfo']['id']; ?>
">
<div class="pageFormContent" layoutH="56">
<div style="clear:both;"> <label>所属分类 classid</label>
            <select name="item.cid" class="combox">
        <?php $_from = $this->_tpl_vars['cout']['recruit_category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['cout']['vinfo']['cid'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
      </select>
    </div>
<div style="clear:both;"> <label>职位名称</label>
            <input name="item.shw_title" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_title']; ?>
"  />
      </div>
<div style="clear:both;"> <label>性别</label>
            <input name="item.shw_sex" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_sex']; ?>
"  />
      </div>
<div style="clear:both;"> <label>年龄</label>
            <input name="item.shw_age" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_age']; ?>
"  />
      </div>
<div style="clear:both;"> <label>待遇</label>
            <input name="item.shw_money" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_money']; ?>
"  />
      </div>
<div style="clear:both;"> <label>语言</label>
            <input name="item.shw_lage" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_lage']; ?>
"  />
      </div>
<div style="clear:both;"> <label>招聘人数</label>
            <input name="item.shw_num" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_num']; ?>
"  />
      </div>
<div style="clear:both;"> <label>工作地点</label>
            <input name="item.shw_place" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_place']; ?>
"  />
      </div>
<div style="clear:both;"> <label>有效期</label>
            <input name="item.shw_loger" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_loger']; ?>
"  />
      </div>
<div style="clear:both;"> <label>学历</label>
            <input name="item.shw_orders" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_orders']; ?>
"  />
      </div>
<div style="clear:both;"> <label>职位说明</label>
            <textarea class="editor" name="item.shw_content" rows="15" cols="80" tools="full" pagetag upLinkUrl="/b2wms.php?act=manage.upload" upImgUrl="/b2wms.php?act=manage.upload" upFlashUrl="/b2wms.php?act=manage.upload" upMediaUrl="/b2wms.php?act=manage.upload" ><?php echo $this->_tpl_vars['cout']['vinfo']['shw_content']; ?>
</textarea>
      </div>
<div style="clear:both;"> <label>职位要求</label>
            <textarea class="editor" name="item.shw_intro" rows="15" cols="80" tools="full" pagetag upLinkUrl="/b2wms.php?act=manage.upload" upImgUrl="/b2wms.php?act=manage.upload" upFlashUrl="/b2wms.php?act=manage.upload" upMediaUrl="/b2wms.php?act=manage.upload" ><?php echo $this->_tpl_vars['cout']['vinfo']['shw_intro']; ?>
</textarea>
      </div>
<div style="clear:both;"> <label>排序值</label>
            <input name="item.mgr_sort" type="text" value="<?php echo $this->_tpl_vars['cout']['vinfo']['mgr_sort']; ?>
"  />
      </div>
<div style="clear:both;"> <label>状态 0:禁用,1:启用</label>
          <select name="item.mgr_status" class="combox">
        <?php $_from = $this->_tpl_vars['cout']['mgr_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['cout']['vinfo']['mgr_status'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?> ><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
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