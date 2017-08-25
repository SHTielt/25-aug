<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'contactpersoon.class.php';


//insert testen
/*
$contactPersoon = new ContactPersoon();
$voornaam = "Piet";
$naam = "Vroman";
$info = "";
$email = "piet.vroman@yahoo.com";
$gsm = "";
$telefoon = "";
$contactVoorkeurId = 1;
$verId = 8;

$contactPersoon->insert($voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $verId);
*/

//update testen
/*
$contactPersoon = new ContactPersoon();
$contactPersoonId = 3;
$voornaam = "Hans";
$naam = "Hanssens";
$info = "blabla";
$email = "hhh@skynet.be";
$gsm = "0479/584123";
$telefoon = NULL;
$contactVoorkeurId = 1;
$verId = 8;

$contactPersoon->update($contactPersoonId, $voornaam, $naam, $info, $email, $gsm, $telefoon, $contactVoorkeurId, $verId);
*/

//selectAll testen
/*
$object = new ContactPersoon();
$contactPersoonsLijst=$object->selectAll();
print_r($contactPersoonsLijst);
*/

 //testen van selectContactPersoonById()
 /*
 $objectS = new ContactPersoon();
 $result = $objectS->selectContactPersoonById(3);
 */

 //delete testen
 /*
 $objectD= new ContactPersoon();
 $objectD->delete(3);
 */
 
 //testen van selectContactPersoonByVerenigingId()
 
 $objectS = new ContactPersoon();
 $result = $objectS->selectContactPersoonByVerenigingId(1);
 
 
?>


<p>Test selectContactPersoonByVerenigingId</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>BestId</th><th>Voornaam</th><th>Naam</th><th>Info</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>CVID</th><th>Verid</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['contID']; ?></td><td><?php  echo $result[0]['contVoornaam']; ?></td><td><?php  echo $result[0]['contNaam']; ?></td><td><?php  echo $result[0]['contInfo']; ?></td>
    	<td><?php  echo $result[0]['contEmail']; ?></td><td><?php  echo $result[0]['contGSM']; ?></td><td><?php  echo $result[0]['contTelefoon']; ?></td>
    	<td><?php  echo $result[0]['cvID']; ?></td><td><?php  echo $result[0]['verID']; ?></td>
    </tr>
</tbody>
</table>

<!--
<p>Test deleting cp</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>
-->
   
<!--
<p>Test selectContactPersoonById</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>ContId</th><th>Voornaam</th><th>Naam</th><th>Info</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>CVID</th><th>Verid</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['contID']; ?></td><td><?php  echo $result[0]['contVoornaam']; ?></td><td><?php  echo $result[0]['contNaam']; ?></td><td><?php  echo $result[0]['contInfo']; ?></td>
    	<td><?php  echo $result[0]['contEmail']; ?></td><td><?php  echo $result[0]['contGSM']; ?></td><td><?php  echo $result[0]['contTelefoon']; ?></td>
    	<td><?php  echo $result[0]['cvID']; ?></td><td><?php  echo $result[0]['verID']; ?></td>
    </tr>
</tbody>
</table>
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
<tr><th>ContId</th><th>Voornaam</th><th>Naam</th><th>Info</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>CVID</th><th>Verid</th></tr>
</thead>
<tbody>
    <?php
        foreach($contactPersoonsLijst as $result)
        {
    ?>
    <tr><td><?php  echo $result['contID']; ?></td><td><?php  echo $result['contVoornaam']; ?></td><td><?php  echo $result['contNaam']; ?></td><td><?php  echo $result['contInfo']; ?></td>
    	<td><?php  echo $result['contEmail']; ?></td><td><?php  echo $result['contGSM']; ?></td><td><?php  echo $result['contTelefoon']; ?></td>
    	<td><?php  echo $result['cvID']; ?></td><td><?php  echo $result['verID']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->


<!--
<p>Test update cp</p>
        <ul>
            <li>Feedback: <?php echo $contactPersoon->getFeedback(); ?></li>
            <li>Error message: <?php echo $contactPersoon->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $contactPersoon->getErrorCode(); ?></li>
        </ul>
-->

<!--
<p>Test insert cp</p>
        <ul>
            <li>Feedback: <?php echo $contactPersoon->getFeedback(); ?></li>
            <li>Error message: <?php echo $contactPersoon->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $contactPersoon->getErrorCode(); ?></li>
            <li>ID: <?php echo $contactPersoon->getContactPersoonId(); ?></li>
        </ul>
-->
 














   













