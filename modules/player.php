<?php
$rezz = mysql_query('SELECT id,Vardas,Admin,Direktorius FROM profiliai WHERE id='.$_SESSION['Logged']);
$newestrow = mysql_fetch_array($rezz);
if ($_SESSION['Logged']>0 && $newestrow['Admin']>1 && $_GET['acc']>0) {

	$accid = $_GET['acc'];
	$result = mysql_query('SELECT Vardas,Warn,Banned,Admin FROM profiliai WHERE id='.$accid);
	$row = mysql_fetch_array($result);
		
		
	if($_GET['unwarn'] > 0 && $row['Warn'] > 0)
	{
		--$row['Warn'];
		//STEBĖJIMO PRADŽIA
		$logfailas = "modules/logs/unwarns_log.txt";
		$duom = mysql_query('SELECT Vardas FROM profiliai WHERE id='. $_SESSION['Logged']);
		$nikas = mysql_fetch_array($duom);
		$open = fopen($logfailas, 'a');
		$data = "$nikas[name] nueme ispejima $row[Name]\n";
		fwrite($open, $data);
		fclose($open);
		//STEBĖJIMO PABAIGA
		mysql_query('UPDATE profiliai SET Warn=' .$row['Warn']. ' WHERE id='.$accid);
		echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">Įspėjimų skaičius žaidėjui <b>' .$row['Name']. '</b> pakeistas į <b>' .$row['Warn']. '</b>.</div><br /><div style="text-align:center"><a href="/player?acc=' .$accid. '">Grįžti atgal</a></div>';		
	}
	elseif($_GET['unlock'] > 0 && $row['Banned'] > 0)
	{
		//STEBĖJIMO PRADŽIA
		$logfailas = "modules/logs/unlocks_log.txt";
		$duom = mysql_query('SELECT name FROM accounts WHERE id='. $_SESSION['Logged']);
		$nikas = mysql_fetch_array($duom);
		$open = fopen($logfailas, 'a');
		$data = "$nikas[name] atrakino $row[Name] saskaita\n";
		fwrite($open, $data);
		fclose($open);
		//STEBĖJIMO PABAIGA
		mysql_query('UPDATE profiliai SET Banned=0 WHERE id='.$accid);
		echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">Sąskaitą vardu <b>' .$row['Name']. '</b> sėkmingai atrakinta.</b>.</div><br /><div style="text-align:center"><a href="/player?acc=' .$accid. '">Grįžti atgal</a></div>';		
	
	}
	else
	{
		//Ieškome, koks VVP acc
		$accr = mysql_query("SELECT id,Vardas FROM profiliai WHERE id=$accid LIMIT 1");
		$acc = mysql_fetch_array($accr);



		//Išvedame visą informaciją
		echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">' .$row['Vardas']. '</span>
		<br/>
		<div style="background-color:#f3eacd;border:1px solid #a28522;color:#a28522;padding:12px">';
		echo 'Turimi įspėjimai: ' .$row['Warn']. ''; if($row['Warn'] > 0) echo ' <a href="page.php?q=player&acc=' .$accid. '&unwarn=1" onClick=\'return confirmUnwarn()\'><img src="images/nuimti.png" border="0" alt="Nuimti įspėjimą"></a>';
		echo '
		<br />
		Sąskaitos statusas:'; if($row['Banned'] > 0) echo ' <span style="color:#CC0000;font-weight:bold;">Užrakinta</span> <a href="page.php?q=player&acc=' .$accid. '&unlock=1" onClick=\'return confirmUnlock()\'><img src="images/atrakinti.png" border="0" alt="atrakinti sąskaitą"></a>';
		elseif($row['Warn'] > 2) echo ' <span style="color:#CC0000;font-weight:bold;">Užrakinta dėl įspėjimų skaičiaus</span>';
		else echo ' <span style="color:#00CC00;font-weight:bold;">Atrakinta</span>';
		echo '
		<br />
		<br />
		<br />
		<br />
		VVP vartotojas: <a href="page.php?q=checkacc&acc=' .$acc['id']. '">' .$acc['Vardas']. '</a>.
		<br/>
		Administravimo lygis: ' .$row['Admin']. '</div><br/><br/>';
	}
}
else header('Location: page.php?q=home');
?>