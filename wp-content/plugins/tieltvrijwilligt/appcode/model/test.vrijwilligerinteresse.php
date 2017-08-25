<?php
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'vrijwilligerinteresse.class.php';


//insert testen
/*
$vrijintObject = new VrijwilligerInteresse();
$vrId = 3;
$intId = 4;
$vrintInfo = "info";
$vrijintObject->insert($vrId, $intId, $vrintInfo);
?>   

<p>Test insert vrijwilligerinteresse</p>
<ul>
            <li>Feedback: <?php echo $vrijintObject->getFeedback(); ?></li>
            <li>Error message: <?php echo $vrijintObject->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $vrijintObject->getErrorCode(); ?></li>
            <li>ID: <?php echo $vrijintObject->getVrijwilligerInteresseId(); ?></li>
</ul>
*/
    
    
   
//delete testen
$objectD= new VrijwilligerInteresse();
$vrintId = 6;
$objectD->delete($vrintId);
?>

<p>Test deleting vrint</p>
<ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
</ul>

<?php
    
//testen van selectproductsByMemberId()
    /*
    function rs_test_SelectProjectsByMemberId($memberId)
    {
    $objectS = new ProjectMember();
    $projectsOfMember = $objectS->selectProjectsByMemberId($memberId);
    ?>
    <table>
    <thead>
    <tr><th>ProjectMemberId</th><th>ProjectId</th><th>MemberId</th><th>Pending</th><th>InsertedBy</th><th>ModifiedBy</th></tr>
    </thead>
    <tbody>
    <?php
    foreach($projectsOfMember as $pom)    
    {
    ?>
    <tr><td><?php  echo $pom['ProjectMemberId']; ?></td><td><?php  echo $pom['ProjectId']; ?></td><td><?php  echo $pom['MemberId']; ?></td><td><?php  echo $pom['Pending']; ?></td><td><?php  echo $pom['InsertedBy']; ?></td><td><?php  echo $pom['ModifiedBy']; ?></td></tr>
    <?php
    }//end foreach
    ?>
    </tbody>
    </table>
    <br />

    <?php
    }//end selectMemberById
    */
    
    
    
    
    
    
       //select projectmembers testen
    /*
    function rs_test_SelectProjectMembers()
    {
    $objectS= new ProjectMember();
    $pms = $objectS->selectAll();

    ?>
    <table>
    <thead>
    <tr><th>ProjectMemberId</th><th>ProjectId</th><th>MemberId</th><th>Pending</th><th>InsertedBy</th></tr>
    </thead>
    <tbody>
    <?php
        foreach($pms as $pm)
        {
    ?>
    <tr><td><?php  echo $pm['ProjectMemberId']; ?></td><td><?php  echo $pm['ProjectId']; ?></td><td><?php  echo $pm['MemberId']; ?></td><td><?php  echo $pm['Pending']; ?></td><td><?php  echo $pm['InsertedBy']; ?></td></tr>
    <?php
        }//end foreach
    ?>
    </tbody>
    </table>
    <br />
    
    <p>Test select projectmember</p>
        <ul>
            <li>Message: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
        </ul>
    </p
    <?php
    
    }//end function
    */
    ?>



    

