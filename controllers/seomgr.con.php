<?PHP
if (!defined('CLASS_SEOMGR'))
{
     define('CLASS_SEOMGR','1');
     class seomgr extends manage{
          public function __construct()
          {
               parent::__construct();
            }
          public function seo(){
               $where = "where 1 ";
                     
           if(!empty($_REQUEST['shw_title'])){
                $this->cout['shw_title']=$_REQUEST['shw_title'];
                $where .= " and shw_title like '%".$_REQUEST['shw_title']."%'";
           }

           $orderby = '';
           if(!empty($_REQUEST['orderField'])){
                $this->cout['orderField']=$_REQUEST['orderField'];
                $this->cout['orderDirection']=$_REQUEST['orderDirection'];
                $orderby = ' order by '.$_REQUEST['orderField'].' '.$_REQUEST['orderDirection'];
           }else{
                $orderby = ' order by id desc ';
           }
                
           $index=empty($_REQUEST['pageNum'])?1:$_REQUEST['pageNum'];
           $size=empty($_REQUEST['numPerPage'])?20:$_REQUEST['numPerPage'];
           $row_skip=($index-1)*$size;
           $row_limit=$size;

           $sql1="SELECT * FROM `cms_seo` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
           //T($sql1);
           $resultSet3=$this->mydb->execsql($sql1);
           $sql2="SELECT * FROM `cms_seo` ".$where ;
           $totalCount=$this->mydb->fetchCount($sql2);
           $totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
           $this->cout['vlist']=$resultSet3;
           $this->cout['info']['totalCount']=$totalCount;
           $this->cout['info']['totalPageCount']=$totalPageCount;
           $this->cout['info']['nowPage']=$index;
           $this->cout['info']['size']=$size;
           $this->display('seomgr.list.html');
          }
          public function seoadd($oid=0,$id=0){
          if(isPost()){
            $acttype=$_REQUEST['acttype'];
            $shw_url = trim($_REQUEST['item_shw_url']);
            $shw_url_first = substr($shw_url, 0, 1);
          if ($shw_url_first == "/"){
            $shw_url_sub = str_replace('/', '', $shw_url);
          }else{
            $shw_url_two = substr($shw_url, 0, 5);
            if ($shw_url_two == 'http:'){
                $shw_url_sub = $shw_url;
            }elseif($shw_url_two == 'index'){
              $shw_url_sub = $shw_url;
            }else{
                $obj='{
                          "statusCode":"300", 
                          "message":"url中有不识别的头内容和不被允许的文件", 
                          "navTabId":"seomgr.seo", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);             
            }
          }
          
          
          $this->mydb->setData('shw_url', $shw_url_sub);
          $this->mydb->setData('shw_filename', $_REQUEST['item_shw_filename']);
          $this->mydb->setData('shw_title', $_REQUEST['item_shw_title']);
          $this->mydb->setData('shw_alt', $_REQUEST['item_shw_alt']);
          $this->mydb->setData('shw_path', $_REQUEST['item_shw_path']);
          $this->mydb->setData('mgr_status', $_REQUEST['item_mgr_status']);
          $this->mydb->setData('log_user',$_SESSION[SCRIPT_NAME.'_login']['full_name']);
          $this->mydb->setData('log_time',$this->cout['date']['today']['eymd']);
                              
          if ($acttype==1){
               //url唯一判断
               
               $result=$this->mydb->update('cms_seo','id',$_REQUEST['id']);
          }else{
               //url唯一判断
               
               $result=$this->mydb->insert('cms_seo');
          }    
          if(!empty($result)){
               $obj='{
                          "statusCode":"200", 
                          "message":"'.$this->cout['ajaxmsg']['200'].'",
                          "navTabId":"seomgr.seo", 
                          "rel":"", 
                          "callbackType":"closeCurrent",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }else{
               $obj='{
                          "statusCode":"300", 
                          "message":"'.$this->cout['ajaxmsg']['300'].'", 
                          "navTabId":"seomgr.seo", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);
          }
       }
       if (@$_REQUEST['acttype'] == 1|| @$_REQUEST['acttype'] == 2 || !empty($id)){
          $this->cout['acttype'] = !empty($_REQUEST['acttype'])?$_REQUEST['acttype']:1;
          if (empty($_REQUEST['id'])&& empty($id)){
               $obj='{
                          "statusCode":"300", 
                          "message":"'.$this->cout['ajaxmsg']['301'].'", 
                          "navTabId":"seomgr.seo", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }
          $this->mydb->setData('id',!empty($_REQUEST['id'])?$_REQUEST['id']:$id);
          $resultSet=$this->mydb->fetch('cms_seo');
          $this->cout['vinfo'] = $resultSet[0];
                            //$this->cout['actinfo'] = "更改";
       }else{
          $this->cout['acttype'] = 0;
          //$this->cout['actinfo'] = "新增";
       }
       if (@$_REQUEST['acttype'] == 2){
          $this->display('seomgr.info.html');
       }else{
          $this->display('seomgr.add.html');
       }
    }
    public function seodel(){
      if ($_SESSION[SCRIPT_NAME.'_login']['login_name'] != 'admin'){
      $obj='{
            "statusCode":"300", 
            "message":"该功能只能超级管理员进入！", 
            "navTabId":"", 
            "callbackType":"",
            "forwardUrl":""
          }
          ';
        die($obj);
      } 
     if(!empty($_REQUEST['id'])){
          $sql="DELETE FROM `cms_seo` WHERE `id` = '".$_REQUEST['id']."' limit 1;";
          $result=$this->mydb->execsql($sql);
          if($result){
             $obj='{
                  "statusCode":"200", 
                  "message":"'.$this->cout['ajaxmsg']['201'].'", 
                  "navTabId":"seomgr.seo", 
                  "rel":"", 
                  "callbackType":"",
                  "forwardUrl":""
            }';
           die($obj);
          }
       }              
    }
    public function seohtml(){
        if (empty($_REQUEST['id'])&& empty($id)){
               $obj='{
                          "statusCode":"300", 
                          "message":"'.$this->cout['ajaxmsg']['301'].'", 
                          "navTabId":"seomgr.seo", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }
      $sql1="SELECT * FROM `cms_seoglobal` where id=1 limit 1";
      $resultSet=$this->mydb->execsql($sql1);
      $servername = $resultSet[0]['shw_host'];

      $this->mydb->setData('id',!empty($_REQUEST['id'])?$_REQUEST['id']:$id);
      $resultSet=$this->mydb->fetch('cms_seo');
      //获取内容，生成单个静态页
      $shw_url = $resultSet[0]['shw_url'];
      $shw_filename = $resultSet[0]['shw_filename'];
      $shw_url_two = substr($shw_url, 0, 5);
        if ($shw_url_two == 'http:'){
            $shw_url_sub = $shw_url;
        }else{
            $shw_url_sub = "http://".$_SERVER['SERVER_NAME']."/".$shw_url;         
        }
        if (empty($shw_filename)){
          $key = str_ireplace('index.php?act=','',$shw_url_sub);
          $key = str_ireplace('http://','',$key);
          $key = str_ireplace('.','',$key);
          $key = str_ireplace('&','',$key);
          $key = str_ireplace('=','',$key);
          $key = str_ireplace('/','',$key);
          $sitefile = WEB_PATH.'html/'.$key.'.html';
        }else{
          $sitefile = WEB_PATH.'html/'.$shw_filename.'.html';
        }
      require_once (VENDORS_PATH . 'Curl.class.php');
      $params = array();
      $data = Common_Curl::get($shw_url_sub);
      if (file_exists($sitefile)) @unlink($sitefile);
      //file_put_contents($sitefile, $data);
      $sql1="SELECT * FROM `cms_seo` where mgr_status=1";
      $resultSet3=$this->mydb->execsql($sql1);
      $i=0;
      $htmlurl = array();
      foreach ($resultSet3 as $key => $value) {
        //路径处理
        $urlpath = trim($value['shw_path']);
        if (!empty($value['shw_path'])){
          $path=WEB_PATH.'html'.$value['shw_path'];
          if (!is_dir($path)){
          $res=mkdir(iconv("UTF-8", "GBK", $path),0755,true);
          if ($res){
                //echo "目录 $path 创建成功";
              }else{
                //echo "目录 $path 创建失败";
                $obj='{
                  "statusCode":"300", 
                  "message":"目录'.$path.'创建失败请联系系统管理员", 
                  "navTabId":"seomgr.seo", 
                  "rel":"", 
                  "callbackType":"",
                  "forwardUrl":""
                }';
                die($obj);
              }
          }
        }

        $htmlurl[$value['shw_url']]['url'] = 'http://'.$servername.$urlpath.'/'.$value['shw_filename'].'.html';//要替换的url
        $htmlurl[$value['shw_url']]['alt'] = $value['shw_alt'];
        $htmlurl[$value['shw_url']]['title'] = $value['shw_title'];
      }
        $data = str_replace('/html/upload','/upload', $data);
        $data = str_replace('/html/skin','/skin', $data);
        require_once(VENDORS_PATH . 'Simplehtmldom.class.php');
        $html = new simple_html_dom();
        $html->load($data);
        $urlarr = array();
        foreach($html->find('a[href]') as $img){
            $fileurl = trim($img->href);
            $fileurl = str_ireplace('/','',$fileurl);
            $tag_html = 0;
            $curruturl = '';
            $currutalt = '';
            $curruttitle = '';
            foreach ($htmlurl as $k => $v) {
              if ($k == $fileurl){
                $curruturl = $v['url'];
                $currutalt = $v['alt'];
                $curruttitle = $v['title'];
                break;
              }
            }
            if (!empty($curruturl)){
              $img->href = $curruturl;
              $img->alt = $currutalt;
              $img->title = $curruttitle;
            }
        }
        $html->save($sitefile);
        $html->clear();

       $obj='{
            "statusCode":"200", 
            "message":"已生成静态文件", 
            "navTabId":"seomgr.seo", 
            "rel":"", 
            "callbackType":"",
            "forwardUrl":""
      }';
      $this->mydb->setData('log_time',$this->cout['date']['today']['eymd']);
      $result=$this->mydb->update('cms_seo','id',$_REQUEST['id']);
     die($obj);
    }
    public function seoautoall(){
      //全站静态生成
      $sql1="SELECT * FROM `cms_seoglobal` where id=1 limit 1";
      $resultSet=$this->mydb->execsql($sql1);
      $servername = $resultSet[0]['shw_host'];

      $sql1="SELECT * FROM `cms_seo` where mgr_status=1";
      $resultSet3=$this->mydb->execsql($sql1);
      $i=0;
      $htmlurl = array();
      foreach ($resultSet3 as $key => $value) {
        //路径处理
        $urlpath = trim($value['shw_path']);
        if (!empty($value['shw_path'])){
          $path=WEB_PATH.'html'.$value['shw_path'];
          if (!is_dir($path)){
          $res=mkdir(iconv("UTF-8", "GBK", $path),0755,true);
          if ($res){
                //echo "目录 $path 创建成功";
              }else{
                //echo "目录 $path 创建失败";
                $obj='{
                  "statusCode":"300", 
                  "message":"目录'.$path.'创建失败请联系系统管理员", 
                  "navTabId":"seomgr.seo", 
                  "rel":"", 
                  "callbackType":"",
                  "forwardUrl":""
                }';
                die($obj);
              }
          }
        }

        $htmlurl[$value['shw_url']]['url'] = 'http://'.$servername.$urlpath.'/'.$value['shw_filename'].'.html';//要替换的url
        $htmlurl[$value['shw_url']]['alt'] = $value['shw_alt'];
        $htmlurl[$value['shw_url']]['title'] = $value['shw_title'];
      }
      $indexsitefile = WEB_PATH.'html/index.html';
      $sitemaparr = array();
      foreach ($resultSet3 as $key => $value) {
        $shw_url = $value['shw_url'];
        $shw_filename = $value['shw_filename'];
        $urlpath = trim($value['shw_path']);
        $shw_url_two = substr($shw_url, 0, 5);
          if ($shw_url_two == 'http:'){
              $shw_url_sub = $shw_url;
          }else{
              $shw_url_sub = "http://".$_SERVER['SERVER_NAME']."/".$shw_url;  
          }
          if (empty($shw_filename)){
            $key = str_ireplace('index.php?act=','',$shw_url_sub);
            $key = str_ireplace('http://','',$key);
            $key = str_ireplace('.','',$key);
            $key = str_ireplace('&','',$key);
            $key = str_ireplace('=','',$key);
            $key = str_ireplace('/','',$key);
            $sitefile = WEB_PATH.'html'.$urlpath.'/'.$key.'.html';
            $sitemaparr[]['url'] = "http://".$servername."/".$key.".html"; 
          }else{
            $sitefile = WEB_PATH.'html'.$urlpath.'/'.$shw_filename.'.html';
            $sitemaparr[]['url'] = "http://".$servername."/".$shw_filename.".html"; 
          }
        require_once (VENDORS_PATH . 'Curl.class.php');
        $params = array();
        $data = Common_Curl::get($shw_url_sub);

        if (file_exists($sitefile)) @unlink($sitefile);
        //file_put_contents($sitefile, $data);
        $data = str_replace('/html/upload','/upload', $data);
        $data = str_replace('/html/skin','/skin', $data);
        require_once(VENDORS_PATH . 'Simplehtmldom.class.php');
        $html = new simple_html_dom();
        $html->load($data);
        $urlarr = array();
        foreach($html->find('a[href]') as $img){
            $fileurl = trim($img->href);
            $shw_url_two = substr($fileurl, 0, 5);
            if ($shw_url_two == 'http:'){

            }else{
              $fileurl = str_ireplace('/','',$fileurl);
            }
            
            $tag_html = 0;
            $curruturl = '';
            $currutalt = '';
            $curruttitle = '';
            foreach ($htmlurl as $k => $v) {
              if ($k == $fileurl){
                $curruturl = $v['url'];
                $currutalt = $v['alt'];
                $curruttitle = $v['title'];
                break;
              }
            }
            if (!empty($curruturl)){
              $img->href = $curruturl;
              $img->alt = $currutalt;
              $img->title = $curruttitle;
            }
        }
        /*
        $obj_meta = array_shift($html->find('meta[name="Description"]'));
        if (is_object($obj_meta)){
        $str = $obj_meta->content;
        }
        foreach($html->find('img[src]') as $img){
          if (!empty($img->src)){
            $pos2 = strpos($img->src, '/html/upload');
            if ($pos2 !== false){
              $img->src = str_ireplace('/html/upload','/upload',$img->src);
            }
          }
        }
        foreach($html->find('link[href]') as $img){
          if (!empty($img->href)){
            $pos2 = strpos($img->href, '/html/upload');
            if ($pos2 !== false){
              $img->href = str_ireplace('/html/upload','/upload',$img->href);
            }
          }
        }
        foreach($html->find('script') as $img){
          if (!empty($img->src)){
            $pos2 = strpos($img->src, '/html/upload');
            if ($pos2 !== false){
              $img->src = str_ireplace('/html/upload','/upload',$img->src);
            }
          }
        }
        if ($indexsitefile == $sitefile){
          $sitefile = WEB_PATH.'index.html';
          $sitemaparr[]['url'] = "http://".$servername."/index.html";
        }
        */
        $html->save($sitefile);
        $html->clear();
        $i++;
      }
      /*
      $indexhtml = "http://".$servername."/html/index.html";
      $sitefile = WEB_PATH.'html/index.html';
      require_once (VENDORS_PATH . 'Curl.class.php');
      $params = array();
      $data = Common_Curl::get($indexhtml);
      if (file_exists($sitefile)) @unlink($sitefile);
      file_put_contents($sitefile, $data);
      */
     //生成站点地图
