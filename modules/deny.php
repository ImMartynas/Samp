<?php

if ($_SESSION['Logged']>0 && $_SESSION['Admin']>0 && $_GET['accid']>0) {
	if (isset($_POST['reason'])) {
		$length = strlen($_POST['reason']);
		if ($length>299||$length<1) echo '<div class="errorbox">Priežastis per ilga arba per trumpa.</div>';
		else {
			$result = mysql_query('SELECT name FROM accounts WHERE id='. $_SESSION['Logged']);
			$row = mysql_fetch_array($result);
			mysql_query('UPDATE pendingchars SET reason=\''. $_POST['reason'] .'\', admname=\''. $row['name'] .'\' WHERE accid='. $_GET['accid']);
			header('Location: /checkchar');
		}
	}
	else header('Location: /checkchar');
}
else header('Location: /home');

?>