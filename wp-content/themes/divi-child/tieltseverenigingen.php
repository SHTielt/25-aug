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
<div class="row-fluid">
                <label id="paginatie">
                    <select size="1" id="aantalPaginas">
                        <option></option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>&nbsp;rijen per pagina
                </label>
                <label id="filtering">
                Zoek:&nbsp;<input type="text" id="filter">
                </label>
</div>

<div id="filteren">
<form method="post" action="http://localhost:8080/sociaalhuis/tieltse-organisaties">
<select id="secSelect" name="secSelect" class="pull-left">
                            <option id="sec0" value="0"></option> 
                            <option id="sec4" value="4" <?php if(!empty($sectorId))  { if($sectorId == 4) {echo "selected";} }?>>Senioren</option>
                            <option id="sec5" value="5" <?php if(!empty($sectorId)) { if($sectorId == 5) {echo "selected";} }?>>Welzijn</option>
</select>
<input type="submit" name="verBtnFilter" class="pull-left btnfilter" value="Filteren op sector" >
</form>
</div>
<div style="clear: both;"></div>
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

<div class="vereniging">
<div class="image">
<?php
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
?>
</div>

<div class="vernaam">
<strong><?php echo $vereniging['verNaam'];?></strong>	
</div>

<div class="verbesch">
<?php echo $vereniging['verBeschrijving'];?>	
</div>

<!--
<div style="display:inline-block; width: 250px;">
<a href="<?php echo sprintf("http://%s",$vereniging['verWebsite']);?>" target="_blank" class="verlink"><?php echo $vereniging['verWebsite'];?></a>	
</div>
-->

<div class="detail">
<form method="post" action="http://localhost:8080/sociaalhuis/vereniging-details">
	<input type="hidden" id="verenigingId" name="verenigingId" value="<?php echo $verenigingId;?>">
	<input type="submit" value="Details" class="btndetails" >
</form>	
</div>
<div style="clear: both;"></div>
</div><!--einde vereniging-->
	
<?php
}//einde if foto actie
}//einde foreach
?>
