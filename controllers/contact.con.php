<?PHP
if (!defined('CLASS_CONTACT'))
{
  define('CLASS_CONTACT','1');
  class contact extends home
  {
    public function __construct()
    {
      parent::__construct();
    }
    public function contact(){
      if (!empty($_REQUEST['cid'])){if(!is_integer((int)($_REQUEST['cid']))){die("参数无效");}} 
      if (!empty($_REQUEST['p'])){if(!is_integer((int)($_REQUEST['p']))){die("参数无效");}} 
      if (!empty($_REQUEST['numPerPage'])){if(!is_integer((int)($_REQUEST['numPerPage']))){die("参数无效");}} 
      $this->cout['title'] = '联系我们';
      $where = "where 1 ";
                $orderby = ' order by log_time desc ';
         
      $index=empty($_REQUEST['p'])?1:$_REQUEST['p'];
      $size=empty($_REQUEST['numPerPage'])?10:$_REQUEST['numPerPage'];
      $row_skip=($index-1)*$size;
      $row_limit=$size;

      $sql1="SELECT * FROM `cms_contact` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
      //T($sql1);
      $resultSet3=$this->mydb->execsql($sql1);
      $sql2="SELECT * FROM `cms_contact` ".$where ;
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
        $this->display('contact.list.html');   
      //}
    }
    public function info($id=0){
           $id = !empty($_REQUEST['id'])?$_REQUEST['id']:$id;
           if (!empty($id) && is_integer((int)($id))){
                $this->mydb->setData('id',$id);
                $resultSet=$this->mydb->fetch('cms_contact');
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
           $this->display('contact.info.html');
        }   
    public function __destruct()
    {
      parent::__destruct();
    }
  }
} 
?>
