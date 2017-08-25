<?php
/*
Plugin Name: Tielt vrijwilligt
Description: Een plugin om een databank van vrijwilligers en verenigingen aan te leggen ten behoeve van het Sociaal Huis Tielt
Author: RE
Version: 1.0
*/

/*
if (!defined('SH_ABS_PATH')) {
define('SH_ABS_PATH',"C:\\wamp64\\www\\sociaalhuis\\");
}
 */

if (!defined('SH_PLUGIN_PATH')) {
    define('SH_PLUGIN_PATH', dirname(__FILE__)."\\");    /*oftewel _DIR_*/
}

//0. load wp core functies
//require_once SH_ABS_PATH.'wp-load.php';
require_once ABSPATH.'wp-load.php';

//1. needed model files
/*helper klassen dienen voor de modelklassen te staan*/
require_once SH_PLUGIN_PATH.'appcode\helpers\feedback.class.php';
require_once SH_PLUGIN_PATH.'appcode\helpers\base.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\vrijwilliger.class.php';
require_once SH_PLUGIN_PATH.'appcode\model\interesse.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/deelwerking.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/beschikbaarheid.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/status.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/contactvoorkeur.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/foto.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/vrijwilligerinteresse.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/vrijwilligerdeelwerking.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/vrijwilligerbeschikbaarheid.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/rechtsvorm.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/sector.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/vereniging.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/verenigingsector.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/bestuurder.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/contactpersoon.class.php';
require_once SH_PLUGIN_PATH.'appcode/model/functie.class.php';


//2. not needed: control files, because not called from scratch
require_once SH_PLUGIN_PATH.'appcode/control/functie.control.php';

/*3. You don't have to use session_start() on top of each page; instead you should add a function in init hook.*/
function session_initialize() {

    if ( ! session_id() ) {
        session_start();
    }
}
add_action( 'init', 'session_initialize' );
?>