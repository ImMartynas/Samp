<?php
$rezz = mysql_query('SELECT id,Vardas,Admin,Direktorius FROM profiliai WHERE id='.$_SESSION['Logged']);
$newestrow = mysql_fetch_array($rezz);
if ($_SESSION['Logged']>0 || $newestrow['Admin']>1) {
		// Nustatome pagr. puslapiavimo nustatymus
		$recordsPerPage = 60; //narių per puslapį
		$pageNum = 1; //pirmas puslapis
		
		// Jeigu puslapis nustatytas adrese
		// nustatom jo tipą į skaitinį
		if(isset($_GET['p']))
		{
			$pageNum = $_GET['p'];
			settype($pageNum, 'integer');
		}
		
		// Prasideda matematika
		$offset = ($pageNum - 1) * $recordsPerPage;
		
		$search = '';
		// jei įvykdyta paieška
		if (isset($_GET['search']))
		{
			$search = $_GET['search'];
			$search = substr($search, 0, 64); 
			$search = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search); 
			$good = trim(preg_replace("/\s(\S{1,2})\s/", " ", ereg_replace(" +", "  "," $search ")));
			// paieškos užklausa
			//$re = mysql_query('SELECT reg_id,player_name FROM server_users WHERE upper(player_name) LIKE \'%'.$good.'%\'');
			$query = "SELECT id,Vardas FROM profiliai WHERE upper(Vardas) LIKE '%$good%' LIMIT $offset, $recordsPerPage;";
			$skc = mysql_num_rows(mysql_query('SELECT id,Vardas FROM profiliai WHERE upper(Vardas) LIKE \'%'.$good.'%\''));
			if($good == "") echo '<div class="errorbox">Jūsų užklausa neteisinga. Ji gali būti per trumpa, per ilga arba su neteisingais simboliais.</div>';
			$search = '&search=' .$_GET['search']. '';
			if($skc > 0) $error = ''; else $error = '<div class="errorbox">Narių su tokiu ar panašiu slapyvardžiu nerasta</div>';
		}
		else $query = "SELECT id,Vardas FROM profiliai ORDER BY id LIMIT $offset, $recordsPerPage;";
		
		$re = mysql_query($query) or die('MySQL klaida pirmame prisijungime');
		while ($row = mysql_fetch_array($re))
		{
			$data .= '» <a href="page.php?q=player&acc=' .$row['id']. '">' .$row['Vardas']. '</a><br />
			';
		}
		
		//Suskaičiuojam, kiek turim narių
		if (isset($_GET['search']))	$numrows = $skc;
		else
		{
		$q = "SELECT COUNT(id) FROM profiliai;";
		$r = mysql_query($q) or die('MySQL klaida skaičiuojant narius');
		$rowsai = mysql_fetch_array($r);
		$numrows = $rowsai['COUNT(id)'];
		}

		$maxPage = ceil($numrows/$recordsPerPage); // didžiausio puslapio skaičius
		$nav = '';
		for($page = 1; $page <= $maxPage; $page++) {     if ($page == $pageNum)     {         $nav .= "<span style='font-size:12px;font-weight:bold'> $page </span>"; // dabartinio puslapio nuoroda
		}
		else
		{
			$nav .= "<a href=\"/players?p=$page$search\"> $page</a>"; // kitų puslapių nuoroda
		}
		}
		if ($pageNum > 1) {

			$page = $pageNum - 1;
			$prev = "<a href=\"/players?p=$page$search\"><strong> < </strong></a>"; //Ankstesnis puslapis
			$first = "<a href=\"/players?p=1$search\"><strong> << </strong></a>"; //Pirmutinis puslapis
		}
		else
		{
			$prev = '';
			$first = '';
		}

		if ($pageNum < $maxPage) {
			$page = $pageNum + 1;
			$next = "<a href=\"/players?p=$page$search\"><strong> > </strong></a>"; //Sekantis puslapis
			$last = "<a href=\"/players?p=$maxPage$search\"><strong> >> </strong></a>"; //Paskutinis puslapis
		}
		else
		{
			$next = '';
			$last = '';
		}
		echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">Žaidėjų sąrašas</span><br/><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">
		' .$error. '
		' .$data. '
		</div>
		<br />
		<br />
		Pasirinkite puslapį: <br />
		' .$first. ' ' .$prev. ' ' .$nav. ' ' .$next. ' ' .$last. '
		<br />
		<div style="text-align:right;"><form method="GET" action="/players">Ieškoti nario: <input type="text" name="search"><input type="submit" value="Ieškoti"></form><br /><br />Išviso: ' .$numrows. '</div>';
}
else header('Location: /home');

?>