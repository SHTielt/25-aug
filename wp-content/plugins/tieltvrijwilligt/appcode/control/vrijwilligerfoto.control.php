<?php
//is needed because there is no reference to this page in the plugin's main file
session_start()  ;

//seems to be needed allthough already defined in vrijwilligerspool.php
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\foto.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\thumbnail.php';
require_once SH_PLUGIN_PATH.'appcode\model\vrijwilliger.class.php';


$bericht;
$target_dir = "../view/fotouploads/";//map van originele foto's
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
echo "targetfile: ".$target_file;
$target_file_name = basename($_FILES["fileToUpload"]["name"]);
echo "targetfilename: ".$target_file_name;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if image file is an actual image or fake image
if(isset($_POST["btnVrijwilligerFotoSave"]))
{
	
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false)
{
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
}
else
{
        $bericht = "Bestand File is geen foto.";
        $uploadOk = 0;
}


// Check if thumbnail file already exists
$thumbnail_dir = "../view/fotouploads/thumbs/";//map van thumbnail foto's
$thumbnail_file = $thumbnail_dir.basename($_FILES["fileToUpload"]["name"]);

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

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
{
    $bericht = "Sorry, enkel jpg, jpeg, png & gif bestanden zijn toegelaten.";
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
		//in productie is $_POST['idHidden'] nooit nULL
		$vrijwilligerId = 1;
        //$vrijwilligerId = $_POST['idHidden'];
        $fotoObject->insert($fotoNaam, $vrijwilligerId);
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
echo $bericht;
$_SESSION['fotoid'] = $fotoId;
echo "fotoId: ".$fotoId;
header('Location: http://localhost:8080/sociaalhuis/vrijwilliger-formulier-foto');
}//einde btnVrijwilligerFotoSave



// Check if image file is an actual image or fake image
if(isset($_POST["btnVrijwilligerFotoUpdate"]))
{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
	{
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }
	else {
        $bericht = "Bestand File is geen foto.";
        $uploadOk = 0;
    }


// Check if thumbnail file already exists
$thumbnail_dir = "../view/fotouploads/thumbs/";//map van thumbnail foto's
$thumbnail_file = $thumbnail_dir.basename($_FILES["fileToUpload"]["name"]);

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
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
{
    $bericht = "Sorry, enkel jpg, jpeg, png & gif bestanden zijn toegelaten.";
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
		$result1 = $fotoObject1->selectFotoByVrijwilligerId($_POST['idHidden']);
		$oudeFotoId = $result1['vrID'];
		$oudeFotoNaam = $result1['fNaam'];
		
    	//0.2 data van de oude thumbnail wissen in databank
    	$fotoObject1->delete($oudeFotoId);
		
    	
    	//0.3 oude thumbnail fysiek wissen
    	unlink('../view/fotouploads/thumbs/'.$oudeFotoNaam);
    	
        //1. thumbnail genereren
        createThumbnail($target_file_name, 300);

        //2. databank data toevoegen
        $fotoObject = new Foto();
        $fotoNaam = $target_file_name;
		$vrijwilligerId = 1;
        //$vrijwilligerId = $_POST['vrijwilligerId'];
        $fotoObject->insert($fotoNaam, $vrijwilligerId);
		$fotoId = $fotoObject->getFotoId();
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
echo $bericht;
$_SESSION['fotoid'] = $fotoId;
echo "fotoId: ".$fotoId;
header('Location: http://localhost:8080/sociaalhuis/vrijwilliger-formulier-foto');
}//einde update


?>

<!--
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <p>Test insert foto</p>
        <ul>
            <li>Message: <?php echo $fotoObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $fotoObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $fotoObject->getErrorCode(); ?></li>
            <li>ID: <?php echo $fotoObject->getFotoId(); ?></li>
        </ul>
    </body>
</html>
     
-->