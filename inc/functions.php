<?php
// Patikrins duomenu bazeje ar yra šio IP irašas
function CheckIfUCPBanned($ip) {
	$result = mysql_query('SELECT reason,admname FROM ucpbans WHERE ip=\''. $ip .'\'');
	if ($row = mysql_fetch_array($result)) {
		echo '<center><img src="images/stop.png"></center><br/><div class="errorbox"><center>Jums yra u&#382;drausta lankytis MGRP &#382;aid&#279;jo valdymo sistemoje.</center><br /><br />Prie&#382;astis: <b>'. $row['reason'] .'</b><br/>U&#382;draud&#279;: <b>'. $row['admname'] .'</b><br /><center>Apeliacijos <a href="http://rp.gta-mp.lt/forum/viewforum.php?f=107">&#269;ia.</a></center></div>';
		return true;
	}
	else return false;
}
//patikrinam ar VVP vartotojas užrakintas
function CheckIfUCPLocked($accid) {
	$resultLOCK = mysql_query('SELECT ucpwarns FROM accounts WHERE id=\''. $accid .'\'');
	$rowLOCK = mysql_fetch_array($resultLOCK);
		if($rowLOCK['ucpwarns'] > 2) {
			echo '<center><img src="images/stop.png"><div class="errorbox">&#352;is VVP vartotojas u&#382;rakintas.</div><center>';
			return true;
		} else {
			return false;
		}
}
//emailo tikrinimo funkcija
function check_email_address($email) {

	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email))
	{
		return false;
	}
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++)
	{
		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i]))
			{ 
				return false;
			}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
	// Pažiūrim ar domenas ne IP
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2)
		{
			return false;
		// per mažai adreso dalių
		}
		for ($i = 0; $i < sizeof($domain_array); $i++)
		{
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i]))
			{
				return false;
			}
		}
 }
 return true;
 }
 
 //prisijungusių vartotojų skaičiavimas
function users_online($who) { 
 	$resultlog = mysql_query('SELECT admin,lastlogin,logged FROM accounts');
	$time2 = mktime(date("H"),date("i")+20,date("s"),date("m"),date("d"),date("Y"));
	$time = date("Y-m-d H:i:s", $time2);
	$online = '0';
	$onlineadm = '0';
	if ($who == "users") 
	{
		while ($rowlog = mysql_fetch_array($resultlog))
		{
			if ($rowlog['lastlogin'] >= $time && $rowlog['logged'] > 0)
			{
			$online++;
			}
		}
		return $online;
	}	
	elseif ($who == "adm")
	{
		while ($rowlog = mysql_fetch_array($resultlog))
		{
			if ($rowlog['lastlogin'] >= $time && $rowlog['logged'] > 0 && $rowlog['admin'] > 0)
			{
			$onlineadm++;
			}
		}
		return $onlineadm;
	}
}
  //Funckija patikrinti ar veikėjo varde nėra LT raidžių
function nick_lt($s) {
	$forbidden = array('ą', 'č', 'ę', 'ė', 'į', 'š', 'ų', 'ū', 'ž', 'Ą', 'Č', 'Ę', 'Ė', 'Į', 'Š', 'Ų', 'Ū', 'Ž');
	foreach ($forbidden as $f)
		if (strpos($s, $f) != false) return false;
	return true;
}
?>