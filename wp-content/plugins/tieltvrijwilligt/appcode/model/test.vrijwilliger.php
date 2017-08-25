<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'vrijwilliger.class.php';


//insert testen
/*
$vrijwilliger = new Vrijwilliger();
$voornaam = "Hans";
$naam = "Hanssens";
$adres = "Markt 2";
$postCode = "8700";
$gemeente = "Tielt";
$geboorteDatum = "1970-10-15";
$email = "hhh@skynet.be";
$gsm = "0479/584123";
$telefoon = NULL;
$info="blabla";
$foto = NULL;
$comment = NULL;
$actief = 1;
$statusId = NULL;
$contactVoorkeurId = 1;
$wpUserId = 4;


$vrijwilliger->insert($voornaam, $naam, $adres, $postCode, $gemeente, $geboorteDatum, $email, $gsm, $telefoon, $info, $foto, $comment, $actief, $statusId, $contactVoorkeurId, $wpUserId);
*/

//update testen
/*
$vrijwilliger = new Vrijwilliger();
$vrijwilligerId = 7;
$voornaam = "Mie";
$naam = "Mietens";
$adres = "Markt 5";
$postCode = "8700";
$gemeente = "Tielt";
$geboorteDatum = "1950-10-15";
$email = "mie.mietens@skynet.be";
$gsm = NULL;
$telefoon = NULL;
$info="blabla";
$foto = NULL;
$comment = NULL;
$actief = 1;
$statusId = NULL;
$contactVoorkeurId = 1;
$wpUserId = 9;

$vrijwilliger->update($vrijwilligerId, $voornaam, $naam, $adres, $postCode, $gemeente, $geboorteDatum, $email, $gsm, $telefoon, $info, $foto, $comment, $actief, $statusId, $contactVoorkeurId, $wpUserId);
*/

//selectAll testen
/*
$object = new Vrijwilliger();
$vrijwilligersLijst=$object->selectAll();
print_r($vrijwilligersLijst);
*/

 //testen van selectVrijwilligerById()
 /*
 $objectS = new Vrijwilliger();
 $result = $objectS->selectVrijwilligerById(3);
 */

 //testen van selectMemberByUserId()
 /*
 $objectS = new Vrijwilliger();
 $result = $objectS->selectVrijwilligerByUserId(2);
 */
 
 //delete testen
 /*
 $objectD= new Vrijwilliger();
 $objectD->delete(2);
 */
 
 //testen van selectVrijwilligerByVoornaamNaamGeboorteDatum
 $objectS = new Vrijwilliger();
 $voornaam = 'Mie';
 $naam = 'Mietens';
 $geboorteDatum = '2015-04-01';
 $result = $objectS->selectVrijwilligerByVoornaamNaamGeboorteDatum($voornaam, $naam, $geboorteDatum);
 
?>


<p>Test selectVrijwilligerByVoornaamNaamGeboorteDatum</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<br />
<table>
<thead>
<tr>
	<th>VrId</th><th>Voornaam</th><th>Naam</th><th>Adres</th><th>Postcode</th><th>Gemeente</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>Info</th><th>Foto</th><th>Comment</th><th>Actief</th>
	<th>RatingId</th><th>CVID</th><th>Userid</th>
</tr>
</thead>
    <tbody>
    <tr><td><?php  echo $result[0]['vrID']; ?></td><td><?php  echo $result[0]['vrVoornaam']; ?></td><td><?php  echo $result[0]['vrNaam']; ?></td><td><?php  echo $result[0]['vrAdres']; ?></td>
    	<td><?php  echo $result[0]['vrPostCode']; ?></td><td><?php  echo $result[0]['vrGemeente']; ?></td><td><?php  echo $result[0]['vrEmail']; ?></td><td><?php  echo $result[0]['vrGSM']; ?></td>
    	<td><?php  echo $result[0]['vrTelefoon']; ?></td><td><?php  echo $result[0]['vrInfo']; ?></td><td><?php  echo $result[0]['vrFoto']; ?></td><td><?php  echo $result[0]['vrComment']; ?></td><td><?php  echo $result[0]['vrActief']; ?></td>
    	<td><?php  echo $result[0]['sID']; ?></td><td><?php  echo $result[0]['cvID']; ?></td><td><?php  echo $result[0]['vrWPUserID']; ?></td>
    	</tr>
    </tbody>
    </table>


<!--
<p>Test update vrijwilliger</p>
        <ul>
            <li>Feedback: <?php echo $vrijwilliger->getFeedback(); ?></li>
            <li>Error message: <?php echo $vrijwilliger->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $vrijwilliger->getErrorCode(); ?></li>
        </ul>

-->

