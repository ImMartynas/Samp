

<td style="width:2px">
	<img src="template/images/menu_stop.jpg" alt="menu stop" />
</td>

<td class="activemenu" onclick="window.location='page.php?q=home'">Pradinis</td>

<td style="width:2px">
	<img src="template/images/menu_stop.jpg" alt="menu stop" />
</td>

<td class="menu" onclick="window.location='page.php?q=home'">Forumai</td>

<td style="width:2px;">
	<img src="template/images/menu_stop.jpg" alt="menu stop" />
</td>
<?php

if ($_SESSION['Logged']==0)
	echo '<td class="menu" onclick="window.location=\'page.php?q=register\'">Registruotis</td>
	<td style="width:2px"><img src="template/images/menu_stop.jpg" alt="menu stop" /></td>
	<td class="menu" onclick="window.location=\'page.php?q=help\'">Naujokas?</td>
	<td style="width:2px"><img src="template/images/menu_stop.jpg" alt="menu stop" /></td>';
	
else {

	echo '<td class="menu" onclick="window.location=\'page.php?q=logout\'">Atsijungti</td>
	<td style="width:2px">
		<img src="template/images/menu_stop.jpg" alt="menu stop" />
	</td>';
}

?>