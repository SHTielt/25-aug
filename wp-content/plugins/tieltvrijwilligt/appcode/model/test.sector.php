<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'sector.class.php';


//insert testen
/*
$sector = new Sector();
$naam = "Erfgoed";
$info = "abc";

$sector->insert($naam, $info);
*/

//update testen
/*
$sectorId = 7;
$sector = new Sector();
$naam = "Erfgoed";
$info = "bla";

$sector->update($sectorId, $naam, $info);
*/

//selectAll testen
/*
$sector = new Sector();
$sectoren = $sector->selectAll();
print_r($sectoren);
*/

 //testen van selectSectorById()
/*
 $objectS = new Sector();
 $result = $objectS->selectSectorById(7);
*/

 //delete testen
 
 $objectD = new Sector();
 $objectD->delete(7);
 
?>


<p>Test deleting sector</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>


<!--
<p>Test selectSectorById</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>sectorId</th><th>Naam</th><th>Info</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['secID']; ?></td><td><?php  echo $result[0]['secNaam']; ?></td><td><?php  echo $result[0]['secInfo']; ?></td>
    </tr>
</tbody>
</table>
-->


<!--
<p>Test selectall</p>
<ul>
            <li>Feedback: <?php echo $sector->getFeedback(); ?></li>
            <li>Error message: <?php echo $sector->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $sector->getErrorCode(); ?></li>
</ul>
 
<table>
<thead>
<tr><th>sectorID</th><th>Naam</th><th>Info</th></tr>
</thead>
<tbody>
    <?php
        foreach($sectoren as $result)
        {
    ?>
    <tr>
    	<td><?php  echo $result['secID']; ?></td><td><?php  echo $result['secNaam']; ?></td><td><?php  echo $result['secInfo']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->


<!--
<p>Test update sector</p>
        <ul>
            <li>Feedback: <?php echo $sector->getFeedback(); ?></li>
            <li>Error message: <?php echo $sector->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $sector->getErrorCode(); ?></li>
        </ul>
-->

<!--
<p>Test insert sector</p>
        <ul>
            <li>Feedback: <?php echo $sector->getFeedback(); ?></li>
            <li>Error message: <?php echo $sector->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $sector->getErrorCode(); ?></li>
            <li>ID: <?php echo $sector->getSectorId(); ?></li>
        </ul>
 -->     
 

