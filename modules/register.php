<?php

$ip=$_SERVER['REMOTE_ADDR'];
if ($_SESSION['Logged'] == 0) { 
if(isset($_POST['Submitas'])) {

$nick = $_POST['name'];
$sur_nick = $_POST['sur_name'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$code = $_POST['code'];
$gender = $_POST['lytis'];

if(empty($nick)) { $error="Neįvedėte savo Žaidėjo vardo.";}
if(empty($sur_nick)) { $error="Neįvedėte savo Žaidėjo pavardės .";}
elseif(empty($pass1)) { $error="Neįvedėte savo slaptažodžio.";}
elseif(empty($pass2)) { $error="Nepakartojote savo slaptažodžio.";}
elseif(empty($code)) { $error="Neįvedėte apsaugos kodo.";}
elseif ($pass1!=$pass2) { $error="Slaptažodžiai nesutapo.";}
elseif($_SESSION['kod'] != $code) { $error= "Apsaugos kodas nesutapo.";}
elseif (strlen($nick)<5){ $error="Žaidėjo vardas turi būti Ilgesnis nei 4 raidės.";}
elseif (strlen($sur_nick)<5){ $error="Žaidėjo pavardė turi būti Ilgesnė nei 4 raidės.";}
elseif (strlen($pass1)<4){ $error="Žaidėjo slaptažodis turi būti Ilgesnis nei 4 simboliai.";}
$rez = mysql_query('SELECT * FROM profiliai WHERE Vardas=\''.$_POST['name'].'_'.$_POST['sur_name'].'\'');
if ($nick = mysql_fetch_array($rez)) { $error="Toks vartotojas jau egzistuoja.";}
$result = mysql_result(mysql_query("SELECT COUNT(*) FROM `profiliai` WHERE `Ip` LIKE '%$ip%'"),0);
if($result >= 2) { $error="Šiom IP adresu jau registruoti 2 vartotojai."; }
if(isset($error)){
echo'<div class="errorbox"><b>Klaida! </b>'.$error.'</div><br />';
}

						else {
						unset($_SESSION['kod']);
							mysql_query('INSERT INTO profiliai (Vardas,Slaptazodis,Reg,Ip,Lytis) VALUES (\''.ucfirst($_POST['name']).'_'.ucfirst($_POST['sur_name']).'\',\''.$pass1.'\',\'1\',\''.$ip.'\',\''.$gender.'\')');
							echo '
<div style="text-align:center">

<table class="centered" style="margin-top:20px;width:639px;background-color:#f2e9d6;border:1px solid #f0a425">
	<tr>
		<td style="text-align:center;width:138px"><img src="template/images/login_lock.jpg" alt="Prisijungimas" /></td>
		<td style="padding:33px 15px"><center><big><b>Sveikname užsiregistravus!</center><br />'.ucfirst($_POST['name']).'_'.ucfirst($_POST['sur_name']).'</b></big><br /><br />Sveikiname užsiregistravus <b>Rytojaus San Fierro Gyvenime!</b> Linkime nuostabiai praleisti laiką mūsų serveryję, iškilus nesklandumams visada galite kreiptis į Administracija ji jums visada padės nes jie tik tam ir yra. Prašome nepamiršti mūsų serverio bėj savo slaptažodžio.. O dabar keliauk į serverį ir pradėk, kas pirmesnis tas gudresnis, mūsų serveryje žmonės aktyvūs, būk pirmas ir susigraibyk viską!<br />Sėkmės žaidžiant.<br /><i>RSFG administracija</i>


<div style="padding-left:75px">
	<form method="post" action="'.$wp['home'].'" onsubmit="return ValidateLoginForm(this)">
	
	<table cellspacing="0" cellpadding="0">
			<td>Greitas prisijungimas:</td>
			<td><input name="User" type="text" maxlength="16" style="width:109px" value="'.ucfirst($_POST['name']).'_'.ucfirst($_POST['sur_name']).'"/></td>
			<td style="width:6px">&nbsp;</td>
			<td><input name="Password" type="password" maxlength="16" style="width:109px" value="'.$_POST['pass1'].'"/></td>
			<td style="width:20px">&nbsp;</td><td><input type="submit" value="Prisijungti" /></td>
		</tr>
		</td>
</table><br /></tr>
	</form>
</div>';}
}
echo '<form method="post" action="'.$wp['register'].'">

<div style="text-align:center">
<big><b>REGISTRACIJA</big></b></p>
<table class="centered" cellpadding="5">
	<tr>
		<td style="width:290px"><b>Žaidėjo vardas:</b><br /> Žaidėjo vardas turi būti nuo <u>4 raidžių</u> NEGALIMA NAUDOTI LIETUVIŠKŲ RAIDŽIŲ VARDE)</i></td>
		<td><input name="name" type="text" maxlength="25" size="25"/></td>
	</tr>
		<tr>
		<td style="width:290px"><b>Žaidėjo pavardė:</b><br />(Pavadė turi būti NE ižimybės pavizdžiui: <u>Obama, Collins, Bond</u> , pavardė turi būti <u>ne trumpesnė nei 4 raidės.</u> NEGALIMA NAUDOTI LIETUVIŠKŲ RAIDŽIŲ PAVADĖJE)</i></td>
		<td><input name="sur_name" type="text" maxlength="25" size="25"/></td>
	</tr>
	<tr>
		<td style="width:280px"><b>Slaptažodis:</b><br /><i>(nuo 4 iki 16 simbolių)</i></td>
		<td><input name="pass1" type="password" maxlength="16" /></td>
	</tr>
	<tr>
		<td style="width:280px"><b>Pakartokite slaptažodį:</b><br /><i>(įrašykite tokį pat slaptažodį, kaip ir prieš tai esančiame laukelyje)</i></td>
		<td><input name="pass2" type="password" maxlength="16" /></td>
	</tr>
	<tr>
		<td style="width:280px"><b>Pakartokite kodą:</b><br /><i>(įrašykite tokį patį kodą, kaip ir parodyta, kad užtikrintumėm kad jūs ne-esate robotas)</i></td>
		<td><img src="/web/wb/captcha/index.php" alt="captcha"/><br>
		<input name="code" type="text" maxlength="7" /></td>
	</tr>
	<tr>
		<td style="width:280px"><b>Pasirinkite lytį</b><br /><i>(jūsų žaidėjo(-os) lytis)</i></td>
		<td>		<select name="lytis">
<option value="1">Vyras</option>
<option value="2">Moteris</option>
</select></td>
	</tr>
		<td style="text-align:right"><input name="Submitas" type="submit" value="Registruotis" /></td>
		<td style="text-align:left"><input name="" type="reset" value="I&scaron;valyti" /></td>
	</tr>
</table>

</div>

</form><br />';}

else header('Location: http://127.0.0.1/web/wb/page.php?q=home');

?>