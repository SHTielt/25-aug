<?php
    
define('RS_DIR_PATH', __DIR__."\\");
define('RS_PLUGIN_PATH',"C:\\wamp64\\www\\sociaalhuis\\wp-content\\plugins\\tieltvrijwilligt\\");

require_once RS_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once RS_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once RS_DIR_PATH.'foto.class.php';


//insert testen
/*
$foto = new Foto();
$naam = "hans.jpg";
$vrId = 4;
$verId = NULL;

$foto->insert($naam, $vrId, $verId);
*/

//update testen
/*
$foto = new Foto();
$fotoId = 2;
$naam = "Hans.gif";
$vrId = 4;
$verId = NULL;

$foto->update($fotoId, $naam, $vrId, $verId);
*/

//testen van selectFotoByVrijwilligerId()
/*
 $objectS = new Foto();
 $result = $objectS->selectFotoByVrijwilligerId(3);
*/

//testen van selectFotoByVerenigingId()

 $objectS = new Foto();
 $result = $objectS->selectFotoByVerenigingId(3);

 
 //delete testen
 /*
 $objectD= new Foto();
 $objectD->delete(4);
 */
 
 //testen van selectFotoById()
 /*
 $objectS = new Foto();
 $result = $objectS->selectFotoById(3);
*/
 
?>
<p>Test selectFotoByVerenigingId</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>FotoId</th><th>Naam</th><th>VrijwilligerId</th><th>VerenigingId</th>
</tr>
</thead>
<tbody>
    <tr>
    	<td><?php  echo $result[0]['fID']; ?></td><td><?php  echo $result[0]['fNaam']; ?></td><td><?php  echo $result[0]['vrID']; ?></td><td><?php  echo $result[0]['verID']; ?></td>
   	</tr>
</tbody>
</table>
<br />

<!--
<p>Test selectFotoByVrijwilligerId</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>FotoId</th><th>Naam</th><th>VrijwilligerId</th><th>VerenigingId</th>
</tr>
</thead>
<tbody>
    <tr>
    	<td><?php  echo $result[0]['fID']; ?></td><td><?php  echo $result[0]['fNaam']; ?></td><td><?php  echo $result[0]['vrID']; ?></td><td><?php  echo $result[0]['verID']; ?></td>
   	</tr>
</tbody>
</table>
<br />
-->



<!--
<p>Test update foto</p>
        <ul>
            <li>Feedback: <?php echo $foto->getFeedback(); ?></li>
            <li>Error message: <?php echo $foto->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $foto->getErrorCode(); ?></li>
        </ul>
-->

<!-- 
<p>Test insert foto</p>
        <ul>
            <li>Feedback: <?php echo $foto->getFeedback(); ?></li>
            <li>Error message: <?php echo $foto->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $foto->getErrorCode(); ?></li>
            <li>ID: <?php echo $foto->getFotoId(); ?></li>
        </ul>
-->   

<!--
<p>Test selectFotoById</p>
<ul>
            <li>Feedback: <?php echo $objectS->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectS->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectS->getErrorCode(); ?></li>
</ul>
<table>
<thead>
<tr>
	<th>FotoId</th><th>Naam</th><th>VrijwilligerId</th>
</tr>
</thead>
<tbody>
    <tr><td><?php  echo $result[0]['fID']; ?></td><td><?php  echo $result[0]['fNaam']; ?></td><td><?php  echo $result[0]['vrID']; ?></td>
    	
   	</tr>
</tbody>
</table>
<br />
-->

<!--
<p>Test deleting foto</p>
        <ul>
            <li>Message: <?php echo $objectD->getFeedback(); ?></li>
            <li>Error message: <?php echo $objectD->getErrorMessage(); ?></li>
            <li>Error code: <?php echo $objectD->getErrorCode(); ?></li>
        </ul>
</p>
-->



   



















   



