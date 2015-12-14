<?php
//Ðis failas á MySQL áraðinëja last login laikà.
//Áterptas á header.php, kad atsinaujintø perkrovus.
//Kadangi ðis failas bus naudojamas ne tik kai þmogus prisijungæs, todël darom if'à
if ($_SESSION['Logged'] > 0)
{
	//Dël labais netikslaus serverio laiko pridedam 24 minutes.
	$time2 = mktime(date("H"),date("i")+24,date("s"),date("m"),date("d"),date("Y"));
	$time = date("Y-m-d H:i:s", $time2);
	mysql_query("UPDATE accounts SET lastlogin = '$time' WHERE id = ". $_SESSION['Logged']);
}
?>