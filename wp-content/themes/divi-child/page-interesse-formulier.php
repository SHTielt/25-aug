<?php get_header();?>
<?php
if(isset($_POST['interesseId']))
{
    $interesseObject = new Interesse();
    $interesseId = $_POST['interesseId'];
    $result = $interesseObject->selectInteresseById($interesseId);
}
else
{
    $interesseObject = new Interesse();
    $interesseObject->setInteresseId("");
}
?>
<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">

<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($_POST['interesseId'])){echo "Interesse toevoegen";} else {echo "Interesse wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/interesses" class="buttonback">&nbsp;Terug</a>
</p>

<form id="frmInteresse" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/interesse.control.php" class="form-horizontal" enctype="multipart/form-data">
            <div class="control-group">
                 <label for="naamInteresse" class="control-label">INTERESSE:</label>
                 <div class="controls"><input id="naamInteresse" name="naamInteresse" type="text" autofocus="true" value="<?php if(isset($result)) {echo $result[0]['intNaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                  <label for="infoInteresse" class="control-label">EXTRA INFO:</label>
                  <div class="controls"><textarea id="infoInteresse" name="infoInteresse" rows="5" cols="40" placeholder="max 255 karakters" style="resize: none"><?php if(isset($result)) {echo $result[0]['intInfo'];} ?></textarea></div>
            </div>
            
            <div class="control-group">
                <label for="actiefInteresse" class="control-label">ACTIEF:</label>
                <div class="controls">
                	<div><input id="actiefInteresse" name="actiefInteresse" type="checkbox" value="1" <?php echo ($result[0]['intActief'] == 1)? 'checked' : '' ;?>></div>
               	</div>
            </div>
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" type="hidden" value="<?php if(isset($result)) {echo $result[0]['intID'];} ?>">
            </div>  
                   
            <div class="control-group">
                <div class="controls">
                <?php
                if(empty($_POST['interesseId']))
                {    
                ?>
                <button id="btnInteresseSave" name="btnInteresseSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnInteresseCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                <?php
                }
                else
                {
                ?>
                <button id="btnInteresseUpdate" name="btnInteresseUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
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