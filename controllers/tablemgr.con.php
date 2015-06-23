<?PHP
if (!defined('CLASS_CONTACTMGR'))
{
     define('CLASS_CONTACTMGR','1');
     class tablemgr extends manage{
          public function __construct()
          {
               parent::__construct();
            }
          public function table(){
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

           $sql1="SELECT * FROM `cms_table` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
           //T($sql1);
           $resultSet3=$this->mydb->execsql($sql1);
           $sql2="SELECT * FROM `cms_table` ".$where ;
           $totalCount=$this->mydb->fetchCount($sql2);
           $totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
           $this->cout['vlist']=$resultSet3;
           $this->cout['info']['totalCount']=$totalCount;
           $this->cout['info']['totalPageCount']=$totalPageCount;
           $this->cout['info']['nowPage']=$index;
           $this->cout['info']['size']=$size;
           $this->display('tablemgr.list.html');
          }
          public function tableadd($oid=0,$id=0){
               if(isPost()){
                    $acttype=$_REQUEST['acttype'];
                                                  $this->mydb->setData('shw_title', $_REQUEST['item_shw_title']);
                                                            $this->mydb->setData('shw_table', $_REQUEST['item_shw_table']);
                              
          if ($acttype==1){
               $result=$this->mydb->update('cms_table','id',$_REQUEST['id']);
          }else{
               $result=$this->mydb->insert('cms_table');
          }    
          if(!empty($result)){
               $obj='{
                          "statusCode":"200", 
                          "message":"'.$this->cout['ajaxmsg']['200'].'",
                          "navTabId":"tablemgr.table", 
                          "rel":"", 
                          "callbackType":"closeCurrent",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }else{
               $obj='{
                          "statusCode":"300", 
                          "message":"'.$this->cout['ajaxmsg']['300'].'", 
                          "navTabId":"tablemgr.table", 
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
                          "navTabId":"tablemgr.table", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }
          $this->mydb->setData('id',!empty($_REQUEST['id'])?$_REQUEST['id']:$id);
          $resultSet=$this->mydb->fetch('cms_table');
          $this->cout['vinfo'] = $resultSet[0];
                //$this->cout['actinfo'] = "更改";
       }else{
          $this->cout['acttype'] = 0;
          //$this->cout['actinfo'] = "新增";
       }
       if (@$_REQUEST['acttype'] == 2){
          $this->display('tablemgr.info.html');
       }else{
          $this->display('tablemgr.add.html');
       }
    }
    public function tabledel(){
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
          $sql="DELETE FROM `cms_table` WHERE `id` = '".$_REQUEST['id']."' limit 1;";
          $result=$this->mydb->execsql($sql);
          if($result){
             $obj='{
                  "statusCode":"200", 
                  "message":"'.$this->cout['ajaxmsg']['201'].'", 
                  "navTabId":"tablemgr.table", 
                  "rel":"", 
                  "callbackType":"",
                  "forwardUrl":""
            }';
           die($obj);
          }
       }              
    }
    public function create(){//智能识别，以及抓取程序
      require_once (VENDORS_PATH . 'Curl.class.php');
      $url='http://rq.fk369.com';
      //print_r($_SERVER['SERVER_NAME']);exit;
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
      return 1;   
    }
      
    public function __destruct()
    {
         parent::__destruct();
    }
   }
}    
?>
