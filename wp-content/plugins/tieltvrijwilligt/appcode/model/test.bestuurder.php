<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'bestuurder.class.php';


//insert testen
/*
$bestuurder = new Bestuurder();
$voornaam = "Piet";
$naam = "Vroman";
$info = "";
$email = "piet.vroman@yahoo.com";
$gsm = "";
$telefoon = "";
$contactVoorkeurId = 1;
$funcId = 2;
$verId = 8;

$bestuurder->insert($voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $funcId, $verId);
*/

//update testen

$bestuurder = new Bestuurder();
$bestuurderId = 8;
$voornaam = "Hans";
$naam = "Hanssens";
$info = "blabla";
$email = "hhh@skynet.be";
$gsm = "0479/584123";
$telefoon = NULL;
$contactVoorkeurId = 1;
$funcId = 1;
$verId = 3;

$bestuurder->update($bestuurderId, $voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $funcId, $verId);


//selectAll testen
/*
$object = new Bestuurder();
$bestuurdersLijst=$object->selectAll();
print_r($bestuurdersLijst);
*/

 //testen van selectBestuurderById()
 /*
 $objectS = new Bestuurder();
 $result = $objectS->selectBestuurderById(3);
 */

 //delete testen
 /*
 $objectD= new Bestuurder();
 $objectD->delete(3);
 */
 
 //testen van selectBestuurderByVerenigingId()
 /* 
 $objectS = new Bestuurder();
 $result = $objectS->selectBestuurderByVerenigingId(4);
 */
 
?>

<p>Test update bestuurder</p>
        <ul>
            <li>Feedback: <?php echo $bestuurder->getFeedback(); ?></li>
            <li>Error message: <?php echo $bestuurder->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $bestuurder->getErrorCode(); ?></li>
        </ul>


<!--
<p>Test insert bestuurder</p>
        <ul>
            <li>Feedback: <?php echo $bestuurder->getFeedback(); ?></li>
            <li>Error message: <?php echo $bestuurder->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $bestuurder->getErrorCode(); ?></li>
            <li>ID: <?php echo $bestuurder->getBestuurderId(); ?></li>
        </ul>
--> 
 
<!--
<p>Test selectBestuurderByVerenigingId</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>BestId</th><th>Voornaam</th><th>Naam</th><th>Info</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>CVID</th><th>Funcid</th><th>Verid</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['bestID']; ?></td><td><?php  echo $result[0]['bestVoornaam']; ?></td><td><?php  echo $result[0]['bestNaam']; ?></td><td><?php  echo $result[0]['bestInfo']; ?></td>
    	<td><?php  echo $result[0]['bestEmail']; ?></td><td><?php  echo $result[0]['bestGSM']; ?></td><td><?php  echo $result[0]['bestTelefoon']; ?></td>
    	<td><?php  echo $result[0]['cvID']; ?></td><td><?php  echo $result[0]['funcID']; ?></td><td><?php  echo $result[0]['verID']; ?></td>
    </tr>
</tbody>
</table>
-->






<!--
<p>Test deleting bestuurder</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>
-->
   



<!--
<p>Test selectall</p>
<ul>
            <li>Feedback: <?php echo $object->getFeedback(); ?></li>
            <li>Error message: <?php echo $object->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $object->getErrorCode(); ?></li>
</ul>
 
<table>
<thead>
<tr><th>BestId</th><th>Voornaam</th><th>Naam</th><th>Info</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>CVID</th><th>Funcid</th><th>Verid</th></tr>
</thead>
<tbody>
    <?php
        foreach($bestuurdersLijst as $result)
        {
    ?>
    <tr><td><?php  echo $result['bestID']; ?></td><td><?php  echo $result['bestVoornaam']; ?></td><td><?php  echo $result['bestNaam']; ?></td><td><?php  echo $result['bestInfo']; ?></td>
    	<td><?php  echo $result['bestEmail']; ?></td><td><?php  echo $result['bestGSM']; ?></td><td><?php  echo $result['bestTelefoon']; ?></td>
    	<td><?php  echo $result['cvID']; ?></td><td><?php  echo $result['funcID']; ?></td><td><?php  echo $result['verID']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->



   













