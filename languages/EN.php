<?php

/**
 *	@module				pw_generator
 *	@version			see info.php of this module
 *	@authors			cms-lab
 *	@copyright		2012 cms-lab
 *	@license			copyright, all rights reserved
 *	@platform			see info.php of this module
 */

// include class.secure.php to protect this file and the whole CMS!
if (defined('WB_PATH'))
{
    include(WB_PATH . '/framework/class.secure.php');
}
else
{
    $oneback = "../";
    $root    = $oneback;
    $level   = 1;
    while (($level < 10) && (!file_exists($root . '/framework/class.secure.php')))
    {
        $root .= $oneback;
        $level += 1;
    }
    if (file_exists($root . '/framework/class.secure.php'))
    {
        include($root . '/framework/class.secure.php');
    }
    else
    {
        trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
    }
}
// end include class.secure.php

//Modul Description
$module_description = 'Create new safe passwords easily.';

//Variables for the backend
$PWG_TEXT['TOOL_HEAD']	= 'Password Generator';
$PWG_TEXT['PW_RESULT_NAME']	= 'Password: ';
$PWG_TEXT['ALPHA_UPPER'] = 'Include Alpha Upper (A-Z): ';
$PWG_TEXT['ALPHA_LOWER'] = 'Include Alpha Lower (a-z): '; 
$PWG_TEXT['INCLUDE_NUMBER'] = 'Include Number (0-9): '; 
$PWG_TEXT['INCLUDE_SYMBOL'] = 'Include Symbol: '; 
$PWG_TEXT['PW_LENGTH'] ='Password Length:';
$PWG_TEXT['GENERATE_PW'] ='Generate Password';
?>