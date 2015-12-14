<?php
if ($_SESSION['Logged']>0) {

if(isset($aInformation) && is_array($aInformation)){
					$time2 = mktime(date("H")+1,date("i")+24);
					$time = date("H:i", $time2); 
echo '<center>
<div style="background-color:#bfcada;border:1px solid #3e536f;color:#3e536f;padding:12px;width:50%">
<table border="1" cellpadding="3" cellspacing="0" rules="rows" frame="below">
<tr>
<td>Pavadinimas:</td>
<td>' .htmlentities($aInformation['Hostname']). '</td>
</tr>
<tr>
<td>Skripto versija</td>
<td>' .htmlentities($aInformation['Gamemode']). '</td>
</tr>
<tr>
<td>Žaidejai</td>
<td>' .$aInformation['Players']. '/' .$aInformation['MaxPlayers']. '</td>
</tr>
<tr>
<td>Veiksmo vieta</td>
<td>' .htmlentities($aInformation['Map']). '</td>
</tr>
<td>IP:</td>
<td>' .$serverIP. ':' .$serverPort. '</td>
<tr>
<td>Laikas</td>
<td>' .$time. '</td>
</tr>
<tr>
<td>SA-MP versija</td>
<td><a href="http://www.gta-mp.lt/files/samp.exe">' .$aServerRules['version']. '</a></td>
</tr>
<tr>
</tr>
</table>
</div>
</center>
<br />';

if(!is_array($aTotalPlayers) || count($aTotalPlayers) == 0){
echo '<center><br /><i>Niekas nežaidžia arba blogai užkrautas puslapis. Perkraukite...</i></center>';
} else {
/*echo '
<center>
<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px;width:50%">
<table width="100%" border="1" cellpadding="3" cellspacing="0" rules="rows" frame="below">
<tr>
<td><b>ID</b></td>
<td><b>Žaidejas</b></td>
<td><b>Lygis</b></td>
</tr>';

foreach($aTotalPlayers AS $id => $value){

echo '<tr>
<td>' .$value['PlayerID']. ' </td>
<td>' .htmlentities($value['Nickname']). '</td>
<td>' .$value['Score']. '</td>
</tr>';

}

echo '</table>
</div>
</center>';*/
echo '<center><div style="background-color:#ccc;border:1px solid #333;padding:5px;width:70%">';
foreach($aTotalPlayers AS $id => $value){
 echo '' .htmlentities($value['Nickname']). ', ';
}
echo '</div></center>';
}
}

}
else header('Location: http://127.0.0.1/web/wb/page.php?q=home');
?>