<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'functie.class.php';


//insert testen
/*
$functie = new Functie();
$naam = "Directeur";
$info = "bla";

$functie->insert($naam, $info);
*/

//update testen
/*
$functieId = 6;
$functie = new Functie();
$naam = "Directrice";
$info = "blabla";

$functie->update($functieId, $naam, $info);
*/

//selectAll testen
/*
$functie = new Functie();
$functies = $functie->selectAll();
print_r($functies);
*/

//testen van selectFunctieById()
/*
$objectS = new Functie();
$result = $objectS->selectFunctieById(6);
*/

 //delete testen
 
 $objectD = new Functie();
 $objectD->delete(6);
 
?>

<p>Test deleting functie</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>


<!--
<p>Test selectFunctieById</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>funcId</th><th>Naam</th><th>Info</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['funcID']; ?></td><td><?php  echo $result[0]['funcNaam']; ?></td><td><?php  echo $result[0]['funcInfo']; ?></td>
    </tr>
</tbody>
</table>
-->

<!--
<p>Test selectall</p>
<ul>
            <li>Feedback: <?php echo $functie->getFeedback(); ?></li>
            <li>Error message: <?php echo $functie->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $functie->getErrorCode(); ?></li>
</ul>
 
<table>
<thead>
<tr><th>functieID</th><th>Naam</th><th>Info</th></tr>
</thead>
<tbody>
    <?php
        foreach($functies as $result)
        {
    ?>
    <tr>
    	<td><?php  echo $result['funcID']; ?></td><td><?php  echo $result['funcNaam']; ?></td><td><?php  echo $result['funcInfo']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->

<!--
<p>Test update functie</p>
        <ul>
            <li>Feedback: <?php echo $functie->getFeedback(); ?></li>
            <li>Error message: <?php echo $functie->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $functie->getErrorCode(); ?></li>
        </ul>
-->

<!--
<p>Test insert functie</p>
        <ul>
            <li>Feedback: <?php echo $functie->getFeedback(); ?></li>
            <li>Error message: <?php echo $functie->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $functie->getErrorCode(); ?></li>
            <li>ID: <?php echo $functie->getFunctieId(); ?></li>
        </ul>
-->       
