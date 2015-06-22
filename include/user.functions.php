<?php
function page($count,$pageSize=8){
	$index=$_REQUEST['p'];
	
	if($index>=$count){$index=$count;}
	if(empty($index)||$index==""||$index<=0){
		$index=1;
	}
	$str = "";
	for($i=1;$i<=$count;$i++){
		$select = "";
		if ($i == $index) $select='class="se"';
		$str .= '<a '.$select.' href="'.modify_url(array('p'=>$i)).'">'.$i.'</a> ';
	}
	$str = '<span>'.$str.'</span>';

	$parent='<a class="none" href="'.modify_url(array('p'=>$index-1)).'">上一页</a> ';
	$next='<a class="none" href="'.modify_url(array('p'=>$index+1)).'">下一页</a> ';
	$out=" ";
	if($index>1){
		$out.=$parent;
	}
	$out.=$str;
	if($index<$count){
		$out.=$next;
	}
	return $out;
}
/**
<form name='frm' id="frm" action='index.php?act=news.news{if $cout.cid}&cid={$cout.cid}{/if}&p=' method='post'>
        {if $cout.info.totalPageCount>0}
        {$cout.info.totalPageCount|page:$cout.info.size}
        {else}
        无更多内容
        {/if}
        {literal}
                <script type="text/javascript">
                function foo(){
                var noties = document.getElementById("sect").value;
                var x=document.getElementById("frm").action ;
                var y=x + noties;
                document.getElementById("frm").action=y;
                document.getElementById("frm").submit()
                }
                </script>
        {/literal}
        {if $cout.info.totalPageCount>1}<input type='submit' name='sub' value='确定'  onclick="foo()"/>{/if}
</form>
**/
function oppage($count,$pageSize=8){
	$index=$_REQUEST['p'];
	
	if($index>=$count){$index=$count;}
	if(empty($index)||$index==""||$index<=0){
		$index=1;
	}
	$n="<select name='sele' id='sect'>";
	$str = "";
	if($index >2 && $count-2<=$index &&  $index<$count-1){
		for($i=$index-2;$i<=$index+1;$i++){
			$select = "";
			if ($i == $index) $select='class="dang"';
			$str .= '<a '.$select.' href="'.modify_url(array('p'=>$i)).'">'.$i.'</a> ';
			//$n .="<option value='$i' selected >第".$i."页</option>";
		}		
	}
	elseif($index >2 && $index <$count-2){
		for($i=$index-2;$i<=$index+2;$i++){
			$select = "";
			if ($i == $index) $select='class="dang"';
			$str .= '<a '.$select.' href="'.modify_url(array('p'=>$i)).'">'.$i.'</a> ';
			//$n .="<option value='$i' selected >第".$i."页</option>";
		}		
	}
	elseif($count<=5){
		for($i=1;$i<=$count;$i++){
			$select = "";
			if ($i == $index) $select='class="dang"';
			$str .= '<a '.$select.' href="'.modify_url(array('p'=>$i)).'">'.$i.'</a> ';
			//$n .="<option value='$i' selected >第".$i."页</option>";
		}
	}
	elseif($count-1<=$index &&$index<=$count ){
		for($i=$index-2;$i<=$count;$i++){
			$select = "";
			if ($i == $index) $select='class="dang"';
			$str .= '<a '.$select.' href="'.modify_url(array('p'=>$i)).'">'.$i.'</a> ';
			//$n .="<option value='$i' selected >第".$i."页</option>";
		}		
	}else{
		for($i=1;$i<=$index+5;$i++){
			$select = "";
			if ($i == $index) $select='class="dang"';
			$str .= '<a '.$select.' href="'.modify_url(array('p'=>$i)).'">'.$i.'</a> ';
			//$n .="<option value='$i' selected >第".$i."页</option>";
		}		
	}
	for($i=1;$i<=$count;$i++){
		$select = "";
		$n .="<option value='$i' selected >第".$i."页</option>";
	}		

	$n.="</select>";
	$str = '<span class="page">'.$str.'</span>';

	$parent='<a class="none" href="'.modify_url(array('p'=>$index-1)).'">上一页</a> ';
	$next='<a class="none" href="'.modify_url(array('p'=>$index+1)).'">下一页</a> ';
	$out=" ";
	if($index<$count){
		$out.=$next;
	}
	if($count>1){
		$out.=$str.$n;
	}else{
		$out.=$str;
	}
	
	if($index>1){
		$out.=$parent;
	}
	return $out;
}
//定义验证函数,以FormValidator::PREFIX打头
function form_validator_require($str)
{
    return !(trim($str) == '');
}
function form_validator_equal($str, $data, $eqto)
{
    if ( !isset($data[$eqto]) )
    {
        return false;
    }
 
    return $data[$eqto] == $str;
}
?>
