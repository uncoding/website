<?php /* Smarty version 2.6.14, created on 2015-06-19 02:40:49
         compiled from default/news.info.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'default/news.info.html', 20, false),)), $this); ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body  class="body_article">
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
<div class="article">
  <ul class="wxlist">
    <li>
      <h1><?php echo $this->_tpl_vars['cout']['vinfo']['shw_title']; ?>
</h1>
      <div class="InfoTime"><?php echo ((is_array($_tmp=$this->_tpl_vars['cout']['vinfo']['log_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
</div>
      <div class="InfoContent"><?php echo $this->_tpl_vars['cout']['vinfo']['shw_content']; ?>
</div>
    </li>
  </ul>
  

  <div class="comment">
    <ul class="wxlist">
      <li>
        <div class="CommentList">
          <h1>评论列表</h1>
        </div>
        <div class="page"></div>
        <div class="LeaveComment">
          <h1>我要评论</h1>
        </div>
        <form>
          <table border="0px" cellpadding="0px" cellspacing="3px" class="comment_table">
            <tr>
              <td class="t1">姓名</td>
              <td class="t2"><input id="gname" name="gname" type="text" value=""  maxlength="100" />
                <input id="ctitle" name="ctitle" value="<?php echo $this->_tpl_vars['cout']['news_catatitle']; ?>
"   type="hidden" maxlength="100"  /></td>
                <input id="ltitle" name="ltitle" value="<?php echo $this->_tpl_vars['cout']['vinfo']['shw_title']; ?>
"   type="hidden"  maxlength="100"  /></td>
            </tr>
            <tr>
              <td class="t1"><span class="required">评论内容</span></td>
              <td class="t2"><textarea id="content"  name="content"   ></textarea></td>
            </tr>


            <tr>
              <td colspan="2"><a id="sendMsg" class="btn" >发表评论</a></td>
            </tr>
          </table>
        </form>
      </li>
    </ul>
  </div>
  <!--评论列表 结束--></div>
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


        <script type="text/javascript"><?php echo '
              $("#sendMsg").click(function(){
                  var gname = $("#gname").val();
                  var content = $("#content").val();
                  var ctitle = $("#ctitle").val();
                  var ltitle = $("#ltitle").val();

                  if($.trim(gname)  == \'\'){
                      alert(\'姓名不能为空\');
                      $("#gname").focus();
                      return false;
                  }

                  if($.trim(content)  == \'\'){
                      alert(\'留言不能为空\');
                      $("#content").focus();
                      return false;
                  }

                  var data = {\'gname\':gname,\'content\':content,\'ctitle\':ctitle,\'ltitle\':ltitle}
// alert(\'xxx\');
                $.ajax({
                    url : \'/index.php?act=comment.addInfo\', 
                    type: \'post\', 
                    data: data, 
                    success:function(msgs){
                      if(msgs == \'ok\'){
                        alert(\'留言成功\');
                        $("#gname").val(\'\');
                        $("#content").val(\'\');
                      }else{
                        alert(\'网络不给力,请稍后重试!\');
                      }
                      // window.location.reload();
                    }
                });

              })
         '; ?>

         </script>
