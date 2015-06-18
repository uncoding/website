<?PHP
/**
 * SimpleVerify.class.php --- 产生随机的校验图片,对比提交的代码的md5值是否和预产生的一致
 *
 * Filename: checkcode.class.php
 * Author: koocyton
 * Copyright (C) 2006, koocyton, all rights reserved.
 * Created: 2006-04-30 15:26
 * Version: 1.0
 * Last-Updated: 
 *           By: koocyton
 *         Line: 103 ~ 106
 * Keywords: php , gd , login , rand
 * Compatibility: GNU Emacs 20.x, GNU Emacs 21.x, GNU Emacs 22.x
 *
 *
 *
 * [示例]
 * 1.生成校验的图片
 * <?PHP
 * include_once("SimpleVerify.class.php");
 * $CC = new SimpleVerify;
 * $CC->putpic();
 * ? >
 *
 * 2.校验
 * <?PHP
 * include_once("SimpleVerify.class.php");
 * $CC = new SimpleVerify;
 * $CC->checkcode=$_POST['checkcode'];
 * if ($CC->check())
 * { echo "成功";
 * } else { echo "失败"; }
 * ? >
 *
 *
 *********************************************/

class SimpleVerify
{
	var $_BeginTime;
	
	var $_RandCodeLength = 4;
	
	var $FailTimeLength = 600;
	
	var $CheckTheName = 'checkcode';
	
	var $_RandCode = '';
	
	var $checkcode;

	var $imgWidth = 55;

	var $imgHeight = 20;

	var $imgFontsize = 16;

	var $astenNumber = 10;
	
	// 构造函数
	function SimpleVerify()
	{
		ini_set("display_errors",true);
		error_reporting(E_ALL);
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		//session_start();
		$this->_BeginTime = time();
	}

	function __construct()
	{
		$this->SimpleVerify();
	}
	
	/**
	 * 方法功能: 将随机数 MD5 后写入SESSIOn
	 */
	function _WriteSession()
	{
		$this->_GetRand();
		$_SESSION[$this->CheckTheName] = array();
		$_SESSION[$this->CheckTheName]['mdfivevalue'] = md5($this->_RandCode);
		$_SESSION[$this->CheckTheName]['maxfailtime'] = $this->_BeginTime + $this->FailTimeLength;
	}
	
	/**
	 * 方法功能: 取得随机数
	 */
	function _GetRand()
	{
		// $str='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		// 	$str='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		// $str='abcdefghijklmnopqrstuvwxyz1234567890';
		$str='1234567890';
		for ($i=0; $i<$this->_RandCodeLength; $i++)
		{
			$this->_RandCode .= $str{mt_rand(0,strlen($str)-1)};
		}
	}
	
	/**
	 * 方法功能: 输出图片
	 */
	function putpic()
	{
		$this->_WriteSession();
		$this->_PutCodeImages();
	}

	/**
	 * 方法功能: 设置图片的大小和文字大小
	 *
	 * @
	 */
	function reSetSize($width=44,$height=20,$fontsize=16,$astenum=10)
	{
		$this->imgWidth = $width;
		$this->imgHeight = $height;
		$this->imgFontsize = $fontsize;
		$this->astenNumber = $astenum;
	}

	/**
	 * 方法功能: 生成图片
	 */
	function _PutCodeImages()
	{
		/**
		 * var $imgWidth = 44;
		 * var $imgHeight = 20;
		 * var $imgFontsize = 16;
		 */
		header("Content-type: image/png");
		$im = imagecreate($this->imgWidth, $this->imgHeight);
		$white = imagecolorallocate($im, 255, 255, 255);
		$black = imagecolorallocate($im, 100, 100, 100);
		for ($i=1; $i<=$this->astenNumber; $i++)
			imageString($im,1,mt_rand(1,60),mt_rand(1,20),"*",imageColorAllocate($im,mt_rand(150,255),mt_rand(150,255),mt_rand(150,255)));
		$font = dirname(__FILE__).DIRECTORY_SEPARATOR.'consola.ttf';
		$text = $this->_RandCode;
		for ($i=0; $i<strlen($text); $i++)
		{
			$m = $i * ($this->imgFontsize-3) + 2;
			$n = mt_rand(-20, 20);
			imagettftext($im, $this->imgFontsize, $n, $m, 15, $black, $font, $text{$i});
		}
		
		// 添加干扰码
		$black = imagecolorallocate($im, 130, 130, 130);
		$jamY1 = mt_rand(ceil($this->imgHeight/8), floor($this->imgHeight/8*7));
		$jamY2 = mt_rand(ceil($this->imgHeight/8), floor($this->imgHeight/8*7));
		$jamY3 = mt_rand(ceil($this->imgHeight/8), floor($this->imgHeight/8*7));
		$jamY4 = mt_rand(ceil($this->imgHeight/8), floor($this->imgHeight/8*7));
		$jamY5 = mt_rand(ceil($this->imgHeight/8), floor($this->imgHeight/8*7));

		$jamX = floor($this->imgWidth/4);
		$jamX1 = mt_rand(0, $jamX);
		$jamX2 = mt_rand($jamX1, $jamX*2);
		$jamX3 = mt_rand($jamX2, $jamX*3);
		
		imageline ($im,      0, $jamY1 ,           $jamX1, $jamY2 , $black);
		imageline ($im, $jamX1, $jamY2 ,           $jamX2, $jamY3 , $black);
		imageline ($im, $jamX2, $jamY3 ,           $jamX3, $jamY4 , $black);
		imageline ($im, $jamX3, $jamY4 ,  $this->imgWidth, $jamY5 , $black);

		imageline ($im,      0, $jamY1-1 ,           $jamX1, $jamY2-1 , $black);
		imageline ($im, $jamX1, $jamY2-1 ,           $jamX2, $jamY3-1 , $black);
		imageline ($im, $jamX2, $jamY3-1 ,           $jamX3, $jamY4-1 , $black);
		imageline ($im, $jamX3, $jamY4-1 ,  $this->imgWidth, $jamY5-1 , $black);
		
		imagepng($im);
		imagedestroy($im);
	}
	
	/**
	 * 方法功能: 判断输入的数是否正确
	 */
	function check()
	{
		if ($this->checkcode=='' || 
			empty($_SESSION[$this->CheckTheName]['mdfivevalue']) || 
			md5($this->checkcode) !== $_SESSION[$this->CheckTheName]['mdfivevalue']
		) return false;
		
		if (empty($_SESSION[$this->CheckTheName]['maxfailtime']) || 
			$_SESSION[$this->CheckTheName]['maxfailtime'] < time()
		) return false;
		
		unset($_SESSION[$this->CheckTheName]['mdfivevalue']);
		return true;
	}
}
?>