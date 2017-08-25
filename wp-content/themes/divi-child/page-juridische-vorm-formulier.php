<?php get_header();?>
<?php
if(isset($_POST['rechtsVormId']))
{
    $rvObject = new RechtsVorm();
    $rvId = $_POST['rechtsVormId'];
    $result = $rvObject->selectRechtsVormById($rvId);
}
else
{
    $rvObject = new RechtsVorm();
    $rvObject->setRechtsVormId("");
}
?>
<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">

<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($_POST['rechtsVormId'])){echo "Juridische vorm toevoegen";} else {echo "Juridische vorm wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/juridische-vormen" class="buttonback">&nbsp;Terug</a>
</p>

<form id="frmSector" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/juridischevorm.control.php" class="form-horizontal" enctype="multipart/form-data">
            <div class="control-group">
                 <label for="naamJurVorm" class="control-label">JURIDISCHE VORM:</label>
                 <div class="controls"><input id="naamJurVorm" name="naamJurVorm" type="text" autofocus="true" value="<?php if(isset($result)) {echo $result[0]['rvNaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                  <label for="infoJurVorm" class="control-label">EXTRA INFO:</label>
                  <div class="controls"><textarea id="infoJurVorm" name="infoJurVorm" rows="5" cols="40" placeholder="max 255 karakters" style="resize: none"><?php if(isset($result)) {echo $result[0]['rvInfo'];} ?></textarea></div>
            </div>
                        
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" type="hidden" value="<?php if(isset($result)) {echo $result[0]['rvID'];} ?>">
            </div>  
                   
            <div class="control-group">
                <div class="controls">
                <?php
                if(empty($_POST['rechtsVormId']))
                {    
                ?>
                <button id="btnJurVormSave" name="btnJurVormSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnJurVormCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                <?php
                }
                else
                {
                ?>
                <button id="btnJurVormUpdate" name="btnJurVormUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
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