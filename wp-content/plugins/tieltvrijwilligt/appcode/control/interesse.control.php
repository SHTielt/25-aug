<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\interesse.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';

//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnInteresseSave']))
{
        $_POST = cleanInput($_POST);
        $interesseObject = new Interesse();
        $intNaam = $_POST['naamInteresse'];
		$intInfo = $_POST['infoInteresse'];
		//echo "intinfo: ".$intInfo;
		
		if(isset($_POST['actiefInteresse']))
		{
			$intActief = TRUE;
		}
		else {
			$intActief = FALSE;
		};
		
        $result = $interesseObject->insert($intNaam, $intInfo, $intActief);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/interesses');
        }
        else
        {
            //$message = $interesseObject->getFeedback();
            $message = "De interesse is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            echo $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}


//update
if(isset($_POST['btnInteresseUpdate']))
{
        $_POST = cleanInput($_POST);
        $interesseObject = new Interesse();
        $intId = $_POST['idHidden'];
		//echo "intid: ".$intId."<br />";
        $intNaam = $_POST['naamInteresse'];
		//echo "intnaam: ".$intNaam."<br />";
		if(isset($_POST['infoInteresse']))
		{
			$intInfo = $_POST['infoInteresse'];
		}
		else
		{
			$intInfo = "NULL";
		}
		//echo "intinfo: ".$intInfo."<br />";
		if(isset($_POST['actiefInteresse']))
		{
			$intActief = TRUE;
		}
		else {
			$intActief = FALSE;
		};
		
		//echo "intactief: ".$intActief."<br />";
        $result = $interesseObject->update($intId, $intNaam, $intInfo, $intActief);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/interesses');
        }
        else
        {
            //$message = $interesseObject->getFeedback();
			$message = "De interesse is niet gewijzigd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}

//delete
if (isset($_GET['interesseid']))
{
    echo "interesseid: ".$_GET['interesseid'];
    $interesseObject = new Interesse();
    $interesseId = $_GET['interesseid'];
    $result = $interesseObject->delete($interesseId);
    if($result)
    {
        header('Location: http://localhost:8080/sociaalhuis/interesses/');
    }
    else
    {
    	//$message = $interesseObject->getFeedback();
        $message = "De interesse is niet verwijderd. Probeer later opnieuw of contacteer de administrator.";
        $_SESSION['message'] = $message;
        header('Location: http://localhost:8080/sociaalhuis/gefaald');
    }
}
?>

