<?PHP
if (!defined('CLASS_PLACARD'))
{
  define('CLASS_PLACARD','1');
  class placard extends home
  {
    public function __construct()
    {
      parent::__construct();
    }
    public function placard(){
      $where = "where 1 ";        
      if(!empty($_REQUEST['name'])){
        $this->cout['name']=$_REQUEST['name'];
        $where .= " and name like '%".$_REQUEST['name']."%'";
      }
                        $orderby = ' order by log_time desc ';
                         
      $index=empty($_REQUEST['p'])?1:$_REQUEST['p'];
      $size=empty($_REQUEST['numPerPage'])?10:$_REQUEST['numPerPage'];
      $row_skip=($index-1)*$size;
      $row_limit=$size;

      $sql1="SELECT * FROM `cms_placard` ".$where.$orderby."  limit {$row_skip} ,{$row_limit}";
      //T($sql1);
      $resultSet3=$this->mydb->execsql($sql1);
      $sql2="SELECT * FROM `cms_placard` ".$where ;
      $totalCount=$this->mydb->fetchCount($sql2);
      if ($totalCount == 1){
        $this->info($resultSet3[0]['id']);exit;
      }else{
        $totalCount/$size>0?$totalPageCount=ceil($totalCount/$size):$totalPageCount=$totalCount/$size;
    foreach ($resultSet3 as $key => $value) {
      $value['shw_intro'] = stripcslashes($value['shw_intro']);
      $this->cout['vlist'][] = $value;
    }
          $this->cout['info']['totalCount']=$totalCount;
        $this->cout['info']['totalPageCount']=$totalPageCount;
        $this->cout['info']['nowPage']=$index;
        $this->cout['info']['size']=$size;
        $this->display('placard.list.html');   
      }
    }
    public function info($id=0){
           $id = !empty($_REQUEST['id'])?$_REQUEST['id']:$id;
           if (!empty($id) && !is_integer($id)){
                $this->mydb->setData('id',$id);
                $resultSet=$this->mydb->fetch('cms_placard');
                $this->cout['vinfo'] = $resultSet[0];
                                    $this->cout['vinfo']['shw_intro'] = stripcslashes($this->cout['vinfo']['shw_intro']);
                 }else{
               die("参数无效");
           }
           $this->display('placard.info.html');
        }   
    public function __destruct()
    {
      parent::__destruct();
    }
  }
} 
?>
