<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\sector.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';

//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnSectorSave']))
{
        $_POST = cleanInput($_POST);
        $sectorObject = new Sector();
        $secNaam = $_POST['naamSector'];
		//$secInfo = $_POST['infoSector'];
		
		if(isset($_POST['infoSector']))
		{
			$secInfo = $_POST['infoSector'];
		}
		else {
			$secInfo = NULL;
		};
		
		
        $result = $sectorObject->insert($secNaam, $secInfo);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/sectoren');
        }
        else
        {
            $message = $sectorObject->getFeedback();
            //$message = "De sector is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            echo $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}


//update
if(isset($_POST['btnSectorUpdate']))
{
        $_POST = cleanInput($_POST);
        $sectorObject = new Sector();
        $secId = $_POST['idHidden'];
		$secNaam = $_POST['naamSector'];
		if(isset($_POST['infoSector']))
		{
			$secInfo = $_POST['infoSector'];
		}
		else {
			$secInfo = NULL;
		};
				
		$result = $sectorObject->update($secId, $secNaam, $secInfo);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/sectoren');
        }
        else
        {
            $message = $sectorObject->getFeedback();
			$message = "De sector is niet gewijzigd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}

//delete
if (isset($_GET['sectorid']))
{
    echo "sectorid: ".$_GET['sectorid'];
    $sectorObject = new Sector();
    $sectorId = $_GET['sectorid'];
    $result = $sectorObject->delete($sectorId);
    if($result)
    {
        header('Location: http://localhost:8080/sociaalhuis/sectoren');
    }
    else
    {
    	$message = $sectorObject->getFeedback();
        //$message = "De sector is niet verwijderd. Probeer later opnieuw of contacteer de administrator.";
        $_SESSION['message'] = $message;
        header('Location: http://localhost:8080/sociaalhuis/gefaald');
    }
}
?>

