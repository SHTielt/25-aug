<?php get_header();?>
<?php
if(isset($_POST['sectorId']))
{
    $sectorObject = new Sector();
    $sectorId = $_POST['sectorId'];
    $result = $sectorObject->selectSectorById($sectorId);
}
else
{
    $sectorObject = new Sector();
    $sectorObject->setSectorId("");
}
?>
<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">

<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($_POST['sectorId'])){echo "Sector toevoegen";} else {echo "Sector wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/sectoren" class="buttonback">&nbsp;Terug</a>
</p>

<form id="frmSector" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/sector.control.php" class="form-horizontal" enctype="multipart/form-data">
            <div class="control-group">
                 <label for="naamSector" class="control-label">SECTOR:</label>
                 <div class="controls"><input id="naamSector" name="naamSector" type="text" autofocus="true" value="<?php if(isset($result)) {echo $result[0]['secNaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                  <label for="infoSector" class="control-label">EXTRA INFO:</label>
                  <div class="controls"><textarea id="infoSector" name="infoSector" rows="5" cols="40" placeholder="max 255 karakters" style="resize: none"><?php if(isset($result)) {echo $result[0]['secInfo'];} ?></textarea></div>
            </div>
                        
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" type="hidden" value="<?php if(isset($result)) {echo $result[0]['secID'];} ?>">
            </div>  
                   
            <div class="control-group">
                <div class="controls">
                <?php
                if(empty($_POST['sectorId']))
                {    
                ?>
                <button id="btnSectorSave" name="btnSectorSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnSectorCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                <?php
                }
                else
                {
                ?>
                <button id="btnSectorUpdate" name="btnSectorUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
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