<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\foto.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\thumbnail.php';
require_once SH_PLUGIN_PATH.'appcode\model\vereniging.class.php';


$bericht;
$target_dir = "../view/fotouploads/";//map van originele foto's
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
echo "targetfile: ".$target_file."<br />";
$target_file_name = basename($_FILES["fileToUpload"]["name"]);
echo "targetfilename: ".$target_file_name."<br />";
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
/*Note: $target_file en $target_file_name worden niet ingevuld bij delete*/

//1. foto toevoegen
if(isset($_POST["btnVerenigingFotoSave"]))
{
//in productie is $_POST['idHiddenVereniging'] nooit nULL
$verenigingId = $_POST['idHiddenVereniging'];
		
$thumbnail_dir = "../view/fotouploads/thumbs/";//map van thumbnail foto's
$thumbnail_file = $thumbnail_dir.basename($_FILES["fileToUpload"]["name"]);

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "png")
{
    $bericht = "Sorry, enkel jpg, jpeg, png & gif bestanden zijn toegelaten.";
    $uploadOk = 0;
}

// Check if thumbnail file already exists
if (file_exists($thumbnail_file))
{
    $bericht = "Sorry, bestand ".$target_file_name." bestaat al.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000)
{
    $bericht = "Sorry, uw bestand is te groot. Het moet kleiner zijn dan 0.5MByte.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) 
{
    $bericht .= " Uw bestand werd niet opgeladen.";
}
else // if everything is ok, try to upload file
 {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
    {
        //1. thumbnail genereren
        createThumbnail($target_file_name, 300);

        //2. databank data toevoegen
        $fotoObject = new Foto();
        $fotoNaam = $target_file_name;
		$vrijwilligerId = NULL;
		
        $fotoObject->insert($fotoNaam, $vrijwilligerId, $verenigingId);
		$fotoId = $fotoObject->getFotoId();
        $bericht = "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is opgeladen.";

        //3. originele grote foto wissen
        unlink('../view/fotouploads/'.$target_file_name);
    } 
    else
    {
        $bericht = "Sorry, er is een fout bij het opladen van uw bestand.";
    }
}
$_SESSION['uploadmessage'] = $bericht;
header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-logo?verenigingid='.$verenigingId);
}//einde foto toevoegen



//2. foto wijzigen
if(isset($_POST["btnVerenigingFotoUpdate"]))
{
//in productie is $_POST['idHiddenVereniging'] nooit nULL
$verenigingId = $_POST['idHiddenVereniging'];
		
$thumbnail_dir = "../view/fotouploads/thumbs/";//map van thumbnail foto's
$thumbnail_file = $thumbnail_dir.basename($_FILES["fileToUpload"]["name"]);

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
{
    $bericht = "Sorry, enkel jpg, jpeg, png & gif bestanden zijn toegelaten.";
    $uploadOk = 0;
}

// Check if thumbnail file already exists
if (file_exists($thumbnail_file))
{
    $bericht = "Sorry, bestand ".$target_file_name." bestaat al.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000)
{
    $bericht = "Sorry, uw bestand is te groot. Het moet kleiner zijn dan 0.5MByte.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) 
{
    $bericht .= " Uw bestand werd niet opgeladen.";
}
else // if everything is ok, try to upload file
{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
    {
    	//0. vorige thumbnail wissen
    	//0.1 oude thumbnail data ophalen
    	$fotoObject1 = new Foto();
		$result1 = $fotoObject1->selectFotoByVerenigingId($_POST['idHiddenVereniging']);
		$oudeFotoId = $result1[0]['fID'];
		$oudeFotoNaam = $result1[0]['fNaam'];
		
    	//0.2 data van de oude thumbnail wissen in databank
    	$fotoObject1->delete($oudeFotoId);
		
    	
    	//0.3 oude thumbnail fysiek wissen
    	unlink('../view/fotouploads/thumbs/'.$oudeFotoNaam);
    	
        //1. thumbnail genereren
        createThumbnail($target_file_name, 300);

        //2. databank data toevoegen
        $fotoObject2 = new Foto();
        $fotoNaam = $target_file_name;
		$vrijwilligerId = NULL;
		//in productie is $_POST['idHiddenVereniging'] nooit nULL
		$verenigingId = $_POST['idHiddenVereniging'];
        $fotoObject2->insert($fotoNaam, $vrijwilligerId, $verenigingId);
		$fotoId = $fotoObject2->getFotoId();
        $bericht = "Het bestand ". basename( $_FILES["fileToUpload"]["name"]). " is opgeladen.";
        //3. originele grote foto wissen
        unlink('../view/fotouploads/'.$target_file_name);
    } 
    else
    {
        $bericht = "Sorry, er is een fout bij het opladen van uw bestand.";
    }
}//einde else
$_SESSION['uploadmessage'] = $bericht;
header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-logo?verenigingid='.$verenigingId);
}//einde update

//3. foto verwijderen
if(isset($_POST["btnVerenigingFotoDelete"]))
{
	$verenigingId = $_POST['idHiddenVereniging'];
   	
    //1. fysieke verwijdering van bestand
    $fotoObject = new Foto();
	$fotoId = $_POST['idHiddenFoto'];
	echo "fotoid: ".$fotoId;
    $gezochteFoto = $fotoObject->selectFotoById($fotoId);
	print_r($gezochteFoto);
    $fotoNaam = $gezochteFoto[0]['fNaam'];
    //unlink('../../../appcode/webapp/view/fotouploads/'.$fotoNaam); //reeds verwijderd na thumnail creatie
    unlink('../view/fotouploads/thumbs/'.$fotoNaam);

    //2. verwijdering uit databank
    $result = $fotoObject->delete($fotoId);
    
    if($result)
    {
       header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-logo?verenigingid='.$verenigingId);
	   $uploadMessage = "Het logo/foto werd verwijderd.";
       $_SESSION['uploadmessage'] = $uploadMessage;
    }
    else
    {
        $uploadMessage = "Geen verwijdering mogelijk. Contacteer de beheerder";
        $_SESSION['uploadmessage'] = $uploadMessage;
		$message = $fotoObject->getFeedback();
        //$message = "De vereniging is niet verwijderd. Probeer later opnieuw of contacteer de administrator.";
        $_SESSION['message'] = $message;
		echo $message;
        header('Location: http://localhost:8080/sociaalhuis/vereniging-formulier-logo?verenigingid='.$verenigingId);
    }
}




?>
<?php

//superglobal $_FILES:
//Array ( [fileToUpload] => Array ( [name] => de_luifel.jpg [type] => image/jpeg [tmp_name] => C:\wamp64\tmp\php695B.tmp [error] => 0 [size] => 8201 ) )

?>