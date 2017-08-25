<?php get_header();?>
<?php
//contactvoorkeuren ophalen
$cvObject = new ContactVoorkeur(); 
$contactVoorkeuren = $cvObject->selectAll();
print_r($contactVoorkeuren);

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

<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($_POST['vrijwilligerId'])){echo "Vrijwilliger personalia toevoegen";} else {echo "Vrijwilliger personalia wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/vrijwilligers" class="buttonback">&nbsp;Terug</a>
</p>

<form id="frmVrijwilliger" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/vrijwilligerspool/appcode/control/vrijwilligerpersonalia.control.php" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validateFrm()">
            <div class="control-group">
                 <label for="voornaamVrijwilliger" class="control-label">VOORNAAM:</label>
                 <div class="controls"><input id="voornaamVrijwilliger" name="voornaamVrijwilliger" type="text" autofocus="true" value="<?php if(isset($result)) {echo $result[0]['vrVoornaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                 <label for="naamVrijwilliger" class="control-label">NAAM:</label>
                 <div class="controls"><input id="naamVrijwilliger" name="naamVrijwilliger" type="text" value="<?php if(isset($result)) {echo $result[0]['vrNaam'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                 <label for="adresVrijwilliger" class="control-label">ADRES:</label>
                 <div class="controls"><input id="adresVrijwilliger" name="adresVrijwilliger" type="text" value="<?php if(isset($result)) {echo $result[0]['vrAdres'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                 <label for="postcodeVrijwilliger" class="control-label">POSTCODE:</label>
                 <div class="controls"><input id="postcodeVrijwilliger" name="postcodeVrijwilliger" type="text" value="<?php if(isset($result)) {echo $result[0]['vrPostCode'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
                 <label for="gemeenteVrijwilliger" class="control-label">GEMEENTE:</label>
                 <div class="controls"><input id="gemeenteVrijwilliger" name="gemeenteVrijwilliger" type="text" value="<?php if(isset($result)) {echo $result[0]['vrGemeente'];} ?>" required><span class="asterisk_input"></span></div>
            </div>
            
            <div class="control-group">
            <label for="gbdVrijwilliger" class="control-label">GEBOORTEDATUM:&nbsp;</label>
            <div class="controls">
                 <input id="gbdVrijwilliger" name="gbdVrijwilliger" type="date" value="<?php if(isset($result)) {echo $result[0]['vrGeboorteDatum'];} ?>" required><span class="asterisk_input"></span><!--verschijnt in html5 datumformaat-->
            </div>
            </div>
            
            <div class="control-group">
                 <label for="emailVrijwilliger" class="control-label">E-MAIL:</label>
                 <div class="controls"><input id="emailVrijwilliger" name="emailVrijwilliger" type="text" value="<?php if(isset($result)) {echo $result[0]['vrEmail'];} ?>"></div>
            </div>
            
            <div class="control-group">
                 <label for="gsmVrijwilliger" class="control-label">GSM:</label>
                 <div class="controls"><input id="gsmVrijwilliger" name="gsmVrijwilliger" type="text" value="<?php if(isset($result)) {echo $result[0]['vrGSM'];} ?>"></div>
            </div>
            
            <div class="control-group">
                 <label for="telVrijwilliger" class="control-label">TELEFOON:</label>
                 <div class="controls"><input id="telVrijwilliger" name="telVrijwilliger" type="text" value="<?php if(isset($result)) {echo $result[0]['vrTelefoon'];} ?>"></div>
            </div>
            
            <div class="control-group">
            <label for="cvVrijwilliger" class="control-label">CONTACT VOORKEUR:</label>
            <div class="controls">
            <select id="cvVrijwilliger" name="cvVrijwilliger" required><span class="asterisk_input"></span>
                <option></option>
                <?php
                    foreach($contactVoorkeuren as $cv)
                    {
                ?>
                <option value="<?php echo $cv['cvID'];?>" <?php if($result[0]['cvID'] == $cv['cvID']) {echo "selected";}?>><?php echo $cv['cvVoorkeur'];?></option>
                <?php
                    }
                ?>
            </select>
            </div>
            </div>
            
            <div class="control-group">
                  <label for="infoVrijwilliger" class="control-label">EXTRA INFO:</label>
                  <div class="controls">
                  	<textarea id="infoVrijwilliger" name="infoVrijwilliger" rows="5" cols="40" placeholder="max 255 karakters" style="resize: none"><?php if(isset($result)) {echo $result[0]['vrInfo'];} ?></textarea>
                  </div>
            </div>
            
            <div class="control-group">
                <label for="actiefVrijwilliger" class="control-label">ACTIEF:</label>
                <div class="controls">
                	<div><input id="actiefVrijwilliger" name="actiefVrijwilliger" type="checkbox" value="1" <?php echo ($result[0]['vrActief'] == 1)? 'checked' : '' ;?>></div>
               	</div>
            </div>
            
            <div class="control-group">
                 <input id="idHidden" name="idHidden" type="hidden" value="<?php if(isset($result)) {echo $result[0]['vrID'];} ?>">
            </div>  
                   
            <div class="control-group">
                <div class="controls">
                <?php
                if(empty($_POST['vrijwilligerId']))
                {    
                ?>
                <button id="btnVrijwilligerSave" name="btnVrijwilligerSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnVrijwilligerCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                <?php
                }
                else
                {
                ?>
                <button id="btnVrijwilligerUpdate" name="btnVrijwilligerUpdate" type="submit" class="btnupdate">&nbsp;Wijzigen</button>
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