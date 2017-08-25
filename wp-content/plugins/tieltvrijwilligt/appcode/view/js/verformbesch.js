function controleerBeschrijving(){
	var veld2 = jQuery("#beschrijvingVereniging").val();
	if (veld2.length >= 50) {
			return false;
	}
	else
	{
		return true;
	}
}

function foutBijBeschrijving(zichtbaar) {
                if (zichtbaar && jQuery("#beschrijvingVereniging.foutveld").length == 0) {
                    //plaatst rode foutmelding en kleurt inputveld geel
                    jQuery("#beschrijvingVereniging").after("<br /><span class='foutmelding'>Gelieve de korte beschrijving van de vereniging te beperken tot 50 karakters.</span><br />");
                    jQuery("#beschrijvingVereniging").addClass("foutveld");
                    jQuery("#beschrijvingVereniging").focus();
                    
                }
                //verwijdert foutmelding en ontkleurt inputveld
                if (!zichtbaar && jQuery("#beschrijvingVereniging.foutveld").length != 0) {
                    jQuery("#beschrijvingVereniging").next().remove(); //verwijdert de eerste br tag
                    jQuery("#beschrijvingVereniging").next().remove();
                    jQuery("#beschrijvingVereniging").next().remove(); //verwijdert de laatste br tag
                    jQuery("#beschrijvingVereniging").removeClass("foutveld");
                }
}

function controleerWebsite(){
	var veld1 = jQuery("#websiteVereniging").val();              
	if (veld1.match("^htt")) {
			return false;
	}
	else
	{
		return true;
	}
}

function foutBijWebsite(zichtbaar) {
                if (zichtbaar && jQuery("#websiteVereniging.foutveld").length == 0) {
                    //plaatst rode foutmelding en kleurt inputveld geel
                    jQuery("#websiteVereniging").after("<br /><span class='foutmelding'>Gelieve het webadres te niet beginnen met http:// of https://.</span><br />");
                    jQuery("#websiteVereniging").addClass("foutveld");
                    jQuery("#websiteVereniging").focus();
                    
                }
                //verwijdert foutmelding en ontkleurt inputveld
                if (!zichtbaar && jQuery("#websiteVereniging.foutveld").length != 0) {
                    jQuery("#websiteVereniging").next().remove(); //verwijdert de eerste br tag
                    jQuery("#websiteVereniging").next().remove();
                    jQuery("#websiteVereniging").next().remove(); //verwijdert de laatste br tag
                    jQuery("#websiteVereniging").removeClass("foutveld");
                }
}

function controleerFacebook(){
	var veld1 = jQuery("#facebookVereniging").val();              
	if (veld1.match("^htt")) {
			return false;
	}
	else
	{
		return true;
	}
}

function foutBijFacebook(zichtbaar) {
                if (zichtbaar && jQuery("#facebookVereniging.foutveld").length == 0) {
                    //plaatst rode foutmelding en kleurt inputveld geel
                    jQuery("#facebookVereniging").after("<br /><span class='foutmelding'>Gelieve het facebook webadres niet te beginnen met https://.</span><br />");
                    jQuery("#facebookVereniging").addClass("foutveld");
                    jQuery("#facebookVereniging").focus();
                    
                }
                //verwijdert foutmelding en ontkleurt inputveld
                if (!zichtbaar && jQuery("#facebookVereniging.foutveld").length != 0) {
                    jQuery("#facebookVereniging").next().remove(); //verwijdert de eerste br tag
                    jQuery("#facebookVereniging").next().remove();
                    jQuery("#facebookVereniging").next().remove(); //verwijdert de laatste br tag
                    jQuery("#facebookVereniging").removeClass("foutveld");
                }
}

jQuery(document).ready(function () {
	
	//1. hide red bar
    jQuery("#sluitinfo").click(function () {
        jQuery("#rodebalk").hide();
    });

    //2. validation max aantal sectoren
    //alert('hi');
    jQuery(".uniform_sec").change(function () {
        var max = 3;
        if (jQuery(".uniform_sec:checked").length == max) {
            jQuery(".uniform_sec").attr('disabled', 'disabled');
            alert('enkel 3 sectoren');
            jQuery(".uniform_sec:checked").removeAttr('disabled');
        }
        else {
            jQuery(".uniform_sec").removeAttr('disabled');
        }
    });
	
    //3. validatie min aantal sectoren
    jQuery('#frmVereniging').submit(function () {
        if (jQuery(".uniform_sec:checked").length == 0) 
        {
            alert('Gelieve tenminste één sector te kiezen.');
            return false;
        }
    });
    

       
    //4. validatie beschrijving
    jQuery("#beschrijvingVereniging").change(function () {
    var correctBeschrijving = controleerBeschrijving();
    foutBijBeschrijving(!correctBeschrijving);
    });
    
    //5. validatie website
    jQuery("#websiteVereniging").change(function () {
    var correctWebsite = controleerWebsite();
    foutBijWebsite(!correctWebsite);
    });
    
    //6. validatie facebook
    jQuery("#facebookVereniging").change(function () {
    var correctFacebook = controleerFacebook();
    foutBijFacebook(!correctFacebook);
    });
    
    
  
});             //einde ready event


 





            
            



