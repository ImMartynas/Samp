<?php
function IsValidSkin($skinid) {
	if ($skinid>299 || $skinid<1) return false;
	switch ($skinid) {
		case 3; case 4; case 5; case 6; case 8; case 42; case 65; case 74; case 86; case 119; case 149; case 208; case 268; case 273; case 289; case 280; case 281; case 267; case 265; case 283; case 284; case 285; case 286; case 274; case 287; case 266; case 282; case 288; case 250; case 276; case 275; case 70; case 228; case 170; case 188; case 186; case 98; case 185; case 187; case 60; case 59; case 223; case 98; case 46; case 227; case 164; case 165; case 163; case 166; case 150; case 300; case 147:
			return false;
			break;
	}	
	return true;
}

if ($_SESSION['Logged'] && isset($_GET['id']))
{
	$id = $_GET['id'];
	if ($_SESSION['Logged']==$id) {
		if (isset($_GET['action'])) {
			if ($_GET['action']=='changeskin') {
				if (isset($_REQUEST['skinid'])) {
					if (IsValidSkin($_REQUEST['skinid'])) {
						mysql_query('UPDATE profiliai SET Isvaizda='. $_REQUEST['skinid'] .' WHERE id='. $id);
						header('Location: page.php?q=home');
					}
					else echo '<div class="errorbox">Pasirinkta išvaidzda yra uždrausta.</div><br />
<div style="text-align:center"><a href="page.php?q=changeskin&id='. $id .'&action=changeskin">Grįžti atgal</a></div>';
				}
				else {
					echo '<div style="text-align:center;font-size:24px;font-weight:bold">Keisti žaidėjo išvaizdą</div>
<br /><br />

<div style="text-align:center">

<table align="center" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="template/images/pvart.png" style="float:left" />
			<div style="margin-left:20px;margin-top:20px;width:448px;text-align:center;padding:16px 41px;background-color:#f0d6ae;border:1px solid #942c14;color:#942c14">
			<span style="font-size:14px;font-weight:bold">Nustatyti išvaizdą pagal jos identifikavimo kodą:</span><br />
			
			<form method="post" action="page.php?q=changeskin&action=changeskin&id='. $id .'">
			
			<input name="skinid" type="text" maxlength="3" /> <input type="submit" value="Si&#371;sti" />
			
			</form>
			
			</div>
		</td>
	</tr>
</table>

</div><br /><br />

<span style="padding-left:15px;color:#3f466b">Taip pat galite pasirinkti išvaizdą iš šio sąrašo:</span>

<br /><div style="margin:2px;padding:3px;border:1px solid #3f466b;background-color:#dcdff0">';
					for ($i=1;$i<300;$i++) {
						if (IsValidSkin($i)) echo '<a href="page.php?q=changeskin&action=changeskin&id='. $id .'&skinid='. $i .'"><img src="images/skins/'. $i .'.jpg" style="padding:1px;border:1px solid #222222;margin:2px;width:55px;height:100px" /></a>';
					}
					echo '</div>';
				}
			}
		}  else header('Location: page.php?q=home');
	} else header('Location: page.php?q=home');
}
?>