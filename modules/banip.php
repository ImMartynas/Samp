<?php

if ($_SESSION['Logged']>0 && $_SESSION['Admin']>1) {
$ipp = $_GET['whichIP'];
	if (!isset($_POST['ip'])) {
		echo '<br /><div style="text-align:center">

<table class="centered">
	<tr>
		<td style="text-align:center">
			<form action="/banip" method="post">
			<span style="font-size:24px;font-weight:bold">Drausti lankytis</span>
			<br /><br />
			
<table>
	<tr>
		<td style="text-align:right">IP:</td>
		<td><input name="ip" type="text" maxlength="17" value="' .$ipp. '" /></td>
	</tr>
	<tr>
		<td>Priežastis:</td>
		<td><input name="reason" type="text" maxlength="49" /></td>
	</tr>
</table>

			<input type="submit" value="Drausti" /> 
			<input name="" type="reset" value="I&scaron;valyti" />
			</form>
		</td>
	</tr>
</table>

</div>

<br /><br />';

		$result = mysql_query('SELECT * FROM ucpbans ORDER by admname');
		echo '
<table style="width:100%;border:2px solid #7f1111;background-color:#f4caca;">';
		$count = false;
		while ($row = mysql_fetch_array($result)) {
			$count = true;
			echo '
	<tr>
		<td>'. $row['ip'] .'</td>
		<td>'. $row['reason'] .'</td>
		<td>' .$row['admname']. '</td>
		<td>(<a href="/unban?ip='. $row['ip'] .'">atbaninti</a>)</td>
	</tr>';
		}
		
		if (!$count) echo '
	<tr>
		<td><i>Įrašų nėra</i></td>
	</tr>';
			echo '
</table>';
		}
		else {
			$length = strlen($_POST['ip']);
			
			if ($length>8) {
					$resultADM = mysql_query("SELECT name FROM accounts WHERE id=". $_SESSION['Logged']);
					$rowADM = mysql_fetch_array($resultADM);
				mysql_query('INSERT INTO ucpbans (ip,reason,admname) VALUES (\''. $_POST['ip'] .'\',\''. $_POST['reason'] .'\',\''. $rowADM['name'] .'\')');
				header('Location: /banip');
			}
			else echo '<div class="errorbox">Blogai įrašytas IP</div>';
		}
		
}
else header('Location: /home');

?>