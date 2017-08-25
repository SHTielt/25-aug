<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'interesse.class.php';


//insert testen
/*
$interesse = new Interesse();
$naam = "Communicatie";
$info = NULL;
$actief = 1;

$interesse->insert($naam, $info, $actief);
*/

//update testen

$interesse = new Interesse();
$interesseId = 2;
$naam = "Animatie";
$info = "Gesproken";
$actief = FALSE;

$interesse->update($interesseId, $naam, $info, $actief);


//selectAll testen
/*
$object = new Interesse();
$interessesLijst=$object->selectAll();
print_r($interessesLijst);
*/

 //testen van selectInteresseById()
 /*
 $objectS = new Interesse();
 $result = $objectS->selectInteresseById(8);
 */

 
 
 //delete testen
 /*
 $objectD= new Interesse();
 $objectD->delete(8);
 */
?>


<p>Test update interesse</p>
        <ul>
            <li>Feedback: <?php echo $interesse->getFeedback(); ?></li>
            <li>Error message: <?php echo $interesse->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $interesse->getErrorCode(); ?></li>
        </ul>


<!--
<p>Test deleting interesse</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>
-->

<!--
<p>Test selectInteresseById</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>IntId</th><th>Naam</th><th>Info</th><th>Actief</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['intID']; ?></td><td><?php  echo $result[0]['intNaam']; ?></td><td><?php  echo $result[0]['intInfo']; ?></td>
    	<td><?php  echo $result[0]['intActief']; ?></td>
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
<tr><th>IntID</th><th>Naam</th><th>Info</th><th>Actief</th></tr>
</thead>
<tbody>
    <?php
        foreach($interessesLijst as $result)
        {
    ?>
    <tr>
    	<td><?php  echo $result['intID']; ?></td><td><?php  echo $result['intNaam']; ?></td><td><?php  echo $result['intInfo']; ?></td><td><?php  echo $result['intActief']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->




  <!--
<p>Test insert interesse</p>
        <ul>
            <li>Feedback: <?php echo $interesse->getFeedback(); ?></li>
            <li>Error message: <?php echo $interesse->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $interesse->getErrorCode(); ?></li>
            <li>ID: <?php echo $interesse->getInteresseId(); ?></li>
        </ul>
-->        



   



