<?php
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'vrijwilligerdeelwerking.class.php';


//insert testen
/*
$vrijdwObject = new VrijwilligerDeelwerking();
$vrId = 3;
$dwId = 4;
$vrdwInfo = "info";
$vrijdwObject->insert($vrId, $dwId, $vrdwInfo);
*/

//delete testen

$objectD = new VrijwilligerDeelwerking();
$vrdwId = 4;
$objectD->delete($vrdwId);
 

?>


<p>Test deleting vrint</p>
<ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
</ul>

<!--
<p>Test insert vrijwilligerdeelwerking</p>
<ul>
            <li>Feedback: <?php echo $vrijdwObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $vrijdwObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $vrijdwObject->getErrorCode(); ?></li>
            <li>ID: <?php echo $vrijdwObject->getVrijwilligerDeelwerkingId(); ?></li>
</ul>

-->   