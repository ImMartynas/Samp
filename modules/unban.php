<?php

if ($_SESSION['Logged']>0 && $_SESSION['Admin']>1) {
	if (isset($_GET['ip'])){
	mysql_query('DELETE FROM ucpbans WHERE ip=\''. $_GET['ip'] .'\'');
	//STEB�JIMO PRAD�IA
	$logfailas = "modules/logs/ucp_unban_log.txt"; //Kad steb�tume, kas k� unbanina padarom log'�
	$duom = mysql_query('SELECT name FROM accounts WHERE id='. $_SESSION['Logged']);
	$nikas = mysql_fetch_array($duom);
	//�RA�IN�JIMAS
	$open = fopen($logfailas, 'a');
	$data = "$nikas[name] atbanino $_GET[ip]\n";
	fwrite($open, $data);
	fclose($open); 
	//PABAIGA
	header('Location: /banip');
	}
}
else header('Location: /home');

?>