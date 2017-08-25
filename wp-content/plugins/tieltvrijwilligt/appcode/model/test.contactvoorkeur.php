 <?php

define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'contactvoorkeur.class.php';

//selectAll testen
/*
$cvObject = new ContactVoorkeur();
$cvs = $cvObject->selectAll(); 
print_r($cvs);
*/

//selectContactVoorkeurById testen

$cvObject = new ContactVoorkeur();
$cv = $cvObject->selectContactVoorkeurById(2);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <!--
        <p>Test select all</p>
        <ul>
            <li>Message: <?php echo $cvObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $cvObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $cvObject->getErrorCode(); ?></li>
        </ul>
        <table border="1">
            <caption>Alle voorkeuren</caption>
            <tr>
                <th>CVId</th>
                <th>Voorkeur</th>
                
            </tr>
            <?php
                foreach ($cvs as $cv)
                {
                    ?>
            <tr>
                <td style="width:  100px"><?php echo $cv['cvID'] ?></td>
                <td style="width:  100px"><?php echo $cv['cvVoorkeur'] ?></td>
                
            </tr>

            <?php
                }
            ?>
        </table>
        -->
        
         
        <p>Test selectContactVoorkeurById</p>
        <ul>
            <li>Message: <?php echo $cvObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $cvObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $cvObject->getErrorCode(); ?></li>
        </ul>
        <table border="1">
            <tr>
                <th>CVId</th>
                <th>Voorkeur</th>
                
            </tr>
            <tr>
                <td style="width:  100px"><?php echo $cv[0]['cvID']; ?></td>
                <td style="width:  100px"><?php echo $cv[0]['cvVoorkeur']; ?></td>
               
            </tr>
        </table>
          

    </body>
</html>


