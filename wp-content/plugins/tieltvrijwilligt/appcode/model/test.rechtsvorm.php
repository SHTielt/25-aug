<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'rechtsvorm.class.php';


//insert testen
/*
$rechtsVorm = new RechtsVorm();
$naam = "NV";
$info = NULL;

$rechtsVorm->insert($naam, $info);
*/

//update testen
/*
$rechtsVormId = 8;
$rechtsVorm = new RechtsVorm();
$naam = "NV";
$info = "bla";

$rechtsVorm->update($rechtsVormId, $naam, $info);
*/

//selectAll testen
/*
$rechtsVorm = new RechtsVorm();
$rechtsVormen = $rechtsVorm->selectAll();
print_r($rechtsVormen);
*/

 //testen van selectRechtsVormById()
/* 
 $objectS = new RechtsVorm();
 $result = $objectS->selectRechtsVormById(8);
*/ 

 //delete testen
 
 $objectD = new RechtsVorm();
 $objectD->delete(8);
 
?>

<p>Test deleting rv</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>


<!--
<p>Test selectRechtsVormById</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>rvId</th><th>Naam</th><th>Info</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['rvID']; ?></td><td><?php  echo $result[0]['rvNaam']; ?></td><td><?php  echo $result[0]['rvInfo']; ?></td>
    </tr>
</tbody>
</table>
<br />
-->


<!--
<p>Test selectall</p>
<ul>
            <li>Feedback: <?php echo $rechtsVorm->getFeedback(); ?></li>
            <li>Error message: <?php echo $rechtsVorm->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $rechtsVorm->getErrorCode(); ?></li>
</ul>
 
<table>
<thead>
<tr><th>rvID</th><th>Naam</th><th>Info</th></tr>
</thead>
<tbody>
    <?php
        foreach($rechtsVormen as $result)
        {
    ?>
    <tr>
    	<td><?php  echo $result['rvID']; ?></td><td><?php  echo $result['rvNaam']; ?></td><td><?php  echo $result['rvInfo']; ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>

-->


<!--
<p>Test update rechtsvorm</p>
        <ul>
            <li>Feedback: <?php echo $rechtsVorm->getFeedback(); ?></li>
            <li>Error message: <?php echo $rechtsVorm->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $rechtsVorm->getErrorCode(); ?></li>
        </ul>
-->

<!--
<p>Test insert rechtsvorm</p>
        <ul>
            <li>Feedback: <?php echo $rechtsVorm->getFeedback(); ?></li>
            <li>Error message: <?php echo $rechtsVorm->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $rechtsVorm->getErrorCode(); ?></li>
            <li>ID: <?php echo $rechtsVorm->getRechtsVormId(); ?></li>
        </ul>
 -->       



