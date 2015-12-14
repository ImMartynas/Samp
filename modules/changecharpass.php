<?php

if ($_SESSION['Logged']>0 && isset($_GET['char']))
{
	$id = $_GET['char'];
	if ($char1==$id||$char2==$id) {
		if (!isset($_POST['oldpass']) || !isset($_POST['newpass']) || !isset($_POST['newpass2']))
		{
			$rez = mysql_query('SELECT Name FROM players WHERE id='.$id);
			$roz = mysql_fetch_array($rez);
			echo '<center><b><h1>DĖMESIO!</h1></b><br />Čia Jūs pakeisite tik savo veikėjo <b>' .$roz['Name']. '</b> slaptažodį. VVP ir kito veikėjo slaptažodis liks, koks buvo.</center><br /><br />
<form action="/changecharpass?char='.$id.'" onsubmit="return ValidateNewPassForm(this)" method="post">

<div style="text-align:center">

<table align="center">
	<tr>
		<td style="text-align:right">Dabartinis slaptažodis:</td>
		<td><input name="oldpass" type="password" maxlength="20" /></td>
	</tr>
	<tr>
		<td style="text-align:right">Naujas slaptažodis:</td>
		<td><input name="newpass" type="password" maxlength="20" /></td>
	</tr>
	<tr>
		<td style="text-align:right">Pakartokite slaptažodį:</td>
		<td><input name="newpass2" type="password" maxlength="20" /></td>
	</tr>
</table>

</div>

<div style="text-align:center">
	<input type="submit" value="Siųsti" class="submit" /> 
	<input name="" type="reset" value="I&scaron;valyti" />
</div>

</form>';
	}
	else
	{
		$result = mysql_query('SELECT Password FROM players WHERE id='. $id);
		$row = mysql_fetch_array($result);
		
		if ($row['Password']==$_POST['oldpass'])
		{
			$newpass = $_POST['newpass'];
			$length = strlen($newpass);
			
			if ($length<4||$length>20) echo '<div class="errorbox">Slaptažodis yra per trumpas arba per ilgas!</div>';
			else {
				if ($newpass==$_POST['newpass2']) {
					mysql_query('UPDATE players SET Password=\''. $newpass .'\' WHERE id='. $id);
										echo '<b>Slaptažodis pakeistas sėkmingai!</b><br />
<a href="/home">Grįžti atgal</a>';
				}
				else echo '<div class="errorbox">Įrašyti slaptažodžiai nesutampa.</div>';
			}
		}
		else echo '<div class="errorbox">Senas slaptažodis yra neteisingas.</div>';
	}
	}
else header('Location: /home');
}
else header('Location: /home');

?>