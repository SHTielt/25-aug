<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\bestuurder.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\contactpersoon.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';

//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnContactPersoonSave']))
{
		//1. bestuurslid als contactpersoon opslaan
		/*
		if(!empty($_POST['bestContactPersoon']))
		{
			$bestuursLidId = $_POST['bestContactPersoon'];
			echo "bestId: ".$bestuursLidId;
			
			//data bestuurslid ophalen ter voorbereiding insert
			$bestObject = new Bestuurder();
			$gezochteBestuurder = $bestObject->selectBestuurderbyId($bestuursLidId);
			$voornaam = $gezochteBestuurder[0]['bestVoornaam'];
			$naam = $gezochteBestuurder[0]['bestNaam'];
			$info = $gezochteBestuurder[0]['bestInfo'];
			$email = $gezochteBestuurder[0]['bestEmail'];
			$gsm = $gezochteBestuurder[0]['bestGSM'];
			$tel = $gezochteBestuurder[0]['bestTelefoon'];
			$cvId = $gezochteBestuurder[0]['cvID'];
			$verId = $gezochteBestuurder[0]['verID'];
			
			//data invoegen in tabel contactpersoon
			$contObject = new ContactPersoon();
			$result = $contObject->insert($voornaam, $naam, $info, $email, $gsm, $tel, $cvId, $verId);
			
			if($result)
        	{
            	header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-contactpersoon?verenigingid='.$verId);
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
		 */
		 
		//else //2. nieuwe contactpersoon opslaan
		//{
			//$_POST = cleanInput($_POST);
        	$contObject = new ContactPersoon();
			$voornaam = $_POST['voornaamContactPersoon'];
			echo "voornaam: ".$voornaam."<br />";
		
        	$naam = $_POST['naamContactPersoon'];
			echo "naam: ".$naam."<br />";
		
			if(!empty($_POST['infoContactPersoon']))
			{
				$info = $_POST['infoContactPersoon'];
			}
			else
			{
				$info = NULL;
			}
			echo "info: ".$info."<br />";
		
			if(!empty($_POST['emailContactPersoon']))
		 	{
				$email = $_POST['emailContactPersoon'];
		 	}
			else
			{
				$email = NULL;
			}
			echo "email: ".$email."<br />";
		
			if(!empty($_POST['gsmContactPersoon']))
			{
				$gsm = $_POST['gsmContactPersoon'];
			}
			else
			{
				$gsm = NULL;
			}
			echo "gsm: ".$gsm."<br />";
		
			if(!empty($_POST['telContactPersoon']))
			{
				$telefoon = $_POST['telContactPersoon'];
			}
			else
			{
				$telefoon = NULL;
			}
			echo "telefoon: ".$telefoon."<br />";
		
			$contactPersoon = 1;
					 
		
			if(!empty($_POST['cvContactPersoon']))
			{
				$contactVoorkeurId = $_POST['cvContactPersoon'];
			}
			else
			{
				$contactVoorkeurId = NULL;
			}
			echo "contactvoorkeur: ".$contactVoorkeurId."<br />";
		
			$verId = $_POST['idVereniging'];
			echo "verId: ".$verId."<br />";
		
			$result = $contObject->insert($voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $verId);
		
        	if($result)
        	{
            	header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-contactpersoon?verenigingid='.$verId);
        	}
		
        	else
        	{
            	$message = $contObject->getFeedback();
            	//$message = "De bestuurder is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            	$_SESSION['message'] = $message;
            	echo $message;
				$errorMessage = $contObject->getErrorMessage();
				echo $errorMessage;
				$errorCode = $contObject->getErrorCode();
				echo $errorCode;
            	//header('Location: http://localhost:8080/sociaalhuis/gefaald');
        	}
		//}
		
        
		 
}


