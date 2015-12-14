<?php
if ($_SESSION['Logged'] > 0 && $_SESSION['Admin'] > 1 || $_SESSION['Logged'] == 16)
{
	if (isset($_POST['faction']) && isset($_POST['rang']) && isset($_POST['char']))
	{
		mysql_query('UPDATE players SET Faction='.$_POST['faction'].', FRank='.$_POST['rang'].' WHERE id='.$_POST['char']);
		echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">Frakcija ir rangas sėkmingai nustatyti</div><br /><div style="text-align:center"><a href="/givelead">Grįžti atgal</a></div>';
	}
	else
	{
	$result1 = mysql_query('SELECT Name FROM players WHERE id='.$char1);
	$row1 = mysql_fetch_array($result1);
	$result2 = mysql_query('SELECT Name FROM players WHERE id='.$char2);
	$row2 = mysql_fetch_array($result2);
	echo '<center><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px;width:50%">Pasirink frakciją ir norimą rangą.</div></center><br />
		<div style="text-align:center">
		<form action="/givelead" method="post">		
		<table align="center">
		<tr>
		<td style="text-align:right">Pasirinkite veikėją:</td>
		<td style="text-align:left"><select name="char">
		<option value="'.$char1.'">'.$row1['Name'].'</option>
		<option value="'.$char2.'">'.$row2['Name'].'</option>	
		</select></td>
		</tr>
		<tr>
		<td style="text-align:right">Pasirinkite frakciją:</td>
		<td style="text-align:left"><select name="faction">
		<option value="0">PD</option>
		<option value="1">MD</option>
		<option value="2">TV7</option>
		<option value="3">Licenzijų biuras</option>
		<option value="4">Savivaldybė</option>		
		</select></td>
		</tr>
		<tr>
		<td style="text-align:right">Pasirinkite rangą: </td>
		<td style="text-align:left"><select name="rang">
		<option value="1">Pirmas</option>
		<option value="2">Antras</option>
		<option value="3">Trečias</option>
		<option value="4">Ketvirtas</option>
		<option value="5">Penktas</option>
		<option value="6">Šeštas</option>				
		</select></td>
		</tr>
		</table>
		<input type="submit" value="Siųsti" />
		</form>
		</div>';
	}
}
else header('Location: /home');
?>