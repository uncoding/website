<?php /* Smarty version 2.6.14, created on 2015-06-22 22:35:05
         compiled from inc/tree.inc.html */ ?>
<div id="leftside">
	<div id="sidebar_s">
		<div class="collapse">
			<div class="toggleCollapse"><div></div></div>
		</div>
	</div>
	<div id="sidebar">
		<div class="toggleCollapse"><h2>后台管理</h2><div>收缩</div></div>
		<div class="accordion" fillSpace="sidebar">
			<div class="accordionHeader">
			</div>
			<div class="accordionContent"> 
				<ul class="tree treeFolder">
					<?php if ($this->_tpl_vars['cout']['usermenu'] != ""): ?> 
					<?php echo $this->_tpl_vars['cout']['usermenu']; ?>

					<?php else: ?>
					<li><span>超越无限网站管理系统</span>
						<ul>
							<li><a href="b2wms.php?act=homephotomgr.homephoto" target="navTab" rel="homephotomgr.homephoto">首页管理</a></li>
							<li><a href="b2wms.php?act=aboutusmgr.aboutus" target="navTab" rel="aboutusmgr.aboutus">关于我们</a></li>
							<li><a href="b2wms.php?act=newsmgr.news" target="navTab" rel="newsmgr.news">新闻动态</a></li>
							<li><a href="b2wms.php?act=servermgr.server" target="navTab" rel="servermgr.server">服务项目</a></li>
							<li><a href="b2wms.php?act=photomgr.photo" target="navTab" rel="photomgr.photo">产品栏目</a></li>
							<li><a href="b2wms.php?act=casesemgr.casese" target="navTab" rel="casesemgr.casese">经典案例</a></li>
							<li><a href="b2wms.php?act=recruitmgr.recruit" target="navTab" rel="recruitmgr.recruit">人才招聘</a></li>
							<li><a href="b2wms.php?act=contactmgr.contact" target="navTab" rel="contactmgr.contact">联系我们</a></li>
							<li><a href="b2wms.php?act=commentmgr.comment" target="navTab" rel="commentmgr.comment">留言列表</a></li>
						</ul>
				</li>
				<li><span>系统管理</span>
						<ul>
<li><a href="b2wms.php?act=skinmgr.skin" target="navTab" rel="skinmgr.skin">皮肤管理</a></li>
<li><a href="b2wms.php?act=admin.loginfo" target="navTab" rel="admin.loginfo">用户操作记录管理</a></li>
<li><a href="b2wms.php?act=navmgr.nav" target="navTab" rel="navmgr.nav">导航条管理</a></li>
<li><a href="b2wms.php?act=classifymgr.classify" target="navTab" rel="classifymgr.classify">分类管理</a></li>
<li><a href="b2wms.php?act=tablemgr.table" target="navTab" rel="tablemgr.table">分类对应表管理</a></li>
<li><a href="b2wms.php?act=navmgr.navreback" target="navTab" rel="navmgr.navreback">导航回收站</a></li>
<!--li><a href="b2wms.php?act=watermarkmgr.watermarkadd&acttype=1&id=1" target="navTab" rel="watermarkmgr.watermark">水印设置</a></li-->
<!--li><a href="b2wms.php?act=seomgr.seo" target="navTab" rel="seomgr.seo">SEO静态处理</a></li-->
<li><a href="b2wms.php?act=seoglobalmgr.seoglobaladd&acttype=1&id=1" target="navTab" rel="seoglbalmgr.seoglobaladd">SEO全局变量配置</a></li>
<li><a href="b2wms.php?act=admin.group" target="navTab" rel="admin.group">用户分组管理</a></li>
<li><a href="b2wms.php?act=admin.usersinfo" target="navTab" rel="adminusers">系统用户管理</a></li> 
<li><a href="b2wms.php?act=admin.sysmenu" target="navTab" rel="admin.sysmenu">系统菜单管理</a></li>

						</ul>		
				</li>
					<?php endif; ?>

									
				</ul>
			</div>
		</div>
	</div>
</div>