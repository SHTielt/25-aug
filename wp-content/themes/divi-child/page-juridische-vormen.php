<?php get_header();?>

<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">
<?php
$rvObject = new RechtsVorm();
$rechtsVormen = $rvObject->selectAll();
?>
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;Juridische vormen</strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>

<div id="actionsdiv">
            <a href="http://localhost:8080/sociaalhuis/juridische-vorm-formulier" class="pull-left buttonadd">&nbsp;Juridische vorm toevoegen</a>
            <a onclick="window.print()" class="pull-right btnprint"><i class="icon-print icon-large"></i>&nbsp;Afdrukken</a>
            <a id="btnexcel" class="pull-right btnexport">&nbsp;Exporteer naar Excel</a>
</div>
<table id="rechtsVormenTabel">
<thead>
<tr>
<th class="sorteer alfabet sh_rvnaam">Juridische vorm</th>
<th class="sorteer alfabet sh_rvinfo">Juridische vorm info</th>
<th class="sh_actie">Actie</th>
</tr>
</thead>
<tbody>
<?php
foreach($rechtsVormen as $rechtsVorm)
{
    $i = $rechtsVorm['rvID'];
?>
<tr>
<td><?php  echo $rechtsVorm['rvNaam']; ?></td>
<td><?php  echo $rechtsVorm['rvInfo']; ?></td>
<td class="sh_actie">
<form method="post" action="http://localhost:8080/sociaalhuis/juridische-vorm-formulier" class="sh_form_edit">
    <input name="rechtsVormId" value="<?php echo $i; ?>" type="hidden" />
    <input type="submit" value="Editeer" class="btnedit" /> 
</form>
<button id="<?php echo "rvBtnDelete".$i?>" class="btndelete">Wis</button>
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