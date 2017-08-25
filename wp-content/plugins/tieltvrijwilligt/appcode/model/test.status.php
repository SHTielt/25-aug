 <?php

define('SH_DIR_PATH', __DIR__."\\");
define('SH_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_DIR_PATH.'status.class.php';

//selectAll testen
/*
$statusObject = new Status();
$statussen = $statusObject->selectAll(); 
print_r($statussen);
*/

//selectStatusById testen

$statusObject = new Status();
$status = $statusObject->selectStatusById(2);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
    	 
        <p>Test selectStatusById</p>
        <ul>
            <li>Message: <?php echo $statusObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $statusObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $statusObject->getErrorCode(); ?></li>
        </ul>
        <table border="1">
            <tr>
                <th>StatusId</th>
                <th>Status</th>
                
            </tr>
            <tr>
                <td style="width:  100px"><?php echo $status[0]['sID']; ?></td>
                <td style="width:  100px"><?php echo $status[0]['sNaam']; ?></td>
               
            </tr>
        </table>
         
         
        <!--
        <p>Test select all</p>
        <ul>
            <li>Message: <?php echo $statusObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $statusObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $statusObject->getErrorCode(); ?></li>
        </ul>
        <table border="1">
            <caption>Alle statussen</caption>
            <tr>
                <th>StatusId</th>
                <th>Status</th>
                
            </tr>
            <?php
                foreach ($statussen as $status)
                {
                    ?>
            <tr>
                <td style="width:  100px"><?php echo $status['sID'] ?></td>
                <td style="width:  100px"><?php echo $status['sNaam'] ?></td>
                
            </tr>

            <?php
                }
            ?>
        </table>
        -->
        
        
        

    </body>
</html>


