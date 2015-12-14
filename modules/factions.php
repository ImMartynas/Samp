<?php
if ($_SESSION['Logged']>0) {
	function GetFaction($name) {
		switch ($name) {
			case 0: $name = 'Policijos departamentas'; break;
			case 1: $name = 'Medicinos departamentas'; break;
			case 2: $name = 'TV7 studija'; break;
			case 3: $name = 'Licenzijų centras'; break;
			case 4: $name = 'Savivaldybė'; break;
			default: $name = 'None'; break;
		}
	return $name;	
	}	
	$result1 = mysql_query('SELECT Faction,FRank FROM players WHERE id='.$char1);
	$row1 = mysql_fetch_array($result1);
	$result2 = mysql_query('SELECT Faction,FRank FROM players WHERE id='.$char2);
	$row2 = mysql_fetch_array($result2);
	if ($row1['FRank'] > 5) $id = $char1;
	elseif ($row2['FRank'] > 5) $id = $char2;
	else $id = 0;
	if ($id > 0)
	{	
		if(isset($_GET['ismesti']))
		{
			$resultdrop = mysql_query('SELECT Faction FROM players WHERE id='.$_GET['ismesti']);
			$rowdrop = mysql_fetch_array($resultdrop);
			if ($rowdrop['Faction'] == $row1['Faction'] || $rowdrop['Faction'] == $row2['Faction'])
			{ 
				mysql_query("UPDATE `players` SET Faction='-1', FRank='0' WHERE id=".$_GET['ismesti']);
				echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">Žaidėjas išmestas iš frakcijos</div><br /><div style="text-align:center"><a href="/factions">Grįžti atgal</a></div>';
			}
			else echo '<div class="errorbox">Šis žaidėjas ne Jūsų frakcijoje</div>';		
		} elseif (isset($_GET['pareigos']))
		{
			$resultdrop = mysql_query('SELECT Name,Faction,FRank FROM players WHERE id='.$_GET['pareigos']);
			$rowdrop = mysql_fetch_array($resultdrop);
			if ($rowdrop['Faction'] == $row1['Faction'] || $rowdrop['Faction'] == $row2['Faction'])
			{
				if(isset($_POST['rangas']))
				{
					mysql_query('UPDATE players SET FRank=\''.$_POST['rangas'].'\' WHERE id='.$_GET['pareigos']);
					echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">Žaidėjo pareigos sėkmingai atnaujintos</div><br /><div style="text-align:center"><a href="/factions">Grįžti atgal</a></div>';
				}
				else
				{
					echo '<center>Dabartinis <b>'.$rowdrop['Name'].'</b> rangas yra <b>'.$rowdrop['FRank'].'</b>.
				<form action="/factions?pareigos='.$_GET['pareigos'].'" method="post">
				Pasirinkite rangą:
				<select name="rangas">
				<option value="1">Pirmas</option>
				<option value="2">Antras</option>
				<option value="3">Trečias</option>
				<option value="4">Ketvirtas</option>
				<option value="5">Penktas</option>
				<option value="6">Šeštas</option>				
				</select>
				<input type="submit" value="Siųsti" />
				</form></center>';

				}
			}
			else echo '<div class="errorbox">Šis žaidėjas ne Jūsų frakcijoje</div>';
		} else {		
		$result = mysql_query('SELECT Faction,FRank FROM players WHERE id='.$id);	
		$row = mysql_fetch_array($result);
		$memresult = mysql_query('SELECT COUNT(id) FROM players WHERE Faction='.$row['Faction']);
		$memrow = mysql_fetch_array($memresult);
		$resultz = mysql_query('SELECT id,Name,PhNumber,FRank FROM players WHERE Faction='.$row['Faction'].' ORDER BY FRank DESC');
		echo '<center><span style="font-size:24px;font-weight:bold;padding-left:18px;">'.GetFaction($row['Faction']).'</span>';
		echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px;width:50%;"><span style="font-size:14px;font-weight:bold">Darbuotojų sąrašas:</span>
		<table  border="1" cellpadding="3" cellspacing="0" rules="rows" frame="below">
		<tr><th>Vardas_Pavardė</th> <th>Rangas</th> <th>IC numeris</th> <th></th> <th></th></tr>';
		while ($rowz = mysql_fetch_array($resultz)) {
			echo '<tr><td>'.$rowz['Name'].'</td> <td>'.$rowz['FRank'].'</td> <td>'.$rowz['PhNumber'].'</td> <td><a href="?pareigos='.$rowz['id'].'"><img src="images/edit.png" border="0"></a> <td><a href="?ismesti='.$rowz['id'].'"><img src="images/trinti.png" border="0"></a></td></tr>
			';
		}	
		echo '</table>Išviso: '.$memrow['COUNT(id)'].'</div></center>';
		}
	}	
	else echo '<div class="errorbox">Jūs nesate jokios frakcijos vadovas</div><br /><div style="text-align:center"><a href="/home">Grįžti atgal</a></div>';
}
else header('Location: /home');
?>