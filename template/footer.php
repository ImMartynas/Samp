<?php
echo '
</td></tr></table></td>
<td valign="top"><table class="sonas"><tr><td>';
if ($_SESSION['Logged'] > 0){
		$result = mysql_query('SELECT * FROM profiliai WHERE id=\''. $_SESSION['Logged'] .'\' LIMIT 1');
		$row = mysql_fetch_array($result);
echo '<div class="sonopav">Valdymo pultas</div><br />';
echo '
<a class="surl" href="page.php?q=exchange">Keitykla </a><br />
<a class="surl" href="page.php?q=vip&psl=">Kreditų Naudojimas </a><br />
<a class="surl" href="page.php?q=changepass">Keisti slaptažodį</a><br />
<a class="surl" href="page.php?q=logout">Atsijungti</a>';
if ($row['Admin']>1){
echo '<br /><br /><div class="sonopav">Administratoriaus pultas</div><br />';
echo '<a class="surl" href="page.php?q=newsadmin">Valdyti naujienas</a><br />
<a class="surl" href="page.php?q=newsadmin">Valdyti žaidėjus</a>';
}
} else {
	if (isset($_POST['User'])) {
		$result = mysql_query('SELECT * FROM profiliai WHERE Vardas=\''. $_POST['User'] .'\' LIMIT 1');
		$row = mysql_fetch_array($result);
		if (!strcmp($row['Slaptazodis'], $_POST['Password'])) {
			$_SESSION['Logged'] = $row['id'];
			if ($row['admin']>0) $_SESSION['Admin'] = $row['admin'];
			$_SESSION['User'] = $row['Vardas'];
			header('Location: http://127.0.0.1/web/wb/page.php?q=home');
		}

	//	$slp1 = mysql_real_escape_string($row['Slaptazodis']);
	// $slp2 = mysql_real_escape_string($_POST['Password']);

		else echo '<div class="errorbox"><b>Klaida!</b> Vartotojo Vardas arba slaptažodis <br />yra įvestas klaidingai.</div>';
	}
echo '<div class="sonopav">Prisijungimas</div><form action="page.php?q=home" method="post" onsubmit="return ValidateLoginForm(this)">
Vartotojo Vardas: <input type="text" class="laukelis" name="User" /><br>Slaptažodis: <input type="password" class="laukelis" name="Password" /><br><br><input type="submit" class="prisijungti" value="" />
</form>';
}
echo '</td></tr></table></td></tr>
</table>
<center><img src="template/images/copyright.png" onclick="alert(\'COPYRIGHTS:.\nKopijuoti draudziama.\nVVP kurė: Ellis, Savininkas ir Dizainą kurė ir jį sukodavo:Martynas,\n&copy; RSFG.TK, 2013\')" /></center>

</body>
</html>
';
?>