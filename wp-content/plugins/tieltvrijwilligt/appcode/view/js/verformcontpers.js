function controleerEmail() {
	            var patroon = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/;
                var email = jQuery("#emailContactPersoon").val().toUpperCase();
                if (patroon.test(email))
                    return true;
                else {
                    return false;
                }
}
  
            
            
function foutBijEmail(zichtbaar) {
	            //plaatst foutmelding en kleurt inputveld geel
                if (zichtbaar && jQuery("#emailContactPersoon.foutveld").length == 0) {
                	jQuery("#emailContactPersoon").after("<br /><span class='foutmelding'>Dit email adres is onjuist.</span><br />");
                    jQuery("#emailContactPersoon").addClass('foutveld');
                    jQuery("#emailContactPersoon").focus();
                }
                //verwijdert foutmelding en ontkleurt inputveld
                if (!zichtbaar && jQuery("#emailContactPersoon.foutveld").length != 0) {
                	jQuery("#emailContactPersoon").next().remove(); //verwijdert de eerste br tag
                    jQuery("#emailContactPersoon").next().remove();
                    jQuery("#emailContactPersoon").next().remove(); //verwijdert de laatste br tag
                    jQuery("#emailContactPersoon").removeClass('foutveld');
                }
}
            
            
function formInvullen(ar){
	jQuery("#voornaamContactPersoon").attr('value',ar['bestVoornaam']);
	jQuery("#naamContactPersoon").attr('value', ar['bestNaam']);
	jQuery("#infoContactPersoon").val(ar['bestInfo']);
	jQuery("#emailContactPersoon").attr('value', ar['bestEmail']);
	jQuery("#gsmContactPersoon").attr('value', ar['bestGSM']);
	jQuery("#telContactPersoon").attr('value', ar['bestTelefoon']);
	jQuery("#cvContactPersoon").val(ar['cvID']);
	//met de jQuery methode val lukt het verzenden van de form niet meer na ajax
	
    //document.getElementById("voornaamContactPersoon").value = ar['bestVoornaam'];
    //document.getElementById("voornaamContactPersoon").innerHTML = ar['bestVoornaam'];
	//document.getElementById("naamContactPersoon").value = ar['bestNaam'];
    //document.getElementById("naamContactPersoon").innerHTML = ar['bestNaam'];
    //document.getElementById("emailContactPersoon").value = ar['bestEmail'];
    //document.getElementById("emailContactPersoon").innerHTML = ar['bestEmail'];
    //document.getElementById("gsmContactPersoon").value = ar['bestGSM'];
    //document.getElementById("gsmContactPersoon").innerHTML = ar['bestGSM'];
    //document.getElementById("telContactPersoon").value = ar['bestTelefoon'];
    //document.getElementById("telContactPersoon").innerHTML = ar['bestTelefoon'];
    //jQuery("#cvContactPersoon").val(ar['cvID']);
    
    //jQuery('input:not([name="idContactPersoon"],[name="idVereniging"])').prop('disabled', true);
	//jQuery('textarea').prop('disabled', true);
    //jQuery('#cvContactPersoon').attr('selected', '-1');
    //door de inpuvelden te disabelen lukt het verzenden van de form niet meer na ajax
}


jQuery(document).ready(function () {

    //1. hide red bar
    jQuery("#sluitinfo").click(function () {
        jQuery("#rodebalk").hide();
    });
    
    //2.of of
    /*
    jQuery("#bestContactPersoon").change(function() {
    	
    	var waarde = jQuery('#bestContactPersoon option:selected').val();
    	if(waarde != 0 ) //bestuurslid gekozen
    	{
    		alert('waarde' + waarde);
    		jQuery('input:not([name="idVereniging"],[name="idContactPersoon"])').val('');
    		//jQuery('input:not([name="idContactPersoon"])').val('');
    		jQuery('textarea').val('');
    		jQuery("#cvContactPersoon").val('0');
    		//jQuery('input:not([name="idVereniging"])').prop('disabled', true);
    		jQuery('input:not([name="idContactPersoon"],[name="idVereniging"])').prop('disabled', true);
    		jQuery('textarea').prop('disabled', true);
    		jQuery('#cvContactPersoon').prop('disabled', true);	
    		var naam = jQuery("#naamContactPersoon").val();
    		alert('naam' + naam);
    		var verid = jQuery("#idVereniging").val();
    		alert('ver' + verid);
    		var cp = jQuery("#idContactPersoon").val();
    		alert('cp' + cp);
   	}
    	else //geen bestuurslid gekozen
    	{
    		//alert('waarde' + waarde);
    		jQuery('input').prop('disabled', false);
    		jQuery('textarea').prop('disabled', false);
    		jQuery('#cvContactPersoon').prop('disabled', false);	
    	}
    	
    });
    */
    
    //3. ajax 
    
    jQuery('#bestContactPersoon').change(function(){
    	var bestuurderId = jQuery('#bestContactPersoon option:selected').val();
    	alert(bestuurderId);
    	if(bestuurderId != 0 ) //bestuurslid gekozen
    	{
    		var xmlhttp = new XMLHttpRequest();
        	xmlhttp.onreadystatechange = function () {
             	//alert(xmlhttp.readyState);
               	//alert(xmlhttp.status);
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    	//alert(xmlhttp.responseText);//responseText is een string van een JSON object. Deze staat niet tussen single of dubele quotes.
                    	var ar = JSON.parse(xmlhttp.responseText); //ar is een JSON object
                    	//JSON object inkijken
                        var lengte = Object.keys(ar).length ;
                        //alert(lengte);  
                        var hoogsteindex = lengte/2 - 1;   
                        //alert(hoogsteindex);
                        /* 
                        for (var i = 0; i <= hoogsteindex; i++)
                        {
                        	alert(ar[i]);
                        	document.write(ar[i] + " ");
                        	document.write("<br />");
                        }
                        */
                        formInvullen(ar);
                        
                    }
        	};
              
        xmlhttp.open("GET", "http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/view/ajax.php?bestuurderid=" + bestuurderId, true); 
        xmlhttp.send();//noodzaakt get methode
        }
    	
    	
    	
    });//einde change
        
    
    
    //3. validatie email adres
    jQuery("#emailContactPersoon").change(function () {
    var correctEmail = controleerEmail();
    foutBijEmail(!correctEmail);
    });  
    
   
  
});             //einde ready event


