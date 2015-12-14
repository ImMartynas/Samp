<?php

if ($_SESSION['Logged']>0)
{
		$result = mysql_query('SELECT * FROM profiliai WHERE id='. $_SESSION['Logged']);
		$row = mysql_fetch_array($result);
		$VIP=$row['Vip'];
	if (!isset($_POST['newname']) || !isset($_POST['newsurname']))
		echo '
<form action="page.php?q=changename" onsubmit="return ValidateNewPassForm(this)" method="post">

<div style="text-align:center">

<table align="center">
	<tr>
		<td style="text-align:right">Norimas Vardas: (Iš didžiosios raidės)</td>
		<td><input name="newname" type="text" maxlength="20" /></td>
	</tr>
	<tr>
		<td style="text-align:right">Norima Pavardė: (Iš didžiosios raidės)</td>
		<td><input name="newsurname" type="text" maxlength="20" /></td>
	</tr>

</table>

</div>

<div style="text-align:center">
	<input type="submit" value="Keisti" class="submit" /> 
	<input name="" type="reset" value="I&scaron;valyti" />
</div>

</form>';
	else
	{	
	
		if ($VIP==0) $reikia=24;
		if ($VIP==1) $reikia=22;
		if ($VIP==2) $reikia=20;
		if ($VIP==3) $reikia=14;
		if ($row['NickPoints']>0) $reikia=-1;
		
		if ($row['Kreditai']>$reikia){
		
			$vardas = $_POST['newname'];
			$vardas1 = strlen($vardas);
			$pavarde = $_POST['newsurname'];
			$pavarde1 = strlen($pavarde);

			$rez = mysql_query('SELECT * FROM profiliai WHERE Vardas=\''.ucfirst($_POST['newname']).'_'.ucfirst($_POST['newsurname']).'\'');
			if ($vardas = mysql_fetch_array($rez)) echo 'Toks vardas jau egzistuoja!<br /><a href="page.php?q=home">Grįžti atgal</a>';
			
			else {
			if ($vardas1<4||$vardas1>20) echo '<div class="errorbox">Vardas yra per trumpas arba per ilgas!</div>';
			elseif ($pavarde1<4||$pavarde1>20) echo '<div class="errorbox">Pavardė yra per trumpa arba per ilga!</div>';
				else {
						
						$newwwwresult = mysql_query('SELECT * FROM saskaitos WHERE Savininkas=\''. ucfirst($row['Vardas']) .'\'');{
			
			while ($newwwwrow = mysql_fetch_array($newwwwresult)) 
			mysql_query('UPDATE saskaitos SET Savininkas=\''. ucfirst($_POST['newname']).'_'.ucfirst($_POST['newsurname']).'\' WHERE Savininkas=\''. ucfirst($row['Vardas']) .'\'');}
						
							$newresult = mysql_query('SELECT * FROM transportas WHERE Owner=\''. ucfirst($row['Vardas']) .'\'');{
			
			while ($newrow = mysql_fetch_array($newresult)) 
			mysql_query('UPDATE transportas SET Owner=\''. ucfirst($_POST['newname']).'_'.ucfirst($_POST['newsurname']).'\' WHERE Owner=\''. ucfirst($row['Vardas']) .'\'');}
			
			
										$newwresult = mysql_query('SELECT * FROM bizniai WHERE Savininkas=\''. ucfirst($row['Vardas']) .'\'');{
			
			while ($newwrow = mysql_fetch_array($newwresult)) 
			mysql_query('UPDATE bizniai SET Savininkas=\''. $_POST['newname'] .'_'.$_POST['newsurname'].'\' WHERE Savininkas=\''. ucfirst($row['Vardas']) .'\'');}
		
												$newwwresult = mysql_query('SELECT * FROM namai WHERE Savininkas=\''. ucfirst($row['Vardas']) .'\'');{
			
			while ($newwwrow = mysql_fetch_array($newwwresult)) 
			mysql_query('UPDATE namai SET Savininkas=\''.ucfirst($_POST['newname']).'_'.ucfirst($_POST['newsurname']).'\' WHERE Savininkas=\''.ucfirst($row['Vardas']).'\'');}
		
					mysql_query('UPDATE profiliai SET Vardas=\''.ucfirst($_POST['newname']).'_'.ucfirst($_POST['newsurname']).'\' WHERE id='. $_SESSION['Logged']);
					if($reikia==-1){
					mysql_query('UPDATE profiliai SET NickPoints=NickPoints-1 WHERE id='. $_SESSION['Logged']);
					echo '<div class="checking">Nemokamas vardo pakeitimo taškas buvo panaudotas!</div><br /><br />';}
					else {
					$reikia++;
					mysql_query('UPDATE profiliai SET Kreditai=Kreditai-'.$reikia.' WHERE id='. $_SESSION['Logged']);}
					echo '<b>Vardas pakeistas sekmingai nuo šiol tu esi '.ucfirst($_POST['newname']).'_'.ucfirst($_POST['newsurname']).'!</b><br />
<a href="page.php?q=home">Grįžti atgal</a>';
						}
					
				}
				
			
		}
		
		else {
		$reikia++;
		echo '<div class="errorbox">Jūs neturite '.$reikia.' kreditų(-o) vardui pasikeisti.</div>';}
	}
}
else header('Location: page.php?q=home');

?>