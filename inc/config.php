<?php

// Sutvarkome header() funkcijà
ob_start('ob_gzhandler');

$wp['accept'] = "/web/wb/page.php?q=accept";
$wp['addq'] = "/web/wb/page.php?q=addq";
$wp['adminlist'] = "/web/wb/page.php?q=adminlist";
$wp['banip'] = "/web/wb/page.php?q=banip";
$wp['banlist'] = "/web/wb/page.php?q=banlist";
$wp['changecharpass'] = "/web/wb/page.php?q=changecharpass";
$wp['changeemail'] = "/web/wb/page.php?q=changeemail";
$wp['changepass'] = "/web/wb/page.php?q=changepass";
$wp['checkacc'] = "/web/wb/page.php?q=checkacc";
$wp['checkchar'] = "/web/wb/page.php?q=checkchar";
$wp['deletechar'] = "/web/wb/page.php?q=deletechar";
$wp['deletecharreq'] = "/web/wb/page.php?q=deletecharreq";
$wp['deny'] = "/web/wb/page.php?q=deny";
$wp['factions'] = "/web/wb/page.php?q=factions";
$wp['findacc'] = "/web/wb/page.php?q=findacc";
$wp['forgotpass'] = "/web/wb/page.php?q=forgotpass";
$wp['givelead'] = "/web/wb/page.php?q=givelead";
$wp['help'] = "/web/wb/page.php?q=help";
$wp['home'] = "/web/wb/page.php?q=home";
$wp['logout'] = "/web/wb/page.php?q=logout";
$wp['logs'] = "/web/wb/page.php?q=logs";
$wp['newchar'] = "/web/wb/page.php?q=newchar";
$wp['news'] = "/web/wb/page.php?q=news";
$wp['newsadmin'] = "/web/wb/page.php?q=newsadmin";
$wp['online'] = "/web/wb/page.php?q=online";
$wp['player'] = "/web/wb/page.php?q=player";
$wp['players'] = "/web/wb/page.php?q=players";
$wp['profile'] = "/web/wb/page.php?q=profile";
$wp['register'] = "/web/wb/page.php?q=register";
$wp['serverinfo'] = "/web/wb/page.php?q=serverinfo";
$wp['unban'] = "/web/wb/page.php?q=unban";
$wp['vip'] = "/web/wb/page.php?q=vip";
$wp['warn'] = "/web/wb/page.php?q=warn";


// Pradedame sesija
session_start();

// MySQL duomenø bazës nustatymai
$config->Host = 'localhost';
$config->User = 'root';
$config->Pass = '';
$config->DB   = 'samp';

if(!isset($_SESSION['Logged']))	$_SESSION['Logged'] = 0;

$con = mysql_connect($config->Host,$config->User,$config->Pass);
if (!$con) die('<div class="errorbox">Nepavyko prisijungti prie duomenu bazes: '. mysql_error() .'</div>');
	
mysql_select_db($config->DB, $con);
//Áterpiama funkcijø biblioteka
include 'inc/functions.php';		
?>