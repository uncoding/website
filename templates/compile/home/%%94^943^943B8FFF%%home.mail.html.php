<?php /* Smarty version 2.6.14, created on 2015-06-19 02:45:45
         compiled from default/home.mail.html */ ?>
<!DOCTYPE html>
<html>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <body class="body_feedback">
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
    <div class="feedback">
      <ul class="wxlist">
        <li>
          <div class="ChannelName">
            <h1>在线反馈</h1>
          </div>
          <form  id="f1" name="f1">
            <input maxlength="100" name="mail" id="mail" type="hidden" value="<?php echo $this->_tpl_vars['cout']['sedmail'][0]['shw_content']; ?>
" >
            <table border="0" cellpadding="0" cellspacing="3" class="feedback_table">
              <tr>
                <td class="t1"><span class="required">姓名</span></td>
                <td class="t2"><input id="author" name="author" type="text"  maxlength="100"   value=""/></td>
              </tr>

              <tr>
                <td class="t1"><span class="required">电话</span></td>
                <td class="t2"><input id="phone" name="phone" type="text"  maxlength="100"   value=""/></td>
              </tr>

              <tr>
                <td class="t1"><span class="required">邮箱</span></td>
                <td class="t2"><input id="mails" name="mails" type="text"  maxlength="100"   value=""/></td>
              </tr>
              <tr>
                <td class="t1">内容</td>
                <td class="t2"><textarea id="content"   name="content"></textarea></td>
              </tr>
              <tr>
                <td colspan="2"><input class="btn" type="submit" name="submit"  value="提交" />
              </tr>
            </table>
          </form>

          <script type="text/javascript" src="http://q.bbctop.com/js/jquery-1.8.3.min.js"></script>
              <script type="text/javascript"><?php echo '
              
                       jQuery(document).ready(function(){
                              $(\'#f1\').submit(function() { 

                                var author = $("#author").val();
                                var phone  = $("#phone").val();
                                var mails   = $("#mails").val();
                                var content= $("#content").val();
                                var pattern= /^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z]+$/;
                                var patterns =/^0?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/;

                                  if($.trim(author)  == \'\'){
                                        alert(\'姓名不能为空\');
                                        $("#author").focus();
                                        return false;
                                    }

                                  if($.trim(phone)  == \'\'){
                                        alert(\'手机不能为空\');
                                        $("#phone").focus();
                                        return false;
                                    }
                                   if(patterns.test(phone) === false) {
                                        alert(\'手机号格式不正确\');
                                        $("#phone").focus();
                                        return false; 
                                     }

                                   if($.trim(content)  == \'\'){
                                        alert(\'内容不能为空\');
                                        $("#content").focus();
                                        return false;
                                    }
                              
                              $.ajax({
                                   type: "get",
                                   async: false,
                                   url: "http://service.bbctop.net/w8s.php?act=msg&"+$(\'#f1\').serialize(),
                                   dataType: "jsonp",
                                   jsonp: "callback",
                                   jsonpCallback:"req",
                                   success: function(json){
                                        $("#phone").val(\'\');
                                        $("#content").val(\'\');
                                        $("#author").val(\'\');
                                        $("#mails").val(\'\');

                                       alert(\'提交结果:\' + json.code );
                                   },
                                   error: function(){
                                       alert(\'出问题了请电话或邮件联系管理员\');
                                   }
                               });      
                              return false; 
                              }); 
                       });
                       '; ?>

                       </script>

        </li>
      </ul>
    </div>
    </td>
    <!--版权 开始-->
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "default/inc/tool.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!--版权 结束-->
</body>
</html>