<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\vrijwilliger.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\cleaninput.php';

//add
//$_POST is always set, but its content might be empty.
if(isset($_POST['btnVrijwilligerSave']))
{
        $_POST = cleanInput($_POST);
        $vrObject = new Vrijwilliger();
		$vrVoornaam = $_POST['voornaamVrijwilliger'];
        $vrNaam = $_POST['naamVrijwilliger'];
		$vrAdres = $_POST['adresVrijwilliger'];
		$vrPostCode = $_POST['postcodeVrijwilliger'];
		$vrGemeente = $_POST['gemeenteVrijwilliger'];
		
		//nederlandse instellingen voor de tijd
        setlocale(LC_TIME, ""); //onvermijdelijk nodig
        setlocale(LC_TIME, "nl_NL");
        $timestampGeboorteDatum = strtotime($_POST['gbdVrijwilliger']);
        $vrGeboorteDatum = date('Y-m-d', $timestampGeboorteDatum);//omzetting in het MySQL string formaat
		
		if(isset($_POST['emailVrijwilliger']))
		 {
			$vrEmail = $_POST['emailVrijwilliger'];
		 }
		else
		{
			$vrEmail = NULL;
		}
		
		if(isset($_POST['gsmVrijwilliger']))
		{
			$vrGsm = $_POST['gsmVrijwilliger'];
		}
		else
		{
			$vrGsm = NULL;
		}
		
		if(isset($_POST['telVrijwilliger']))
		{
			$vrTelefoon = $_POST['telVrijwilliger'];
		}
		else
		{
			$vrTelefoon = NULL;
		}
		
		if(isset($_POST['cvVrijwilliger']))
		{
			$vrContactVoorkeur = $_POST['cvVrijwilliger'];
		}
		else
		{
			$vrContactVoorkeur = NULL;
		}
		
		if(isset($_POST['infoVrijwilliger']))
		{
			$vrInfo = $_POST['infoVrijwilliger'];
		}
		else
		{
			$vrInfo = NULL;
		}
		
		if(isset($_POST['actiefVrijwilliger']))
		{
			$vrActief = TRUE;
		}
		else
		{
			$vrActief = FALSE;
		};
		
		$foto = NULL;
		$comment = NULL;
		$statusId = NULL;
		
		$wpUserId = $_SESSION['wpuserid'];/*Wat is de levensduur van een $_SESSION variabele?*/
		echo "wpuserid: ".$wpUserId;
		/*Hoe wordt wpUserId bepaald als coordinator na lange tijd met dit formulier verder doet?*/
		
        $result = $vrObject->insert($vrVoornaam, $vrNaam, $vrAdres, $vrPostCode, $vrGemeente, $vrGeboorteDatum, $vrEmail, $vrGsm, $vrTelefoon, $vrInfo, $foto, $comment, $vrActief, $statusId, $vrContactVoorkeur, $wpUserId);
        if($result)
        {
            header('Location: http://localhost:8080/sociaalhuis/vrijwilliger-formulier-foto');
        
        }
		
        else
        {
            $message = $vrObject->getFeedback();
            //$message = "De vrijwilliger personalia zijn niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            echo $message;
            header('Location: http://localhost:8080/sociaalhuis/gefaald');
        }
		 
}


//update
if(isset($_POST['btnVrijwilligerUpdate']))
{
        $_POST = cleanInput($_POST);
        $vrObject = new Vrijwilliger();
		$vrVoornaam = $_POST['voornaamVrijwilliger'];
        $vrNaam = $_POST['naamVrijwilliger'];
		$vrAdres = $_POST['adresVrijwilliger'];
		$vrPostCode = $_POST['postcodeVrijwilliger'];
		$vrGemeente = $_POST['gemeenteVrijwilliger'];
		
		//nederlandse instellingen voor de tijd
        setlocale(LC_TIME, ""); //onvermijdelijk nodig
        setlocale(LC_TIME, "nl_NL");
        $timestampGeboorteDatum = strtotime($_POST['gbdVrijwilliger']);
        $vrGeboorteDatum = date('Y-m-d', $timestampGeboorteDatum);//omzetting in het MySQL string formaat
		
		if(isset($_POST['emailVrijwilliger']))
		 {
			$vrEmail = $_POST['emailVrijwilliger'];
		 }
		else
		{
			$vrEmail = NULL;
		}
		
		if(isset($_POST['gsmVrijwilliger']))
		{
			$vrGsm = $_POST['gsmVrijwilliger'];
		}
		else
		{
			$vrGsm = NULL;
		}
		
		if(isset($_POST['telVrijwilliger']))
		{
			$vrTelefoon = $_POST['telVrijwilliger'];
		}
		else
		{
			$vrTelefoon = NULL;
		}
		
		if(isset($_POST['cvVrijwilliger']))
		{
			$vrContactVoorkeur = $_POST['cvVrijwilliger'];
		}
		else
		{
			$vrContactVoorkeur = NULL;
		}
		
		if(isset($_POST['infoVrijwilliger']))
		{
			$vrInfo = $_POST['infoVrijwilliger'];
		}
		else
		{
			$vrInfo = NULL;
		}
		echo "Info: ".$vrInfo;
		
		if(isset($_POST['actiefVrijwilliger']))
		{
			$vrActief = TRUE;
		}
		else {
			$vrActief = FALSE;
		};
		
		$vrId = $_POST['idHidden'];
		echo 'vrId: '.$vrId;
		
		$foto=NULL;
		$comment=NULL;
		$statusId = NULL;
		$wpUserId= 9;/*dient uniek te zijn voorlopig*/
		
		
		
		
        $result = $vrObject->update($vrId, $vrVoornaam, $vrNaam, $vrAdres, $vrPostCode, $vrGemeente, $vrGeboorteDatum, $vrEmail, $vrGsm, $vrTelefoon, $vrInfo, $foto, $comment, $vrActief, $statusId, $vrContactVoorkeur, $wpUserId);
        if($result)
        {
            //header('Location: http://localhost:8080/sociaalhuis/vrijwilligers');
            header('Location: http://localhost:8080/sociaalhuis/vrijwilligers');
        
        }
        else
        {
            $message = $vrObject->getFeedback();
            //$message = "De interesse is niet toegevoegd. Probeer later opnieuw of contacteer de administrator.";
            $_SESSION['message'] = $message;
            echo $message;
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

