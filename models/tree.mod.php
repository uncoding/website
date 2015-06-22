<?php
if (!defined('MODEL_TREE'))
{
	define('MODEL_TREE', 1);
	
	require_once(MODELS_PATH . 'models.php');
	
	class tree extends models  
	{
		public function __construct($dataTableName)
		{
			parent::__construct($dataTableName);
		}
		/**
		 * 动态菜单设计，根据用户的权限生成
		 */
		public function getNodeTree($table,$node,$rank=array()){
			$menu = new  stdClass();
			$menu->id = "dianxing";
			$menu->iconCls = "icon-docs";
			$menu->text = "点行管理系统";
			$menu->singleClickExpand = true;
			$menu->children = array();
			$ob=new ObjFilter($table::_TableName);
			$ob->add($table::menulevel,0,"=");
			$ob->add($table::isenable,1,"=");
			$ob->orderBy($table::displayorder,"ASC");
			$_tmp=DBM::$defaultDBM->filter($ob);
			$usermenu0 =  array();
			foreach ($_tmp as $_value){
				$menu0 = new  stdClass();
				$menu0->id = $_value['nodekey'];
				$menu0->iconCls = "icon-pkg";
				$menu0->text = $_value['modulename'];
				$menu0->cls = "package";
				$menu0->singleClickExpand = true;	
				$ob1=new ObjFilter($table::_TableName);
				$ob1->add($table::menulevel,1,"=");
				$ob1->add($table::isenable,1,"=");
				$ob1->add($table::nodekey,$_value['nodekey'],"=");
				$ob1->orderBy($table::displayorder,"ASC");
				$_tmp1=DBM::$defaultDBM->filter($ob1);
				if (count($_tmp1)>0){
					$usermenu =  array();
					foreach ($_tmp1 as $_value1){
						foreach ($rank as $_v){//用户权限判断
							if ($_v == $_value1['code']){
								$menu1=json_decode($_value1['jstext']);
								array_push($usermenu,$menu1);	
							}
						}
					}
					if (count($usermenu) > 0){
						$menu0->children = $usermenu;
						array_push($usermenu0,$menu0);						
					}
				}
			}
			if (count($usermenu0)>0){
				$menu->children = $usermenu0;
			}
			return json_encode($menu);
		}
		
		public function __destruct()
		{
			parent::__destruct();
		}
	}
}
?>