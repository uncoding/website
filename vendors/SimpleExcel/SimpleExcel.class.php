<?php
class SimpleExcel
{
	var $rowsNum=0;
	var $attrib=array();
	var $encoding='';
	
	function __construct($encoding='GBK')
	{
		$this->encoding = $encoding;
		echo pack("ssssss",0x809,0x8,0x0,0x10,0x0,0x0);
		return;
	}
	
	function encode($string)
	{
		if ($this->encoding == 'GBK' || $this->encoding == 'GB2312')
		{
			return $string;
		} else {
			return mb_convert_encoding($string, 'GBK', $this->encoding);
		}
	}
	
	function excelItem($string=array())
	{
		for ($i=0;$i<count($string);$i++)
		{
			$string[$i] = $this->encode($string[$i]);
			$L = strlen($string[$i]);
			echo pack("ssssss",0x204,8+$L,$this->rowsNum,$i,0x0,$L);
			echo $string[$i];
		}
		
		$this->rowsNum++;
		return;
	}
	
	function colsAttrib($string=array())
	{
		$this->attrib=$string;
		return;
	}
	
	function excelWrite($string=array())
	{
		for ($i=0;$i<count($string);$i++)
		{
			$string[$i] = $this->encode($string[$i]);
			
			if ($this->attrib[$i]=="1")
			{
				echo pack("sssss",0x203,14,$this->rowsNum,$i,0x0);
				echo pack("d",$string[$i]);
			} else {
				$L = strlen($string[$i]);
				echo pack("ssssss",0x204,8+$L,$this->rowsNum,$i,0x0,$L);
				echo $string[$i];
			}
		}
		
		$this->rowsNum++;
	}
	
	function excelEnd()
	{
		echo pack("ss",0x0A,0x00);
		return;
	}
}


/**
 * 雨人 2004.11.25
**
header("Content-Type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=已使用的合同列表.xls");

header("Pragma: no-cache");

header("Expires: 0");

...
...

$excel=new SimpleExcel();                             调用类开始

$excel->excelItem(array("编号","认刊号","项目","地区","单位","金额","收款时间"));               第一行，可按不一定要的

$excel->colsAttrib(array("1","a","a","a","a","1","a"));                                 定义属性，数字型为"1"，字符型为"a"

...
...
$excel->excelWrite(array("01010","01010","ac","ad","ae","af","ag"));

$excel->excelWrite(array("02020","02020","bc","bd","be","bf","bg"));

...
...
$excel->excelEnd();                             类完成

 *
*/
?>