<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'deelwerking.class.php';


//insert testen
/*
$deelWerking = new Deelwerking();
$naam = "Kringloopwinkel";
$info = NULL;
$actief = 1;

$deelWerking->insert($naam, $info, $actief);
*/

//update testen
/*
$deelWerking = new Deelwerking();
$deelWerkingId = 5;
$naam = "Kringloopwinkel";
$info = "Naast OCMW";
$actief = 1;

$deelWerking->update($deelWerkingId, $naam, $info, $actief);
*/

//selectAll testen
/*
$object = new Deelwerking();
$deelWerkingsLijst=$object->selectAll();
print_r($deelWerkingsLijst);
*/

 //testen van selectDeelwerkingById()
 /*
 $objectS = new Deelwerking();
 $result = $objectS->selectDeelwerkingById(4);
 */

 
 
 //delete testen
 $objectD= new Deelwerking();
 $objectD->delete(5);
 
?>


<p>Test deleting deelWerking</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>


<!--
<p>Test selectDeelwerkingById</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>DwID</th><th>Naam</th><th>Info</th><th>Actief</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['dwID']; ?></td><td><?php echo $result[0]['dwNaam']; ?></td><td><?php  echo $result[0]['dwInfo']; ?></td>
    	<td><?php  echo $result[0]['dwActief']; ?></td>
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
<tr><th>dwID</th><th>Naam</th><th>Info</th><th>Actief</th></tr>
</thead>
<tbody>
    <?php
        foreach($deelWerkingsLijst as $result)
        {
    ?>
    <tr>
    	<td><?php  echo $result['dwID']; ?></td><td><?php  echo $result['dwNaam']; ?></td><td><?php  echo $result['dwInfo']; ?></td><td><?php  echo $result['dwActief']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->


<!--
<p>Test update deelWerking</p>
        <ul>
            <li>Feedback: <?php echo $deelWerking->getFeedback(); ?></li>
            <li>Error message: <?php echo $deelWerking->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $deelWerking->getErrorCode(); ?></li>
        </ul>
-->

<!-- 
<p>Test insert deelWerking</p>
        <ul>
            <li>Feedback: <?php echo $deelWerking->getFeedback(); ?></li>
            <li>Error message: <?php echo $deelWerking->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $deelWerking->getErrorCode(); ?></li>
            <li>ID: <?php echo $deelWerking->getDeelwerkingId(); ?></li>
        </ul>
 --> 


