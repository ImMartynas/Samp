<?php
$rezz = mysql_query('SELECT id,Vardas,Admin,Direktorius FROM profiliai WHERE id='.$_SESSION['Logged']);
$newestrow = mysql_fetch_array($rezz);
if ($_SESSION['Logged']>0 || $newestrow['Admin']>1) {
if (isset($_GET['veiksm'])) {
	$veiksm = $_GET['veiksm'];
	if ($veiksm == "isp") {
				echo '<center><br /><span class="h1">Naujien&#371; valymas</span><br /><br />
				Jus norite istrinti visas naujienas...<br /><br />
				<a href="page.php?q=newsadmin&veiksm=isp2">Testi</a><br /><br /><a href="page.php?q=home">Atgal</a><br /><br /></center>';	
	}
	if ($veiksm == "isp2") {
				mysql_query('SELECT * FROM `naujienos` ');
				mysql_query('TRUNCATE TABLE `naujienos` ');
					echo '<div class="checking">Visos naujienos buvo iðtrintos sekmingai.</div><br />
					<a href="page.php?q=home">Atgal</a><br /><br />';		
	}
}
if(isset($_POST['Submitas'])) {

$autorius = $_POST['autorius'];
$pavadinimas = $_POST['pavadinimas'];
$string = $_POST['naujiena'];

if(empty($autorius) || empty($pavadinimas) || empty($string)) echo 'Uþpildykite visus laukelius!<br /><a href="page.php?q=newsadmin">Atgal</a>';
 else {
 include("replace.php");
mysql_query('INSERT INTO naujienos(data,autorius,pavadinimas,naujiena) VALUES(\''.date("Y-m-d H:m").'\',\''.$_POST['autorius'].'\',\''.$_POST['pavadinimas'].'\',\''.$string.'\')');
echo 'Naujiena sekmingai ádëta! <br /><a href="page.php?q=home">Atgal</a>';
}
} else {
if (!empty($veiksm)){
}
else { echo '<a href="page.php?q=newsadmin&veiksm=isp">Iðvalyti visas naujienas</a><br /><br />';

echo '<span class="h1">Naujien&#371; administravimas</span><br /><br />
<form action="page.php?q=newsadmin" method="post">
<b>Ra&#353;yti naujien&#261;</b>
<table width="100%"><tr><td>Naujienos autorius:</td><td><input name="autorius" type="text" maxlength="15" /></td></tr>
<tr><td>Naujienos pavadinimas:</td><td><input name="pavadinimas" type="text" maxlength="30" /></td></tr>
<tr><td>Naujienos tekstas:</td><td><textarea name="naujiena" cols="50" rows="13" lang="lt"></textarea></td></tr>
<td style="text-align:right"><input name="Submitas" type="submit" value="Kelti" /></td>
		<td style="text-align:left"><input name="" type="reset" value="I&scaron;valyti" /></td>
</table>
</form>';
}
}
} else {header('Location: page.php?q=home');}



?>