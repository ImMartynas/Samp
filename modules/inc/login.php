<?php
//�is failas � MySQL �ra�in�ja last login laik�.
//�terptas � header.php, kad atsinaujint� perkrovus.
//Kadangi �is failas bus naudojamas ne tik kai �mogus prisijung�s, tod�l darom if'�
if ($_SESSION['Logged'] > 0)
{
	//D�l labais netikslaus serverio laiko pridedam 24 minutes.
	$time2 = mktime(date("H"),date("i")+24,date("s"),date("m"),date("d"),date("Y"));
	$time = date("Y-m-d H:i:s", $time2);
	mysql_query("UPDATE accounts SET lastlogin = '$time' WHERE id = ". $_SESSION['Logged']);
}
?>