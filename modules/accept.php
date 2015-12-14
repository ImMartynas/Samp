<?php

// Patikrinam ar vartotojas turi tam tikras teises
if ($_SESSION['Logged']>0 && $_SESSION['Admin']>0 && $_GET['accid']>0) {
	
	$accid = $_GET['accid'];
	$result = mysql_query("SELECT * FROM pendingchars WHERE accid=". $accid);
	$row = mysql_fetch_array($result);
	if ($row['reason'] == NULL) {
		if ($accid != $row['accid'])
			echo '<div class="errorbox">Klaida!</div>';
		else {
			$newresult = mysql_query('SELECT id FROM players WHERE name=\''. $row['charname'] .'\'');
			if ($newrow = mysql_fetch_array($newresult))
				echo '<div class="errorbox">Tokiu vardu žaidėjas jau yra sukurtas</div>';
			else {
				$newresult = mysql_query('SELECT password,accid1,accid2 FROM accounts WHERE id='. $accid);
				$newrow = mysql_fetch_array($newresult);
					
				if ($newrow['accid1']==0) {
					$resultADM = mysql_query("SELECT name FROM accounts WHERE id=". $_SESSION['Logged']);
					$rowADM = mysql_fetch_array($resultADM);
					mysql_query("INSERT INTO players (Name,Password,accepted) VALUES ('". $row['charname'] ."','". $newrow['password'] ."','". $rowADM['name'] ."')");
					mysql_query("DELETE FROM pendingchars WHERE accid=". $accid);
					$newresultz = mysql_query("SELECT id FROM players WHERE Name='". $row['charname'] ."'");
					$newrowz = mysql_fetch_array($newresultz);
					mysql_query("UPDATE accounts SET accid1=". $newrowz['id'] ." WHERE id=". $accid);
					header('Location: /checkchar');
				}
				else if ($newrow['accid2']==0) {
					$resultADM = mysql_query("SELECT name FROM accounts WHERE id=". $_SESSION['Logged']);
					$rowADM = mysql_fetch_array($resultADM);
					mysql_query("INSERT INTO players (Name,Password,accepted) VALUES ('". $row['charname'] ."','". $newrow['password'] ."','". $rowADM['name'] ."')");
					mysql_query("DELETE FROM pendingchars WHERE accid=". $accid);
					$newresultz = mysql_query("SELECT id FROM players WHERE Name='". $row['charname'] ."'");
					$newrowz = mysql_fetch_array($newresultz);
					mysql_query("UPDATE accounts SET accid2=". $newrowz['id'] ." WHERE id=". $accid);
					header('Location: /checkchar');
				}
				else
					echo "<div class=\"errorbox\">Ši sąskaita jau turi 2 žaidėjus.</div>";
			}
		}
	}
}
else header('Location: /home');
	
?>