//update
if(isset($_POST['btnContactPersoonUpdate']))
{
		
		
		
        //a. bestuurslid als contactpersoon opslaan
        /*
		if(!empty($_POST['bestContactPersoon']))
		{
			
			//1.data bestuurslid ophalen ter voorbereiding update
			$bestuursLidId = $_POST['bestContactPersoon'];
			echo "bestId: ".$bestuursLidId;
			$bestObject = new Bestuurder();
			$gezochteBestuurder = $bestObject->selectBestuurderById($bestuursLidId);
			print_r($gezochteBestuurder);
			$voornaam = $gezochteBestuurder[0]['bestVoornaam'];
			$naam = $gezochteBestuurder[0]['bestNaam'];
			$info = $gezochteBestuurder[0]['bestInfo'];
			$email = $gezochteBestuurder[0]['bestEmail'];
			$gsm = $gezochteBestuurder[0]['bestGSM'];
			$tel = $gezochteBestuurder[0]['bestTelefoon'];
			$cvId = $gezochteBestuurder[0]['cvID'];
			$verId = $gezochteBestuurder[0]['verID'];
			
			//2. id van contactpersoon ophalen die moet gewijzigd worden
			$contactPersoonId = $_POST['idContactPersoon'];
			echo "contactperssoon: ".$contactPersoonId;
			
			//3.update
			$contObject = new ContactPersoon();
			$result = $contObject->update($contactPersoonId, $voornaam, $naam, $info, $email, $gsm, $tel, $cvId, $verId);
			
			if($result)
        	{
            	header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-contactpersoon?verenigingid='.$verId);
        	}
		
        	else
        	{
            	$message = $bestObject->getFeedback();
            	//$message = "De bestuurder is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            	$_SESSION['message'] = $message;
            	echo $message;
            	header('Location: http://localhost:8080/sociaalhuis/gefaald');
        	}
		}
		 */
		 
		//else //b. nieuwe contactpersoon opslaan
		//{
			//echo "arrived";
			$_POST = cleanInput($_POST);
        	$contObject = new ContactPersoon();
			$voornaam = $_POST['voornaamContactPersoon'];
			echo "voornaam: ".$voornaam."<br />";
		
        	$naam = $_POST['naamContactPersoon'];
			echo "naam: ".$naam."<br />";
		
			if(!empty($_POST['infoContactPersoon']))
			{
				$info = $_POST['infoContactPersoon'];
			}
			else
			{
				$info = NULL;
			}
			echo "info: ".$info."<br />";
		
			if(!empty($_POST['emailContactPersoon']))
		 	{
				$email = $_POST['emailContactPersoon'];
		 	}
			else
			{
				$email = NULL;
			}
			echo "email: ".$email."<br />";
		
			if(!empty($_POST['gsmContactPersoon']))
			{
				$gsm = $_POST['gsmContactPersoon'];
			}
			else
			{
				$gsm = NULL;
			}
			echo "gsm: ".$gsm."<br />";
		
			if(!empty($_POST['telContactPersoon']))
			{
				$telefoon = $_POST['telContactPersoon'];
			}
			else
			{
				$telefoon = NULL;
			}
			echo "telefoon: ".$telefoon."<br />";
		
			$contactPersoon = 1;
					 
		
			if(!empty($_POST['cvContactPersoon']))
			{
				$contactVoorkeurId = $_POST['cvContactPersoon'];
			}
			else
			{
				$contactVoorkeurId = NULL;
			}
			echo "contactvoorkeur: ".$contactVoorkeurId."<br />";
		
			$verId = $_POST['idVereniging'];
			echo "verId: ".$verId."<br />";
			
			$cpId = $_POST['idContactPersoon'];
			echo "cpId: ".$cpId."<br />";	
		
			$result = $contObject->update($cpId, $voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $verId);
		
        	if($result)
        	{
            	header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-contactpersoon?verenigingid='.$verId);
        	}
		
        	else
        	{
            	$message = $contObject->getFeedback();
            	//$message = "De bestuurder is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            	$_SESSION['message'] = $message;
            	echo $message."<br />";
				$errorMessage = $contObject->getErrorMessage();
				echo $errorMessage."<br />";
				$errorCode = $contObject->getErrorCode();
				echo $errorCode."<br />";
            	//header('Location: http://localhost:8080/sociaalhuis/gefaald');
        	}
		//}
		
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

