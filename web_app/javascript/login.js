Ext.QuickTips.init();
LoginWindow=Ext.extend(Ext.Window,{
	title : '超越无限网站管理系统用户登录',
	width : 320,
	height : 140,
	collapsible : false,
	closable : false,
	defaults : {
		border : false
	},
	
	buttonAlign : 'center',
	createFormPanel :function() {
		return new Ext.form.FormPanel( {
			bodyStyle : 'padding-top:6px',
			defaultType : 'textfield',
			labelAlign : 'right',
			labelWidth : 55,
			labelPad : 0,
			frame : true,
			
			defaults : {
				allowBlank : false,
				width : 220
			},
			items : [{
				cls : 'user',
				name : 'username',
				fieldLabel : '帐号',
				blankText : '帐号不能为空'
			}, {
				cls : 'key',
				name : 'password',
				fieldLabel : '密码',
				blankText : '密码不能为空',
				inputType : 'password'
			}]
		});
	},
	login:function() {
		this.fp.form.submit({
			waitMsg : '正在登录......',
			url : '/b2wms.php?act=manage.dologin',
			success : function(form, action) {
				window.location.href = '/b2wms.php';
			},
			failure : function(form, action) {
				form.reset();
				Ext.MessageBox.alert('警告', action.result.msg);
			}
		});
	},
	initComponent : function(){
		LoginWindow.superclass.initComponent.call(this);
		this.fp=this.createFormPanel();
		this.add(this.fp);
		this.addButton('登录',this.login,this);
		this.addButton('重置', function(){this.fp.form.reset();},this);
	}
});

Ext.onReady(function()
{
	var win=new LoginWindow();
	win.show();
}
);