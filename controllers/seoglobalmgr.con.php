<?PHP
if (!defined('CLASS_SEOGLOBALMGR'))
{
     define('CLASS_SEOGLOBALMGR','1');
     class seoglobalmgr extends manage{
          public function __construct()
          {
               parent::__construct();
            }
          public function seoglobal(){
               $where = "where 1 ";
                     
           if(!empty($_REQUEST['shw_keyword'])){
                $this->cout['shw_keyword']=$_REQUEST['shw_keyword'];
                $where .= " and shw_keyword like '%".$_REQUEST['shw_keyword']."%'";
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

           $sql1="SELECT * FROM `cms_seoglobal` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
           //T($sql1);
           $resultSet3=$this->mydb->execsql($sql1);
           $sql2="SELECT * FROM `cms_seoglobal` ".$where ;
           $totalCount=$this->mydb->fetchCount($sql2);
           $totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
           $this->cout['vlist']=$resultSet3;
           $this->cout['info']['totalCount']=$totalCount;
           $this->cout['info']['totalPageCount']=$totalPageCount;
           $this->cout['info']['nowPage']=$index;
           $this->cout['info']['size']=$size;
           $this->display('seoglobalmgr.list.html');
          }
          public function seoglobaladd($oid=0,$id=0){
               if(isPost()){
$acttype=$_REQUEST['acttype'];
        $this->mydb->setData('shw_keyword', $_REQUEST['item_shw_keyword']);
        $this->mydb->setData('shw_desc', $_REQUEST['item_shw_desc']);
        $this->mydb->setData('shw_host', $_REQUEST['item_shw_host']);
        $this->mydb->setData('shw_sitename', $_REQUEST['item_shw_sitename']);
        $this->mydb->setData('shw_html', $_REQUEST['item_shw_html']);
        $this->mydb->setData('log_user',$_SESSION[SCRIPT_NAME.'_login']['full_name']);
        $this->mydb->setData('log_time',$this->cout['date']['today']['eymd']);
                              
          if ($acttype==1){
               $result=$this->mydb->update('cms_seoglobal','id',$_REQUEST['id']);
          }
          if(!empty($result)){
               $obj='{
                          "statusCode":"200", 
                          "message":"'.$this->cout['ajaxmsg']['200'].'",
                          "navTabId":"seoglobalmgr.seoglobal", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }else{
               $obj='{
                          "statusCode":"300", 
                          "message":"'.$this->cout['ajaxmsg']['300'].'", 
                          "navTabId":"seoglobalmgr.seoglobal", 
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
                          "navTabId":"seoglobalmgr.seoglobal", 
                          "rel":"", 
                          "callbackType":"",
                          "forwardUrl":""
                    }';
               die($obj);                              
          }
          $this->mydb->setData('id',!empty($_REQUEST['id'])?$_REQUEST['id']:$id);
          $resultSet=$this->mydb->fetch('cms_seoglobal');
          $this->cout['vinfo'] = $resultSet[0];
                          //$this->cout['actinfo'] = "更改";
       }else{
          $this->cout['acttype'] = 0;
          //$this->cout['actinfo'] = "新增";
       }
       if (@$_REQUEST['acttype'] == 2){
          $this->display('seoglobalmgr.info.html');
       }else{
          $this->display('seoglobalmgr.add.html');
       }
    }
    public function seoglobaldel(){
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
          $sql="DELETE FROM `cms_seoglobal` WHERE `id` = '".$_REQUEST['id']."' limit 1;";
          $result=$this->mydb->execsql($sql);
          if($result){
             $obj='{
                  "statusCode":"200", 
                  "message":"'.$this->cout['ajaxmsg']['201'].'", 
                  "navTabId":"seoglobalmgr.seoglobal", 
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
