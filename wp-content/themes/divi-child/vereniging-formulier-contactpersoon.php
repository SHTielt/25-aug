<?php

//komende van vereniging bestuur
if(isset( $_GET['verenigingid']))
{
	$verenigingId = $_GET['verenigingid'];
	//echo "verenigingid: ".$verenigingId;
}
else
{
	$verenigingId = "";
	//echo "verenigingid: ".$verenigingId;
}

//bestuursleden van de vereniging ophalen
$bestObject = new Bestuurder();
$bestuursLeden = $bestObject->selectBestuurderbyVerenigingId($verenigingId);
//print_r($bestuursLeden) ;

//contactpersoon van de vereniging ophalen
$cpObject = new ContactPersoon();
$cPersoon = $cpObject->selectContactPersoonByVerenigingId($verenigingId);
//print_r($cPersoon);

//contactvoorkeuren ophalen
$cvObject = new ContactVoorkeur(); 
$contactVoorkeuren = $cvObject->selectAll();

//naam van de vereniging ophalen
$verObject = new Vereniging();
$gezochteVer = $verObject->selectVerenigingById($verenigingId);
 

?>


<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($cPersoon)){echo "Contactpersoon toevoegen";} else {echo "Contactpersoon wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>

<?php if(empty($cPersoon))
{
?>	
<p style="padding-bottom: 1em;">Gelieve een bestuurslid als contactpersoon aan te duiden of voer de data van een nieuwe persoon in.</p>
<?php
}
else
{
?>
<p style="padding-bottom: 1em;">Gelieve een ander bestuurslid als contactpersoon aan te duiden of wijzig de data van de contactpersoon.</p>
<?php
}
?>
<div id="actionsdiv">
    <a href="<?php echo "http://localhost:8080/sociaalhuis/vereniging-formulier-bestuur?verenigingid=".$verenigingId; ?>" class="buttonback" title="<?php echo "Terug naar bestuur van ".$gezochteVer[0]['verNaam']; ?>">&nbsp;Terug</a>
    <a href="<?php echo "http://localhost:8080/sociaalhuis/vereniging-formulier-logo?verenigingid=".$_GET['verenigingid']; ?>" class="pull-right buttonadd" title="<?php echo "Naar logo/foto van ".$gezochteVer[0]['verNaam']; ?>">&nbsp;Naar logo/foto</a>
</div>

<form id="frmContactPersoon" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/contactpersoon.control.php" class="form-horizontal" enctype="multipart/form-data">
            <div class="control-group">
            <label for="bestContactPersoon" class="control-label">BESTUURSLID:</label>
            <div class="controls">
            <select id="bestContactPersoon" name="bestContactPersoon">
                <option value="0">Kies bestuurslid</option>
                <?php
                    foreach($bestuursLeden as $bestuursLid)
                    {
                ?>
                <option value="<?php echo $bestuursLid['bestID'];?>" ><?php echo $bestuursLid['bestVoornaam']." ".$bestuursLid['bestNaam'];?></option>
                <?php
                    }
                ?>
            </select>
            </div>
            </div> 
            
            <hr style="width:90%; margin-bottom: 1.5em;"/>
                       
            <div class="control-group">
                 <label for="voornaamContactPersoon" class="control-label">VOORNAAM:</label>
                 <div class="controls"><input id="voornaamContactPersoon" name="voornaamContactPersoon" type="text"  value="<?php if(isset($cPersoon)) {echo $cPersoon[0]['contVoornaam'];} ?>" required autofocus="true"><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                 <label for="naamContactPersoon" class="control-label">NAAM:</label>
                 <div class="controls"><input id="naamContactPersoon" name="naamContactPersoon" type="text" value="<?php if(isset($cPersoon)) {echo $cPersoon[0]['contNaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                  <label for="infoContactPersoon" class="control-label">EXTRA INFO:</label>
                  <div class="controls">
                  	<textarea id="infoContactPersoon" name="infoContactPersoon" rows="5" cols="40" placeholder="max 255 karakters" style="resize: none"><?php if(isset($cPersoon)) {echo $cPersoon[0]['contInfo'];} ?></textarea>
                  </div>
            </div>
            
            <div class="control-group">
                 <label for="emailContactPersoon" class="control-label">E-MAIL:</label>
                 <div class="controls"><input id="emailContactPersoon" name="emailContactPersoon" type="text" value="<?php if(isset($cPersoon)) {echo $cPersoon[0]['contEmail'];} ?>"></div>
            </div>
            
            <div class="control-group">
                 <label for="gsmContactPersoon" class="control-label">GSM:</label>
                 <div class="controls"><input id="gsmContactPersoon" name="gsmContactPersoon" type="text" value="<?php if(isset($cPersoon)) {echo $cPersoon[0]['contGSM'];} ?>"></div>
            </div>
            
            <div class="control-group">
                 <label for="telContactPersoon" class="control-label">TELEFOON:</label>
                 <div class="controls"><input id="telContactPersoon" name="telContactPersoon" type="text" value="<?php if(isset($cPersoon)) {echo $cPersoon[0]['contTelefoon'];} ?>"></div>
            </div>
            
            <div class="control-group">
            <label for="cvContactPersoon" class="control-label">CONTACT VOORKEUR:</label>
            <div class="controls">
            <select id="cvContactPersoon" name="cvContactPersoon">
                <option></option>
                <?php
                    foreach($contactVoorkeuren as $cv)
                    {
                ?>
                <option value="<?php echo $cv['cvID'];?>" <?php if($cPersoon[0]['cvID'] == $cv['cvID']) {echo "selected";}?>><?php echo $cv['cvVoorkeur'];?></option>
                <?php
                    }
                ?>
            </select>
            </div>
            </div>
            
            <div class="control-group">
                 <input id="idContactPersoon" name="idContactPersoon" type="hidden" value="<?php if(isset($cPersoon)) {echo $cPersoon[0]['contID'];} ?>">
            </div> 
                       
            <div class="control-group">
                 <input id="idVereniging" name="idVereniging" type="hidden" value="<?php echo $verenigingId; ?>">
            </div>  
                   
            <div class="control-group">
                <div class="controls">
                <?php
                if(empty($cPersoon))
                {    
                ?>
                <button id="btnContactPersoonSave" name="btnContactPersoonSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnContactPersoonCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                <?php
                }
                else
                {
                ?>
                <button id="btnContactPersoonUpdate" name="btnContactPersoonUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
              
                <?php
                }
                ?>
                </div>
            </div>          
</form>


