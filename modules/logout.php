<?php

mysql_query("UPDATE accounts SET logged = '0' WHERE id = ". $_SESSION['Logged']);
unset($_SESSION['Logged']);
unset($_SESSION['Admin']);
header('Location: page.php?q=home');

?>