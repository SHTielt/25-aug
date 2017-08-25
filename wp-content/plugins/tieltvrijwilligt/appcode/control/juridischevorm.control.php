<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\rechtsvorm.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';

//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnJurVormSave']))
{
        $_POST = cleanInput($_POST);
        $rvObject = new RechtsVorm();
        $rvNaam = $_POST['naamJurVorm'];
				
		if(isset($_POST['infoJurVorm']))
		{
			$rvInfo = $_POST['infoJurVorm'];
		}
		else {
			$rvInfo = NULL;
		};
		
		
        $result = $rvObject->insert($rvNaam, $rvInfo);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/juridische-vormen');
        }
        else
        {
            $message = $functieObject->getFeedback();
            //$message = "De functie is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            echo $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}


//update
if(isset($_POST['btnJurVormUpdate']))
{
        $_POST = cleanInput($_POST);
        $rvObject = new RechtsVorm();
        $rvId = $_POST['idHidden'];
		$rvNaam = $_POST['naamJurVorm'];
		if(isset($_POST['infoJurVorm']))
		{
			$rvInfo = $_POST['infoJurVorm'];
		}
		else {
			$rvInfo = NULL;
		};
				
		$result = $rvObject->update($rvId, $rvNaam, $rvInfo);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/juridische-vormen');
        }
        else
        {
            $message = $functieObject->getFeedback();
			//$message = "De functie is niet gewijzigd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}

//delete
if (isset($_GET['rvid']))
{
    $rvObject = new RechtsVorm();
    $rvId = $_GET['rvid'];
    $result = $rvObject->delete($rvId);
    if($result)
    {
         header('Location: http://localhost:8080/sociaalhuis/juridische-vormen');
    }
    else
    {
    	$message = $rvObject->getFeedback();
        //$message = "De functie is niet verwijderd. Probeer later opnieuw of contacteer de administrator.";
        $_SESSION['message'] = $message;
        header('Location: http://localhost:8080/sociaalhuis/gefaald');
    }
}
?>

