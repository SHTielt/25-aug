<?php get_header();?>

<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">
<?php
$dwObject = new DeelWerking();
$deelWerkingen = $dwObject->selectAll();
?>
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;Deelwerkingen: <?php echo count($deelWerkingen)?> rijen</strong>
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
            <a href="http://localhost:8080/sociaalhuis/deelwerking-formulier/" class="pull-left buttonadd">&nbsp;Deelwerking toevoegen</a>
            <a onclick="window.print()" class="pull-right btnprint"><i class="icon-print icon-large"></i>&nbsp;Afdrukken</a>
            <a id="btnexcel" class="pull-right btnexport">&nbsp;Exporteer naar Excel</a>
</div>
<table id="deelwerkingenTabel">
<thead>
<tr>
<th class="sorteer alfabet sh_dwnaam">Deelwerking</th>
<th class="sorteer alfabet sh_dwinfo">Deelwerking info</th>
<th class="sh_dwactief">Actief</th>
<th class="sh_actie">Actie</th>
</tr>
</thead>
<tbody>
<?php
foreach($deelWerkingen as $deelWerking)
{
    $i = $deelWerking['dwID'];
?>
<tr>
<td><?php  echo $deelWerking['dwNaam']; ?></td>
<td><?php  echo $deelWerking['dwInfo']; ?></td>
<td><?php  if($deelWerking['dwActief'] == 1) {echo "Ja";} else {echo "Neen";} ?></td>
<td class="sh_actie">
<form method="post" action="http://localhost:8080/sociaalhuis/deelwerking-formulier/" class="sh_form_edit">
    <input name="deelwerkingId" value="<?php echo $i; ?>" type="hidden" />
    <input type="submit" value="Editeer" class="btnedit" title="edit" /> 
</form>
<button id="<?php echo "dwBtnDelete".$i?>" title="wis" class="btndelete">Wis</button>
</td>
</tr>
<?php }//end foreach ?>
</tbody>
</table>
</section>		
</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>