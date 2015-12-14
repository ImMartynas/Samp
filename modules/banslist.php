<?php
if ($_SESSION['Logged']>0 && $_SESSION['Admin']>1) {
	//STEBĖJIMO PRADŽIA
	$logfailas = "modules/logs/unban_log.txt"; //Kad stebėtume, kas ką unbanina padarom log'ą
	//Ištraukiam administratoriaus niką
	$duom = mysql_query('SELECT name FROM accounts WHERE id='. $_SESSION['Logged']);
	$nikas = mysql_fetch_array($duom);
	//STEBĖJIMO PABAIGA
	
	if($_GET['deleteip'] != "" && $_GET['char']){
		mysql_query("DELETE FROM bans WHERE ip='$_GET[deleteip]' AND name='$_GET[char]'");
		//ĮRAŠINĖJIMAS
		$open = fopen($logfailas, 'a');
		$data = "$nikas[name] atbanino $_GET[char] ($_GET[deleteip])\n";
		fwrite($open, $data);
		fclose($open); 
		//PABAIGA
		echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">Draudimas žaisti nuo veikėjo vardo '.$_GET['char'].' ir IP ' .$_GET['deleteip']. ' nuimtas.<br><br><a href="/banslist">Grįžti atgal.</a>';
	}
	elseif($_GET['ip'] != ""){
		$ip = $_GET['ip'];
		@mysql_query("SET NAMES utf8"); //gaunam UTF-8
		$query = "SELECT * FROM bans WHERE ip='$ip'";
		$result = mysql_query($query) or die('MySQL klaida 1');

		//Lentelė
		$data = '<center><table class="data" border="1" cellpadding="3" cellspacing="0" rules="rows" frame="below">
		<tr>
		<th>Vardas</th>
		<th>IP</th>
		<th>Admin vardas</th>
		<th>Priežastis</th>
		<th></th>
		</tr>';
		//išvedimas
			while($row = mysql_fetch_assoc($result)) {
				//Dėl blogo banų įrašymo pakeičiam kai kuriuos netikslumus
				$string = $row[reason];
				$patterns[0] = '/pinig(.*) (.*)ytas/';
				$patterns[1] = '/ginklu(.*) (.*)ytas/';
				$replacements[1] = 'ginklų čytas';
				$replacements[0] = 'pinigų čytas';
				$reasonas = preg_replace($patterns, $replacements, $string);
				//Nu ir galiausiai eilutės
				$data .= "\n<tr>
				\n\t<td> $row[name]</td>
				\n\t<td> $row[ip] </td>
				\n\t<td> $row[admname]</td>
				\n\t<td> $reasonas</td>
				\n\t<td><a href='/banslist?deleteip=$row[ip]&char=$row[name]' onClick='return confirmUnban()'><img src='images/trinti.png' border='0'></td>
				\n</tr>";
			}
		$data .= "\n</table></center>\n";
		echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">Draudimo paieška</span><br/><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">';
		echo '<a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>IP: <input type=\\\'text\\\' name=\\\'ip\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal IP</a>';
		echo '<br><a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>Veikėjo vardas: <input type=\\\'text\\\' name=\\\'charname\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal veikėjo vardą</a>';
		echo '<br><span id="laukelis"></span></div>';
		echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">Draudimai žaisti ant IP '.$ip.'</span><br/><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">';
		echo $data;
		echo '</div>';
	}
	elseif($_GET['charname'] != ""){
		$charas = $_GET['charname'];
		@mysql_query("SET NAMES utf8"); //gaunam UTF-8
		$query = "SELECT * FROM bans WHERE name='$charas'";
		$result = mysql_query($query) or die('MySQL klaida 1');

		//Lentelė
		$data = '<center><table class="data" border="1" cellpadding="3" cellspacing="0" rules="rows" frame="below">
		<tr>
		<th>Vardas</th>
		<th>IP</th>
		<th>Admin vardas</th>
		<th>Priežastis</th>
		<th></th>
		</tr>';
		//išvedimas
			while($row = mysql_fetch_assoc($result)) {
				$string = $row[reason];
				//Dėl blogo banų įrašymo pakeičiam kai kuriuos netikslumus
				$patterns[0] = '/pinig(.*) (.*)ytas/';
				$patterns[1] = '/ginkl(.*) (.*)ytas/';
				$replacements[1] = 'ginklų čytas';
				$replacements[0] = 'pinigų čytas';
				$reasonas = preg_replace($patterns, $replacements, $string);
				//Nu ir galiausiai eilutės
				$data .= "\n<tr>
				\n\t<td> $row[name]</td>
				\n\t<td> $row[ip] </td>
				\n\t<td> $row[admname]</td>
				\n\t<td> $reasonas</td>
				\n\t<td><a href='/banslist?deleteip=$row[ip]&char=$row[name]' onClick='return confirmUnban()'><img src='images/trinti.png' border='0'></td>
				\n</tr>";
			}
		$data .= "\n</table></center>\n";
		echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">Draudimo paieška</span><br/><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">';
		echo '<a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>IP: <input type=\\\'text\\\' name=\\\'ip\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal IP</a>';
		echo '<br><a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>Veikėjo vardas: <input type=\\\'text\\\' name=\\\'charname\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal veikėjo vardą</a>';
		echo '<br><span id="laukelis"></span></div>';
		echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">Draudimai žaisti ant veikėjo vardo '.$charas.'</span><br/><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">';
		echo $data;
		echo '</div>';
	}
		else
	{
														/*BANŲ RODYMAS*/
	//NUSTATYMAI:
	$recordsPerPage = 30; //Banų per puslapį
	$pageNum = 1; //pirmas puslapis
	//NUSTATYMŲ PABAIGA

	//Įkeliam banus
	if(isset($_GET['p'])) {
		$pageNum = $_GET['p'];
		settype($pageNum, 'integer');
	}

	$offset = ($pageNum - 1) * $recordsPerPage;

	$query = "SELECT * FROM bans LIMIT $offset, $recordsPerPage;"; # 1. Main query
	@mysql_query("SET NAMES utf8"); //gaunam UTF-8
	$result = mysql_query($query) or die('MySQL klaida');

	//Lentelė
	$data = '<center><table class="data" border="1" cellpadding="3" cellspacing="0" rules="rows" frame="below">
	<tr>
	<th>Vardas</th>
	<th>IP</th>
	<th>Admin vardas</th>
	<th>Priežastis</th>
	<th></th>
	</tr>';

	//išvedimas
	while($row = mysql_fetch_assoc($result)) {
		$string = $row[reason];
		//Dėl blogo banų įrašymo pakeičiam kai kuriuos netikslumus
		$patterns[0] = '/pinig(.*) (.*)ytas/';
		$patterns[1] = '/ginkl(.*) (.*)ytas/';
		$replacements[1] = 'ginklų čytas';
		$replacements[0] = 'pinigų čytas';
		$reasonas = preg_replace($patterns, $replacements, $string);
		//Nu ir galiausiai eilutės
		$data .= "\n<tr>
		\n\t<td> $row[name]</td>
		\n\t<td> $row[ip] </td>
		\n\t<td> $row[admname]</td>
		\n\t<td> $reasonas</td>
		\n\t<td><a href='/banslist?deleteip=$row[ip]&char=$row[name]' onClick='return confirmUnban()'><img src='images/trinti.png' border='0'></td>
		\n</tr>";
	}
	$data .= "\n</table></center>\n";

	//Suskaičiuojam, kiek turim banų
	$q = "SELECT COUNT(name) FROM bans;";
	$r = mysql_query($q) or die('MySQL klaida');
	$rowsai = mysql_fetch_assoc($r);
	$numrows = $rowsai['COUNT(name)'];

	$maxPage = ceil($numrows/$recordsPerPage); //Dižiausias puslapis
	$nav = '';
	for($page = 1; $page <= $maxPage; $page++) {     if ($page == $pageNum)     {         $nav .= "<span style='font-size:14px;font-weight:bold'> $page </span>"; //Dabartinis puslapis
		}
		else
		{
			$nav .= "<a href=\"banslist?p=$page\"> $page</a>";//Kitų puslapių nuoroda
		}
	}

	if ($pageNum > 1) {

		$page = $pageNum - 1;
 		 $prev = "<a href=\"banslist?p=$page\"><strong> < </strong></a>"; //Ankstesnis puslapis
 		 $first = "<a href=\"banslist?p=1\"><strong> << </strong></a>"; //Pirmutinis puslapis
	}
	else
	{
		$prev = '<strong> </strong>';
		  $first = '<strong> </strong>';
	}

	if ($pageNum < $maxPage) {
  		$page = $pageNum + 1;
  		$next = "<a href=\"banslist?p=$page\"><strong> > </strong></a>"; //Sekantis puslapis
  		$last = "<a href=\"banslist?p=$maxPage\"><strong> >> </strong></a>"; //Paskutinis puslapis
	}
	else
	{
		  $next = '<strong> </strong>';
  		$last = '<strong> </strong>';
	}
	echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">Draudimo paieška</span><br/><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">';
	echo '<a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>IP: <input type=\\\'text\\\' name=\\\'ip\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal IP</a>';
	echo '<br><a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>Veikėjo vardas: <input type=\\\'text\\\' name=\\\'charname\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal veikėjo vardą</a>';
	echo '<br><span id="laukelis"></span></div>';
	echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">Draudimų sąrašas</span><br/><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">';
	echo $data;
	echo '</div>';
	echo '<br />';	
	echo '<div style="background-color:#bfcada;border:1px solid #3e536f;color:#3e536f;padding:12px">';
	echo "$first $prev $nav $next $last";
	echo '</div>';
	}
}
else header('Location: /home');
?>