<?php

//get functie
function getFunctie($funcId)
{
	$funcObject = new Functie();
	$result = $funcObject->selectFunctieById($funcId);
	echo $result[0]['funcNaam'];
}

//get contact voorkeur
function getContactVoorkeur($cvId)
{
	$cvObject = new ContactVoorkeur();
	$result = $cvObject->selectContactVoorkeurById($cvId);
	echo $result[0]['cvVoorkeur'];
}

//get sector
function getSector($secId)
{
	$secObject = new Sector();
	$result = $secObject->selectSectorById($secId);
	echo $result[0]['secNaam'];
}

//get juridische vorm
function getRechtsVorm($cvId){
	$cvObject = new RechtsVorm();
	$result = $cvObject->selectRechtsVormById($cvId);
	echo $result[0]['rvNaam'];
}

if(isset($_POST['verenigingId']))
{
$verenigingId = $_POST['verenigingId'];
//echo $verenigingId;


$verObject = new Vereniging();
$gezochteVereniging = $verObject->selectVerenigingbyId($verenigingId);

//1.fotonaam ophalen
$fotoObject = new Foto();
$gezochteFoto = $fotoObject->selectFotoByVerenigingId($verenigingId);
$fotoNaam = $gezochteFoto[0]['fNaam'];
//echo "fotonaam: ".$fotoNaam;

//2. bestuursleden ophalen
$bestuurderObject = new Bestuurder();
$bestuur = $bestuurderObject->selectBestuurderbyVerenigingId($verenigingId);
//print_r($bestuur);

//3.contactpersoon ophalen
$contObject = new ContactPersoon();
$contactPersoon = $contObject->selectContactPersoonByVerenigingId($verenigingId);
//print_r($contactPersoon);

//4. sectoren van vereniging ophalen
$versecObject = new VerenigingSector();
$versectoren = $versecObject->selectSectorenByVerenigingId($verenigingId);


}//einde if isset

?>
<a href="http://localhost:8080/sociaalhuis/tieltse-organisaties" class="buttonback" title="Terug naar Tieltse organisaties">&nbsp;Terug</a>
<h1 style="margin-top: 1em;"><?php echo $gezochteVereniging[0]['verNaam'];?></h1>

<div id="omschrijving" style="text-align:justify;" class="onderdeel">
<div id="imagediv" style="width: 250px; float:left; padding-right: 1em;">
<?php if(!empty($fotoNaam))
{
?>
<img src="<?php echo sprintf("http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/view/fotouploads/thumbs/%s",$fotoNaam); ?>" alt="<?php echo $fotoNaam;?>" title="<?php echo $vereniging['verNaam'];?>" />
<?php
}
else {
	echo "geen logo/foto";
}
?>
</div>
<?php echo $gezochteVereniging[0]['verOmschrijving'];?>	
</div>
<div style="clear: both;"></div>

<div id="werkingsgebied" class="onderdeel">
<h3>Werkingsgebied</h3>	
<?php echo $gezochteVereniging[0]['verWerkingsGebied'];?>
</div>

<div id="contactpersoon" class="onderdeel">
<h3 style="display: inline-block;">Contactpersoon</h3><span> voor nieuwe leden</span><br />
<?php
if(!empty($contactPersoon))
{
if(!empty($contactPersoon[0]['contNaam']))
{
?>
<div><?php echo "Naam: ".$contactPersoon[0]['contVoornaam']." ".$contactPersoon[0]['contNaam'];?></div>
<?php
}
?>
<?php if(!empty($contactPersoon[0]['contEmail']))
{
?>
<div><?php echo "E-mail adres: "; echo htmlentities($contactPersoon[0]['contEmail']); ?></div>
<?php
}
?>
<?php if(!empty($contactPersoon[0]['contGSM']))
{
?>
<div><?php echo "GSM: ".$contactPersoon[0]['contGSM'];?></div>
<?php
}
?>
<?php if(!empty($contactPersoon[0]['contTelefoon']))
{
?>
<div><?php echo "Telefoon: ".$contactPersoon[0]['contTelefoon'];?></div>
<?php
}
?>
<?php if(!empty($contactPersoon[0]['cvID']))
{
?>
<div><?php echo "Contact voorkeur: "; getContactVoorkeur($contactPersoon[0]['cvID']);?></div>
<?php
}
}//end main if
else {
	echo "Momenteel is er geen contactpersoon opgegeven.";
}
?>
</div>
	
<div id="bestuur" class="onderdeel">
<h3>Bestuursleden</h3>
<?php if(!empty($bestuur))
{
?>
<table id="bestuursTabel">
<thead>
	<tr><th>Naam</th><th>Functie</th><th>E-mail adres</th><th>GSM</th><th>Telefoon</th><th>Contact voorkeur</th></tr>
</thead>
<tbody>
    <?php
        foreach($bestuur as $bestuurder)
        {
    ?>
    <tr><td><?php  echo $bestuurder['bestVoornaam']." ".$bestuurder['bestNaam']; ?></td>
    	<td><strong><?php getFunctie($bestuurder['funcID']);?></strong></td>
    	<td><?php  echo htmlentities($bestuurder['bestEmail']); ?></td>
    	<td><?php  echo $bestuurder['bestGSM']; ?></td>
    	<td><?php  echo $bestuurder['bestTelefoon']; ?></td>
    	<td><?php  getContactVoorkeur($bestuurder['cvID']); ?></td>
    </tr>
    <?php
        }//end foreach
    ?>
</tbody>
</table>
<?php
}
else {
	echo "Momenteel zijn er geen bestuursleden opgegeven.";
}
?>
</div><!--einde bestuur-->

<div id="sectoren" class="onderdeel">
<h3>Sectoren</h3>	
<?php
//print_r($versectoren);
foreach($versectoren as $versec){
	getSector($versec['secID']);
	echo " ";
}
?>
</div>

<div id="rechtsvorm" class="onderdeel">
<h3>Juridische vorm</h3>	
<?php
getRechtsVorm($gezochteVereniging[0]['rvID']);
?>
</div>

<div id="internet">
	<?php if(!empty($gezochteVereniging[0]['verWebsite']))
	{
	?>
	<a href="<?php echo sprintf("http://%s",$gezochteVereniging[0]['verWebsite']);?>" target="_blank"><img style="padding-right:0.5em;" id="#www" src="http://localhost:8080/sociaalhuis/wp-content/themes/divi-child/icons/world-wide-web_40.jpg" alt="world-wide-web" title="<?php echo $gezochteVereniging[0]['verWebsite'];?>" /></a>
	<?php
	}
	?>
	<?php if(!empty($gezochteVereniging[0]['verFacebook']))
	{
	?>
	<a href="<?php echo sprintf("http://%s",$gezochteVereniging[0]['verFacebook']);?>" target="_blank"><img style="padding-left:0.5em;" id="#fb" src="http://localhost:8080/sociaalhuis/wp-content/themes/divi-child/icons/facebook_40.png" alt="facebook" title="<?php echo "Facebook pagina van ".$gezochteVereniging[0]['verNaam'];?>" /></a>
	<?php
	}
	?>
</div>
	
