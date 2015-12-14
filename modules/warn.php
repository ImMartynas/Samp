<?
if ($_SESSION['Logged']>0 && $_SESSION['Admin']>0 && $_GET['acc']>0) {

	//Gaunamas ID žaidėjo, kuris gaus įspėjimą.
	$accid = $_GET['acc'];

	//Gaunami reikalingi duomenys iš MySQL
	$result = mysql_query('SELECT name,ucpwarns,lastip FROM accounts WHERE id='. $accid);
	$row = mysql_fetch_array($result);

	//Pridedamas įspėjimas prie senų.
	$newWARNS = $row['ucpwarns'] + 1;

	//Rašoma žinutė administratoriui.
	if($newWARNS < 3){
		//Nustatomi naujas įspėjimų skaičius.
		mysql_query('UPDATE accounts SET ucpwarns=' .$newWARNS. ' WHERE id='. $accid);
		echo '<div style="background-color:#f3eacd;border:1px solid #a28522;color:#a28522;padding:12px">Jūs įspėjote vartotoją ' .$row['name']. ', dabar Jis jau turi ' .$newWARNS. ' įsp.  <a href="/checkchar">Grįžti atgal.</a></div>';
		//Įrašome duomenis į logą
		$time2 = mktime(date("H"),date("i")+20,date("s"),date("m"),date("d"),date("Y"));
		$time = date("Y-m-d H:i:s", $time2); 
		$logfailas = "modules/logs/warns_log.txt";
		$duom = mysql_query('SELECT name FROM accounts WHERE id='. $_SESSION['Logged']);
		$nikas = mysql_fetch_array($duom);
		$open = fopen($logfailas, 'a');
		$data = "[$time] $nikas[name] ispejo $row[name]\n";
		fwrite($open, $data);
		fclose($open); 
	} elseif($newWARNS == 3) {
		//Nustatomi naujas įspėjimų skaičius.
		mysql_query('UPDATE accounts SET ucpwarns=' .$newWARNS. ' WHERE id='. $accid);
		//Įdedami BAN, jeigu tai 3 įspėjimas.
		mysql_query("INSERT INTO ucpbans (ip,reason,admname) VALUES ('". $row['lastip'] ."','Jūs surinkote 3 įspėjimus (" .$row['name']. ")','VVP įspėjimų sistema')");
		mysql_query("INSERT INTO bans (name,ip,admname,reason) VALUES ('" .$row['name']. "','" . $row['lastip'] . "','VVP Skujus','Jūs surinkote 3 įspėjimus VVP')");
		//Pranešimas, kad žaidėjas gavo BAN.
		echo '<div style="background-color:#f3eacd;border:1px solid #a28522;color:#a28522;padding:12px">Vartotojas ' .$row['name']. ' gavo trečiąjį įspėjimą, todėl jam buvo uždrausta lankytis VVP ir žaidime. <a href="/checkchar">Grįžti atgal.</a></div>';
		//Įrašome duomenis į logą
		$time2 = mktime(date("H"),date("i")+20,date("s"),date("m"),date("d"),date("Y"));
		$time = date("Y-m-d H:i:s", $time2); 
		$logfailas = "modules/logs/warns_log.txt";
		$duom = mysql_query('SELECT name FROM accounts WHERE id='. $_SESSION['Logged']);
		$nikas = mysql_fetch_array($duom);
		$open = fopen($logfailas, 'a');
		$data = "[$time] $nikas[name] ispejo $row[name] [BANAS]\n";
		fwrite($open, $data);
		fclose($open); 
	} else {
		echo '<div style="background-color:#f3eacd;border:1px solid #a28522;color:#a28522;padding:12px">Vartotojui ' .$row['name']. ' čia jau yra uždrausta lankytis. <a href="/checkchar">Grįžti atgal.</a></div>';
	}
}
else header('Location: /home');
?>
