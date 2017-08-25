
jQuery(document).ready(function () {
    		
            //1. filteren
    		jQuery("#filter").change(function () {
         	var tekst = jQuery(this).val();
         	jQuery("tbody tr").hide();
         	jQuery("tbody tr td:contains('" + tekst + "')").parent().show();
    		});
    		
    		//2. filteren
    		jQuery("#filter").change(function () {
         	var tekst = jQuery(this).val();
         	jQuery("tbody tr").hide();
         	jQuery("tbody tr td:contains('" + tekst + "')").parent().show();
    		});
    
            //3.paginatie
     		jQuery("#aantalPaginas").change(function () {
         	//alert('hi');
                    var ps = jQuery("#aantalPaginas option:selected").text();
                    //alert(ps);
                    if (ps == "") {
                        jQuery("#tieltseVerenigingenTabel").datatable('destroy');
                    }
                    else {
                        jQuery("#tieltseVerenigingenTabel").datatable({
                            pageSize: ps,
                            pagingNumberOfPages: 5
                        });
                        
                    };
            //class van td is verloren gegaan; opnieuw toevoegn
            jQuery("#tieltseVerenigingenTabel tbody tr td:first-child").attr('class','image');
            jQuery("#tieltseVerenigingenTabel tbody tr td:nth-child(2)").attr('class','vernaam');
            jQuery("#tieltseVerenigingenTabel tbody tr td:nth-child(3)").attr('class','verbesch');
            jQuery("#tieltseVerenigingenTabel tbody tr td:last-child").attr('class','detail');
      		});

});  //einde ready event


            