<!--
<p>Test insert vrijwilliger</p>
        <ul>
            <li>Feedback: <?php echo $vrijwilliger->getFeedback(); ?></li>
            <li>Error message: <?php echo $vrijwilliger->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $vrijwilliger->getErrorCode(); ?></li>
            <li>ID: <?php echo $vrijwilliger->getVrijwilligerId(); ?></li>
        </ul>
 -->       


<!--
<p>Test deleting vrijwilliger</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>
-->
   
<!--
<p>Test selectVrijwilligerByUserId</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<br />
<table>
<thead>
<tr>
	<th>VrId</th><th>Voornaam</th><th>Naam</th><th>Adres</th><th>Postcode</th><th>Gemeente</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>Info</th><th>Foto</th><th>Comment</th><th>Actief</th>
	<th>RatingId</th><th>CVID</th><th>Userid</th>
</tr>
</thead>
    <tbody>
    <tr><td><?php  echo $result[0]['vrID']; ?></td><td><?php  echo $result[0]['vrVoornaam']; ?></td><td><?php  echo $result[0]['vrNaam']; ?></td><td><?php  echo $result[0]['vrAdres']; ?></td>
    	<td><?php  echo $result[0]['vrPostCode']; ?></td><td><?php  echo $result[0]['vrGemeente']; ?></td><td><?php  echo $result[0]['vrEmail']; ?></td><td><?php  echo $result[0]['vrGSM']; ?></td>
    	<td><?php  echo $result[0]['vrTelefoon']; ?></td><td><?php  echo $result[0]['vrInfo']; ?></td><td><?php  echo $result[0]['vrFoto']; ?></td><td><?php  echo $result[0]['vrComment']; ?></td><td><?php  echo $result[0]['vrActief']; ?></td>
    	<td><?php  echo $result[0]['rID']; ?></td><td><?php  echo $result[0]['cvID']; ?></td><td><?php  echo $result[0]['vrWPUserID']; ?></td>
    	</tr>
    </tbody>
    </table>
-->

<!--
<p>Test selectVrijwilligerById</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>VrId</th><th>Voornaam</th><th>Naam</th><th>Adres</th><th>Postcode</th><th>Gemeente</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>Info</th><th>Foto</th><th>Comment</th><th>Actief</th>
	<th>RatingId</th><th>CVID</th><th>Userid</th>
</tr>
</thead>
    <tbody>
    <tr><td><?php  echo $result[0]['vrID']; ?></td><td><?php  echo $result[0]['vrVoornaam']; ?></td><td><?php  echo $result[0]['vrNaam']; ?></td><td><?php  echo $result[0]['vrAdres']; ?></td>
    	<td><?php  echo $result[0]['vrPostCode']; ?></td><td><?php  echo $result[0]['vrGemeente']; ?></td><td><?php  echo $result[0]['vrEmail']; ?></td><td><?php  echo $result[0]['vrGSM']; ?></td>
    	<td><?php  echo $result[0]['vrTelefoon']; ?></td><td><?php  echo $result[0]['vrInfo']; ?></td><td><?php  echo $result[0]['vrFoto']; ?></td><td><?php  echo $result[0]['vrComment']; ?></td><td><?php  echo $result[0]['vrActief']; ?></td>
    	<td><?php  echo $result[0]['rID']; ?></td><td><?php  echo $result[0]['cvID']; ?></td><td><?php  echo $result[0]['vrWPUserID']; ?></td>
    	</tr>
    </tbody>
    </table>
    <br />
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
<tr><th>VrId</th><th>Voornaam</th><th>Naam</th><th>Adres</th><th>Postcode</th><th>Gemeente</th><th>Email</th><th>gsm</th><th>Telefoon</th><th>Info</th><th>Foto</th><th>Comment</th><th>Actief</th>
	<th>RatingId</th><th>CVID</th><th>Userid</th></tr>
</thead>
<tbody>
    <?php
        foreach($vrijwilligersLijst as $result)
        {
    ?>
    <tr><td><?php  echo $result['vrID']; ?></td><td><?php  echo $result['vrVoornaam']; ?></td><td><?php  echo $result['vrNaam']; ?></td><td><?php  echo $result['vrAdres']; ?></td>
    	<td><?php  echo $result['vrPostCode']; ?></td><td><?php  echo $result['vrGemeente']; ?></td><td><?php  echo $result['vrEmail']; ?></td><td><?php  echo $result['vrGSM']; ?></td><td><?php  echo $result['vrTelefoon']; ?></td>
    	<td><?php  echo $result['vrInfo']; ?></td><td><?php  echo $result['vrFoto']; ?></td><td><?php  echo $result['vrComment']; ?></td><td><?php  echo $result['vrActief']; ?></td>
    	<td><?php  echo $result['rID']; ?></td><td><?php  echo $result['cvID']; ?></td><td><?php  echo $result['vrWPUserID']; ?></td>
    	</tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->







