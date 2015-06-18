<?php
class tree{
public $tree = array();
public $newtree = array();
public $i = 1;
public $l = 0;
public $prestr = "----";
public $formatstr = "{#cid#}{#name#}";
public function __construct($tree){
if (is_array($tree)){
 $this->tree = $tree;
}else{
 return false;
}
}

public function getchild($arr,$pid = 0){

$c = $v = array();
if(is_array($arr)){
 foreach($arr as $k => $v){
  if($v['pid'] == $pid){
   $c[$k] = $v;
  }
 }
}

return $c?$c:false;

}

public function getTree($pid){

$child = $this->getchild($this->tree,$pid);
if(is_array($child)){
 $this->l ++;
 $cnum = count($child);
 $ps = "";
 for($j = 1; $j <= $this->l; $j ++){
   $ps = $ps.$this->prestr;
  }
 foreach($child as $k => $v){
  $this->newtree[$this->i] = $v;
  $this->newtree[$this->i]['lever'] = $this->l;
  $this->newtree[$this->i]['prestr'] = $ps;
  $this->i ++;
  $this->getTree($v['id']);
 }
 $this->l --;
}else{
 
}
return $this->newtree;

}

public function getFormatStr($pid){
$fstr = "";
$nt = $this->getTree($pid);
foreach($nt as $k=>$v){
 $fstr .= str_replace('{#cid#}',$v['id'],str_replace("{#name#}",$v['prestr'].$v['name'],$this->formatstr));
}
return $fstr;
}

}