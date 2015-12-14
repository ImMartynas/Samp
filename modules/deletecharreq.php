<?php
if ($_SESSION['Logged'] > 0)
	mysql_query("DELETE FROM pendingchars WHERE accid=". $_SESSION['Logged'] );
	
header('Location: index.php');
?>