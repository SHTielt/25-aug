 <?php

define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'beschikbaarheid.class.php';

//selectAll testen
$bsbObject = new Beschikbaarheid();
$beschikbaarheden = $bsbObject->selectAll(); 
print_r($beschikbaarheden);


//selectRatingById testen
/*
$ratingObject = new Rating();
$rating = $ratingObject->selectRatingById(2);
*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <
        <p>Test select all</p>
        <ul>
            <li>Message: <?php echo $bsbObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $bsbObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $bsbObject->getErrorCode(); ?></li>
        </ul>
        <table border="1">
            <caption>Alle beschikbaarheden</caption>
            <tr>
                <th>BeschikbaarheidsId</th>
                <th>Beschikbaarheid</th>
                
            </tr>
            <?php
                foreach ($beschikbaarheden as $bsb)
                {
                    ?>
            <tr>
                <td style="width:  100px"><?php echo $bsb['bsbID'] ?></td>
                <td style="width:  200px"><?php echo $bsb['bsbNaam'] ?></td>
                
            </tr>

            <?php
                }
            ?>
        </table>
        
        <!--
         
        <p>Test selectRatingById</p>
        <ul>
            <li>Message: <?php echo $ratingObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $ratingObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $ratingObject->getErrorCode(); ?></li>
        </ul>
        <table border="1">
            <tr>
                <th>RatingId</th>
                <th>Rating</th>
                
            </tr>
            <tr>
                <td style="width:  100px"><?php echo $rating[0]['rID']; ?></td>
                <td style="width:  100px"><?php echo $rating[0]['rNaam']; ?></td>
               
            </tr>
        </table>
         --> 

    </body>
</html>


