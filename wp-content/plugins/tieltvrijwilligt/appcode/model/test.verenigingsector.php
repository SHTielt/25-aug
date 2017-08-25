<?php
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'verenigingsector.class.php';


//insert testen
/*
$versecObject = new VerenigingSector();
$verId = 1;
$secId = 4;
$versecObject->insert($verId, $secId);
*/

//testen van selectSectorenByVerenigingId
/*
$versecObject = new VerenigingSector();
$verId = 1;
$versectoren = $versecObject->selectSectorenByVerenigingId($verId);
print_r($versectoren);
*/

//delete testen
/*
$objectD = new VerenigingSector();
$versecId = 3;
$objectD->delete($versecId);
*/
 
//selectVerenigingSectorById nog niet getest

//testen van selectVerenigingBySectorId
$versecObject = new VerenigingSector();
$secId = 3;
$versectoren = $versecObject->selectVerenigingBySectorId($secId);
print_r($versectoren);


?>


<p>test van selectVerenigingBySectorId</p>
<ul>
            <li>Feedback: <?php echo $versecObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $versecObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $versecObject->getErrorCode(); ?></li>
</ul>
 
<table>
<thead>
<tr><th>VerSecId</th><th>Verid</th><th>Secid</th></tr>
</thead>
<tbody>
    <?php
        foreach($versectoren as $result)
        {
    ?>
    <tr><td><?php  echo $result['versecID']; ?></td><td><?php  echo $result['verID']; ?></td><td><?php  echo $result['secID']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>


<!--
<p>test van selectSectorenByVerenigingId</p>
<ul>
            <li>Feedback: <?php echo $versecObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $versecObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $versecObject->getErrorCode(); ?></li>
</ul>
 
<table>
<thead>
<tr><th>VerSecId</th><th>Verid</th><th>Secid</th></tr>
</thead>
<tbody>
    <?php
        foreach($versectoren as $result)
        {
    ?>
    <tr><td><?php  echo $result['versecID']; ?></td><td><?php  echo $result['verID']; ?></td><td><?php  echo $result['secID']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->

<!--
<p>Test deleting </p>
<ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
</ul>
-->


<!--
<p>test van selectSectorenByVerenigingId</p>
<ul>
            <li>Feedback: <?php echo $versecObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $versecObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $versecObject->getErrorCode(); ?></li>
</ul>
 
<table>
<thead>
<tr><th>VerSecId</th><th>Verid</th><th>Secid</th></tr>
</thead>
<tbody>
    <?php
        foreach($versectoren as $result)
        {
    ?>
    <tr><td><?php  echo $result['versecID']; ?></td><td><?php  echo $result['verID']; ?></td><td><?php  echo $result['secID']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
-->

<!--
<p>Test insert verenigingsector</p>
<ul>
            <li>Feedback: <?php echo $versecObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $versecObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $versecObject->getErrorCode(); ?></li>
            <li>ID: <?php echo $versecObject->getVerenigingSectorId(); ?></li>
</ul>
-->
   


