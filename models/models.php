<?PHP
if (!defined('CLASS_MODELS'))
{
	define('CLASS_MODELS','1');

	function &NewTableModels($datatable)
	{
		$models_class = MODELS_PATH . strtolower($datatable) . '.mod.php';
		if (!file_exists($models_class))
		{
			$m = new models($datatable);
			return $m;
		} else {
			require($models_class);
			$m = new $datatable($datatable);
			return $m;
		}
	}

	class models
	{
		var $mydb;

		var $msdb;

		var $dataTableName = '';
	
		// 构造函数 要执行父类的构造函数，需要在子类的构造函数中调用 parent::__construct
		public function __construct($dataTableName)
		{
			$this->cout = &$GLOBALS['cout'];
			$this->mydb = &$GLOBALS['mydb'];
			// $this->msdb = &$GLOBALS['msdb'];
			$this->dataTableName = $dataTableName;
            $this->mydb->debug = false;
			//$this->mydb->debug = true;
		}

		function MyGetAll($field="*", $where="1")
		{
			$this->cout['sql'][] = "SELECT ".$field." FROM ".$this->dataTableName." WHERE " . $where;
			return $this->mydb->GetAll(end($this->cout['sql']));
		}

		function MyGetRow($field="*", $where="1")
		{
			$this->cout['sql'][] = "SELECT ".$field." FROM ".$this->dataTableName." WHERE " . $where;
			return $this->mydb->GetRow(end($this->cout['sql']));
		}

		function MyGetOne($field="*", $where="1")
		{
			$this->cout['sql'][] = "SELECT ".$field." FROM ".$this->dataTableName." WHERE " . $where;
			return $this->mydb->GetOne(end($this->cout['sql']));
		}
		
		function MyGetCol($field='*', $where='1') 
		{
			$this->cout['sql'][] = "SELECT ".$field." FROM ".$this->dataTableName." WHERE " . $where;
			return $this->mydb->GetCol(end($this->cout['sql']));
		}

		function MyGetLimit($arrFields=array(), $where="1", $pages=20, $nowpage=1)
		{
			$this->cout['sql'][] = "SELECT count(*) FROM ".$this->dataTableName." WHERE " . $where;
			$maxnum = $this->mydb->GetOne(end($this->cout['sql']));

			if (!empty($arrFields) && is_array($arrFields) && count($arrFields)>=1)
				$field = implode(",", $arrFields);
			else
				$field = "*";

			if (empty($_GET['nowpage']) || $_GET['nowpage']<1)
				$nowpage = 1;
			else 
				$nowpage = $_GET['nowpage'];

			$limit = ($nowpage-1)*$pages;
			$this->cout['cleftpage'] = array('maxnum'=>$maxnum, 'pages'=>$pages, 'nowpage'=>$nowpage);
			$sql = "SELECT ".$field." FROM ".$this->dataTableName." WHERE " . $where;
			$rst = $this->mydb->SelectLimit($sql,$numrows=$pages,$offset=$limit,$inputarr=false);
			$this->cout['sql'][] = $rst->sql;
			return $this->mydb->GetAll($rst->sql);
		}


		function LeeGetLimit($arrFields=array(), $where="1", $pages=20, $nowpage=1)
		{
			$this->cout['sql'][] = "SELECT count(*) FROM ".$this->dataTableName." WHERE " . $where;
			$maxnum = $this->mydb->GetOne(end($this->cout['sql']));

			if (!empty($arrFields) && is_array($arrFields) && count($arrFields)>=1)
				$field = implode(",", $arrFields);
			else
				$field = "*";
			$limit = ($nowpage-1)*$pages;
			$this->cout['cleftpage'] = array('maxnum'=>$maxnum, 'pages'=>$pages, 'nowpage'=>$nowpage);
			$sql = "SELECT ".$field." FROM ".$this->dataTableName." WHERE " . $where;
			$rst = $this->mydb->SelectLimit($sql,$numrows=$pages,$offset=$limit,$inputarr=false);
			$this->cout['sql'][] = $rst->sql;
			return $this->mydb->GetAll($rst->sql);
		}

		function MyDelete($where="")
		{
			if (empty($where))
				return;
			$mySQL = "DELETE FROM ".$this->dataTableName." WHERE " . $where;
			$this->mydb->Execute($mySQL);
		}

		function MyUpdate($arrFields, $where=false)
		{
			if (empty($arrFields) || !is_array($arrFields) || count($arrFields)<1)
				return;
			$this->mydb->AutoExecute($this->dataTableName, $arrFields, 'UPDATE', $where=$where);
		}

		function MyInsert($arrFields)
		{
			if (empty($arrFields) || !is_array($arrFields) || count($arrFields)<1)
				return;
			$this->mydb->AutoExecute($this->dataTableName, $arrFields, 'INSERT') or die($this->mydb->ErrorMsg());
			return $this->mydb->Insert_ID();
		}

		// 析构函数 要执行父类的构造函数，需要在子类的构造函数中调用 parent::__destruct
		function __destruct() //{{{
		{
		}
		//}}}
	}
}
?>
