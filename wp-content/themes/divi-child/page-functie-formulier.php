<?php get_header();?>
<?php
if(isset($_POST['functieId']))
{
    $functieObject = new Functie();
    $functieId = $_POST['functieId'];
    $result = $functieObject->selectFunctieById($functieId);
}
else
{
    $functieObject = new Functie();
    $functieObject->setFunctieId("");
}
?>
<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">

<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($_POST['functieId'])){echo "Functie toevoegen";} else {echo "Functie wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/functies" class="buttonback">&nbsp;Terug</a>
</p>

<form id="frmSector" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/functie.control.php" class="form-horizontal" enctype="multipart/form-data">
            <div class="control-group">
                 <label for="naamFunctie" class="control-label">FUNCTIE:</label>
                 <div class="controls"><input id="naamFunctie" name="naamFunctie" type="text" autofocus="true" value="<?php if(isset($result)) {echo $result[0]['funcNaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                  <label for="infoFunctie" class="control-label">EXTRA INFO:</label>
                  <div class="controls"><textarea id="infoFunctie" name="infoFunctie" rows="5" cols="40" placeholder="max 255 karakters" style="resize: none"><?php if(isset($result)) {echo $result[0]['funcInfo'];} ?></textarea></div>
            </div>
                        
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" type="hidden" value="<?php if(isset($result)) {echo $result[0]['funcID'];} ?>">
            </div>  
                   
            <div class="control-group">
                <div class="controls">
                <?php
                if(empty($_POST['functieId']))
                {    
                ?>
                <button id="btnFunctieSave" name="btnFunctieSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnFunctieCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                <?php
                }
                else
                {
                ?>
                <button id="btnFunctieUpdate" name="btnFunctieUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
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