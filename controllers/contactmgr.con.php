<?PHP
if (!defined('CLASS_CONTACTMGR'))
{
     define('CLASS_CONTACTMGR','1');
     class contactmgr extends manage{
          public function __construct()
          {
               parent::__construct();
            }
          public function contact(){
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

           $sql1="SELECT * FROM `cms_contact` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
           //T($sql1);
           $resultSet3=$this->mydb->execsql($sql1);
           $sql2="SELECT * FROM `cms_contact` ".$where ;
           $totalCount=$this->mydb->fetchCount($sql2);
           $totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
           $this->cout['vlist']=$resultSet3;
           $this->cout['info']['totalCount']=$totalCount;
           $this->cout['info']['totalPageCount']=$totalPageCount;
           $this->cout['info']['nowPage']=$index;
           $this->cout['info']['size']=$size;
           $this->display('contactmgr.list.html');
          }
          public function contactadd($oid=0,$id=0){
               if(isPost()){
      $string = stripslashes($_POST['item_shw_content']);
preg_match_all("/<img .*\/>/isU",$string,$img_array);
$img_num=(count($img_array[0]));
for($i=0;$i< $img_num;$i++){
  $srcfile = preg_replace('|<img.*?src="(.*?)".*?>|ims',"$1",$img_array[0][$i]);
  if (stripos($srcfile,"http") === false){
  }else{
  $ext=strrchr($srcfile,".");
  $descfilename = time().rand(10000,99999).$ext;
  $descfile = UPLOAD_PATH.'/'.$descfilename;
ob_start();
readfile($srcfile);
$img = ob_get_contents();
ob_end_clean();
$size = strlen($img);
$fp2 = @fopen($descfile, "a");
fwrite($fp2, $img);
fclose($fp2);
  $urlfile='/html/upload/'.$descfilename;
  $_REQUEST['item_shw_content'] = str_replace($srcfile, $urlfile, $_REQUEST['item_shw_content']);
  }
}
                      $acttype=$_REQUEST['acttype'];
                            $this->mydb->setData('shw_title', $_REQUEST['item_shw_title']);
                            $this->mydb->setData('shw_content', $_REQUEST['item_shw_content']);
                            $this->mydb->setData('shw_remark', $_REQUEST['item_shw_remark']);
                            $this->mydb->setData('log_user',$_SESSION[SCRIPT_NAME.'_login']['full_name']);
                            $this->mydb->setData('log_time',$this->cout['date']['today']['eymd']);
/*
$sensitivestr = "";
if (!empty($_REQUEST['item_shw_title'])){
$sensitivestr .= $_REQUEST['item_shw_title'].'|';
}
if (!empty($_REQUEST['item_shw_content'])){
$sensitivestr .= $_REQUEST['item_shw_content'].'|';
}
if (!empty($_REQUEST['item_shw_remark'])){
$sensitivestr .= $_REQUEST['item_shw_remark'].'|';
}
if (!empty($sensitivestr)){
$word = $this->sensitive($sensitivestr);
if (!empty($word)){
  $obj='{
            "statusCode":"300", 
            "message":"有如下违禁词:'.$word.'请改正后再提交！", 
            "navTabId":"aboutusmgr.aboutus", 
            "rel":"", 
            "callbackType":"",
            "forwardUrl":""
      }';
  die($obj);
}
}
*/
          if ($acttype==1){
               $result=$this->mydb->update('cms_contact','id',$_REQUEST['id']);
          }else{
               $result=$this->mydb->insert('cms_contact');
/*
              $key = str_ireplace('cms_','','contact');
              $shw_url="index.php?act=".$key.".info&id=".$result;
              $key = str_ireplace('index.php?act=','',$shw_url);
              $key = str_ireplace('.','',$key);
              $key = str_ireplace('&','',$key);
              $key = str_ireplace('=','',$key);
              $key = str_ireplace('/','',$key);
              $this->mydb->setData('shw_url', $shw_url);
              $this->mydb->setData('shw_filename', $key);
              $this->mydb->setData('shw_title', $_REQUEST['item_shw_title']);
              $this->mydb->setData('shw_alt', $_REQUEST['item_shw_title']);
              $this->mydb->setData('mgr_only', 'cms_contact_'.$result);
              $this->mydb->insert('cms_seo');
*/
          }    
          if(!empty($result)){
               $obj='{
                          "statusCode":"200", 
                          "message":"'.$this->cout['ajaxmsg']['200'].'",
                          "navTabId":"contactmgr.contact", 
                          "rel":"", 
                          "callbackType":"closeCurrent",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }else{
               $obj='{
                          "statusCode":"300", 
                          "message":"'.$this->cout['ajaxmsg']['300'].'", 
                          "navTabId":"contactmgr.contact", 
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
                          "navTabId":"contactmgr.contact", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }
          $this->mydb->setData('id',!empty($_REQUEST['id'])?$_REQUEST['id']:$id);
          $resultSet=$this->mydb->fetch('cms_contact');
          $this->cout['vinfo'] = $resultSet[0];
        $this->cout['vinfo']['shw_content'] = stripcslashes($this->cout['vinfo']['shw_content']);
                  //$this->cout['actinfo'] = "更改";
       }else{
          $this->cout['acttype'] = 0;
          //$this->cout['actinfo'] = "新增";
       }
       if (@$_REQUEST['acttype'] == 2){
          $this->display('contactmgr.info.html');
       }else{
          $this->display('contactmgr.add.html');
       }
    }
    public function contactdel(){
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
          $sql="DELETE FROM `cms_contact` WHERE `id` = '".$_REQUEST['id']."' limit 1;";
          $result=$this->mydb->execsql($sql);
          if($result){
             $obj='{
                  "statusCode":"200", 
                  "message":"'.$this->cout['ajaxmsg']['201'].'", 
                  "navTabId":"contactmgr.contact", 
                  "rel":"", 
                  "callbackType":"",
                  "forwardUrl":""
            }';
           die($obj);
          }
       }              
    }
      
      public function __destruct()
      {
           parent::__destruct();
      }
     }
}    
?>
