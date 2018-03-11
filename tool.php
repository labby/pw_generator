<?php

/**
 *	@module			pw_generator
 *	@version		see info.php of this module
 *	@author			cms-lab
 *	@copyright		2016-2018 cms-lab
 *	@license		copyright, all rights reserved
 *	@license_terms	please see info.php of this module 
 *	@platform		see info.php of this module
 */


// include class.secure.php to protect this file and the whole CMS!
if (defined('LEPTON_PATH')) {	
	include(LEPTON_PATH.'/framework/class.secure.php'); 
} else {
	$oneback = "../";
	$root = $oneback;
	$level = 1;
	while (($level < 10) && (!file_exists($root.'/framework/class.secure.php'))) {
		$root .= $oneback;
		$level += 1;
	}
	if (file_exists($root.'/framework/class.secure.php')) { 
		include($root.'/framework/class.secure.php'); 
	} else {
		trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
	}
}
// end include class.secure.php

$debug = true;

if (true === $debug)
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL | E_STRICT);
}

// get instance of functions file
$oPWG = pw_generator::getInstance();

if(isset ($_GET['tool']) && (empty($_POST)) ) {
	$oPWG->display('show');
} elseif(isset ($_POST['job']) && ($_POST['job'] == 'generate') ) {
	$oPWG->display('generate');
} elseif(isset ($_POST['show_info']) && ($_POST['show_info']== 'show') ) {
	$oPWG->show_info();
} else {
	die('something went wrong');
}

?>