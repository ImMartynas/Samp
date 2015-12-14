<?php

if ($_SESSION['Logged']>0 && $_SESSION['Admin']>0) {

	$resultas = mysql_query('SELECT COUNT(charname) FROM pendingchars WHERE reason is NULL');
	$rowas = mysql_fetch_array($resultas);
	echo '<div style="color:#8b610f;padding:10px;border:2px solid #8b610f;background-color:#ecdfc6">
		
<span style="font-size:16px;font-weight:bold">Būk atidus!</span><br /><br />
Visuomet patikrink, ar žaidėjo yra tam tikro formato (Vardas_Pavarde). Taip pat varde negali būti lietuviškų raidžių. Netingėk ir perskaityk visą istoriją prieš atmesdamas ar priimdamas ją.

</div><br /><b>Nepatikrintų anketų: ' .$rowas['COUNT(charname)']. '</b>
<br /><b>Prisijungusių tikrintojų: ' .users_online(adm). '</b>
<br /><br />
';

	$result = mysql_query('SELECT * FROM pendingchars ORDER by submited');
	$bright = false;
	$count = false;
	$howmuch = 0;
		
	while ($row = mysql_fetch_array($result)) {
		if ($row['reason'] == NULL) {
			$count = true;
			echo '<div style="margin:5px;padding:15px;';
			if ($bright) {
				echo 'background-color:#f4f3f0;border:1px solid #a0a0a0';
				$bright = false;
			}
			else {
				echo 'background-color:#e5ecf9;border:1px solid #9da9bf';
				$bright = true;
			}
			$accid = $row['accid'];
			$result2 = mysql_query('SELECT * FROM accounts WHERE id='. $accid .'');
			$row2 = mysql_fetch_array($result2);
			$accNAME = $row2['name'];
			if($row['submited'] != NULL){
			$submited = $row['submited'];
			} else {
			$submited = "informacijos nėra";
			}
			$metai = date('Y') - $row['age'];
			echo '"> <p align="right">Pateikimo data: '.$submited.'</p>
<b>Žaidėjo vardas:</b> '. $row['charname'] .'<br /> 
<b>Gimimo metai:</b> '. $row['age'] .' (' .$metai. ')<br /><br />

<b>Kas yra "powergame"? Kas yra "metagame"? Savais žodžiais paaiškinkite ir nurodykite pavyzdžių.</b><br />
'. $row['pgmg'] .'<br /><br />

<b>Kas yra "deathmatch"? Paaiškinkite jo šakas, kaip "revenge kill" ir "spawn kill". Pateikite pavyzdžių.</b><br />
'. $row['dmrktt'] .'<br /><br />

<b>Kur dar esate žaidę ir kiek laiko? Parašykite taip pat ir žaidėjų vardus.</b><br />
'. $row['history'] .'<br /><br />

<b>Dabar įsivaizduokite, kad jus partrenkė mašina. Kaip "suroleplayintumėte" šią situaciją?</b><br />
'. $row['carcrashrp'] .'<br /><br />

<b>Dabar įsivaizduokite, kad Jūs važiuojate mašina ir į jus atsitrenkia kitas žmogus. Kaip "suroleplayintumėte" šią situaciją?</b><br />
'. $row['carscrash'] .'<br /><br />

<div style="text-align:right;font-size:14px">

<a href="/accept?accid='. $accid .'">Priimti</a> | <a href="javascript:;" onclick="document.getElementById(\'reason-'. $accid .'\').innerHTML=\'<form action=\\\'/deny?accid='. $accid .'\\\' method=\\\'post\\\'>Priežastis: <input name=\\\'reason\\\' type=\\\'text\\\' maxlength=\\\'299\\\' /> <input type=\\\'submit\\\' value=\\\'Atmesti\\\' /></form>\';">Atmesti</a>

<span id="reason-'. $accid .'"></span><br/>

</div>
<div style="color:#8b610f;padding:10px;border:1px solid #8b610f;background-color:#ecdfc6"><span style="font-size:10px;font-weight:bold"><b>VVP slapyvardis:</b> <a href="/checkacc?acc='. $accid. '" title="Informacija apie '. $accNAME. '">'. $accNAME. '</a> | <a href="/warn?acc=' .$accid. '" onClick=\'return confirmPost()\'>Įspėti vartotoją</a>'; if ($_SESSION['Admin']>1){ echo ' | <a href="/banip?whichIP=' .$row2['lastip']. '">Drausti lankytis VVP</a>'; } echo '</span></div>
</div>
<br />
';
			}
		}
		if (!$count) echo '<div class="errorbox"><i>Žaidėjo aplikacijų nėra</i></div>';
}
else header('Location: /home');

?>