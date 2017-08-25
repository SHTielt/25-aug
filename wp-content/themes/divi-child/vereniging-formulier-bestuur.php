<?php
//overzichtsformulier van bestuurders

 get_header();?>
<?php
//$_GET['verenigingid']) is nooit leeg want kan nt bereikt worden zonder URL met querystring
if(isset($_GET['verenigingid']))
{
	$bestObject = new Bestuurder();
	$verenigingId = $_GET['verenigingid'];
	$bestuurders = $bestObject->selectBestuurderByVerenigingId($verenigingId);	
	//print_r($bestuurders);
}

?>
<?php
//functie van bestuurslid ophalen
function getFunctie($funcId)
{
    $funcObject = new Functie();
    $result = $funcObject->selectFunctieById($funcId);
    echo $result[0]['funcNaam'];
}
?>
<?php
//naam van de vereniging ophalen
$verObject = new Vereniging();
$gezochteVer = $verObject->selectVerenigingById($verenigingId);

 
?>
<div id="overzichtBestuurders">
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;Bestuurders van <?php echo $gezochteVer[0]['verNaam']?></strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>

<div id="actionsdiv">
			<a href="http://localhost:8080/sociaalhuis/verenigingen" class="pull-left buttonback" title="Terug naar verenigingen">Terug</a>
            <a href="<?php echo "http://localhost:8080/sociaalhuis/vereniging-formulier-bestuurder?verenigingid=".$_GET['verenigingid']; ?>" class="pull-left buttonadd">&nbsp;Bestuurder toevoegen</a>
            <a href="<?php echo "http://localhost:8080/sociaalhuis/vereniging-formulier-contactpersoon?verenigingid=".$_GET['verenigingid']; ?>" class="pull-right buttonadd" title="<?php echo "Naar contactpersoon van ".$gezochteVer[0]['verNaam']; ?>">&nbsp;Naar contactpersoon</a>
            
</div>
<table id="bestuurdersTabel">
<thead>
<tr>
<th class="sorteer alfabet sh_bestvoornaam">Voornaam</th>	
<th class="sorteer alfabet sh_bestnaam">Naam</th>
<th class="sorteer alfabet sh_bestfunctie">Functie</th>
<th class="sorteer alfabet sh_bestemail">E-mail adres</th>
<th class="sh_actie">Actie</th>
</tr>
</thead>
<tbody>
<?php
if(count($bestuurders) == 0)
{
?>
<tr>
<td colspan="5">
<?php
	echo "Geen bestuurders.";
?>
</td>	
</tr>
<?php	
}
else
{
	

foreach($bestuurders as $bestuurder)
{
    $i = $bestuurder['bestID'];
?>
<tr>
<td><?php  echo $bestuurder['bestVoornaam']; ?></td>	
<td><?php  echo $bestuurder['bestNaam']; ?></td>
<td><?php  getFunctie($bestuurder['funcID']); ?></td>
<td><?php echo $bestuurder['bestEmail']; ?></td>
<td class="sh_actie">
	
<form method="post" action="<?php echo "http://localhost:8080/sociaalhuis/vereniging-formulier-bestuurder?verenigingid=".$_GET['verenigingid'] ?>" class="sh_form_edit">
    <input name="bestuurderId" value="<?php echo $i; ?>" type="hidden" />
    <input name="verenigingId" value="<?php echo $verenigingId; ?>" type="hidden" />
    <input type="submit" value="Editeer" class="btnedit" title="edit" /> 
</form>
<button id="<?php echo "bestBtnDelete".$i?>" title="wis" class="btndelete">Wis</button>

</td>
</tr>
<?php
}//end foreach
}//end else ?>
</tbody>
</table>
</div>

