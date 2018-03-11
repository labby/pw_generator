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

$debug = true;

if (true === $debug)
{
    ini_set('display_errors', 1);
    error_reporting(E_ALL | E_STRICT);
}

if (!isset($admin) || !is_object($admin))
    die();

global $admin;

// Load Language file
if(LANGUAGE_LOADED) {
	if(!file_exists(WB_PATH.'/modules/pw_generator/languages/'.LANGUAGE.'.php')) {
		require_once(WB_PATH.'/modules/pw_generator/languages/EN.php');
	} else {
		require_once(WB_PATH.'/modules/pw_generator/languages/'.LANGUAGE.'.php');
	}
}

// check if backend.css file needs to be included into the <body></body>
if(!method_exists($admin, 'register_backend_modfiles') && file_exists(WB_PATH .'/modules/droplets/backend.css')) {
	echo '<style type="text/css">';
	include(WB_PATH .'/modules/droplets/backend.css');
	echo "\n</style>\n";
}

// generate pw using class
if( $_POST ) {
	require_once(WB_PATH.'/modules/pw_generator/external/class.chip_password_generator.php');	

	$length = ( empty( $_POST['length'] ) ) ? 8 : $_POST['length'];
	$alpha_upper_include = ( empty( $_POST['alpha_upper_include'] ) || $_POST['alpha_upper_include'] == 'no' ) ? FALSE : TRUE;
	$alpha_lower_include = ( empty( $_POST['alpha_lower_include'] ) || $_POST['alpha_lower_include'] == 'no' ) ? FALSE : TRUE;
	$number_include = ( empty( $_POST['number_include'] ) || $_POST['number_include'] == 'no' ) ? FALSE : TRUE;
	$symbol_include = ( empty( $_POST['symbol_include'] ) || $_POST['symbol_include'] == 'no' ) ? FALSE : TRUE;
	
	
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

$leptoken = (isset($_GET['leptoken']) ? "&leptoken=" . $_GET['leptoken'] : "");

?>
<div id="tool">
<div id="tool_header"><?php echo $PWG_TEXT['TOOL_HEAD']; ?></div>
<div id="tool_support"><script type="text/javascript" src="http://cms-lab.com/live-support/livehelp_js.php?eo=1&department=4&amp;serversession=1&amp;pingtimes=15"></script></a></div>
<div id="pw_content">
      <div id="content_input">      
              <form method="post" action="">
                
                <div class="inputvalue">
                  <p><?php echo $PWG_TEXT['ALPHA_UPPER']; ?></p> <select name="alpha_upper_include" id="alpha_upper_include">
                  <?php
                  $alpha_upper_include = array( 'yes' => "Yes", 'no' => "No" );
				  foreach( $alpha_upper_include as $key => $val ):
				  $selected = '';
				  if( $key == $_POST['alpha_upper_include'] ) {
					  $selected = 'selected="selected"';					  
				  }
				  ?>
                  <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $val; ?></option>
                  <?php
                  endforeach;
				  ?> 
                  </select>
                </div>
                
              <div class="inputvalue">
                  <p><?php echo $PWG_TEXT['ALPHA_LOWER']; ?></p><select name="alpha_lower_include" id="alpha_lower_include">
                  <?php
                  $alpha_lower_include = array( 'yes' => "Yes", 'no' => "No" );
				  foreach( $alpha_lower_include as $key => $val ):
				  $selected = '';
				  if( $key == $_POST['alpha_lower_include'] ) {
					  $selected = 'selected="selected"';					  
				  }
				  ?>
                  <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $val; ?></option>
                  <?php
                  endforeach;
				  ?> 
                  </select>
                </div>
                
              <div class="inputvalue">
                  <p><?php echo $PWG_TEXT['INCLUDE_NUMBER']; ?></p><select name="number_include" id="number_include">
                  <?php
                  $number_include = array( 'yes' => "Yes", 'no' => "No" );
				  foreach( $number_include as $key => $val ):
				  $selected = '';
				  if( $key == $_POST['number_include'] ) {
					  $selected = 'selected="selected"';					  
				  }
				  ?>
                  <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $val; ?></option>
                  <?php
                  endforeach;
				  ?> 
                  </select>
                </div>
                
              <div class="inputvalue">
                  <p><?php echo $PWG_TEXT['INCLUDE_SYMBOL']; ?></p><select name="symbol_include" id="symbol_include">
                  <?php
                  $symbol_include = array( 'yes' => "Yes", 'no' => "No" );
				  foreach( $symbol_include as $key => $val ):
				  $selected = '';
				  if( $key == $_POST['symbol_include'] ) {
					  $selected = 'selected="selected"';					  
				  }
				  ?>
                  <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $val; ?></option>
                  <?php
                  endforeach;
				  ?> 
                  </select>
                </div>
                
                <?php
                $length = ( empty($_POST['length']) ) ? 8 : $_POST['length'] ;
				?>
              <div class="inputvalue">
               <p><?php echo $PWG_TEXT['PW_LENGTH']; ?></p><input type="text" name="length" value="<?php echo $length; ?>" />
               </div>
                
                <input type="submit" name="submit" value="<?php echo $PWG_TEXT['GENERATE_PW']; ?>" />
              </form>
            </div><!-- end content input -->
       </div><!-- end content -->
 
        <?php if( !empty($password) ): ?>
          <div class="pw_result_name"><?php echo $PWG_TEXT['PW_RESULT_NAME'];?></div>
          <div class="pw_result"><?php echo $password; ?></div> 
        
      </div>           
</div> <!-- end tool -->        
        <?php endif; ?>
<div id="copyright"><hr size="1" /><a href="http://www.cms-lab.com" target="_blank">&copy; 2012 by cms-lab.com</a></div>

