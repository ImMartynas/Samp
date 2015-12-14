<?php
if($_SESSION['Logged'] > 0)
{
	//Prisijungę prie VVP
	$resultlog = mysql_query('SELECT name,admin,lastlogin,logged FROM accounts ORDER BY name');
	$time2 = mktime(date("H"),date("i")+20,date("s"),date("m"),date("d"),date("Y"));
	$time = date("Y-m-d H:i:s", $time2);
	$nr = '0';
	echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">
	<span style="font-size:14px;font-weight:bold">Dabar prisijungę prie VVP:</span><br /><br />';
	while ($rowlog = mysql_fetch_array($resultlog))
	{
		if ($rowlog['lastlogin'] >= $time && $rowlog['logged'] > 0)
		{
			if ($nr != 0) echo ', ';
			if ($rowlog['admin'] > 1) echo '<span style="color:#CC0000;font-weight:bold;">';
			if ($rowlog['admin'] == 1) echo '<span style="color:#CC9900;font-weight:bold;">';
			echo $rowlog['name'];
			if ($rowlog['admin'] > 0) echo '</span>';
			$nr++;
		}
	}
	echo '<br /><br />
	<span style="font-style:italic;font-size:10px;">Išviso: <b> ' .users_online(users). '</b><br />Legenda: <span style="color:#CC0000;font-weight:bold;">VVP administratoriai</span>, <span style="color:#CC9900;font-weight:bold;">VVP anketų tikrintojai</span>.
	</div>';
	//Prisijungę IG
	$nr = '0';
	echo '<br /><br />
	<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">
	<span style="font-size:14px;font-weight:bold">Dabar prisijungę žaidime:</span><br /><br />';
	if ($aInformation['Players'] == "Informacija neužkrauta") echo 'Informacija neužkrauta. Perkraukite puslapį.';
	else
	{
		foreach($aTotalPlayers AS $id => $value)
		{
			$result = mysql_query('SELECT Admin FROM players WHERE Name=\''.$value['Nickname'].'\'');
			$r = mysql_fetch_array($result);
			if ($nr != 0) echo ', ';
			if ($r['Admin'] == 4) echo '<span style="color:#CC0000;font-weight:bold;">';
			if ($r['Admin'] == 3) echo '<span style="color:#990000;font-weight:bold;">';
			if ($r['Admin'] == 2) echo '<span style="color:#006600;font-weight:bold;">';
			if ($r['Admin'] == 1) echo '<span style="color:#00CC00;font-weight:bold;">';
			echo $value['Nickname'];
			if ($r['Admin'] > 0) echo '</span>';
			$nr++;
		}
	}
	echo '<br /><br />
	<span style="font-style:italic;font-size:10px;">Išviso: <b>' .$aInformation['Players']. '</b><br />Legenda: <span style="color:#CC0000;font-weight:bold;">Pagr. administratoriai</span>, <span style="color:#990000;font-weight:bold;">Super administratoriai</span>, <span style="color:#006600;font-weight:bold;">Administratoriai</span>, <span style="color:#00CC00;font-weight:bold;">Moderatoriai</span>.
	</div>';
}
else header('Location: /home');
?>