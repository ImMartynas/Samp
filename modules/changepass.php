<?php

if ($_SESSION['Logged']>0)
{
	if (!isset($_POST['oldpass']) || !isset($_POST['newpass']) || !isset($_POST['newpass2']))
		echo '
<form action="page.php?q=changepass" onsubmit="return ValidateNewPassForm(this)" method="post">

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
	else
	{
		$result = mysql_query('SELECT Slaptazodis FROM profiliai WHERE id='. $_SESSION['Logged']);
		$row = mysql_fetch_array($result);
		
		if ($row['Slaptazodis']==$_POST['oldpass'])
		{
			$newpass = $_POST['newpass'];
			$length = strlen($newpass);
			
			if ($length<4||$length>20) echo '<div class="errorbox">Slaptažodis yra per trumpas arba per ilgas!</div>';
			else {
				if ($newpass==$_POST['newpass2']) {
					mysql_query('UPDATE profiliai SET Slaptazodis=\''. $newpass .'\' WHERE id='. $_SESSION['Logged']);
					
					echo '<b>Slaptažodis pakeistas sėkmingai!</b><br />
<a href="page.php?q=home">Grįžti atgal</a>';
				}
				else echo '<div class="errorbox">Įrašyti slaptažodžiai nesutampa.</div>';
			}
		}
		else echo '<div class="errorbox">Senas slaptažodis yra neteisingas.</div>';
	}
}
else header('Location: page.php?q=home');

?>