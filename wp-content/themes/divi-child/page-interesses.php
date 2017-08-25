<?php get_header();?>

<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">
<?php
$intObject = new Interesse();
$interesses = $intObject->selectAll();
//print_r($interesses);
?>
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;Interesses: <?php echo count($interesses)?> rijen</strong>
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
            <a href="http://localhost:8080/sociaalhuis/interesse-formulier" class="buttonadd">&nbsp;Interesse toevoegen</a>
            <a onclick="window.print()" class="pull-right btnprint"><i class="icon-print icon-large"></i>&nbsp;Afdrukken</a>
            <a id="btnexcel" class="pull-right btnexport">&nbsp;Exporteer naar Excel</a>
</div>
<table id="interessesTabel">
<thead>
<tr>

<th class="sorteer alfabet sh_intnaam">Interesse</th>
<th class="sorteer alfabet sh_intinfo">Interesse info</th>
<th class="sh_intactief">Actief</th>
<th class="sh_actie">Actie</th>
</tr>
</thead>
<tbody>
<?php
foreach($interesses as $interesse)
{
    $i = $interesse['intID'];
?>
<tr>
<td><?php  echo $interesse['intNaam']; ?></td>
<td><?php  echo $interesse['intInfo']; ?></td>
<td><?php  if($interesse['intActief'] == 1) {echo "Ja";} else {echo "Neen";}?></td>
<td class="sh_actie">
<form method="post" action="http://localhost:8080/sociaalhuis/interesse-formulier/" class="sh_form_edit">
    <input name="interesseId" value="<?php echo $i; ?>" type="hidden" />
    <input type="submit" value="Editeer" class="btnedit" title="edit" /> 
</form>
<button id="<?php echo "intBtnDelete".$i?>" title="wis" class="btndelete">Wis</button>
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