<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\deelwerking.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';

//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnDeelwerkingSave']))
{
        $_POST = cleanInput($_POST);
        $deelwerkingObject = new DeelWerking();
        $dwNaam = $_POST['naamDeelwerking'];
		if(isset($_POST['infoDeelwerking']))
		{
			$dwInfo = $_POST['infoDeelwerking'];
		}
		else
		{
			$dwInfo = "NULL";
		}
		if(isset($_POST['actiefDeelwerking']))
		{
			$dwActief = TRUE;
		}
		else {
			$dwActief = FALSE;
		};
		
        $result = $deelwerkingObject->insert($dwNaam, $dwInfo, $dwActief);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/deelwerkingen');
        }
        else
        {
            //$message = $deelwerkingObject->getFeedback();
            $message = "De deelwerking is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            echo $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}


//update
if(isset($_POST['btnDeelwerkingUpdate']))
{
        $_POST = cleanInput($_POST);
        $deelwerkingObject = new DeelWerking();
        $dwId = $_POST['idHidden'];
		//echo "dwid: ".$dwId;
        $dwNaam = $_POST['naamDeelwerking'];
		if(isset($_POST['infoDeelwerking']))
		{
			$dwInfo = $_POST['infoDeelwerking'];
		}
		else
		{
			$dwInfo = "NULL";
		}
		if(isset($_POST['actiefDeelwerking']))
		{
			$dwActief = TRUE;
		}
		else {
			$dwActief = FALSE;
		};
		
        $result = $deelwerkingObject->update($dwId, $dwNaam, $dwInfo, $dwActief);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/deelwerkingen');
        }
        else
        {
            //$message = $deelwerkingObject->getFeedback();
			$message = "De deelwerking is niet gewijzigd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}

//delete
if (isset($_GET['deelwerkingid']))
{
    echo "deelwerkingid: ".$_GET['deelwerkingid'];
    $deelwerkingObject = new DeelWerking();
    $deelwerkingId = $_GET['deelwerkingid'];
    $result = $deelwerkingObject->delete($deelwerkingId);
    if($result)
    {
        header('Location: http://localhost:8080/sociaalhuis/deelwerkingen/');
    }
    else
    {
    	//$message = $deelwerkingObject->getFeedback();
        $message = "De deelwerking is niet verwijderd. Probeer later opnieuw of contacteer de administrator.";
        $_SESSION['message'] = $message;
        header('Location: http://localhost:8080/sociaalhuis/gefaald');
    }
}
?>

