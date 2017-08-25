
jQuery(document).ready(function () {
     
    jQuery("#sluitinfo").click(function () {
        alert('hi2');
        jQuery("#rodebalk").hide();
    });

});  //einde ready event


function validateFrm() {
//alert('hi4');
var veld1 = jQuery("#emailVrijwilliger").val();              
//alert(veld1);
var veld2 = jQuery("#gsmVrijwilliger").val();              
//alert(veld2);
var veld3 = jQuery("#telVrijwilliger").val();              
//alert(veld3);   
if((veld1 == '') && (veld2 == '') && (veld3 == '')) {
	alert('Gelieve tenminste een e-mail adres, een gsm-nummer of een telefoonnummer mee te delen.');
}				

 }
            

