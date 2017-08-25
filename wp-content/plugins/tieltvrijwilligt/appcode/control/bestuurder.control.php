<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\bestuurder.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';

//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnBestuurderSave']))
{
        $_POST = cleanInput($_POST);
        $bestObject = new Bestuurder();
		$voornaam = $_POST['voornaamBestuurder'];
		echo "voornaam: ".$voornaam."<br />";
		
        $naam = $_POST['naamBestuurder'];
		echo "naam: ".$naam."<br />";
		
		if(!empty($_POST['infoBestuurder']))
		{
			$info = $_POST['infoBestuurder'];
		}
		else
		{
			$info = NULL;
		}
		echo "info: ".$info."<br />";
		
		if(!empty($_POST['emailBestuurder']))
		 {
			$email = $_POST['emailBestuurder'];
		 }
		else
		{
			$email = NULL;
		}
		echo "email: ".$email."<br />";
		
		if(!empty($_POST['gsmBestuurder']))
		{
			$gsm = $_POST['gsmBestuurder'];
		}
		else
		{
			$gsm = NULL;
		}
		echo "gsm: ".$gsm."<br />";
		
		if(!empty($_POST['telBestuurder']))
		{
			$telefoon = $_POST['telBestuurder'];
		}
		else
		{
			$telefoon = NULL;
		}
		echo "telefoon: ".$telefoon."<br />";
		
		if(!empty($_POST['cvBestuurder']))
		{
			$contactVoorkeurId = $_POST['cvBestuurder'];
		}
		else
		{
			$contactVoorkeurId = NULL;
		}
		echo "contactvoorkeur: ".$contactVoorkeurId."<br />";
		
		if(!empty($_POST['funcBestuurder']))
		{
			$funcId = $_POST['funcBestuurder'];
		}
		else
		{
			$funcId = NULL;
		}
		echo "functie: ".$funcId."<br />";
		
		$verId = $_POST['idVereniging'];
		echo "verId: ".$verId."<br />";
		
		$result = $bestObject->insert($voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $funcId, $verId);
		
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-bestuur?verenigingid='.$verId);
        }
		
        else
        {
            $message = $bestObject->getFeedback();
            //$message = "De bestuurder is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            echo $message;
            //header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
		 
}


//update
if(isset($_POST['btnBestuurderUpdate']))
{
        $_POST = cleanInput($_POST);
        $bestObject = new Bestuurder();
		
		$bestuurderId = $_POST['idBestuurder'];
		$voornaam = $_POST['voornaamBestuurder'];
		echo "voornaam: ".$voornaam."<br />";
        $naam = $_POST['naamBestuurder'];
		echo "naam: ".$naam."<br />";
		
		if(!empty($_POST['infoBestuurder']))
		{
			$info = $_POST['infoBestuurder'];
		}
		else
		{
			$info = NULL;
		}
		echo "info: ".$info."<br />";
		
		if(!empty($_POST['emailBestuurder']))
		 {
			$email = $_POST['emailBestuurder'];
		 }
		else
		{
			$email = NULL;
		}
		echo "email: ".$email."<br />";
		
		if(!empty($_POST['gsmBestuurder']))
		{
			$gsm = $_POST['gsmBestuurder'];
		}
		else
		{
			$gsm = NULL;
		}
		echo "gsm: ".$gsm."<br />";
		
		if(!empty($_POST['telBestuurder']))
		{
			$telefoon = $_POST['telBestuurder'];
		}
		else
		{
			$telefoon = NULL;
		}
		echo "telefoon: ".$telefoon."<br />";
		
		if(!empty($_POST['cvBestuurder']))
		{
			$contactVoorkeurId = $_POST['cvBestuurder'];
		}
		else
		{
			$contactVoorkeurId = NULL;
		}
		echo "contactvoorkeur: ".$contactVoorkeurId."<br />";
		
		if(!empty($_POST['funcBestuurder']))
		{
			$funcId = $_POST['funcBestuurder'];
		}
		else
		{
			$funcId = NULL;
		}
		echo "functie: ".$funcId."<br />";
		
		$verId = $_POST['idVereniging'];
		echo "verId: ".$verId."<br />";
		
			
        $result = $bestObject->update($bestuurderId, $voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $funcId, $verId);
        if($result)
        {
             header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-bestuur?verenigingid='.$verId);
        }
        else
        {
            $message = $bestObject->getFeedback();
            //$message = "De interesse is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            echo $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
}



//delete
if (isset($_GET['bestuurderid']))
{
    echo "bestuurderid: ".$_GET['bestuurderid'];
    $bestObject = new Bestuurder();
    $bestuurderId = $_GET['bestuurderid'];
	
	//verId ophalen nodig voor URL
	$gezochteBestuurder = $bestObject->selectBestuurderbyId($bestuurderId);
	$verId = $gezochteBestuurder[0]['verID'];
    $result = $bestObject->delete($bestuurderId);
    if($result)
    {
         header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-bestuur?verenigingid='.$verId);
    }
    else
    {
    	//$message = $interesseObject->getFeedback();
        $message = "De bestuurder is niet verwijderd. Probeer later opnieuw of contacteer de administrator.";
        $_SESSION['message'] = $message;
        header('Location: http://localhost:8080/sociaalhuis/gefaald');
    }
}

if (isset($_GET['actie']) && isset($_GET['bestuurderid']))
{
	echo "hier";
	
    echo "bestuurderid: ".$_GET['bestuurderid'];
    $bestuurderObject = new Bestuurder();
    $bestuurderId = $_GET['bestuurderid'];
	
    $result = $bestuurderObject->selectBestuurderbyId($bestuurderId);
	print_r($result);
	
    if(!empty($result))
    {
        header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier?bestuurderid=');
    }
    else
    {
    	$message = $interesseObject->getFeedback();
        //$message = "De bestuurder is niet gevonden. Probeer later opnieuw of contacteer de administrator.";
        $_SESSION['message'] = $message;
        header('Location: http://localhost:8080/sociaalhuis/gefaald');
    }
	  
	 
}

?>

