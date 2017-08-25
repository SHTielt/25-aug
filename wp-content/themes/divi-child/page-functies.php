<?php get_header();?>

<div id="main-content">
<div class="container">
<div id="content-area" class="clearfix">
<section id="content" class="sh_content">
<?php
$funcObject = new Functie();
$functies = $funcObject->selectAll();
?>
<div id="rodebalk" class="alert-info">
                <strong>&nbsp;Functies</strong>
                <button id="sluitinfo" type="button" class="close">&times;</button>    
</div>

<div id="actionsdiv">
            <a href="http://localhost:8080/sociaalhuis/functie-formulier" class="pull-left buttonadd">&nbsp;Functie toevoegen</a>
            <a onclick="window.print()" class="pull-right btnprint"><i class="icon-print icon-large"></i>&nbsp;Afdrukken</a>
            <a id="btnexcel" class="pull-right btnexport">&nbsp;Exporteer naar Excel</a>
</div>
<table id="functiesTabel">
<thead>
<tr>
<th class="sorteer alfabet sh_funcnaam">Functie</th>
<th class="sorteer alfabet sh_funcinfo">Functie info</th>
<th class="sh_actie">Actie</th>
</tr>
</thead>
<tbody>
<?php
foreach($functies as $functie)
{
    $i = $functie['funcID'];
?>
<tr>
<td><?php  echo $functie['funcNaam']; ?></td>
<td><?php  echo $functie['funcInfo']; ?></td>
<td class="sh_actie">
<form method="post" action="http://localhost:8080/sociaalhuis/functie-formulier" class="sh_form_edit">
    <input name="functieId" value="<?php echo $i; ?>" type="hidden" />
    <input type="submit" value="Editeer" class="btnedit" /> 
</form>
<button id="<?php echo "funcBtnDelete".$i?>" class="btndelete">Wis</button>
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