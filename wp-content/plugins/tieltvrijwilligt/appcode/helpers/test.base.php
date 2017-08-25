<?php

define('RS_DIR_PATH', __DIR__."\\");
echo "mappad: ".RS_DIR_PATH;
require_once RS_DIR_PATH.'feedback.class.php';
require_once RS_DIR_PATH.'base.class.php';


$object = new \Base(); 
$object->connect();
echo "Feedback: ".$object->getFeedback();
echo "<br />";
echo "Error message: ".$object->getErrorMessage();
echo "<br />";
echo "Error code: ".$object->getErrorCode();
?> 