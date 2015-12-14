<?php
if ($_SESSION['Logged']>0 && $_SESSION['Admin']>1 || $_SESSION['Logged'] == 69) {
	//Jei ieškome pagal IP
	if ($_GET['ip'] > 0){
		$ip = $_GET['ip'];
		$count = false;
		echo '<center><span style="font-size:24px;font-weight:bold;padding-left:18px">VVP vartotojai, kurių IP ' .$ip. '</span></center><br /><br />';
		$result = mysql_query("SELECT id,name FROM `accounts` WHERE lastip='$ip' OR regip='$ip'");
			while($row = mysql_fetch_array($result))
			{
				$count = true;
				echo '<div style="color:#8b610f;padding:10px;border:1px solid #8b610f;background-color:#ecdfc6"><span style="font-size:10px;font-weight:bold">';
				echo '<b>VVP slapyvardis:</b> <a href="/checkacc?acc=' .$row['id']. '">' .$row['name']. '</a>';
				echo '<br />';
				echo '</div>
				<br />';		
			}
		
		if(!$count) echo '<div class="errorbox">Klaida!<br>Vartotojo tokiu IP nėra.</div><br /><div style="text-align:center"><a href="/findacc">Grįžti atgal</a></div>';
	}
	//Jei ieškome pagal veikėjo vardą
	elseif ($_GET['charname'] != "") {
		$charas = $_GET['charname'];
		$result1 = mysql_query("SELECT id FROM `players` WHERE Name='$charas'");
		$row1 = mysql_fetch_array($result1);
		$charoID = $row1['id'];
			if($charoID != ""){
				$rezult = mysql_query("SELECT id,name FROM accounts WHERE accid1='$charoID' OR accid2='$charoID'");
				$rowz = mysql_fetch_array($rezult);
				echo '<div style="color:#8b610f;padding:10px;border:1px solid #8b610f;background-color:#ecdfc6"><span style="font-size:10px;font-weight:bold">VVP vartotojas turintis veikėją tokiu vardu yra <a href="/checkacc?acc='.$rowz['id'].'">'.$rowz['name'].'</a><br><br><a href="/findacc">Grįžti į paiešką.</a></div>';
			}
			else
			{
				echo '<div class="errorbox">Klaida!<br>Veikėjo tokiu vardu nėra.</div><br /><div style="text-align:center"><a href="/findacc">Grįžti atgal</a></div>';
			}
	}
	elseif ($_GET['ucpname'] != "")
	{
		echo '<center><span style="font-size:24px;font-weight:bold;padding-left:18px">Vartotojas ' .$_GET['ucpname']. ' rastas!</span></center><br /><br />';
		$result = mysql_query("SELECT id,name FROM `accounts` WHERE name='$_GET[ucpname]'");
		$row = mysql_fetch_array($result);	
		if($row['name'] != ""){
			echo '<div align="center" style="color:#8b610f;padding:10px;border:1px solid #8b610f;background-color:#ecdfc6"><span style="font-size:18px;font-weight:bold;">';
			echo '<a href="/checkacc?acc=' .$row['id']. '">Žiūrėti ' .$row['name']. ' duomenis</a>.';
			echo '</div>';
		}
		else
		{
			echo '<div class="errorbox">Klaida!<br>VVP vartotojo tokiu vardu nėra.</div><br /><div style="text-align:center"><a href="/findacc">Grįžti atgal</a></div>';
		}
	}
	else
	{
	//Jei paieška, dar neįvykdyta
	echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">VVP vartotojo paieška</span><br/><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">';
	echo '<a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>IP: <input type=\\\'text\\\' name=\\\'ip\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal IP</a>';
	echo '<br><a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>Veikėjo vardas: <input type=\\\'text\\\' name=\\\'charname\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal veikėjo vardą</a>';
	echo '<br><a href="javascript:;" onclick="document.getElementById(\'laukelis\').innerHTML = \'<form action=\\\' '.$_SERVER['php_self'].'\\\' method=\\\'get\\\'>VVP vardas: <input type=\\\'text\\\' name=\\\'ucpname\\\' /> <input type=\\\'submit\\\' value=\\\'Ieškoti\\\' /></form>\';">Ieškoti pagal VVP vardą</a>';
	echo '<br><span id="laukelis"></span></div>';
	}
}
else echo '<div class="errorbox">Jūs neturite priėjimo prie šio puslapio.</div>';
?>
