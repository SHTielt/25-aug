<?php get_header();?>

<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">
<?php
//alle sectoren ophalen
$secObject = new Sector();
$sectoren = $secObject->selectAll();

//sector ophalen
function getSector($sectorId)
{
	$secObject = new Sector();
	$result = $secObject->selectSectorbyId($sectorId);
	echo $result[0]['secNaam'];
}

if(isset($_POST['verBtnFilter']) && $_POST['secSelect'] != 0)
{
	$sectorId = $_POST['secSelect'];
	//echo "sectorId: ".$sectorId;
	$verObject = new Vereniging();
	$verenigingen = $verObject->filterVerenigingenbySector($sectorId);
	//var_dump($verenigingen);
}
else
{
	$verObject = new Vereniging();
	$verenigingen = $verObject->selectAll();	
	//var_dump($verenigingen);
}
?>
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;Verenigingen: <?php echo count($verenigingen)?> rijen</strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>
          
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


<div id="actionsdiv">
            <a href="http://localhost:8080/sociaalhuis/vereniging-formulier-beschrijving" class="pull-left buttonadd">&nbsp;Vereniging toevoegen</a>
            <div id="filterdiv">
<form method="post" action="http://localhost:8080/sociaalhuis/verenigingen">

<select id="secSelect" name="secSelect" class="pull-left">
                            <option id="sec0" value="0"></option> 
                            <?php
                            foreach($sectoren as $sector)
                            {
                            ?>
                            <option id="<?php echo "sec".$sector['secID']; ?>" value="<?php echo $sector['secID'];?>" <?php if(!empty($sectorId))
                            {
                            	if($sectorId == $sector['secID'])
                            	{
                            		echo "selected";}
								}?>>
							<?php echo $sector['secNaam'];?></option> 
                            <?php
                            }
                            ?>
</select>
<input type="submit" name="verBtnFilter" class="pull-left btnfilter" value="Filteren op sector" >
</form>
</div>  
            <a onclick="window.print()" class="pull-right btnprint"><i class="icon-print icon-large"></i>&nbsp;Afdrukken</a>
            <a id="btnexcel" class="pull-right btnexport">&nbsp;Exporteer naar Excel</a>
</div>
<table id="verenigingenTabel">
<thead>
<tr>
<th class="sorteer alfabet sh_vernaam">Naam</th>
<th class="sorteer alfabet sh_verlocatie">Locatie</th>
<th class="sorteer alfabet sh_verwebsite">Website</th>
<th class="sh_veractief">Actief</th>
<th class="sh_actie">Actie</th>
</tr>
</thead>
<tbody>
<?php
if(count($verenigingen) != 0)
{
	

foreach($verenigingen as $vereniging)
{
    $i = $vereniging['verID'];
?>
<tr>
<td style="overflow: hidden;"><?php  echo $vereniging['verNaam']; ?></td>
<td style="overflow: hidden;"><?php  echo $vereniging['verLocatie']; ?></td>
<td style="overflow: hidden;"><a href="<?php  echo "http://".$vereniging['verWebsite']; ?>" target="_blank"><?php echo $vereniging['verWebsite']; ?></a></td>
<td><?php  if($vereniging['verActief'] == 1) {echo "Ja";} else {echo "Neen";} ?></td>
<td class="sh_actie">
<form method="post" action="http://localhost:8080/sociaalhuis/vereniging-formulier-beschrijving" class="sh_form_edit">
    <input name="verenigingId" value="<?php echo $i; ?>" type="hidden" />
    <input type="submit" value="Editeer" class="btnedit" /> 
</form>
<button id="<?php echo "verBtnDelete".$i?>" class="btndelete">Wis</button>
</td>
</tr>
<?php
}//end foreach
}//end if
else
{
?>
<tr>
<td colspan="5">
<?php
echo "Er zijn geen verenigingen van de sector ";getSector($sectorId);
?>	
</td>	
</tr>
<?php
}
?>
</tbody>
</table>
<div class="paging"></div>
</section>		
</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>