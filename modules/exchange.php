<?php
if ($_SESSION['Logged']>0) {
$id = $_SESSION['Logged'];
$rezult = mysql_query('SELECT Pinigai,BankoSaskaita,Resp,Kreditai FROM profiliai WHERE id='. $id);
$row = mysql_fetch_array($rezult);

if(isset($_POST['Submitas'])) {
$course = $_POST['kursas'];
	if (empty($course1)){
	if ($course == "1"){
	echo '		<form method="post" action="page.php?q=exchange">
	Turite ta&#353;k&#371;: <b>'.$row['Resp'].'</b>.<br />
	<center>Kiek Ta&#353;k&#371; norite pakeisti &#303; Pinigus? <br />( Kursas: 1 Ta&#353;kas = 50 LT )<br /><br /></center>
	<table align="center">
	<tr>
		<td><select name="kursas1">
<option value="1">5 ta&#353;kus &#303; 250 LT.</option>
<option value="2">10 ta&#353;k&#371; &#303; 600 LT.</option>
<option value="3">50 ta&#353;k&#371; &#303; 4000 LT.</option>
<option value="4">100 ta&#353;k&#371; &#303; 9,000 LT.</option>
<option value="5">200 ta&#353;k&#371; &#303; 20,000 LT.</option>
<option value="6">300 ta&#353;k&#371; &#303; 34,000 LT.</option>
<option value="7">500 ta&#353;k&#371; &#303; 60,000 LT.</option>
<option value="8">1000 ta&#353;k&#371; &#303; 130,000 LT.</option>
</select></td>
		<td style="text-align:right"><input name="Sub2" type="submit" value="Keisti" /></form>
	</tr>
</table>
		<a href="page.php?q=exchange">Atgal</a>';
	}
	
	if ($course == "2"){
	echo '		<form method="post" action="page.php?q=exchange">
	Turite ta&#353;k&#371;: <b>'.$row['Resp'].'</b>.<br />
	<center>Kiek Ta&#353;k&#371; norite pakeisti &#303; Kreditus? <br />( Kursas: 25 Ta&#353;kai = 1 Kreditas )<br /><br />
	<u>Kuo daugiau kei&#269;iate gaunate didesn&#303; pried&#261;</u>!<br /><br />
	Pavizd&#382;iui: Pagal kurs&#261; tur&#279;tum&#279;t gauti u&#382; 1000 ta&#353;k&#371; 40 XP, bet gaunate bonus&#261; 40 !!</center>
	<table align="center">
	<tr>
				<td><select name="kursas1">
<option value="1">25 ta&#353;kus &#303; 1 kredit&#261;.</option>
<option value="2">50 ta&#353;k&#371; &#303; 3 kreditus.</option>
<option value="3">70 ta&#353;k&#371; &#303; 5 kreditus.</option>
<option value="4">100 ta&#353;k&#371; &#303; 7 kreditus.</option>
<option value="5">200 ta&#353;k&#371; &#303; 15 kredit&#371;.</option>
<option value="6">300 ta&#353;k&#371; &#303; 23 kreditus.</option>
<option value="7">500 ta&#353;k&#371; &#303; 39 kreditus.</option>
<option value="8">1000 ta&#353;k&#371; &#303; 80 kredit&#371;.</option>
</select></td>
		<td style="text-align:right"><input name="Sub3" type="submit" value="Keisti" /></form>
	</tr>
</table>
		<a href="page.php?q=exchange">Atgal</a>';
	}
	
	if ($course == "3"){
	echo '		<form method="post" action="page.php?q=exchange">
	Turite ta&#353;k&#371;: <b>'.$row['Resp'].'</b>.<br />
	<center>Kiek Ta&#353;k&#371; norite pakeisti &#303; Pinigus? <br />( Kursas: 1 Taðkas = 1 XP. )<br />
	<u>Kuo daugiau kei&#269;iate gaunate didesn&#303; pried&#261;</u>!</center><br /><br />
	Pavizd&#382;iui: Pagal kurs&#261; tur&#279;tum&#279;t gauti u&#382; 1000 ta&#353;k&#371; 1000 XP, bet gaunate bonus&#261; 240 xp !
	<table align="center">
	<tr>
	<tr>
				<td><select name="kursas1">
<option value="1">25 ta&#353;kus &#303; 25 XP.</option>
<option value="2">50 ta&#353;k&#371; &#303; 55 XP.</option>
<option value="3">70 ta&#353;k&#371; &#303; 80 XP.</option>
<option value="4">100 ta&#353;k&#371; &#303; 120 XP.</option>
<option value="5">200 ta&#353;k&#371; &#303; 245 XP.</option>
<option value="6">300 ta&#353;k&#371; &#303; 370 XP.</option>
<option value="7">500 ta&#353;k&#371; &#303; 620 XP.</option>
<option value="8">1000 ta&#353;k&#371; &#303; 1240 XP.</option>
</select></td>
		<td style="text-align:right"><input name="Sub4" type="submit" value="Keisti" /></form>
	</tr>
</table>
		<a href="page.php?q=exchange">Atgal</a>';
	}

	
	if ($course == "4"){
	echo '		<form method="post" action="page.php?q=exchange">
	Turite Pinig&#371;: <b>'.$row['Pinigai'].'</b>.<br />
	<center>Kiek Pinig&#371; norite pakeisti &#303; Kreditus? <br />( Kursas: 1,800 LT = 1 Kreditas )<br />
	<u>Kuo daugiau kei&#269;iate gaunate didesn&#303; pried&#261;!</u><br /><br />
	Pavizd&#382;iui: 1,800 x 80 = 144,000 sumok&#279;tum&#279;t jaigu keistum&#279;t po vien&#261; , o sutaupote net 2,000 !</center>
	<table align="center">
	<tr>
			<tr>
				<td><select name="kursas1">
<option value="1">1,800 LT. &#303; 1 kredit&#261;.</option>
<option value="2">5,200 LT. &#303; 3 kreditus.</option>
<option value="3">10,000 LT. &#303; 5 kreditus.</option>
<option value="4">13,200 LT. &#303; 7 kreditus.</option>
<option value="5">30,000 LT. &#303; 15 kredit&#371;.</option>
<option value="6">42,500 LT. &#303; 23 kreditus.</option>
<option value="7">71,000 LT. &#303; 39 kreditus.</option>
<option value="8">142,000 LT. &#303; 80 kredit&#371;.</option>
</select></td>
		<td style="text-align:right"><input name="Sub5" type="submit" value="Keisti" /></form>
	</tr>
</table>
		<a href="page.php?q=exchange">Atgal</a>';
	}
	
	if ($course == "5"){
	echo '		<form method="post" action="page.php?q=exchange">
	Turite ta&#353;k&#371;: <b>'.$row['Resp'].'</b>.<br />
	<center>Kiek Pinig&#371; norite pakeisti &#303; XP? <br />(Kursas: 56 LT = 1 XP)<br />
	<u>Kuo daugiau kei&#269;iate gaunate didesn&#303; pried&#261;!</u><br /><br />
	Pavizd&#382;iui: Pagal kurs&#261; tur&#279;tum&#279;t gauti u&#382; 44,800 ta&#353;k&#371; 800 XP, bet bet sutaupote 4,000 LT. !</center>
	<table align="center">
	<tr>
				<td><select name="kursas1">
<option value="1">560 LT. &#303; 10 XP.</option>
<option value="2">1600 LT. &#303; 30 XP.</option>
<option value="3">2,500 LT. &#303; 50 XP.</option>
<option value="4">3,550 LT. &#303; 70 XP.</option>
<option value="5">7,300 LT. &#303; 150 XP.</option>
<option value="6">11,800 LT. &#303; 230 XP.</option>
<option value="7">20,800 LT. &#303; 390 XP.</option>
<option value="8">40,800 LT. &#303; 800 XP.</option>
</select></td>
		<td style="text-align:right"><input name="Sub6" type="submit" value="Keisti" /></form>
	</tr>
</table>
		<a href="page.php?q=exchange">Atgal</a>';
	}
	
}
}
if(isset($_POST['Sub2'])) {
$course1 = $_POST['kursas1'];
		if ($course1 == "1"){
			if($row['Resp']>4){
				mysql_query('UPDATE profiliai SET Resp=Resp-5 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Pinigai=Pinigai+250 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "2"){
			if($row['Resp']>9){
							mysql_query('UPDATE profiliai SET Resp=Resp-10 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Pinigai=Pinigai+600 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "3"){
			if($row['Resp']>49){
							mysql_query('UPDATE profiliai SET Resp=Resp-50 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Pinigai=Pinigai+4000 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "4"){
			if($row['Resp']>99){
							mysql_query('UPDATE profiliai SET Resp=Resp-100 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Pinigai=Pinigai+9000 WHERE id=\''. $id .'\''); 
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "5"){
			if($row['Resp']>199){
							mysql_query('UPDATE profiliai SET Resp=Resp-200 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Pinigai=Pinigai+20000 WHERE id=\''. $id .'\''); 
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "6"){
			if($row['Resp']>299){
							mysql_query('UPDATE profiliai SET Resp=Resp-300 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Pinigai=Pinigai+34000 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "7"){
			if($row['Resp']>499){
							mysql_query('UPDATE profiliai SET Resp=Resp-500 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Pinigai=Pinigai+60000 WHERE id=\''. $id .'\''); 
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "8"){
			if($row['Resp']>999){
							mysql_query('UPDATE profiliai SET Resp=Resp-1000 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Pinigai=Pinigai+130000 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}echo'<a href="page.php?q=exchange">Atgal</a>';
			}
			
			if(isset($_POST['Sub3'])) {
$course1 = $_POST['kursas1'];
		if ($course1 == "1"){
			if($row['Resp']>24){
				mysql_query('UPDATE profiliai SET Resp=Resp-25 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+1 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "2"){
			if($row['Resp']>49){
							mysql_query('UPDATE profiliai SET Resp=Resp-50 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+3 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "3"){
			if($row['Resp']>69){
							mysql_query('UPDATE profiliai SET Resp=Resp-70 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+5 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "4"){
			if($row['Resp']>99){
							mysql_query('UPDATE profiliai SET Resp=Resp-100 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+7 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "5"){
			if($row['Resp']>199){
							mysql_query('UPDATE profiliai SET Resp=Resp-200 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+15 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "6"){
			if($row['Resp']>299){
							mysql_query('UPDATE profiliai SET Resp=Resp-300 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+23 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "7"){
			if($row['Resp']>499){
							mysql_query('UPDATE profiliai SET Resp=Resp-500 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+39 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "8"){
			if($row['Resp']>999){
							mysql_query('UPDATE profiliai SET Resp=Resp-1000 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+80 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}echo'<a href="page.php?q=exchange">Atgal</a>';
			}
			
			if(isset($_POST['Sub4'])) {
$course1 = $_POST['kursas1'];
		if ($course1 == "1"){
			if($row['Resp']>24){
				mysql_query('UPDATE profiliai SET Resp=Resp-25 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+25 WHERE id=\''. $id .'\'');   
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "2"){
			if($row['Resp']>49){
							mysql_query('UPDATE profiliai SET Resp=Resp-50 WHERE id=\''. $id .'\''); 
								mysql_query('UPDATE profiliai SET Xp=Xp+55 WHERE id=\''. $id .'\'');   
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "3"){
			if($row['Resp']>69){
							mysql_query('UPDATE profiliai SET Resp=Resp-70 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+80 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "4"){
			if($row['Resp']>99){
							mysql_query('UPDATE profiliai SET Resp=Resp-100 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+120 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "5"){
			if($row['Resp']>199){
							mysql_query('UPDATE profiliai SET Resp=Resp-200 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+245 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "6"){
			if($row['Resp']>299){
							mysql_query('UPDATE profiliai SET Resp=Resp-300 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+370 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "7"){
			if($row['Resp']>499){
							mysql_query('UPDATE profiliai SET Resp=Resp-500 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+620 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}
		if ($course1 == "8"){
			if($row['Resp']>999){
							mysql_query('UPDATE profiliai SET Resp=Resp-1000 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+1240 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Ta&#353;kai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Ta&#353;k&#371;!</div><br />';
				}echo'<a href="page.php?q=exchange">Atgal</a>';
			}
			
			if(isset($_POST['Sub5'])) {
$course1 = $_POST['kursas1'];
		if ($course1 == "1"){
			if($row['Pinigai']>1799){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-1800 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+1 WHERE id=\''. $id .'\'');  
					echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "2"){
			if($row['Pinigai']>5199){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-5200 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+3 WHERE id=\''. $id .'\'');  
					echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "3"){
			if($row['Pinigai']>9999){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-10000 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+5 WHERE id=\''. $id .'\'');  
					echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "4"){
			if($row['Pinigai']>13199){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-13200 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+7 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "5"){
			if($row['Pinigai']>29999){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-30000 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+15 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "6"){
			if($row['Pinigai']>42499){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-42500 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+23 WHERE id=\''. $id .'\'');  
					echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "7"){
			if($row['Pinigai']>70999){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-71000 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+39 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "8"){
			if($row['Pinigai']>141999){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-142000 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai+80 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}echo'<a href="page.php?q=exchange">Atgal</a>';
			}
			
			if(isset($_POST['Sub6'])) {
$course1 = $_POST['kursas1'];
		if ($course1 == "1"){
			if($row['Pinigai']>559){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-560 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+10 WHERE id=\''. $id .'\'');   
								echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "2"){
			if($row['Pinigai']>1599){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-1600 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+30 WHERE id=\''. $id .'\'');   
								echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "3"){
			if($row['Pinigai']>2499){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-2500 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+50 WHERE id=\''. $id .'\'');   
								echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "4"){
			if($row['Pinigai']>3549){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-3550 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+70 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "5"){
			if($row['Pinigai']>7299){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-7300 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+150 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "6"){
			if($row['Pinigai']>11799){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-11800 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+230 WHERE id=\''. $id .'\'');  
								echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "7"){
			if($row['Pinigai']>20799){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-20800 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+390 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';				
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}
		if ($course1 == "8"){
			if($row['Pinigai']>40799){
							mysql_query('UPDATE profiliai SET Pinigai=Pinigai-40800 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Xp=Xp+800 WHERE id=\''. $id .'\'');  
				echo '<div class="checking">Pinigai sekmingai i&#353;keisti!<br></div><br />';
					}
					else echo '<div class="errorbox"><b>Klaida!</b> Neturite tiek Pinig&#371;!</div><br />';
				}echo'<a href="page.php?q=exchange">Atgal</a>';
			}
if(empty($course) && empty($course1)){
echo '<center><br /><h2>Keitykla</h2><br /><center>';
echo 'Turite Pinig&#371; Rankose: <b>'.$row['Pinigai'].'</b> LT.<br />
Turite Pinig&#371;: <b>'.$row['BankoSaskaita'].'</b> LT.<br />
Turite Kredit&#371;: <b>'.$row['Kreditai'].'</b>.<br />
Turite Pagarbos ta&#353;k&#371;: <b>'.$row['Resp'].'</b>.<br />
	<tr>
		<td style="width:280px"><b>Pasirinkite kurs&#261;</b><br /></td>
		<form method="post" action="page.php?q=exchange">
		<td>		<select name="kursas">
<option value="1">Pagarbos ta&#353;kai > &#381;aidimo pinigai</option>
<option value="2">Pagarbos ta&#353;kai > Kreditai</option>
<option value="3">Pagarbos ta&#353;kai > XP</option>
<option value="4">Pinigai > Kreditai</option>
<option value="5">Pinigai > XP</option>
</select></td>
<td style="text-align:right"><input name="Submitas" type="submit" value="T&#281;sti" /></form>';
}
}
else header('Location: page.php?q=home');
?>