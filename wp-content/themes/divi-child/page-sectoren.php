<?php get_header();?>

<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">
<?php
$sectorObject = new Sector();
$sectoren = $sectorObject->selectAll();
?>
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;Sectoren</strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>

<div id="actionsdiv">
            <a href="http://localhost:8080/sociaalhuis/sector-formulier/" class="pull-left buttonadd">&nbsp;Sector toevoegen</a>
            <a onclick="window.print()" class="pull-right btnprint"><i class="icon-print icon-large"></i>&nbsp;Afdrukken</a>
            <a id="btnexcel" class="pull-right btnexport">&nbsp;Exporteer naar Excel</a>
</div>
<table id="sectorenTabel">
<thead>
<tr>
<th class="sorteer alfabet sh_secnaam">Sector</th>
<th class="sorteer alfabet sh_secinfo">Sector info</th>
<th class="sh_actie">Actie</th>
</tr>
</thead>
<tbody>
<?php
foreach($sectoren as $sector)
{
    $i = $sector['secID'];
?>
<tr>
<td><?php  echo $sector['secNaam']; ?></td>
<td><?php  echo $sector['secInfo']; ?></td>
<td class="sh_actie">
<form method="post" action="http://localhost:8080/sociaalhuis/sector-formulier/" class="sh_form_edit">
    <input name="sectorId" value="<?php echo $i; ?>" type="hidden" />
    <input type="submit" value="Editeer" class="btnedit" /> 
</form>
<button id="<?php echo "secBtnDelete".$i?>" class="btndelete">Wis</button>
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