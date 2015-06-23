<?PHP
if (!defined('CLASS_CONTROLLERS')){
	define('CLASS_CONTROLLERS','1');
	
	class controllers{
	
		// ADOdb MySQL对象
		var $mydb;
	
		// ADOdb SQLserver对象
		var $msdb;

		// Smarty对象
		var $tpl;

		// 保存程序产生的变量到这个数组
		var $cout;
		
		var $staticMod;
		var $report;
		// 构造函数 要执行父类的构造函数，需要在子类的构造函数中调用 parent::__construct
		public function __construct(){
			require_once MODELS_PATH.'db.mod.php';
			$this->mydb = new DB();
			$this->tpl = &$GLOBALS['tpl'];
			$this->cout = &$GLOBALS['cout'];
			$this->report = &$GLOBALS['report'];
//			$this->staticMod = &ado_link('static_table');
			if (empty($_SERVER['argv'][0]) || !preg_match("/cron\.php$/", $_SERVER['argv'][0])) {
				//if (!$this->checkip()) $this->noip();
				if(!$this->checklogin()) $this->nologin();
				if(!$this->checkrank()) $this->norank();
			}
		}
		public function locationUrl($vAction)
		{
			header('Location: ' . $vAction);
			exit();
		}		
		//重定义smarty的display方法
		protected function display($tpl,$arg=""){
			if ($arg=="alert") {echo "\$this->cout:<br>\n";print_r($this->cout);}
			$this->tpl->assign("cout",$this->cout);
			$this->tpl->display($tpl);
		}
		//
		
		//重定义smarty的fetch方法
		protected function fetch($tpl,$arg=""){
			if ($arg=="alert") {echo "\$this->cout:<br>\n";print_r($this->cout);}
			$this->tpl->assign("cout",$this->cout);
			return $this->tpl->fetch($tpl);
		}
		//

		public function main(){
			if (!empty($_SESSION[SCRIPT_NAME.'_login']['rankmenu']) && $_SESSION[SCRIPT_NAME.'_login']['login_name'] != 'admin' ){
				$this->cout['usermenu'] = $_SESSION[SCRIPT_NAME.'_login']['rankmenu'];
			}else{
				$this->cout['usermenu'] = '';
			}
			$this->display(SCRIPT_NAME . ".main.html");
		}

		public function weekDate($time){
			if (!empty($time)){
				$now=getdate($time);
				$Now_Time=$time;
			}else{
				$now=getdate();
				$Now_Time=time();
			}
			$Week_day=$now['weekday'];
			switch($Week_day){
				case 'Monday':
					$Last_time=$Now_Time;
					$Next_time=$Now_Time+(6*24*60*60);
					break;
				case 'Tuesday':
					$Last_time=$Now_Time-(1*24*60*60);
					$Next_time=$Now_Time+(5*24*60*60);
					break;
				case 'Wednesday':
					$Last_time=$Now_Time-(2*24*60*60);
					$Next_time=$Now_Time+(4*24*60*60);
					break;
				case 'Thursday':
					$Last_time=$Now_Time-(3*24*60*60);
					$Next_time=$Now_Time+(3*24*60*60);
					break;
				case 'Friday':
					$Last_time=$Now_Time-(4*24*60*60);
					$Next_time=$Now_Time+(2*24*60*60);     break;
				case 'Saturday':
					$Last_time=$Now_Time-(5*24*60*60);
					$Next_time=$Now_Time+(1*24*60*60);
					break;
				case 'Sunday':
					$Last_time=$Now_Time-(6*24*60*60);
					$Next_time=$Now_Time;     break;
			}
			//echo $Last_time;
			//echo $Next_time;
			$Last_time1=date('Y-m-d', $Last_time);
			$Next_time1=date('Y-m-d', $Next_time) ;
			$week_rs = array('start'=>$Last_time1,'end'=>$Next_time1);
			return($week_rs);
		}		
			public function nologin()
		{
			$_SESSION[SCRIPT_NAME.'_login'] = array();
			unset($_SESSION[SCRIPT_NAME.'_login']);
			$this->display(SCRIPT_NAME . ".nologin.html");
			exit;
		}
		public function checklogin()
		{
			if (in_array($this->cout['act'][0], array_flip($this->cout[SCRIPT_NAME.'_rank']['unlimit'])))
				return true;
			if (!$this->checksession())
				return false;
			else
				return true;
		}
		public function checksession()
		{
			if (empty($_SESSION[SCRIPT_NAME.'_login']['login_id']) || empty($_SESSION[SCRIPT_NAME.'_login']['login_name']) || 
				empty($_SESSION[SCRIPT_NAME.'_login']['full_name']) || empty($_SESSION[SCRIPT_NAME.'_login']['rank']) || 
				empty($_SESSION[SCRIPT_NAME.'_login']['time']))
			{
				return false;
			} else {
				return true;
			}
		}
		public function checkip()
		{
			if (in_array(getClientIP(), $GLOBALS['cout']['allow_ip']))
				return true;
			else
				return false;
		}
		public function noip()
		{
			$this->display(SCRIPT_NAME . ".noip.html");
			exit;
		}
		public function norank()
		{
			$this->display(SCRIPT_NAME . ".norank.html");
			exit;
		}
		public function checkrank()
		{	
			if (!isset($_SESSION[SCRIPT_NAME.'_login']['rank'])) 
				return true;
			$rank = json_decode($_SESSION[SCRIPT_NAME.'_login']['rank']);
			if (in_array($this->cout['act'][0], array_flip($this->cout[SCRIPT_NAME.'_rank']['unlimit'])))
				return true;
			if ($_SESSION[SCRIPT_NAME.'_login']['login_name'] == 'admin') return true;
			$current_act = $this->cout['act'][1].".".$this->cout['act'][2];
			$rank_str = implode(",", $rank);
			$rankNew = explode(",", $rank_str);
			$rankNew = array_unique($rankNew); 
			//error_log(print_r($current_act,true).'|当前权限\n', 3, "/tmp/1.log");
			if (in_array($current_act, $rankNew))
				return true;
			else
				return false;
		}	
		public function operatelog($type, $log_desc='', $extend_info=array())//{{{ 操作记录
		{	
			$extend_info['staff_id'] = $_SESSION['manage_login']['login_id'];
			$extend_info['code'] = $type;
			$extend_info['log_date'] = $this->cout['date']['today']['eymd'];
			$extend_info['log_content'] = $log_desc;
						
			$this->mydb->setData('staff_id', $extend_info['staff_id']);
			$this->mydb->setData('code', $extend_info['code']);
			$this->mydb->setData('log_date', $extend_info['log_date']);
			$this->mydb->setData('log_content', $extend_info['log_content']);
			$result=$this->mydb->insert('logoperate');
		}
		
        public function __destruct(){
			//$this->mydb->Close();
		}
	}
	
}
?>
