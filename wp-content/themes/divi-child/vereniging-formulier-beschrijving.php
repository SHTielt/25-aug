<?php
//get rechtsvormen
$rvObject = new RechtsVorm(); 
$rechtsVormen = $rvObject->selectAll(); 

//sectoren ophalen
$secObject = new Sector(); 
$sectoren = $secObject->selectAll(); 


function checkSector($sectorIds, $sectorId)
{
    foreach($sectorIds as $secid)
    {
        if($secid == $sectorId) {echo "checked";}
    }
}

//komende van verenigingbeschrijving.control.php
if(isset($_SESSION['laatsteid']))
{
	$verObject = new Vereniging();
    $verId = $_SESSION['laatsteid'];
	//echo "verenigingid: ".$verId;
    $verObject->setVerenigingId($verId);//nodig voor hidden field
    $result = $verObject->selectVerenigingById($verId);
	//print_r($result);

    //sectoren ophalen van 1 vereniging
    $versecObject = new VerenigingSector();
    $sectorenVanVereniging = $versecObject->selectSectorenByVerenigingId($verId);
    
    $sectorIds = array();
    foreach($sectorenVanVereniging as $sv)
    {
        array_push($sectorIds, $sv['secID']);
    }
    //echo "sectorIds: ";
	//print_r($sectorIds);
}

//komende van overzicht verenigingen

