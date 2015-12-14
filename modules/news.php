<?php

echo '<span class="h1">Naujienos</span>
<table style="background-color: #ffffff;color: #000000;" width="100%"><tr><td>';

if (@$_GET['read']){
$getnew=mysql_query('SELECT data,autorius,pavadinimas,naujiena FROM naujienos WHERE id=\''.$_GET['read'].'\' LIMIT 1');
$newres = mysql_fetch_array($getnew);
echo '<font style="text-transform:uppercase;"><b>'. $newres['pavadinimas'] .'</b></font><br />
pagal <b>'.$newres['autorius'].'</b>, '.$newres['data'].'<br /><br />
'.$newres['naujiena'].'<br />';
echo '<br /><a href="/news"><font color="black">Atgal</font></a>';
} else {

$newscoq=mysql_query("SELECT count(id) FROM naujienos");
$newscores=mysql_fetch_array($newscoq);
if ($newscores['count(id)'] < 1){
echo 'Naujienø nëra.';
} else {
$getnews=mysql_query('SELECT data,autorius,pavadinimas,naujiena FROM naujienos ORDER BY data DESC LIMIT 1');
$newsres = mysql_fetch_array($getnews);
echo '<b>Naujausia</b><br />Pavadinimas: "<font style="text-transform:uppercase;"><b>'. $newsres['pavadinimas'] .'</b>"</font><br />
pagal <b>'.$newsres['autorius'].'</b>, '.$newsres['data'].'<br /><br />
'.$newsres['naujiena'].'<br /><br /><br /><b>Taipat kitos naujienos:</b><br />';

$allq=mysql_query('SELECT id,pavadinimas FROM naujienos ORDER BY data');
while ($allr=mysql_fetch_array($allq)){
echo '<a href="/news?read='.$allr['id'].'" alt="Skaityti"><font color="black">'.$allr['pavadinimas'].'</font></a><br />';
}
}
}

echo '</td></tr></table>';

?>