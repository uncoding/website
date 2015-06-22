<?PHP

if (!defined('STATIC_TABLE'))
{
	define('STATIC_TABLE','1');
	
	require_once(MODELS_PATH . 'models.php');
	
	class static_table extends models
	{
		var $dataDir = '';
		var $dataFile = '';
		var $info = array();
		var $tableList = array(
			'city',
			'citydistrict',
			'placetopcatalog',
			'province',
			'placesecondcatalogBytopId',
			'placemenutree',
			'cityByprovince',
			'citydistrictBycityId',
			'bizdistrictBycityDistrictID',
			'placethirdcatalogBysecondId',
			'merchantheadoffice'
		);
		
		public function __construct($tableName)
		{
			parent::__construct($tableName);
			$this->dataDir = DATA_PATH . 'static_table' . DS;
			
			if (!file_exists($this->dataDir))
			{
				@mkdir($this->dataDir, 0777);
				$this->reCacheAll();
			}
		}
		
		public function initInfo($tableName, $reCache=FALSE)
		{
			if (in_array($tableName, $this->tableList))
			{
				$this->dataFile = $this->dataDir . $tableName . '.php';
				
				if (!$reCache && empty($GLOBALS['static_table'][$tableName]))
				{
					if (is_readable($this->dataFile))
					{
						require($this->dataFile);
						$GLOBALS['static_table'][$tableName] = $tableInfo;
					} else {
						$reCache = true;
					}
				}
				
				if ($reCache)
				{
					$this->dataTableName = $tableName;
					$this->info = array();
					$this->$tableName();
					
					if (is_writeable($this->dataDir))
					{
						if (file_exists($this->dataFile)) @unlink($this->dataFile);
						
						$fileContents = "<?php\n\$tableInfo = " . var_export($this->info, TRUE) . ";\n?>";
						
						file_put_contents($this->dataFile, $fileContents);
					}
					
					$GLOBALS['static_table'][$tableName] = $this->info;
				}
				
				return $GLOBALS['static_table'][$tableName];
			} else {
				return array();
			}
		}
		
		public function reCacheAll()
		{
			foreach ($this->tableList as $tableName)
			{
				$this->initInfo($tableName, TRUE);
			}
		}
		
		private function city()
		{
			$ob=new ObjFilter(city::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $_value)
			{
				$this->info[$_value['id']] = $_value;
			}
		}
		private function cityByprovince()
		{
			$ob=new ObjFilter(city::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $_value)
			{
				$this->info[$_value['provinceId']][] = $_value;
			}
		}		
		
		private function citydistrict()
		{
			$ob=new ObjFilter(citydistrict::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $_value)
			{
				$this->info[$_value['id']] = $_value;
			}
		}
		private function citydistrictBycityId()
		{
			$ob=new ObjFilter(citydistrict::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $_value)
			{
				$this->info[$_value['cityId']][] = $_value;
			}
		}
		private function bizdistrictBycityDistrictID()
		{
			$ob=new ObjFilter(bizdistrict::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $_value)
			{
				$this->info[$_value['cityDistrictID']][] = $_value;
			}
		}
		private function placethirdcatalogBysecondId()
		{
			$ob=new ObjFilter(placethirdcatalog::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $_value)
			{
				$this->info[$_value['secondId']][] = $_value;
			}
		}
		private function placetopcatalog() {
			$ob=new ObjFilter(placetopcatalog::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $key=>$_value)
			{
				$this->info[$key] = $_value;
			}
		}
		private function province(){
			$ob=new ObjFilter(province::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $key=>$_value)
			{
				$this->info[$key] = $_value;
			}			
		}
		private function placesecondcatalogBytopId(){
			$ob=new ObjFilter(placesecondcatalog::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			$info = array();
			foreach ($_tmp as $_value)
			{
				$this->info[$_value['topId']][] = $_value;
			}			
		}
		private function placemenutree(){
			$ob=new ObjFilter(placemenutree::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $key=>$_value)
			{
				$this->info[$key] = $_value;
			}			
		}

		private function merchantheadoffice(){
			$ob=new ObjFilter(merchantheadoffice::_TableName);
			$_tmp=DBM::$defaultDBM->filter($ob);
			foreach ($_tmp as $key=>$_value)
			{
				$this->info[$key] = $_value;
			}				
		}
		public function __destruct()
		{
			parent::__destruct();
		}
	}
}
?>