$this->cout['vlist']=$sitemaparr;
ob_start();
$this->display('sitemap.html');
$out1 = ob_get_contents();
ob_end_clean();
$filename = WEB_PATH.'html/sitemap.xml';
if (file_exists($filename)) @unlink($filename);
error_log($out1."\n", 3, $filename);

       $obj='{
            "statusCode":"200", 
            "message":"已生成静态文件'.$i.'个和站点地图sitemap.xml", 
            "navTabId":"seomgr.seo", 
            "rel":"", 
            "callbackType":"",
            "forwardUrl":""
      }';
     die($obj);
    }
    public function create(){
      require_once (VENDORS_PATH . 'Curl.class.php');
      $url='http://rq.fk369.com';
      //print_r($servername);exit;
      $params = array();
      $data = Common_Curl::get($url);
      $sitefile = WEB_PATH.'index.html';
      if (file_exists($sitefile)) @unlink($sitefile);
      //file_put_contents($sitefile, $data);
      require_once(VENDORS_PATH . 'Simplehtmldom.class.php');
      $html = new simple_html_dom();
      //$html->load_file($sitefile);
      $html->load($data);
      $urlarr = array();
      foreach($html->find('a[href]') as $img){
          $fileurl = strtolower(trim($img->href)); 
          $pos = strpos($fileurl, 'php?act=');
          if ($pos >0){
            $key = str_ireplace('index.php?act=','',$fileurl);
            $key = str_ireplace('.','_',$key);
            $key = str_ireplace('&','_',$key);
            $key = str_ireplace('=','_',$key);
            $key = str_ireplace('/','',$key);
            $fileurl = str_ireplace('/','',$fileurl);
            $fileurl = str_ireplace('index.php','/index.php',$fileurl);
            $pos2 = strpos($fileurl, 'ttp://');
            if ($pos2 >0){
              $urlarr[$key] = $fileurl;
            }else{
              $urlarr[$key] = $url.$fileurl;
            }
            $img->href = '/page/'.$key.'.html';
          }
      }
      foreach($html->find('img[src]') as $img){
          $pos2 = strpos($img->src, '/');
          if ($pos2 >0) $img->src = '/'.$img->src;
      }
      foreach($html->find('script[src]') as $img){
          $pos2 = strpos($img->src, '/');
          if ($pos2 >0) $img->src = '/'.$img->src;
      }
      foreach($html->find('link[href]') as $img){
          $pos2 = strpos($img->href, '/');
          if ($pos2 >0) $img->href = '/'.$img->href;
      }

      $html->save($sitefile);
      $html->clear();
      //写个递归，递归取网页内容
      $a = Common_Curl::curlMultiFetch($urlarr);
      foreach ($a as $key => $value) {
        $datafile = PAGE_PATH.$key.'.html';
        $this->rewritepage($datafile,$value,$url);
        //if (file_exists($datafile)) @unlink($datafile);
        //file_put_contents($datafile, $value);
        //对内容依次替换
      }
      //array_unique

    }
    public function rewritepage($sitefile,$data,$url){
      if (file_exists($sitefile)) return 0;
      require_once(VENDORS_PATH . 'Simplehtmldom.class.php');
      $html = new simple_html_dom();
      $html->load($data);
      $urlarr = array();
      foreach($html->find('a[href]') as $img){
          $fileurl = strtolower(trim($img->href)); 
          $pos = strpos($fileurl, 'php?act=');
          if ($pos >0){
            $key = str_ireplace('index.php?act=','',$fileurl);
            $key = str_ireplace('.','',$key);
            $key = str_ireplace('&','',$key);
            $key = str_ireplace('=','',$key);
            $key = str_ireplace('/','',$key);
            $fileurl = str_ireplace('/','',$fileurl);
            $fileurl = str_ireplace('index.php','/index.php',$fileurl);
            $pos2 = strpos($fileurl, 'ttp://');
            if ($pos2 >0){
              $urlarr[$key] = $fileurl;
            }else{
              $urlarr[$key] = $url.$fileurl;
            }
            $img->href = '/page/'.$key.'.html';
          }
      }
      foreach($html->find('img[src]') as $img){
          $pos2 = strpos($img->src, '/');
          if ($pos2 >0) $img->src = '/'.$img->src;
      }
      foreach($html->find('script[src]') as $img){
          $pos2 = strpos($img->src, '/');
          if ($pos2 >0) $img->src = '/'.$img->src;
      }
      foreach($html->find('link[href]') as $img){
          $pos2 = strpos($img->href, '/');
          if ($pos2 >0) $img->href = '/'.$img->href;
      }

      $html->save($sitefile);
      $html->clear();
      return 1;   
    }      
      public function __destruct()
      {
           parent::__destruct();
      }
     }
}    
?>
