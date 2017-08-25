<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");
define('ABSPATH',"C:\\wamp64\\www\\sociaalhuis\\");
//define('WPINC',"wp-includes\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\vrijwilliger.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';
require( ABSPATH.'\wp-blog-header.php' );/*loads the whole wp library*/
header("HTTP/1.0 200 OK");/*gaat met en zonder deze regel*/


//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnVrijwilligerAccountSave']))
{
		$_POST = cleanInput($_POST);
        $login_name = $_POST['gebruikersnaamVrijwilliger'];
		$existingUsername = username_exists( $login_name ); /*Returns:	(int|false) The user's ID on success, and false on failure.*/
		echo $existingUsername;
		if(is_numeric($existingUsername))
		{
			$message = "Deze gebruikersnaam bestaat reeds!";
			$_SESSION['username'] = $_POST['gebruikersnaamVrijwilliger'];
			$_SESSION['password'] = $_POST['wachtwoordVrijwilliger'];
		    $_SESSION['foutmeldinggebruikersnaam'] = $message;
            header('Location: http://localhost:8080/sociaalhuis/vrijwilliger-formulier-account');
		}
		else
		{
			$password =  $_POST['wachtwoordVrijwilliger'];
        	$userdata = array(
    		'user_login'  =>  $login_name,
    		'user_pass'   =>  $password
			);
			print_r($userdata);
			$result = wp_insert_user( $userdata ) ; /*returns user's ID or a WP_Error object*/

			//On success
		
			if ( ! is_wp_error( $result ) ) {
    			echo "User created : ". $result;
				$_SESSION['wpuserid'] = $result;
    			header('Location: http://localhost:8080/sociaalhuis/vrijwilliger-formulier-personalia');
			}
              
        	else
        	{
        		$error_string = $result->get_error_message();
            	$_SESSION['message'] = $error_string;
            	header('Location: http://localhost:8080/sociaalhuis/gefaald');
        	}	
			
		}  
 
}


//update wellicht niet nodig

//delete wellicht niet nodig

?>

