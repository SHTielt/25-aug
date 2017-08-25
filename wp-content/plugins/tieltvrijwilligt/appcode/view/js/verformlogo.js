
jQuery(document).ready(function () {

    //1. hide red bar
    jQuery("#sluitinfo").click(function () {
        jQuery("#rodebalk").hide();
    });
    
    //2. verwijder foto
    jQuery("#btnVerenigingFotoDelete").on("click", deleteFoto);
      
});             //einde ready event

function deleteFoto() {
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

                var r = confirm("Bent u zeker om deze foto te verwijderen?");
                if(r == true)
                {
                    window.location.href = 'http://localhost:8080/sociaalhuis/wp-content/plugins/tieltvrijwilligt/appcode/control/vrijwilligerfoto.control.php';
                    //zonder return false wordt de action URL van het formulier genomen; 
                }
                             
                                
            } //end deleteFoto
