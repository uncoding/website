<?PHP
if (!defined('CLASS_SERVER'))
{
  define('CLASS_SERVER','1');
  class server extends home
  {
    public function __construct()
    {
      parent::__construct();

       ## 获取当前分类以及分类下得内容
        $phoCls=$this->mydb->execsql("SELECT * FROM `cms_classify` where mgr_status=1 and mgr_table='cms_server' and cid = 4 order by mgr_sort asc");
            //print_r($cms_left);
            if(!empty($phoCls))
            {
              $this->cout['phoCls']=$phoCls;
              foreach( $this->cout['phoCls'] as $key => $value)
               {
                   $sql1="SELECT * FROM `cms_server` where cid='{$value['id']}' order by log_time asc limit 5";
                   $cms_cass=$this->mydb->execsql($sql1);
                    if(!empty($cms_cass) )
                    {
                      $this->cout['cms_cass'][]=$cms_cass;


                      $num = count($this->cout['cms_cass']);
                      for($i=0; $i<$num; $i++){
                          $this->cout['cms_cass'][$key][$i]['shw_content'] = stripslashes($this->cout['cms_cass'][$key][$i]['shw_content']);
                      }

                   }
               }
            }
    }
    public function server(){
      if (!empty($_REQUEST['cid'])){if(!is_integer((int)($_REQUEST['cid']))){die("参数无效");}} 
      if (!empty($_REQUEST['p'])){if(!is_integer((int)($_REQUEST['p']))){die("参数无效");}} 
      if (!empty($_REQUEST['numPerPage'])){if(!is_integer((int)($_REQUEST['numPerPage']))){die("参数无效");}} 
      $this->cout['title'] = '服务业务';
      $where = "where 1 ";
  if(!empty($_REQUEST['cid']) && is_integer((int)($_REQUEST['cid']))){
    $this->cout['cid']=$_REQUEST['cid'];
    $where .= " and cid = ".$_REQUEST['cid']." ";
    $sql1="SELECT * FROM `cms_classify` where id={$_REQUEST['cid']} and mgr_status=1 limit 1 ";
    $resultSet3=$this->mydb->execsql($sql1);
    if (!empty($resultSet3[0])) $this->cout['server_catatitle']=$resultSet3[0]['shw_title'];
  }
                    $orderby = ' order by log_time desc ';
         
      $index=empty($_REQUEST['p'])?1:$_REQUEST['p'];
      $size=empty($_REQUEST['numPerPage'])?10:$_REQUEST['numPerPage'];
      $row_skip=($index-1)*$size;
      $row_limit=$size;

      $sql1="SELECT * FROM `cms_server` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
      //T($sql1);
      $resultSet3=$this->mydb->execsql($sql1);
      $sql2="SELECT * FROM `cms_server` ".$where ;
      $totalCount=$this->mydb->fetchCount($sql2);
      //if ($totalCount == 1){
        //$this->info($resultSet3[0]['id']);exit;
      //}else{
        $totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
   foreach ($resultSet3 as $key => $value) {
    $value['shw_content'] = stripcslashes($value['shw_content']);
    $this->cout['vlist'][] = $value;
  }
        $this->cout['info']['totalCount']=$totalCount;
        $this->cout['info']['totalPageCount']=$totalPageCount;
        $this->cout['info']['nowPage']=$index;
        $this->cout['info']['size']=$size;

        $cid = $_REQUEST['cid'];
        if($cid == 4) {
            $this->display('server.list.html'); 
        }else{
            $this->display('server.list1.html'); 
        }  
      //}
    }
    public function info($id=0){
           $id = !empty($_REQUEST['id'])?$_REQUEST['id']:$id;
           if (!empty($id) && is_integer((int)($id))){
                $this->mydb->setData('id',$id);
                $resultSet=$this->mydb->fetch('cms_server');
                $this->cout['vinfo'] = $resultSet[0];
                $this->cout['title'] = $this->cout['vinfo']['shw_title'];
$this->cout['vinfo']['shw_content'] = stripcslashes($this->cout['vinfo']['shw_content']);
if ($this->cout['waterstatus'] == 1){
  $srcfile = '/html/upload/';
  $urlfile=$this->cout['waterserver'].'/index.php?act=home.waterimg&path=';
  $this->cout['vinfo']['shw_content'] = str_replace($srcfile, $urlfile, $this->cout['vinfo']['shw_content']);
}
//$this->cout['vinfo']['shw_content'] = $this->keywordurl($this->cout['vinfo']['shw_content']);
           }else{
               die("参数无效");
           }
    require_once (VENDORS_PATH.'Tree.class.php');
    $sql1="SELECT * FROM `cms_classify` where mgr_table='cms_server' and mgr_status=1 order by mgr_sort asc";
    $resultSet3=$this->mydb->execsql($sql1);
    $this->cout['server_category'] = array();
    $cate = array();
    foreach ($resultSet3 as $key => $value) {
      $subcate = array('id'=>$value['id'],'pid'=>$value['cid'],'name'=>$value['shw_title']);
      $cate[]=$subcate;
    }
    $tree = new tree($cate);
    $tree->prestr = '&gt;';
    $ordertree = $tree->getTree(0);
    $p=array();
    foreach($ordertree as $k => $v){
      $p[$v['lever']] = '<a href="/index.php?act=server.server&cid='.$v['id'].'">'.$v['name'].'</a>'.$v['prestr'];
      if ($v['lever'] > 1){
        $procate = '';
        for($i=1;$i<$v['lever'];$i++){
          $procate = $procate.$p[$i];
        }
        $this->cout['server_category'][$v['id']] = $procate.'<a href="/index.php?act=server.server&cid='.$v['id'].'">'.$v['name'].'</a>';
      }else{
        $this->cout['server_category'][$v['id']] = '<a href="/index.php?act=server.server&cid='.$v['id'].'">'.$v['name'].'</a>';
      }
    }
           $this->display('server.info.html');
        }   
    public function __destruct()
    {
      parent::__destruct();
    }
  }
} 
?>
