   jQuery(document).ready(function () {
			//1. hide red bar
            jQuery("#sluitinfo").click(function () {
            jQuery("#rodebalk").hide();
            });
            
			//2. snel sorteren dankzij de expando sortKey
    		var tabel = jQuery("#verenigingenTabel");
            jQuery('th', tabel).each(function (columnIndex) {
            if (jQuery(this).is('.sorteer')) {
            var col = this;
            jQuery(this).click(function () {
            var rijen = tabel.find('tbody > tr');
            /*vooraf opslaan van keyA en keyB in sortKey*/
            jQuery.each(rijen, function (index, rij) {

            if (jQuery(col).is('.alfabet')) {
                    rij.sortKey = jQuery(rij).children('td').eq(columnIndex).text().toUpperCase();
            }

            if (jQuery(col).is('.getal')) {
                    var waarde = jQuery(rij).children('td').eq(columnIndex).text();
                    rij.sortKey = parseFloat(waarde);
            }
            });

            rijen.sort(function (a, b) {
                    if (a.sortKey < b.sortKey) return -1;
                    if (a.sortKey > b.sortKey) return 1;
                    return 0;
            });

            jQuery.each(rijen, function (index, rij) {
            tabel.children('tbody').append(rij);
            rij.sortKey = null;
            });

            }); //einde click event
            } //einde if sorteer
            }); //einde each
            	
            //3. filteren
    		jQuery("#filter").change(function () {
         	var tekst = jQuery(this).val();
         	jQuery("tbody tr").hide();
         	jQuery("tbody tr td:contains('" + tekst + "')").parent().show();
    		});
    
            

            //4.temporary feedback message
            if (jQuery("#message").text().trim().length != 0) {
                    var message = jQuery("#message").text();
                    alert(message);
            };//einde if

            

            //5. verwijder deelwerking
            jQuery("table").on("click", "button.btndelete", deleteVereniging);
            
            //6.export to excel
            jQuery("#btnexcel").click(function(){
            alert('hi');
            jQuery("#verenigingenTabel").table2excel({
        	// exclude CSS class
        	exclude: ".noExl",
        	name: "Verenigingen",
        	filename: "verenigingen", 
        	fileext: ".xls"
            });
     		});
     		
     		//7.paginatie
     		jQuery("#aantalPaginas").change(function () {
         	//alert('hi');
                    var ps = jQuery("#aantalPaginas option:selected").text();
                    //alert(ps);
                    if (ps == "") {
                        jQuery("#verenigingenTabel").datatable('destroy');
                    }
                    else {
                        jQuery("#verenigingenTabel").datatable({
                            pageSize: ps,
                            pagingNumberOfPages: 5
                        });
                    };
      		});
      		
      		//8. sectoren filteren
      		//jQuery("#secSelect").on("change", toonGefilterdeVerenigingen);
            
            //6. buttons in action column
            /*
            $(".btndelete").button(
            {
                  icons: { primary: "ui-icon-trash" }
            });

            $(".btnedit").button(
            {
                        icons: { primary: "ui-icon-pencil" }
            });
            */

            }); //einde ready event

			function toonGefilterdeVerenigingen(){
				alert('hi');
			}
			
            function deleteVereniging() {
                var btnid = jQuery(this).attr("id"); //attribuut lezen in jQuery
                var id = btnid.substring(12);
                
                //dialog widget bij verwijderen record
                /*
                $("#warningDeletion").dialog(
                {
                    buttons: [
                {
                    text: "Yes",
                    click: function () { window.location.href = '../control/projecttype.control.php?projecttypeid=' + id; }
                },
                {
                    text: "No",
                    click: function () { $(this).dialog("close"); }
                }]
                });
                */

                var r = confirm("Bent u zeker om deze vereniging en zijn sectoren, bestuursleden en foto/logo te verwijderen?");
                if(r == true)
                {
                    window.location.href = 'http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/verenigingbeschrijving.control.php?verenigingid=' + id;
                    return false; //to prevent window.location.href is assigned badly;
                }
                             
                                
            } //end deleteVereniging

            

 