
jQuery(document).ready(function () {

    //1. hide red bar
    jQuery("#sluitinfo").click(function () {
        jQuery("#rodebalk").hide();
    });
    
    //2. bestuurder verwijderen
    jQuery("table").on("click", "button.btndelete", deleteBestuurder);
    
    //3. snel sorteren dankzij de expando sortKey
    var tabel = jQuery("#bestuurdersTabel");
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
  
});             //einde ready event

function deleteBestuurder() {
				alert('hi');
                var btnid = jQuery(this).attr("id"); //attribuut lezen in jQuery
                var id = btnid.substring(13);
                alert(id);
                
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

                var r = confirm("Bent u zeker om deze bestuurder te verwijderen?");
                if(r == true)
                {
                    window.location.href = 'http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/bestuurder.control.php?bestuurderid=' + id;
                    return false; //to prevent window.location.href is assigned badly;
                }
                             
                                
            } //end deleteBestuurder