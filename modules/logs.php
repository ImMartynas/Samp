<?
if ($_SESSION['Logged']>0 && $_SESSION['Admin'] > 1 || $_SESSION['Logged'] == 489) {
	if ($_GET['log'] == "warns")
	{

		$file = file_get_contents('./modules/logs/warns_log.txt', FILE_USE_INCLUDE_PATH);
		echo '<pre>'.$file.'</pre>';

	}
	elseif ($_GET['log'] == "bans")
	{
		$file = file_get_contents('./modules/logs/unban_log.txt', FILE_USE_INCLUDE_PATH);
		echo '<pre>'.$file.'</pre>';
	}
	else
	{
		echo '<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">
		<span style="font-size:14px;font-weight:bold">Pasirinkite, kokį log\'ą norite peržiūrėti:</span>
		<br /><br />
		<a href="/logs?log=warns">VVP įspėjimų log\'ą</a>
		<br />
		<a href="/logs?log=bans">Žaidimo ban\'ų log\'ą</a>
		<br />';
	}
}
 else header('Location: /home');
?>
