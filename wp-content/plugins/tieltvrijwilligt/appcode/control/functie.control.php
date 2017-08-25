<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");
//require_once (ABSPATH.'wp-load.php');
//echo get_template_directory();


require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\functie.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';


//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnFunctieSave']))
{
        $_POST = cleanInput($_POST);
        $functieObject = new Functie();
        $funcNaam = $_POST['naamFunctie'];
				
		if(isset($_POST['infoFunctie']))
		{
			$funcInfo = $_POST['infoFunctie'];
		}
		else {
			$funcInfo = NULL;
		};
		
		
        $result = $functieObject->insert($funcNaam, $funcInfo);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/functies');
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
if(isset($_POST['btnFunctieUpdate']))
{
        $_POST = cleanInput($_POST);
        $functieObject = new Functie();
        $funcId = $_POST['idHidden'];
		$funcNaam = $_POST['naamFunctie'];
		if(isset($_POST['infoFunctie']))
		{
			$funcInfo = $_POST['infoFunctie'];
		}
		else {
			$funcInfo = NULL;
		};
				
		$result = $functieObject->update($funcId, $funcNaam, $funcInfo);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/functies');
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
if (isset($_GET['functieid']))
{
    echo "functieid: ".$_GET['functieid'];
    $functieObject = new Functie();
    $functieId = $_GET['functieid'];
    $result = $functieObject->delete($functieId);
    if($result)
    {
        header('Location: http://localhost:8080/sociaalhuis/functies');
    }
    else
    {
    	$message = $functieObject->getFeedback();
        //$message = "De functie is niet verwijderd. Probeer later opnieuw of contacteer de administrator.";
        $_SESSION['message'] = $message;
        header('Location: http://localhost:8080/sociaalhuis/gefaald');
    }
}
?>

