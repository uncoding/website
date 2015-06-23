<?PHP
if (!defined('CLASS_MUSICMGR'))
{
     define('CLASS_MUSICMGR','1');
     class musicmgr extends manage{
          public function __construct()
          {
               parent::__construct();
  require_once (VENDORS_PATH.'Tree.class.php');
$sql1="SELECT * FROM `cms_classify` where mgr_table='cms_music' and mgr_status=1 order by mgr_sort asc";
$resultSet3=$this->mydb->execsql($sql1);
$this->cout['music_category'] = array();
$this->cout['music_category'][0] = '请选择';
$cate = array();
foreach ($resultSet3 as $key => $value) {
  $subcate = array('id'=>$value['id'],'pid'=>$value['cid'],'name'=>$value['shw_title']);
  $cate[]=$subcate;
}
$tree = new tree($cate);
$tree->prestr = '-';
$ordertree = $tree->getTree(0);
$p=array();
foreach($ordertree as $k => $v){
  $p[$v['lever']] = $v['name'].$v['prestr'];
  if ($v['lever'] > 1){
    $procate = '';
    for($i=1;$i<$v['lever'];$i++){
      $procate = $procate.$p[$i];
    }
    $this->cout['music_category'][$v['id']] = $procate.$v['name'];
  }else{
    $this->cout['music_category'][$v['id']] = $v['name'];
  }
}
            }
          public function music(){
               $where = "where 1 ";
                    if(!empty($_REQUEST['cid'])){
            $this->cout['cid']=$_REQUEST['cid'];
            $where .= " and cid = '".$_REQUEST['cid']."'";
          } 
                     
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

           $sql1="SELECT * FROM `cms_music` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
           //T($sql1);
           $resultSet3=$this->mydb->execsql($sql1);
           $sql2="SELECT * FROM `cms_music` ".$where ;
           $totalCount=$this->mydb->fetchCount($sql2);
           $totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
           $this->cout['vlist']=$resultSet3;
           $this->cout['info']['totalCount']=$totalCount;
           $this->cout['info']['totalPageCount']=$totalPageCount;
           $this->cout['info']['nowPage']=$index;
           $this->cout['info']['size']=$size;
           $this->display('musicmgr.list.html');
          }
          public function musicadd($oid=0,$id=0){
               if(isPost()){
                              $k = 0;
                    foreach ($_FILES as $key => $value) {
                      if (!empty($value['name'])){
                       $k++; 
                      }
                    }              
              if($k>0){
                require_once (VENDORS_PATH . 'UploadFile.class.php');
                $upload = new UploadFile();
                $upload->maxSize  = 2048576 * 3 ; 
                $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg','mp3');
                $upload->savePath =  './html/upload/';
                $upload->saveRule = 'uniqid';
                $upload->thumb = false;                $upload->thumbMaxWidth = 100;
                $upload->thumbMaxHeight = 100;
                $upload->uploadReplace = false;
                $upload->thumbPrefix = '100_100_';

                if(!$upload->upload()) {
                       $obj='{
                                  "statusCode":"300", 
                                  "message":"'.$upload->getErrorMsg().'", 
                                  "navTabId":"photomgr.photo", 
                                  "rel":"", 
                                  "callbackType":"",
                                  "forwardUrl":""
                            }';
                       die($obj);
                }else{
                  $imgs = $upload->getUploadFileInfo();
                  $i = 0;
                  foreach ($_FILES as $key => $value) {
                    if (!empty($value['name'])){
                      $_REQUEST[$key] = $imgs[$i]['savename'];
                      $i++;
                    }                    
                  }
                }
              }
                    $acttype=$_REQUEST['acttype'];
                                                  $this->mydb->setData('cid', $_REQUEST['item_cid']);
                                                            $this->mydb->setData('shw_url', $_REQUEST['item_shw_url']);
                                                              if (!empty($_REQUEST['img_up'])){
              $this->mydb->setData('img_up', $_REQUEST['img_up']);
            }
                                                            $this->mydb->setData('shw_content', $_REQUEST['item_shw_content']);
                                                            $this->mydb->setData('shw_intro', $_REQUEST['item_shw_intro']);
                                                              if (!empty($_REQUEST['img_up2'])){
              $this->mydb->setData('img_up2', $_REQUEST['img_up2']);
            }
                                                            $this->mydb->setData('shw_title', $_REQUEST['item_shw_title']);
                                                            $this->mydb->setData('mgr_sort', $_REQUEST['item_mgr_sort']);
                                                            $this->mydb->setData('mgr_status', $_REQUEST['item_mgr_status']);
                              
          if ($acttype==1){
               $result=$this->mydb->update('cms_music','id',$_REQUEST['id']);
          }else{
               $result=$this->mydb->insert('cms_music');
          }    
          if(!empty($result)){
               $obj='{
                          "statusCode":"200", 
                          "message":"'.$this->cout['ajaxmsg']['200'].'",
                          "navTabId":"musicmgr.music", 
                          "rel":"", 
                          "callbackType":"closeCurrent",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }else{
               $obj='{
                          "statusCode":"300", 
                          "message":"'.$this->cout['ajaxmsg']['300'].'", 
                          "navTabId":"musicmgr.music", 
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
                          "navTabId":"musicmgr.music", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }
          $this->mydb->setData('id',!empty($_REQUEST['id'])?$_REQUEST['id']:$id);
          $resultSet=$this->mydb->fetch('cms_music');
          $this->cout['vinfo'] = $resultSet[0];
            $this->cout['vinfo']['shw_content'] = stripcslashes($this->cout['vinfo']['shw_content']);
      $this->cout['vinfo']['shw_intro'] = stripcslashes($this->cout['vinfo']['shw_intro']);
                    //$this->cout['actinfo'] = "更改";
       }else{
          $this->cout['acttype'] = 0;
          //$this->cout['actinfo'] = "新增";
       }
       if (@$_REQUEST['acttype'] == 2){
          $this->display('musicmgr.info.html');
       }else{
          $this->display('musicmgr.add.html');
       }
    }
    public function musicdel(){
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
          $sql="DELETE FROM `cms_music` WHERE `id` = '".$_REQUEST['id']."' limit 1;";
          $result=$this->mydb->execsql($sql);
          if($result){
             $obj='{
                  "statusCode":"200", 
                  "message":"'.$this->cout['ajaxmsg']['201'].'", 
                  "navTabId":"musicmgr.music", 
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
