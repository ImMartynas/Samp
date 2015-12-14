<?php
$rezz = mysql_query('SELECT id,Vardas,Admin,Direktorius FROM profiliai WHERE id='.$_SESSION['Logged']);
$newestrow = mysql_fetch_array($rezz);
if ($_SESSION['Logged']>0 && $newestrow['Admin']>1 && $_GET['acc']>0) {

	//gaunamas VVP vartotojo ID iš adreso
	$accid = $_GET['acc'];
	if($accid == "489") echo '<div class="errorbox">Informacija įslaptinta</div>';
	else
	{
	//Pirmasis jungimasis prie MySQL gauti VVP vartotojo duomenims.
	$result = mysql_query('SELECT * FROM accounts WHERE id='.$accid);
	$row = mysql_fetch_array($result);

	//Jeigu IP neturimas, padarome, kad tai rašytų žodžiais.
	if($row['regip'] == "000.000.000.000"){
		$regip = 'Nėra informacijos';
	} else {
		$regip = $row['regip'];
	}
	if($row['lastip'] == "000.000.000.000"){
		$lastip = 'Nėra informacijos';
	} else {
		$lastip = $row['lastip'];
	}
//Ieškome, kokius veikėjus turi šis VVP vartotojas.
$resultCHAR1 = mysql_query('SELECT * FROM players WHERE id='.$row['accid1']);
$rowCHAR1 = mysql_fetch_array($resultCHAR1);
$resultCHAR2 = mysql_query('SELECT * FROM players WHERE id='.$row['accid2']);
$rowCHAR2 = mysql_fetch_array($resultCHAR2);

//Jeigu vartotojų nėra - parašome tai.
if($row['accid1'] > 0){
$char1 = $rowCHAR1['Name'];
$id1 = $rowCHAR1['id'];
} else {
$char1 = "Nesukurtas";
$id1 = "0";
}
if($row['accid2'] > 0){
$char2 = $rowCHAR2['Name'];
$id2 = $rowCHAR2['id'];
} else {
$char2 = "Nesukurtas";
$id2 = "0";
}

//Išvedame visą informaciją
echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">' .$row['name']. '</span><br/>
<div style="background-color:#f3eacd;border:1px solid #a28522;color:#a28522;padding:12px">';
echo 'IP adresas, kuriuo registravosi: ' .$regip. '<br/>
IP paskutinio prisijungimo metu: ' .$lastip. ' | <a href="/findacc?ip=' .$lastip. '">Tikrinti</a>'; if ($_SESSION['Admin']>1) echo ' | <a href="/banip?whichIP=' .$lastip. '">Drausti lankytis VVP</a><br />
Paskutinis prisijungimas: ' .$row['lastlogin']. '<br />
El. paštas: ' .$row['email']. '';
echo '<br />VVP įspėjimai: ' .$row['ucpwarns']. ' | <a href="/warn?acc=' .$accid. '" onClick=\'return confirmPost()\'>Įspėti vartotoją</a><br />
VVP administravimo lygis: ' .$row['admin']. '</div><br/><br/>';
echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">
<span style="font-size:14px;font-weight:bold">Turimi veikėjai:</span><br />
Pirmasis veikėjas: ' .$char1. ' (ID: '. $id1. ', priėmė: ' .$rowCHAR1['accepted']. ')<br/>
Antrasis veikėjas: ' .$char2. ' (ID: '. $id2. ', priėmė: ' .$rowCHAR2['accepted']. ')<br/>
</div>';

}
}
else header('Location: /home');
?>