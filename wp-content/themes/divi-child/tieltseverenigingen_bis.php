<?php
//alle sectoren ophalen
$secObject = new Sector();
$sectoren = $secObject->selectAll();
?>

<?php
if(isset($_POST['verBtnFilter']) && $_POST['secSelect'] != 0)
{
	//gefilterde verenigingen ophalen	
	$sectorId = $_POST['secSelect'];
	//echo "sectorId: ".$sectorId;
	$verObject = new Vereniging();
	$verenigingen = $verObject->filterVerenigingenbySector($sectorId);
	//var_dump($verenigingen);
}
else
{
	//alle verenigingen ophalen
	$verObject = new Vereniging();
	$verenigingen = $verObject->selectAll();
	
}
	
?>
<div id="tieltverdiv">
	
<div id="sectordiv">
<form method="post" action="http://localhost:8080/sociaalhuis/tieltse-organisaties">
<select id="secSelect" name="secSelect" class="pull-left">
                            <option id="sec0" value="0"></option> 
                            <option id="sec4" value="4" <?php if(!empty($sectorId))  { if($sectorId == 4) {echo "selected";} }?>>Senioren</option>
                            <option id="sec5" value="5" <?php if(!empty($sectorId)) { if($sectorId == 5) {echo "selected";} }?>>Welzijn</option>
</select>
<input type="submit" name="verBtnFilter" class="pull-left btnfilter" value="Filteren op sector" >
</form>
</div>

<div id="pagdiv" >
<label id="paginatie">
                    <select size="1" id="aantalPaginas">
                        <option></option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>&nbsp;rijen per pagina
</label>
</div>

<div id="zoekdiv">
<label id="filtering">
                Zoek:&nbsp;<input type="text" id="filter">
</label>
</div>

</div><!--einde tieltverdiv-->
<div style="clear: both;"></div>

<table id="tieltseVerenigingenTabel">
	<!--
<thead>
<tr>
	<th class="image">&nbsp;</th>
	<th class="vernaam">&nbsp;</th>
	<th class="verbesch">&nbsp;</th>
	<th class="detail">&nbsp;</th>
</tr>
</thead>
-->
<tbody>
<?php
//selectie op actieve verenigingen
foreach($verenigingen as $vereniging)
{
	
if($vereniging['verActief'] == 1)
{
	$verenigingId = $vereniging['verID'];	
	//print_r($vereniging);
	
    $fotoObject = new Foto();
	$gezochteFoto = $fotoObject->selectFotoByVerenigingId($verenigingId);
?>


<tr>
<td class="image"><?php
if(!empty($gezochteFoto))
{
$fotoNaam = $gezochteFoto[0]['fNaam'];
?>
<img src="<?php echo sprintf("http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/view/fotouploads/thumbs/%s",$fotoNaam); ?>" alt="<?php echo $fotoNaam;?>" title="<?php echo $vereniging['verNaam'];?>" />	
<?php
}
else
{
	echo "geen logo/foto";
}
?></td>
<td class="vernaam">
<strong><?php echo $vereniging['verNaam'];?></strong>		
</td>
<td class="verbesch">
	<?php echo $vereniging['verBeschrijving'];?>
</td>
<td class="detail">
	<form method="post" action="http://localhost:8080/sociaalhuis/organisatie-details">
	<input type="hidden" id="verenigingId" name="verenigingId" value="<?php echo $verenigingId;?>">
	<input type="submit" value="Details" class="btndetails" >
</form>	
</td>
</tr>	
	
<?php
}//einde if foto actie
}//einde foreach
?>
</tbody>
</table>
<div class="paging"></div>
