<?php

/**
 *	@module			pw_generator
 *	@version		see info.php of this module
 *	@author			cms-lab
 *	@copyright		2016-2018 cms-lab
 *	@license		copyright, all rights reserved
 *	@license_terms  please see info.php of this module 
 *	@platform		see info.php of this module
 */

class pw_generator extends LEPTON_abstract {
	
	public $database = 0;
	public $admin = 0;
	public $addon_color = 'blue';
	public $support_link = "<a href=\"#\">NO Live-Support / FAQ</a>";
	public $readme_link =  "<a href=\"http://cms-lab.com/_documentation/pw_generator/readme.php \" class=\"info\"target=\"_blank\">Readme</a>";
	public $action_url = ADMIN_URL . '/admintools/tool.php?tool=pw_generator';	

	public static $instance;

	public function initialize() 
	{
		$this->database = LEPTON_database::getInstance();		
		$this->init_tool();
	}

	public function init_tool( $sToolname = '' )
	{
		
	}

    public function display($id) 
	{
		$length = ( empty( $_POST['length'] ) ) ? 12 : $_POST['length'];
		$alpha_upper_include = ( empty( $_POST['alpha_upper_include'] ) || $_POST['alpha_upper_include'] == 'no' ) ? FALSE : TRUE;
		$alpha_lower_include = ( empty( $_POST['alpha_lower_include'] ) || $_POST['alpha_lower_include'] == 'no' ) ? FALSE : TRUE;
		$number_include = ( empty( $_POST['number_include'] ) || $_POST['number_include'] == 'no' ) ? FALSE : TRUE;
		$symbol_include = ( empty( $_POST['symbol_include'] ) || $_POST['symbol_include'] == 'no' ) ? FALSE : TRUE;		
		
		if ( $id == 'show') 
		{	
			// do nothing but display
			$password = false;
		}

		if ( $id == 'generate') 
		{	
			require_once(LEPTON_PATH.'/modules/pw_generator/classes/chip_password_generator.php');	

			 $args = array(
						'length'				=>	$length,
						'alpha_upper_include'	=>	$alpha_upper_include,
						'alpha_lower_include'	=>	$alpha_lower_include,						
						'number_include'		=>	$number_include,
						'symbol_include'		=>	$symbol_include,	
					);
			$object = new chip_password_generator( $args );
			
			$password = $object->get_password();				
		}	
	
		// data for twig template engine	
		$data = array(
			'oPWG'		=> $this,
			'POST'		=> $_POST,
			'password'	=> $password,
			'length'	=> $length,
			'alpha_upper_include'	=> $alpha_upper_include,
			'alpha_lower_include'	=> $alpha_lower_include,
			'number_include'	=> $number_include,
			'symbol_include'	=> $symbol_include,			
			'leptoken'	=> get_leptoken()		

		);

		/**	
		 *	get the template-engine.
		 */
		$oTwig = lib_twig_box::getInstance();
		$oTwig->registerModule('pw_generator');
			
		echo $oTwig->render( 
			"@pw_generator/display.lte",	//	template-filename
			$data						//	template-data
		);
	
	}	

    public function show_info() 
	{
		// data for twig template engine	
		$data = array(
			'oPWG'			=> $this,
			'image_url'		=> 'http://cms-lab.com/_documentation/media/pw_generator/pw_generator.jpg'
			);

		/**	
		 *	get the template-engine.
		 */
		$oTwig = lib_twig_box::getInstance();
		$oTwig->registerModule('pw_generator');
			
		echo $oTwig->render( 
			"@pw_generator/info.lte",	//	template-filename
			$data						//	template-data
		);		
		
	}
	
}

  

?>