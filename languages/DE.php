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

//Modul Description
$module_description = 'Erzeuge einfach sichere Passworte.';

//Variables for the backend
$MOD_PW_GENERATOR = array(
	'PASSWORD'	=> 'Dein generiertes Passwort:',
	'CHOOSE'	=> 'Wähle Vorgaben',	
	'PW_RESULT_NAME'	=> 'Passwort: ',
	'ALPHA_UPPER' => 'Großbuchstaben (A-Z): ',
	'ALPHA_LOWER' => 'Kleinbuchstaben (a-z): ', 
	'INCLUDE_NUMBER' => 'Zahlen (0-9): ', 
	'INCLUDE_SYMBOL' => 'Sonderzeichen: ', 
	'PW_LENGTH' =>'Passwort Länge:',
	'GENERATE_PW' =>'Passwort erzeugen',
	'YES' =>'Ja',
	'NO' =>'Nein'
);
?>