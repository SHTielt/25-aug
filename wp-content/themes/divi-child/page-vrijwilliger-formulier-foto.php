<?php get_header();?>
<?php


if(isset($_POST['vrijwilligerId']))
{
    $vrijwilligerObject = new Vrijwilliger();
    $vrijwilligerId = $_POST['vrijwilligerId'];
    $result = $vrijwilligerObject->selectVrijwilligerById($vrijwilligerId);
	print_r($result);
}
else
{
    $vrijwilligerObject = new Vrijwilliger();
    $vrijwilligerObject->setVrijwilligerId("");
    
}
?>
<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">
	


<?php
if(!isset($_SESSION['fotoid']))//nog geen foto opgeladen
{
/*uploadmessage komt van vrijwilligerfotocontrol.php*/
$uploadMessage = isset($_SESSION['uploadmessage'])? $_SESSION['uploadmessage'] : "";
unset($_SESSION['uploadmessage']);
?>
<div id="rodebalk" class="alert-info">
            <strong>&nbsp;Foto toevoegen</strong>
             <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/vrijwilligers" class="buttonback">&nbsp;Terug</a>
</p>
<div id="uploaddiv">     
<form action="http://localhost:8080/sociaalhuis/wp-content/plugins/vrijwilligerspool/appcode/control/vrijwilligerfoto.control.php" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="control-group">
                <label for="fileToUpload" class="control-label">Foto kiezen:</label>
                <div class="controls"><input type="file" name="fileToUpload" id="fileToUpload"></div>
            </div>
            <div class="control-group">
                <label for="naam" class="control-label">Foto opladen:</label>
                <div class="controls">
                	<button id="btnVrijwilligerFotoSave" name="btnVrijwilligerFotoSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                    <button id="btnVrijwilligerFotoCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                </div>
            </div>
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" type="hidden" value="<?php if(isset($result)) {echo $result[0]['vrID'];} ?>">
            </div>  
</form>
 <div id="uploadMessage"><?php echo $uploadMessage; ?></div>
</div> 

<?php
}
else //wel foto opgeladen
{
?>
<div id="rodebalk" class="alert-info">
            <strong>&nbsp;Foto wijzigen of verwijderen</strong>
             <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/vrijwilligers" class="buttonback">&nbsp;Terug</a>
</p>
<div id="uploaddiv">     
<form action="http://localhost:8080/sociaalhuis/wp-content/plugins/vrijwilligerspool/appcode/control/vrijwilligerfoto.control.php" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="control-group">
                <label for="fileToUpload" class="control-label">Foto kiezen:</label>
                <div class="controls"><input type="file" name="fileToUpload" id="fileToUpload"></div>
            </div>
            
            <div class="control-group">
                <label for="naam" class="control-label">Foto Wijzigen:</label>
                <div class="controls">
                	<button id="btnVrijwilligerFotoUpdate" name="btnVrijwilligerFotoUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
                    <button id="btnVrijwilligerFotoCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                </div>
            </div>
            
            <div class="control-group">
                <label for="naam" class="control-label">Foto Verwijderen:</label>
                <div class="controls">
                	<button id="btnVrijwilligerFotoDelete" name="btnVrijwilligerFotoDelete" type="submit" class="btndelete">&nbsp;Verwijderen</button>
                </div>
            </div>
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" type="hidden" value="<?php if(isset($result)) {echo $result[0]['vrID'];} ?>">
            </div>  
</form>
 <div id="uploadMessage"><?php echo $uploadMessage; ?></div>
</div> 
<div id="fotodiv"> 
<?php
/*$_SESSION['fotoid'] komt van vrijwilligerfotocontrol.php*/
if(isset($_SESSION['fotoid']))
{
    $fotoObject = new Foto();
    $result = $fotoObject->selectFotoById($_SESSION['fotoid']);
	
?>
<img id="<?php echo $result[0]['fNaam'];?>" alt="<?php echo $result[0]['fNaam'];?>" title="<?php echo $result[0]['fNaam'];?>" src="<?php echo "http://localhost:8080/sociaalhuis/wp-content/plugins/vrijwilligerspool/appcode/view/fotouploads/thumbs/".$result[0]['fNaam']?>"/>
<?php
unset($_SESSION['fotoid']);
}
?>
</div><!--einde fotodiv-->
<?php	
}



?>


</section>		
</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->       
<?php       
?>