<?php

if ($_SESSION['Logged']>0)
{
	$result = mysql_query('SELECT accid FROM pendingchars WHERE accid='. $_SESSION['Logged']);
	$row = mysql_fetch_array($result);
	
	if ($row['accid'] == $_SESSION['Logged']) echo '<div class="errorbox">Jūs jau turite nusiuntę prašymą</div><br /><div style="text-align:center"><a href="/home">Grįžti atgal</a></div>';
	else
	{
	
		if (isset($_POST['charname']))
		{
			$length = strlen($_POST['charname']);
			$do1 = substr_count($_POST['carcrashrp'], '/do');
			$me1 = substr_count($_POST['carcrashrp'], '/me');
			$do2 = substr_count($_POST['carscrash'], '/do');
			$me2 = substr_count($_POST['carscrash'], '/me');
			$name = substr_count($_POST['charname'], ' ');
			
			
			if ($length>16 || $length<5) echo '<div class="errorbox">Žaidejo vardas yra per trumpas arba per ilgas.</div><br /><div style="text-align:center"><a href="/newchar">Grįžti atgal</a></div>';
			else
			{
				$result = mysql_query('SELECT `id` FROM `players` WHERE `name` LIKE \''. $_POST['charname'] .'\'');
				
				if ($row = mysql_fetch_array($result)) echo '<div class="errorbox">Jau toks žaidėjo vardas yra užimtas.</div><br /><div style="text-align:center"><a href="/newchar">Grįžti atgal</a></div>';
				elseif($name > 0) echo '<div class="errorbox">Veikėjo varde negali būti tarpų.</div><br /><div style="text-align:center"><a href="/newchar">Grįžti atgal</a></div>';
				elseif(strlen($_POST['pgmg'])+strlen($_POST['dmrktt'])+strlen($_POST['carcrashrp'])+strlen($_POST['carscrash'])<1000) echo '<div class="errorbox">Anketoje turi būti mažiausiai 1000 simbolių.<br /><br /><center><b>JEI BANDYSITE APEITI ŠIĄ SISTEMĄ JUMS BUS UŽDRAUSTA LANKYTIS!</b></center></div><br /><div style="text-align:center"><a href="/newchar">Grįžti atgal</a></div>';
				elseif(!nick_lt($_POST['charname'])) echo '<div class="errorbox">Veikėjo varde negali būti lietuviškų simbolių</div><br /><div style="text-align:center"><a href="/newchar">Grįžti atgal</a></div>';
				elseif($_POST['age'] == "---") echo '<div class="errorbox">Nepasirinkote savo veikėjo ' .$_POST['charname']. ' metų.</div><br /><div style="text-align:center"><a href="/newchar">Grįžti atgal</a></div>';
				elseif($do1 < 2 || $me1 < 10) echo '<div class="errorbox">Pirmos avarijos "roleplayinime" yra per mažai /do arba /me komandų.</div><br /><div style="text-align:center"><a href="/newchar">Grįžti atgal</a></div>';
				elseif($do2 < 2 || $me2 < 10) echo '<div class="errorbox">Antros avarijos "roleplayinime" yra per mažai /do arba /me komandų.</div><br /><div style="text-align:center"><a href="/newchar">Grįžti atgal</a></div>';
				else {
					$time2 = mktime(date("H"),date("i")+20,date("s"),date("m"),date("d"),date("Y"));
					$time = date("Y-m-d H:i:s", $time2); 
					if (mysql_query('INSERT INTO `pendingchars` (`accid`,`charname`,`age`,`pgmg`,`dmrktt`,`history`,`carcrashrp`,`carscrash`) VALUES ('. $_SESSION['Logged'] .',\''. $_POST['charname'] .'\','. $_POST['age'] .',\''. $_POST['pgmg'] .'\',\''. $_POST['dmrktt']. '\',\''. $_POST['history'] .'\',\''. $_POST['carcrashrp'] .'\',\''. $_POST['carscrash'] .'\')', $con))
					{
						echo '
<div style="text-align:center">

<table cellspacing="0" cellpadding="0" class="centered">
	<tr>
		<td>
			<img src="template/images/reg_check.png" style="padding:0 0 5px 5px;float:right" />
			<div style="width:494px;border:1px solid #aaaaaa;padding:25px 15px;background-color:#FFF;margin-right:38px;margin-top:25px">Jūsų žaidėjo aplikacija buvo nusiųsta administracijai.
			<br /><br />
			Administracija įvertins Jūsų pastangas ir aptars Jūsų "roleplay" lygį. Kelių valandų bėgyje, ar net minučių, Jūs gausite atsakymą, tad nepamirškite vis dar čia prisijungti ir patikrinti, ar jums pavyko sukurti žaidėją. Būkite kantrūs.
			</div>
		</td>
	</tr>
</table>

</div>

<br /><br />

<div style="text-align:center"><a href="/home">Grįžti atgal</a></div>';
					}
					else echo '<div class="errorbox">Klaida! '. mysql_error() .'</div>';
				}
			}
		}
		else
		{
			echo '
<div style="text-align:center">

<table class="centered" style="width:590px;background-color:#f6e9bd;border:1px solid #ba7419;padding:15px 4px">
	<tr>
		<td style="color:#ba7419">
			<span style="font-size:14px;font-weight:bold">Ką reikia žinoti prieš rašant žaidėjo aplikaciją?</span>
			<br /><br />
			Mes rekomenduojame žaidėjo aplikaciją pradėti rašyti programoje “Microsoft Word” ar kitoje, tokio pobūdžio, programoje. Prieš siųsdami aplikaciją, visus klausimus kurnors išsisaugokite, jei administracija atmes Jūsų aplikaciją, kad ją galėtumėte redaguoti. Taip pat žaidėjo vardas turi būti parašytas šiuo formatu: Vardas_Pavarde
		</td>
	</tr>
</table>

</div>

<br /><br />

<form action="/newchar" method="post" onsubmit="return checkform(this);">

<table>
	<tr>
		<td><b>Vardas_Pavarde:</b></td>
		<td><input name="charname" type="text" maxlength="16" /></td>
	</tr>
	<tr>
		<td><b>Veikėjo gimimo metai:</b></td>
		<td><select name="age">
				<option value="---">Pasirinkite metus</option>
				';
			for ($i=1920;$i<1996;$i++)
			{
				$metai = date('Y') - $i;
				echo '<option value="'. $i .'">'. $i .' (' .$metai. ')</option>
				';
			}
			echo '
			</select>
		</td>
	</tr>
</table>

<br /><br />

<b>Kas yra "powergame"? Kas yra "metagame"? Savais žodžiais paaiškinkite ir nurodykite pavyzdžių.</b><br />
<textarea name="pgmg" cols="76" rows="15" lang="lt"></textarea>

<br /><br />

<b>Kas yra "deathmatch"? Paaiškinkite jo šakas, kaip "revenge kill" ir "spawn kill". Pateikite pavyzdžių.</b><br />
<textarea name="dmrktt" cols="76" rows="15" lang="lt"></textarea>

<br /><br />

<b>Kokiuose <u>RolePlay</u> serveriuose esate dar žaidę ir kiek laiko? Parašykite taip pat ir žaidėjų vardus.</b><br />
<textarea name="history" cols="76" rows="15" lang="lt"></textarea>

<br /><br />

<b>Dabar įsivaizduokite, kad <u>jus partrenkė</u> mašina. Kaip "suroleplayintumėte" šią situaciją?</b><br />
<textarea name="carcrashrp" cols="76" rows="15" lang="lt"></textarea>

<br /><br />

<b>Dabar įsivaizduokite, kad <u>Jūs važiuojate mašina</u> ir į jus atsitrenkia kitas žmogus. Kaip "suroleplayintumėte" šią situaciją?</b><br />
<textarea name="carscrash" cols="76" rows="15" lang="lt"></textarea>

<br /><br />

<input type="submit" value="Siųsti" /> <input name="" type="reset" value="Išvalyti" />

</form>';
		}
	}
}
else header('Location: /home');

?>