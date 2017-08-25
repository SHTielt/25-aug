<?php get_header();?>
<?php
if(isset($_POST['deelwerkingId']))
{
    $deelwerkingObject = new Deelwerking();
    $deelwerkingId = $_POST['deelwerkingId'];
    $result = $deelwerkingObject->selectDeelwerkingById($deelwerkingId);
	//print_r($result);
}
else
{
    $deelwerkingObject = new Deelwerking();
    $deelwerkingObject->setDeelwerkingId("");
    
}
?>
<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">

<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($_POST['deelwerkingId'])){echo "Deelwerking toevoegen";} else {echo "Deelwerking wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/deelwerkingen" class="buttonback">&nbsp;Terug</a>
</p>

<form id="frmDeelwerking" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/vrijwilligerspool/appcode/control/deelwerking.control.php" class="form-horizontal" enctype="multipart/form-data">
            <div class="control-group">
                 <label for="naamDeelwerking" class="control-label">DEELWERKING:</label>
                 <div class="controls"><input id="naamDeelwerking" name="naamDeelwerking" type="text" autofocus="true" value="<?php if(isset($result)) {echo $result[0]['dwNaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                  <label for="infoDeelwerking" class="control-label">EXTRA INFO:</label>
                  <div class="controls">
                  	<textarea id="infoDeelwerking" name="infoDeelwerking" rows="5" cols="40" placeholder="max 255 karakters" style="resize: none"><?php if(isset($result)) {echo $result[0]['dwInfo'];} ?></textarea>
                  </div>
            </div>
            
            <div class="control-group">
                <label for="actiefDeelwerking" class="control-label">ACTIEF:</label>
                <div class="controls">
                	<div><input id="actiefDeelwerking" name="actiefDeelwerking" type="checkbox" value="1" <?php echo ($result[0]['dwActief'] == 1)? 'checked' : '' ;?>></div>
               	</div>
            </div>
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" value="<?php if(isset($result)) {echo $result[0]['dwID'];} ?>">
            </div>  
                   
            <div class="control-group">
                <div class="controls">
                <?php
                if(empty($_POST['deelwerkingId']))
                {    
                ?>
                <button id="btnDeelwerkingSave" name="btnDeelwerkingSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnDeelwerkingCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                <?php
                }
                else
                {
                ?>
                <button id="btnDeelwerkingUpdate" name="btnDeelwerkingUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
                <?php
                }
                ?>
                </div>
            </div>          
         </form>
</section>		
</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>