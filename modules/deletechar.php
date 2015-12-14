<?php

if ($_SESSION['Logged']>0) {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		
		if ($char1==$id||$char2==$id) {
			if (isset($_POST['req'])) {
				if ($_POST['req']=='Taip') {
					$nameresule = mysql_query('SELECT Name FROM players WHERE id='. $id);
					$namerow = mysql_fetch_array($nameresult);
					mysql_query('DELETE FROM players WHERE id='. $id);
					$result = mysql_query('SELECT accid1,accid2 FROM accounts WHERE id='. $_SESSION['Logged']);
					$row = mysql_fetch_array($result);
					
					if ($char1==$id) mysql_query('UPDATE accounts SET accid1=0 WHERE id='. $_SESSION['Logged']);
					else if ($char2==$id) mysql_query('UPDATE accounts SET accid2=0 WHERE id='. $_SESSION['Logged']);
					
					mysql_query('DELETE FROM ownablevehicles WHERE owner='. $id);
					
					header('Location: /home');
				}
				else header('Location: /home');
			}
			else {
				$result = mysql_query('SELECT Name FROM players WHERE id='. $id);
				$row = mysql_fetch_array($result);
				echo '
<table align="center" style="margin-top:20px;width:639px;background-color:#f2e9d6;border:1px solid #f0a425">
	<tr>
		<td style="text-align:center;width:138px"><img src="template/images/login_lock.jpg" /></td>
		<td style="padding:33px 15px">Žaidėjo <b>'. $row['Name'] .'</b> pašalinimas.<br /><br /><b>Įspėjimas!</b> Pašalinus žaidėją jo nebebus įmanoma atkurti. Taip pat su žaidėjo pašalinimu bus pašalinta ir žaidėjo nuosavos transporto priemonės bei jam priklausantis nekilnojamasis turtas bus parduotas savivaldybei.</td>
	</tr>
</table><br />

<form action="page.php?q=deletechar&id='. $id .'" method="post">

<div style="text-align:center"><b>Ar tikrai norite ištrinti '. $row['Name'] .'?</b><br /><input name="req" type="submit" value="Taip" /> <input name="req" type="submit" value="Ne" /></div>

</form>';
			}
		}
		else header('Location: /home');
	}
	else header('Location: /home');
}
else header('Location: /home');

?>