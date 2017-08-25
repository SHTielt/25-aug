<?php
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'vrijwilligerbeschikbaarheid.class.php';


//insert testen
/*
$vrijbsbObject = new VrijwilligerBeschikbaarheid();
$vrId = 3;
$bsbId = 4;
$vrbsbInfo = "3 uren";
$vrijbsbObject->insert($vrId, $bsbId, $vrbsbInfo);
*/   
    
   
//delete testen
$objectD= new VrijwilligerBeschikbaarheid();
$vrbsbId = 4;
$objectD->delete($vrbsbId);

?>




<p>Test deleting vrbsb</p>
<ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
</ul>

<!--
<p>Test insert vrijwilligerbsb</p>
<ul>
            <li>Feedback: <?php echo $vrijbsbObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $vrijbsbObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $vrijbsbObject->getErrorCode(); ?></li>
            <li>ID: <?php echo $vrijbsbObject->getVrijwilligerBeschikbaarheidId(); ?></li>
</ul>
-->