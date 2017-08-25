<?php get_header();?>

<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">
<?php
function getVrijwilligerStatus($statusId) {
	if(isset($statusId))
	{
		$statusObject = new Status();
		$result = $statusObject->selectStatusById($statusId);
		$status = $result[0]['sNaam'];	
	}
	else
	{
		$status = "Niet gekeurd";	
	}
	echo $status;
}

$vrObject = new Vrijwilliger();
$vrijwilligers = $vrObject->selectAll();
?>
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;Vrijwilligers: <?php echo count($vrijwilligers)?> rijen</strong>
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
            <a href="http://localhost:8080/sociaalhuis/vrijwilliger-formulier/" class="pull-left buttonadd">&nbsp;Vrijwilliger toevoegen</a>
            <a onclick="window.print()" class="pull-right btnprint"><i class="icon-print icon-large"></i>&nbsp;Afdrukken</a>
            <a id="btnexcel" class="pull-right btnexport">&nbsp;Exporteer naar Excel</a>
</div>
<table id="vrijwilligersTabel">
<thead>
<tr>
<th class="sorteer alfabet sh_vrvoornaam">Voornaam</th>
<th class="sorteer alfabet sh_vrnaam">Naam</th>
<th class="sorteer alfabet sh_vrgeboortedatum">Geboortedatum</th>
<th class="sorteer alfabet sh_vrstatus">Status</th>
<th class="sh_vractief">Actief</th>
<th class="sh_actie">Actie</th>
</tr>
</thead>
<tbody>
<?php
foreach($vrijwilligers as $vrijwilliger)
{
    $i = $vrijwilliger['vrID'];
?>
<tr>
<td><?php  echo $vrijwilliger['vrVoornaam']; ?></td>
<td><?php  echo $vrijwilliger['vrNaam']; ?></td>
<td><?php  echo $vrijwilliger['vrGeboorteDatum']; ?></td>
<td><?php  getVrijwilligerStatus($vrijwilliger['sID']); ?></td>
<td><?php  if($vrijwilliger['dwActief'] == 1) {echo "Ja";} else {echo "Neen";} ?></td>
<td class="sh_actie">
<form method="post" action="http://localhost:8080/sociaalhuis/vrijwilliger-formulier-personalia/" class="sh_form_edit">
    <input name="vrijwilligerId" value="<?php echo $i; ?>" type="hidden" />
    <input type="submit" value="Editeer" class="btnedit" title="edit" /> 
</form>
<button id="<?php echo "vrBtnDelete".$i?>" title="wis" class="btndelete">Wis</button>
</td>
</tr>
<?php }//end foreach ?>
</tbody>
</table>
<div class="paging"></div>
</section>		
</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>