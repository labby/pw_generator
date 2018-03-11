<?php

/**
 *	@module				pw_generator
 *	@version			see info.php of this module
 *	@authors			cms-lab
 *	@copyright		2012 cms-lab
 *  @license      http://www.gnu.org/licenses/gpl.html
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


$module_directory     = 'pw_generator';
$module_name          = 'Password-Generator';
$module_function      = 'tool';
$module_version       = '0.1.0';
$module_platform      = '1.x';
$module_author        = 'cms-lab';
$module_license       = 'http://www.gnu.org/licenses/gpl.html';
$module_license_terms = '-';
$module_description   = 'Create new safe passwords easily.';
$module_guid          = '85c87526-bb39-4b6e-bfc2-135c3d01aebb';

/**
 *	based on a php script of
 *	Life.Object
 *  E-Mail:	life.object@gmail.com
 *  Website:	http://www.tutorialchip.com/
 *  Help:	http://www.tutorialchip.com/php-password-generator-class/
 */

?>