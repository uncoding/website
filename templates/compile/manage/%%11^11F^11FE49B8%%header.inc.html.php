<?php /* Smarty version 2.6.14, created on 2015-06-17 22:13:58
         compiled from inc/header.inc.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>超越无限网站管理系统</title>
<link href="/dwzjs/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/dwzjs/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/dwzjs/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="/dwzjs/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>

<script src="/dwzjs/js/speedup.js" type="text/javascript"></script>
<script src="/dwzjs/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="/dwzjs/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/dwzjs/js/jquery.validate.js" type="text/javascript"></script>
<script src="/dwzjs/js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="/dwzjs/xheditor/xheditor-1.1.14-zh-cn.min.js" type="text/javascript"></script>
<script src="/dwzjs/uploadify/scripts/swfobject.js" type="text/javascript"></script>
<script src="/dwzjs/uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>

<!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
<script type="text/javascript" src="/dwzjs/chart/raphael.js"></script>
<script type="text/javascript" src="/dwzjs/chart/g.raphael.js"></script>
<script type="text/javascript" src="/dwzjs/chart/g.bar.js"></script>
<script type="text/javascript" src="/dwzjs/chart/g.line.js"></script>
<script type="text/javascript" src="/dwzjs/chart/g.pie.js"></script>
<script type="text/javascript" src="/dwzjs/chart/g.dot.js"></script>
<script src="/dwzjs/js/dwz.min.js" type="text/javascript"></script>
<script src="/dwzjs/js/dwz.regional.zh.js" type="text/javascript"></script>
  <script type="text/javascript">
  <?php echo '
	$(function(){
		DWZ.init("dwz.frag.xml", {
	//		loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
	//		loginUrl:"login.html",	// 跳到登录页面
			statusCode:{ok:200, error:300, timeout:301}, //【可选】
			pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
			debug:false,	// 调试模式 【true|false】
			callback:function(){
				initEnv();
				$("#themeList").theme({themeBase:"/dwzjs/themes"}); // themeBase 相对于index页面的主题base路径
			}
		});

	});
	'; ?>

	</script>
</head>
<body scroll="no">
<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a  href="http://www.bbctop.com"><img src="/oa_logo.png"></a>
				<ul class="nav">
					<li>您好，<?php echo $_SESSION['manage_login']['full_name']; ?>
</li>
					<li><a mask="true" target="dialog" href="/b2wms.php?act=admin.changepwda">修改密码</a></li>
					<li><a href="/b2wms.php?act=manage.nologin">退出</a></li>
				</ul>				
			</div>
			<!-- navMenu -->
		</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/tree.inc.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>