if(isset($_POST['verenigingId']))
{
    $verObject = new Vereniging();
    $verId = $_POST['verenigingId'];
	//echo "verenigingid: ".$verId;
    $verObject->setVerenigingId($verId);//nodig voor hidden field
    $result = $verObject->selectVerenigingById($verId);
	//print_r($result);

    //sectoren ophalen van 1 vereniging
    $versecObject = new VerenigingSector();
    $sectorenVanVereniging = $versecObject->selectSectorenByVerenigingId($verId);
    
    $sectorIds = array();
    foreach($sectorenVanVereniging as $sv)
    {
        array_push($sectorIds, $sv['secID']);
    }
    //echo "sectorIds: ";
	//print_r($sectorIds);
}
else
{
    $verObject = new Vereniging();
    $verObject->setVerenigingId("");
}
?>
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($_POST['verenigingId']) && empty($_SESSION['laatsteid'])){echo "Vereniging beschrijving toevoegen";} else {echo "Vereniging beschrijving wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
<a href="http://localhost:8080/sociaalhuis/verenigingen" class="buttonback" title="Terug naar verenigingen">&nbsp;Terug</a>
<?php if(!empty($_POST['verenigingId']) || !empty($_SESSION['laatsteid']))
{
?>
 <a href="<?php echo "http://localhost:8080/sociaalhuis/vereniging-formulier-bestuur?verenigingid=".$verId;?>" class="pull-right buttonnext" title="<?php echo "Naar bestuur van ".$result[0]['verNaam']; ?>">&nbsp;Naar bestuur</a> 
<?php	
}
?>
           
</p>

<form id="frmVereniging" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/verenigingbeschrijving.control.php" class="form-horizontal" enctype="multipart/form-data" >
            <div class="control-group">
                 <label for="naamVereniging" class="control-label">NAAM:</label>
                 <div class="controls"><input id="naamVereniging" name="naamVereniging" autofocus="true" type="text" value="<?php if(isset($result)) {echo $result[0]['verNaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                 <label for="locatieVereniging" class="control-label">LOCATIE:</label>
                 <div class="controls"><input id="locatieVereniging" name="locatieVereniging" type="text" value="<?php if(isset($result)) {echo $result[0]['verLocatie'];} ?>"></div>
            </div>
            
            <div class="control-group">
                 <label for="beschrijvingVereniging" class="control-label">KORTE BESCHRIJVING:</label>
                 <div class="controls"><input id="beschrijvingVereniging" name="beschrijvingVereniging" type="text" placeholder="max 50 karakters" value="<?php if(isset($result)) {echo $result[0]['verBeschrijving'];} ?>"></div>
            </div>
            
            <div class="control-group">
                 <label for="omschrijvingVereniging" class="control-label">OMSCHRIJVING:</label>
                 <div class="controls"><textarea id="omschrijvingVereniging" name="omschrijvingVereniging" placeholder="max 1000 karakters" rows="10" cols="100" required><?php if(isset($result)) {echo $result[0]['verOmschrijving'];} ?></textarea><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                 <label for="werkingsGebiedVereniging" class="control-label">WERKINGSGEBIED:</label>
                 <div class="controls"><input id="werkingsGebiedVereniging" name="werkingsGebiedVereniging" type="text" value="<?php if(isset($result)) {echo $result[0]['verWerkingsGebied'];} ?>"></div>
            </div>
            
            <div class="control-group">
            <label for="websiteVereniging" class="control-label">WEBSITE:&nbsp;</label>
            <div class="controls">
                 <input id="websiteVereniging" name="websiteVereniging" type="text" placeholder="www.voorbeeld.be" value="<?php if(isset($result)) {echo $result[0]['verWebsite'];} ?>" >
            </div>
            </div>
            
            <div class="control-group">
                 <label for="facebookVereniging" class="control-label">FACEBOOK:</label>
                 <div class="controls"><input id="facebookVereniging" name="facebookVereniging" type="text" placeholder="www.facebook.com/voorbeeld" value="<?php if(isset($result)) {echo $result[0]['verFacebook'];} ?>"></div>
            </div>
            
            <div class="control-group">
            <label for="rvVereniging" class="control-label">JURIDISCHE VORM:</label>
            <div class="controls">
            <select id="rvVereniging" name="rvVereniging" required>
                <option value=""></option>
                <?php
                    foreach($rechtsVormen as $rv)
                    {
                ?>
                <option value="<?php echo $rv['rvID'];?>" <?php if($result[0]['rvID'] == $rv['rvID']) {echo "selected";}?>><?php echo $rv['rvNaam'];?></option>
                <?php
                    }
                ?>
            </select><span class="asterisk_input"></span>
            </div>
            </div>
            
            
            <div class="control-group">
                  <label for="sectorenVrijwilliger" class="control-label">SECTOREN:</label>
                  <div class="controls">
                  	<div id="sectorenfieldset">
                    <?php foreach($sectoren as $sector)  
                    {
                        $i = $sector['secID'];
                    ?>
                        <input class="uniform_sec" type="checkbox" name="sector[]" value="<?php echo $sector['secID']; ?>" <?php if(isset($sectorIds)){ checkSector($sectorIds, $i);} ?> > <?php echo $sector['secNaam']; ?><br />
                    <?php
                    }
                    ?>
                    </div>
                    <span class="asterisk_input"></span>
                  </div>
            </div>
            
            
            <div class="control-group">
                <label for="actiefVereniging" class="control-label">ACTIEF:</label>
                <div class="controls">
                	<div><input id="actiefVereniging" name="actiefVereniging" type="checkbox" value="1" <?php echo ($result[0]['verActief'] == 1)? 'checked' : '' ;?>></div>
               	</div>
            </div>
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" type="hidden" value="<?php if(isset($result)) {echo $result[0]['verID'];} ?>">
            </div> 
            
            <div class="control-group">
                 <input id="wpUserID" name="wpUserID" type="hidden" value="<?php if(isset($result)) {echo $result[0]['verWPUserID'];} ?>">
            </div>  
            
            <div class="control-group">
                <div class="controls">
                <?php
                if(empty($_POST['verenigingId']) && empty($_SESSION['laatsteid']))
                {    
                ?>
                <button id="btnVerenigingSave" name="btnVerenigingSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnVerenigingCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                <?php
                }
                else
                {
                ?>
                <button id="btnVerenigingUpdate" name="btnVerenigingUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
                <?php
                unset($_SESSION['laatsteid']);
                }
                ?>
                </div>
            </div>          
         </form>