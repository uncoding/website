<?PHP
if (!defined('CLASS_HOME')){
	define('CLASS_HOME','1');
	class home{
		var $mydb;
		var $tpl;
		var $cout;
		var $staticMod;
		public function __construct(){
			require_once MODELS_PATH.'db.mod.php';
			$this->mydb = new DB();
			$this->tpl = &$GLOBALS['tpl'];
			$this->cout = &$GLOBALS['cout'];
			## 首页banner 图片
			$banner = $this->mydb->execsql("SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=1 and mgr_status = 1 order by mgr_sort asc limit 10");
            $this->cout['banner']=$banner;
            
            ## LOGO
			$logPic = $this->mydb->execsql("SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=13 order by  log_time desc limit 1");
            $this->cout['logPic']=$logPic;

            ## 首页案例
			$indxCas = $this->mydb->execsql("SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=14 order by  log_time desc limit 6");
            $this->cout['indxCas']=$indxCas;

            ## 首页服务
			$indxSer = $this->mydb->execsql("SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=15 order by  log_time desc limit 6");
            $this->cout['indxSer']=$indxSer;

             ## 首页新闻
			$indxNews = $this->mydb->execsql("SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=16 order by  log_time desc limit 6");
            $this->cout['indxNews']=$indxNews;

            ## 底部按钮
			$bttons = $this->mydb->execsql("SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=17 and mgr_status = 1 order by mgr_sort asc limit 4");
            $this->cout['bttons']=$bttons;

            ## 底部联系我们
			$btLink = $this->mydb->execsql("SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=18 and mgr_status = 1 order by mgr_sort asc limit 4");
            $this->cout['btLink']=$btLink;
            $this->cout['btLink'][0]['shw_content'] = stripslashes($btLink[0]['shw_content']);

             ## 收件邮箱
			$sedmail = $this->mydb->execsql("SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=19 order by  log_time desc limit 1");
            $this->cout['sedmail']=$sedmail;
            $this->cout['sedmail'][0]['shw_content']=stripslashes($sedmail[0]['shw_content']);
             

			//皮肤显示
			$sql4="SELECT * FROM `cms_skin` where mgr_status = 1 limit 1 ";
			$res=$this->mydb->execsql($sql4);
			if (!empty($res)){
				$this->cout['skin']=$res[0]['shw_skin'];
				$this->cout['url']=$res[0]['shw_url'];				
			}else{
				$this->cout['skin']='html/skin/default';
				$this->cout['url']='default';
			}
			$sql="SELECT * FROM `cms_seoglobal` where id = 1 limit 1 ";
			$res=$this->mydb->execsql($sql);
			if (!empty($res)){
				$this->cout['seokeywords']=$res[0]['shw_keyword'];
				$this->cout['seodescription']=$res[0]['shw_desc'];
			}

			/*
			$sql1="SELECT * FROM `cms_watermark` where id=1 limit 1";
			$resultSet=$this->mydb->execsql($sql1);
			$this->cout['waterstatus'] = $resultSet[0]['mgr_status'];
			$this->cout['waterserver'] = $resultSet[0]['shw_server'];
			*/

	      $sql1="SELECT * FROM `cms_contact` limit 1";
	      $resultSet=$this->mydb->execsql($sql1);
	      if (!empty($resultSet[0])){
	      	$this->cout['contact'] = $resultSet[0];
	      	//$this->cout['contact']['shw_content'] = stripcslashes($this->cout['contact']['shw_content']);
	      }
	      $sql1="SELECT * FROM `cms_nav` where cid=0 and mgr_status=1 order by mgr_sort asc ";
          $resultSet5=$this->mydb->execsql($sql1);
	      $sql1="SELECT * FROM `cms_nav` where cid>0 and mgr_status=1 order by mgr_sort asc ";
          $resultSet3=$this->mydb->execsql($sql1);
          $this->cout['navsub'] = $resultSet3;
		    foreach ($resultSet5 as $key => $value) {
		      $j=0;
		      foreach ($this->cout['navsub'] as $k => $v){
		      	if ($v['cid']== $value['id'] ) $j++;
		      }
		      $value['sub'] = $j;
		      $this->cout['nav'][] = $value;
		    }
	      $sql1="SELECT * FROM `cms_classify` where cid =1 and mgr_status =1 order by mgr_sort asc ";
	      $resultSet=$this->mydb->execsql($sql1);                
	      $this->cout['cms_classify'] = $resultSet;
	      $sql1="SELECT * FROM `cms_homephoto` where mgr_status =1 and cid=3 order by mgr_sort asc limit 6";
	      $resultSet=$this->mydb->execsql($sql1);                
	      $this->cout['cms_homephoto'] = $resultSet;
		//导航选中功能
        $menuselect = DATA_PATH.'menuselectcache.php';
        if (file_exists($menuselect)){
                require_once ($menuselect);
                $ordertree = $tableInfo;
        }else{
                require_once (VENDORS_PATH.'Tree.class.php');
                $sql1="SELECT * FROM `cms_nav` where mgr_status=1 order by mgr_sort asc";
                $resultSet3=$this->mydb->execsql($sql1);
                $this->cout['nav_category'] = array();
                $this->cout['nav_category2'] = array();
                $cate = array();
                foreach ($resultSet3 as $key => $value) {
                  $subcate = array('id'=>$value['id'],'pid'=>$value['cid'],'name'=>$value['shw_title'],'link'=>$value['shw_link'],'isselect'=>0,'sub'=>0);
                  $cate[]=$subcate;
                }
                $tree = new tree($cate);
                $tree->prestr = '-';
                $ordertree = $tree->getTree(0);
        }
        if (sizeof($ordertree) > 0){
                foreach($ordertree as $k => $v){
                        if ($v['isselect']==1) $currentmenuid = $v['id'];
                }
                foreach($ordertree as $k => $v){
                   $v['link'] =  trim(stripcslashes($v['link']));
                   if ($v['link'] == $_SERVER['REQUEST_URI']){
                                if ($v['lever'] == 1){
                                        $currentmenuid = $v['id'];
                                }elseif($v['lever'] == 2){
                                        $currentmenuid = $v['pid'];
                                }elseif($v['lever'] == 3){
                                        foreach ($ordertree as $key => $value) {
                                                if ($v['pid']==$value['id']) $currentmenuid = $value['pid'];
                                        }
                                }
                   }
                   $ordertree[$k]['isselect'] =0;
                   $v['isselect'] =0;
                  $j=0;
              foreach ($ordertree as $k1 => $v1){
                if ($v1['pid']== $v['id'] ) $j++;
              }
              $v['sub'] = $j;
              $this->cout['nav_category'][$v['id']] = $v;
                }
                if (!empty($currentmenuid)){
                        $this->cout['nav_category'][$currentmenuid]['isselect']=1;
                }
                $fileContents = "<?php\n\$tableInfo = " . var_export($this->cout['nav_category'], TRUE) . ";\n?>";
                if (file_exists($menuselect)) @unlink($menuselect);
                file_put_contents($menuselect, $fileContents);
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
			$this->tpl->display($this->cout['url'].'/'.$tpl);
		}
		
		//重定义smarty的fetch方法
		protected function fetch($tpl,$arg=""){
			if ($arg=="alert") {echo "\$this->cout:<br>\n";print_r($this->cout);}
			$this->tpl->assign("cout",$this->cout);
			return $this->tpl->fetch($tpl);
		}
		public function main(){

			$this->display("home.main.html");
		}
		public function mail(){

			$this->display("home.mail.html");
		}
		public function waterimg(){
			if (!empty($_REQUEST['path'])){
				$file = UPLOAD_PATH.'/'.$_REQUEST['path'];
				if (is_file($file)){
					$sql1="SELECT * FROM `cms_watermark` where id=1 limit 1";
					$resultSet=$this->mydb->execsql($sql1);
					if (sizeof($resultSet) >0 ){
						$waterstatus = $resultSet[0]['mgr_status'];
						$waterfile = empty($resultSet[0]['img_up'])?'water.png':$resultSet[0]['img_up'];
						$waterpositon = $resultSet[0]['shw_positon'];
						$wateralpha = $resultSet[0]['shw_alpha'];
						$shw_character = $resultSet[0]['shw_character'];
						$shw_angle = $resultSet[0]['shw_angle'];
						$shw_font = '/data/font/'.$this->cout['mgr_font'][$resultSet[0]['shw_font']];
						$shw_fontsize = $resultSet[0]['shw_fontsize'];
						$shw_fillcolor = $resultSet[0]['shw_fillcolor'];
						$shw_undercolor = $resultSet[0]['shw_undercolor'];
						if ($waterstatus == 1){
							require_once(VENDORS_PATH.'PHPImageWorkshop/ImageWorkshop.php');
							if ($resultSet[0]['mgr_isimg'] == 1){
								$norwayLayer = ImageWorkshop::initFromPath($file);
								$watermarkLayer = ImageWorkshop::initFromPath(UPLOAD_PATH.'/'.$waterfile);
								if (!empty($shw_angle)) $watermarkLayer->rotate($shw_angle);
								if (!empty($wateralpha)) $watermarkLayer->opacity($wateralpha);
								$norwayLayer->addLayer(1, $watermarkLayer, 10, 10, $waterpositon);
$image = $norwayLayer->getResult();
header('Content-type: image/jpeg');
imagejpeg($image, null, 95);
exit;
							}else{
								$norwayLayer = ImageWorkshop::initFromPath($file);
								$str=$shw_character;
								if (!empty($shw_undercolor)){
									$textLayer = ImageWorkshop::initTextLayer($str, $shw_font, $shw_fontsize, $shw_fillcolor, 0,$shw_undercolor);
								}else{
									$textLayer = ImageWorkshop::initTextLayer($str, $shw_font, $shw_fontsize, $shw_fillcolor, 0);
								}
								
								if (!empty($shw_angle)) $textLayer->rotate($shw_angle);
								if (!empty($wateralpha)) $textLayer->opacity($wateralpha);
								$norwayLayer->addLayer(1, $textLayer, 10, 10, $waterpositon);
$image = $norwayLayer->getResult();
header('Content-type: image/jpeg');
imagejpeg($image, null, 95);
exit;
							}

						}					
					}
				}
			}
		}
		public function keywordurl($str){
			if (empty($str)) return $str;
			$sql="SELECT * FROM `cms_keyword` where mgr_status=1 ";
	        $resultSet=$this->mydb->execsql($sql);
	        foreach ($resultSet as $key => $value) {
	        	$urlstr = '<a href="'.$value['shw_url'].'" target="_blank">'.$value['shw_key'].'</a>';
	        	$timezone = md5(time());
	        	$tmpstr = '<a href="'.$value['shw_url'].'" target="_blank">'.$timezone.'</a>';
	        	if (!empty($value['shw_replace'])){
	        		$str=str_ireplace($value['shw_replace'], $urlstr, $str);
	        	}else{
	        		$keycount1 = substr_count($str,$urlstr);
	        		$keycount2 = substr_count($str,$value['shw_key']);
	        		if ($keycount1 != $keycount2){
	        			$str = str_ireplace($urlstr,$tmpstr, $str);
	        			$str = str_ireplace($value['shw_key'], $urlstr, $str);
	        			$str = str_ireplace($tmpstr,$urlstr, $str);
	        		}
	        	}
	        }
	        return $str;
		}
		public function authcode(){
			require VENDORS_PATH.'SimPixelCaptcha.class.php';
			$code = new SimPixelCaptcha();
			$code->set('zoom', 1);
			$code->set('type', 1);
			$code->set('noise', 12);
			$code->output('authcode');
		}
        public function __destruct(){
			//$this->mydb->Close();
		}
	}
	
}
?>
