function controleerEmail() {
	            var patroon = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/;
                var email = jQuery("#emailBestuurder").val().toUpperCase();
                if (patroon.test(email))
                    return true;
                else {
                    return false;
                }
}
            
            
function foutBijEmail(zichtbaar) {
	            //plaatst foutmelding en kleurt inputveld geel
                if (zichtbaar && jQuery("#emailBestuurder.foutveld").length == 0) {
                	jQuery("#emailBestuurder").after("<br /><span class='foutmelding'>Dit email adres is onjuist.</span><br />");
                    jQuery("#emailBestuurder").addClass('foutveld');
                    jQuery("#emailBestuurder").focus();
                }
                //verwijdert foutmelding en ontkleurt inputveld
                if (!zichtbaar && jQuery("#emailBestuurder.foutveld").length != 0) {
                	jQuery("#emailBestuurder").next().remove(); //verwijdert de eerste br tag
                    jQuery("#emailBestuurder").next().remove();
                    jQuery("#emailBestuurder").next().remove(); //verwijdert de laatste br tag
                    jQuery("#emailBestuurder").removeClass('foutveld');
                }
}

jQuery(document).ready(function () {

    //1. hide red bar
    jQuery("#sluitinfo").click(function () {
        jQuery("#rodebalk").hide();
    });
    
    
	//2. email validatie
    jQuery("#emailBestuurder").change(function () {
    var correctEmail = controleerEmail();
    foutBijEmail(!correctEmail);
    });        
	
    
   
  
});             //einde ready event

