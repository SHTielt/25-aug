<?php get_header();?>
<?php
$userName = isset($_SESSION['username'])? $_SESSION['username'] : "";
$password = isset($_SESSION['password'])? $_SESSION['password'] : "";
$foutMeldingGebruikersnaam = isset($_SESSION['foutmeldinggebruikersnaam'])? $_SESSION['foutmeldinggebruikersnaam'] : "";
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['foutmeldinggebruikersnaam']);

 
?>
<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">

<div id="rodebalk" class="alert-info">
                <strong>&nbsp;<?php if(empty($_POST['vrijwilligerId'])){echo "Vrijwilliger account toevoegen";} else {echo "Vrijwilliger account wijzigen";}?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
<p>
            <a href="http://localhost:8080/sociaalhuis/vrijwilligers" class="buttonback">&nbsp;Terug</a>
</p>

<form id="frmVrijwilligerAccount" method="POST" action="http://localhost:8080/sociaalhuis/wp-content/plugins/vrijwilligerspool/appcode/control/vrijwilligeraccount.control.php" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validateAccount()">
            <div class="control-group">
                 <label for="gebruikersnaamVrijwilliger" class="control-label">GEBRUIKERSNAAM:</label>
                 <div class="controls"><input id="gebruikersnaamVrijwilliger" name="gebruikersnaamVrijwilliger" type="text" autofocus="true" value="<?php echo $userName;?>" required>
                 	<span class="asterisk_input"></span>
                 	<span id="message1" class="sh_message"><?php echo $foutMeldingGebruikersnaam; ?></span>
                 </div>
            	 
            </div>
            
            <div class="control-group">
                 <label for="wachtwoordVrijwilliger" class="control-label">WACHTWOORD:</label>
                 <div class="controls"><input id="wachtwoordVrijwilliger" name="wachtwoordVrijwilliger" type="text" value="<?php echo $password; ?>" required><span class="asterisk_input"></span></div>
            </div>
            
           
                   
            <div class="control-group">
                <div class="controls">
                
                <button id="btnVrijwilligerAccountSave" name="btnVrijwilligerAccountSave" type="submit" class="btnsave">&nbsp;Opslaan</button>
                <button id="btnVrijwilligerAccountCancel" type="reset" class="btncancel">&nbsp;Cancel</button>
                
                </div>
            </div>          
         </form>
</section>		
</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>