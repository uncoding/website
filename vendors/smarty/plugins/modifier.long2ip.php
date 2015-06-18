<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     long2ip<br>
 * Date:     Feb 26, 2003
 * Purpose:  convert \r\n, \r or \n to <<br>>
 * Input:<br>
 *         - contents = contents to replace
 *         - preceed_test = if true, includes preceeding break tags
 *           in replacement
 * Example:  {$text|long2ip}
 * @link http://smarty.php.net/manual/en/language.modifier.nl2br.php
 *          long2ip (Smarty online manual)
 * @version  1.0
 * @author   Mao Hangjun
 * @param string
 * @return string
 */
function smarty_modifier_long2ip($string)
{
    return long2ip($string);
}

/* vim: set expandtab: */

?>
