<?php

if ($_SESSION['Logged']>0) {
$id = $_SESSION['Logged'];
$rezult = mysql_query('SELECT * FROM profiliai WHERE id='. $id);
$row = mysql_fetch_array($rezult);
$kreditai = $row['Kreditai'];
$VIP=$row['Vip'];
$psl = $_GET['psl'];


if (isset($_GET['veiksm'])) {
	$veiksm = $_GET['veiksm'];
	if ($veiksm == "isp" ) {
		if($row['Warn']>0){
			$rez = mysql_query('SELECT * FROM profiliai WHERE id='. $id .' AND Warn>0');
					if ($VIP==0) $reikia=9;
					elseif ($VIP==1) $reikia=8;
					elseif ($VIP==2) $reikia=6;
					elseif ($VIP==3) $reikia=4;
					if ($row['Kreditai']>$reikia){
					mysql_query('UPDATE profiliai SET Warn=Warn-1 WHERE id='. $id);
					$reikia++;
					$isp = $row['Warn'] - 1;
					echo '<div class="checking">Įspėjimas žaidėjui <b>'. $row['Vardas'] .'</b> nuimtas sėkmingai už <b>'.$reikia.' kreditų</b> dar liko: '.$isp.' įspėjim.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';	
					mysql_query('UPDATE profiliai SET Kreditai=Kreditai-'.$reikia.' WHERE id='. $id);
						
		}
		else echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų nuimti <b>'. $row['Vardas'] .'</b> įspėjimą. Reikia '.$reikia.' krd.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';	
	}
	else echo '<div class="errorbox"><b>Klaida!</b> Žaidėjas neturi įspėjimų.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}

	elseif ($veiksm == "money"){
			if ($row['Vip']==0) $gauna=50;
			elseif ($row['Vip']==1) $gauna=54;
			elseif ($row['Vip']==2) $gauna=61;
			elseif ($row['Vip']==3) $gauna=75;
			if($kreditai > 19){
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET Pinigai=Pinigai+'.$gauna.'000 WHERE id=\''. $id .'\'');  
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-20 WHERE id='. $id);
				echo '<div class="checking">Žaidėjui '.$row['Vardas'].' pridėta '.$gauna.',000 LT. Į piniginę!<br></div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
			}
			else echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų nusipirkti Pinigų.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	
	elseif ($veiksm == "xp"){

		if ($row['Vip']==0) $gauna=500;
		elseif ($row['Vip']==1) $gauna=550;
		elseif ($row['Vip']==2) $gauna=600;
		elseif ($row['Vip']==3) $gauna=670;
			if($kreditai > 9){
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET Xp=Xp+'.$gauna.' WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-10 WHERE id='. $id);
				echo '<div class="checking">Žaidėjui '.$row['Vardas'].' pridėta '.$gauna.' patirties taškų!<br></div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
			}
			else echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų nusipirkti Patirties taškų.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	
		elseif ($veiksm == "house"){
			if($row['NamoTalonas']==0){
				if($kreditai > 49){
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET NamoTalonas=1 WHERE id=\''. $id .'\'');  
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-50 WHERE id='. $id);
				echo '<div class="checking">Žaidėjas '.$row['Vardas'].' gavo Namo taloną.<br></div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
				}
				else echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų nusipirkti Namo Talonui.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
			}
			else echo '<div class="errorbox"><b>Klaida!</b> Žaidėjas jau turi Namo Taloną.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	
	elseif ($veiksm == "freedom" ){
	if ($row['Vip']==0) $kaina=15;
elseif ($row['Vip']==1) $kaina=13;
elseif ($row['Vip']==2) $kaina=10;
elseif ($row['Vip']==3) $kaina=6;
			if($row['Ieskomumas']>0) {
			if ($kreditai >= $kaina) {
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET Ieskomumas=0 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-'.$kaina.' WHERE id='. $id);
				echo '<div class="checking">Vartotojas <b>'. $row['Vardas'] .'</b> buvo sekmingai išteisintas.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
		}
		else echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų išteisinti '. $row['Vardas'] .'. Reikia '.$kaina.' krd. </div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	else echo '<div class="errorbox"><b>Klaida!</b> Žaidėjo Policija negaudo.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	
	elseif ($veiksm == "vip"){
		if($row['Vip']==0) {
			if($kreditai > 24){
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET Vip=1 WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET NickPoints=1 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-25 WHERE id='. $id);
				echo '<div class="checking">Sveikiname Isigijus Bronze VIP statusą!<br>Jūs gavote 1 kart. Nemokamai pasikeisti vardą ir kitas privilegijas kurios yra išvardintos.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
			}
			else echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų nusipirkti Bronze VIP statusą.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
		}
		else echo '<div class="errorbox"><b>Klaida!</b> Vartotojas jau turi Bronze VIP statusą.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	
		elseif ($veiksm == "vip1"){
		if($row['Vip'] < 2) {
		if($kreditai > 39){
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET Vip=2 WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET NickPoints=2 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-40 WHERE id='. $id);
				echo '<div class="checking">Sveikiname Isigijus Silver VIP statusą!<br>Jūs gavote 2 kart. Nemokamai pasikeisti vardą ir kitas privilegijas kurios yra išvardintos.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
			}
			else echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų nusipirkti Silver VIP statusą.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
		}
		else echo '<div class="errorbox"><b>Klaida!</b> Vartotojas jau turi Silver VIP statusą.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	
			elseif ($veiksm == "vip2"){
	if($row['Vip'] < 3) {
		if($kreditai > 54){
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET Vip=3 WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET NickPoints=3 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-55 WHERE id='. $id);
				echo '<div class="checking">Sveikiname Isigijus Paskutinijį GOLD VIP statusą!<br>Jūs gavote 3 kart. Nemokamai pasikeisti vardą ir kitas privilegijas kurios yra išvardintos.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
			
			}
			else echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų nusipirkti GOLD VIP statusą.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
		}
		else echo '<div class="errorbox"><b>Klaida!</b> Vartotojas jau turi GOLD VIP statusą.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	
	elseif ($veiksm == "drpas"){
					if ($VIP==0) $reikia=34;
					elseif ($VIP==1) $reikia=32;
					elseif ($VIP==2) $reikia=30;
					elseif ($VIP==3) $reikia=24;
	if($kreditai > $reikia){
		if($row['Banned']==1) {
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET Banned=0 WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET BannedReason=0 WHERE id=\''. $id .'\''); 
				$reikia++;
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-'.$reikia.' WHERE id='. $id);
				echo '<div class="checking">Draudimas žaisti už <b>"'. $row['BannedReason'] .'"</b> Vartotojui <b>'. $row['Vardas'] .'</b> yra nuimtas sėkmingai už <b>'.$reikia.' kred.</b></div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
			}
			else echo '<div class="errorbox"><b>Klaida!</b> Vartotojui nėra uždrausta žaisti.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
		}
		else { $reikia++; echo '<div class="errorbox"><b>Klaida!</b> Nepakanka kreditų Atblokuoti žaidėją. Reikia '.$reikia.' krd.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';}
	}
	
		elseif ($veiksm == "kljmlaik" ){
			if($row['KalejimoLaikas']>0) {
			$min = $row['KalejimoLaikas'];
			$kaina = ceil($min * 0.05);
			if ($kaina > $kreditai) echo '<div class="errorbox"><b>Klaida!</b> <i>Nepakanka kreditų išleisti '. $row['Vardas'] .' iš kalėjimo. Reikia '.$kaina.'</i></div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
			mysql_query('SELECT * FROM profiliai WHERE id=\''. $id .'\''); 
			mysql_query('UPDATE profiliai SET KalejimoLaikas=0 WHERE id=\''. $id .'\''); 
				mysql_query('UPDATE profiliai SET Kreditai=Kreditai-'.$kaina.' WHERE id='. $id);
				echo '<div class="checking">Vartotojui <b>'. $row['Vardas'] .'</b> kalėjimas yra nuimtas sėkmingai už <b>'.$kaina.'</b></div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
	else echo '<div class="errorbox"><b>Klaida!</b> Žaidėjas nėra kaleime.</div><br /><a href="page.php?q=vip&psl=">Atgal</a>';
	}
}
if (!empty($veiksm)){}
else {
echo '<h2>Kreditų Naudojimas</h2>
<p>Jūs galite užsisakyti tam tikras paslaugas už turimus kreditus visos paslaugos pateiktos apačioje.<br />Jūsų turimi kreditai: <b> '.$kreditai.' </b>. (<a href="page.php?q=vip&psl=paaiskinimas5">Kaip gauti?</a>)</p>';
if($psl == 'paaiskinimas5') {
echo '<table class="centered" style="margin-top:20px;width:639px;background-color:#f2e9d6;border:1px solid #f0a425"><td style="padding:33px 15px"><br /><br />
Siūskite Nurodyta Žinutę su tekstu: <b><br>Kreditai '.$row['Vardas'].' </b> numeriu: 1649.<br /><br /><u>Įspėjimas! Jaigu kur nors klaidą padarysite pinigai bus nuimti o jūs nieko negausite Vardas ir Raktožodis turi būti tikslūs kaip ir nurodyti!</u><br /><br/>Pavizdys: <b>Kreditai Abrahamas_Linkolnas</b> - ir jūs gausite 10 kreditų, žinutės kaina 1LTL.<br /><br /><a href="page.php?q=vip&psl=">[<u>Paslėpti</u>]</a><br /><br /></td></table>';
}
echo '<hr /><center><h3>VIP užsisakymas</h3>
<p>VIP užsisakote visam laikui nebent gaunate Block`ą arba administratorius atema iš jūsų. <br />
VIP privilegijos yra tokios jog visur jiems taikoma kažkokia nuolaida, jie gali turėti savo Klubus ir t.t<br />VIP lygis     Kaina<br /> 
<b>BRONZE - 25 kreditai.<br />
SILVER - 40 kreditų.<br />
GOLD - 55 kreditai.<br /> </b><a href="page.php?q=vip&psl=paaiskinimas">[Išskleisti paaiškinimus]</a><br /><br/>';
if($psl == 'paaiskinimas') {
echo '<table class="centered" style="margin-top:20px;width:639px;background-color:#f2e9d6;border:1px solid #f0a425"><td style="padding:33px 15px"><b>Bronze</b> tai <u>pirmasis</u> VIP lygis užsisakes jį galėsite vairuoti <u>"Elegy" automobilį, galėsite patekti į Oro uostą,VIP miestą</u>, Taip pat galėsite <u>pasikeisti vardą 1 kartą</u>. Bei gausite <u>nuolaida</u> visiems pirkiniams tinklapyje. <br /><br />';
echo '<b>Silver</b> tai <u>antrasis</u> VIP lygis užsisakes jį galėsite vairuoti <u>"Elegy" bei "Banshee" automobilius, galėsite patekti į Oro uostą,VIP miestą bei galėsite turėti savo Klubą</u> už tam tikrą kainą, Taip pat galėsite <u>pasikeisti vardą 2 kartus</u>. Bei gausite <u>nuolaida</u> visiems pirkiniams tinklapyje. <br /><br />';
echo '<b>Gold</b> tai <u>trečiasis</u> VIP lygis užsisakes jį galėsite vairuoti <u>"Elegy","Banshee","Bullet" bei "NRG-500", galėsite patekti į Oro uostą,VIP miestą taipat galėsite turėti savo Klubą,namą norimoje vietoje</u> už tam tikrą kainą, Taip pat galėsite pasikeisti <u>vardą 3 kartus</u>. Bei gausite <u>nuolaida</u> visiems pirkiniams tinklapyje. <br /><br /><a href="page.php?q=vip&psl=">[<u>Paslėpti</u>]</a><br /><br /></td></table>';

}
if ($row['Vip'] >2) echo '<i>Jūs jau turite GOLD VIP statusą.</i><br />';

if($row['Vip']==0){
	if ($kreditai > 24) {
	echo '<a href="page.php?q=vip&veiksm=vip&psl=">Užsisakyti BRONZE VIP</a><br />';
	}
else echo 'Nepakanka kreditų';	
	}


if ($kreditai > 39) {
		if($row['Vip'] < 2){
		echo '<a href="page.php?q=vip&veiksm=vip1&psl=">Užsisakyti SILVER VIP</a><br />';
		}
	}
if ($kreditai > 54) {
	if($row['Vip'] < 3){
	echo '<a href="page.php?q=vip&veiksm=vip2&psl=">Užsisakyti GOLD VIP</a><br />';
	}
	}

if ($row['Vip']==0) $gauna=50;
elseif ($row['Vip']==1) $gauna=54;
elseif ($row['Vip']==2) $gauna=61;
elseif ($row['Vip']==3) $gauna=75;

echo '</p><h3>Pinigų pirkimas</h3>
<p>Reikia pinigų? O turite tik kreditų? <br />Kaina: <b>20</b> kreditų = '.$gauna.',000 LT.<br /><a href="page.php?q=vip&psl=paaiskinimas1">[<u><blink>VIP`ai GAUNA DAUGIAU</blink>!</u>]</a><br/><br/>';
if($psl == 'paaiskinimas1') {
echo '<table class="centered" style="margin-top:20px;width:639px;background-color:#f2e9d6;border:1px solid #f0a425"><td style="padding:33px 15px"><br /><br />Bronze VIP Gauna: 54,000 LT.<br />';
echo "Silver VIP Gauna: 61,000 LT.<br />";
echo "Gold VIP Gauna: 75,000 LT.<br />";
echo '<br /><br /><a href="page.php?q=vip&psl=">[<u>Paslėpti</u>]</a><br /><br /><td></table>';
}
if($row['Kreditai']>19){
echo '<a href="page.php?q=vip&veiksm=money&psl=">Pridėti '.$row['Vardas'].' '.$gauna.',000 LT.</a>';
}
else echo '<i>Nepakanka kreditų.</i>';

if ($row['Vip']==0) $gauna=500;
elseif ($row['Vip']==1) $gauna=550;
elseif ($row['Vip']==2) $gauna=600;
elseif ($row['Vip']==3) $gauna=670;

echo '</p><h3>Patirties pirkimas</h3>
<p>Norite stoti į Svajonių darbą? O trūksta tik trupučio? <br />Kaina: <b>10</b> kreditų = '.$gauna.' xp.<br /><a href="page.php?q=vip&psl=paaiskinimas1">[<u><blink>VIP`ai GAUNA DAUGIAU</blink>!</u>]</a><br/><br/>';
if($psl == 'paaiskinimas1') {
echo '<table class="centered" style="margin-top:20px;width:639px;background-color:#f2e9d6;border:1px solid #f0a425"><td style="padding:33px 15px"><br /><br />Bronze VIP Gauna: 550 xp.<br />';
echo "Silver VIP Gauna: 600 xp.<br />";
echo "Gold VIP Gauna: 670 xp.<br />";
echo '<br /><br /><a href="page.php?q=vip&psl=">[<u>Paslėpti</u>]</a><br /><br /><td></table>';
}
if($row['Kreditai']>9){
echo '<a href="page.php?q=vip&veiksm=xp&psl=">Pridėti '.$row['Vardas'].' '.$gauna.' xp.</a>';
}
else echo '<i>Nepakanka kreditų.</i>';

echo '</p><h3>Namo talono pirkimas</h3>
<p>Norite būti garantuotas kad kritiniu atvėju jums išeitų namas? <br />Kaina: <b>50</b> kreditų.<br /> Už šį taloną išeina bent kuris namas NEMOKAMAI.<br/><br/>';
if ($row['NamoTalonas']==0){
	if($row['Kreditai']>49)
	{
	echo '<a href="page.php?q=vip&veiksm=house&psl=">Pirkti namo taloną.</a>';
	}
	else echo '<i>Nepakanka kreditų.</i>';
}
else echo '<i>Jūs jau turite Namo taloną.</i>';

if ($row['Vip']==0) $kaina=15;
elseif ($row['Vip']==1) $kaina=13;
elseif ($row['Vip']==2) $kaina=10;
elseif ($row['Vip']==3) $kaina=6;

echo '</p><h3>Išteisinimas</h3>
<p>Policija sekioja jus ant kiekvieno kampo? Niekas neima kyšių? <br />Kaina: <b>'.$kaina.'</b> kreditai(-ų).<br /><a href="page.php?q=vip&psl=paaiskinimas1">[<u><blink>VIP`ams PIGIAU</blink>!</u>]</a><br/><br/>';
if($psl == 'paaiskinimas1') {
echo '<table class="centered" style="margin-top:20px;width:639px;background-color:#f2e9d6;border:1px solid #f0a425"><td style="padding:33px 15px"><br /><br />Bronze VIP Kaina: 23 kreditai.<br />';
echo "Silver VIP Kaina: 21 kreditas.<br />";
echo "Gold VIP Kaina: 15 kreditų.<br />";
echo '<br /><br /><a href="page.php?q=vip&psl=">[<u>Paslėpti</u>]</a><br /><br /><td></table>';
}

if ($row['Ieskomumas'] == 0) echo '<i>Žaidėjo Policija negaudo.</i>';
elseif ($row['Kreditai']>=$kaina){
	echo '<a href="page.php?q=vip&veiksm=freedom&psl=">Nuimti '.$row['Vardas'].' ieškomumą.</a>';
	}
	else echo 'Nepakanka kreditų';


if ($row['Vip']==0) $kaina=25;
elseif ($row['Vip']==1) $kaina=23;
elseif ($row['Vip']==2) $kaina=21;
elseif ($row['Vip']==3) $kaina=15;

echo '</p><h3>Vardo Keitimas</h3>
<p>Vartotojo vardą galite dažniausiai keičiamasi dėl "CELEBRITY" t.y. ižimybės vardo turėjimo . <br />Kaina: <b>'.$kaina.'</b> kreditai(-ų).<br /> Bėje galite <b>'.$row['NickPoints'].'</b> kart. pasikeisti vardą nemokamai.<br /><a href="page.php?q=vip&psl=paaiskinimas1">[<u><blink>VIP`ams PIGIAU</blink>!</u>]</a><br/><br/>';
if($psl == 'paaiskinimas1') {
echo '<table class="centered" style="margin-top:20px;width:639px;background-color:#f2e9d6;border:1px solid #f0a425"><td style="padding:33px 15px"><br /><br />Bronze VIP Kaina: 23 kreditai.<br />';
echo "Silver VIP Kaina: 21 kreditas.<br />";
echo "Gold VIP Kaina: 15 kreditų.<br />";
echo '<br /><br /><a href="page.php?q=vip&psl=">[<u>Paslėpti</u>]</a><br /><br /><td></table>';
}

if ($kreditai >= $kaina)
{
	
	echo '<a href="page.php?q=changename">Pasikeisti vardą</a>';

	
} else { 
echo '<i>Nepakanka kreditų.</i>';
} 
if ($row['Vip']==0) $kaina=10;
elseif ($row['Vip']==1) $kaina=9;
elseif ($row['Vip']==2) $kaina=7;
elseif ($row['Vip']==3) $kaina=5;


echo '</p><h3>Įspėjimų nuėmimas</h3>
<p>Surinkus žaidėjui 3 įspėjimus žaidėjas gauna Block`ą ir už Atblokavimą kaina tampa didesnė. <br />Kaina: <b>1- įspėjimas = '.$kaina.' kreditai(-ų)</b>.<a href="page.php?q=vip&psl=paaiskinimas2">[<u><blink>VIP PIGIAU</blink>!</u>]</a><br/><br/>';
if($psl == 'paaiskinimas2') {
echo "<br /><br />Bronze VIP Kaina: 1 - įspėjimas 9 kreditai.<br />";
echo "Silver VIP Kaina: 1 įspėjimas 7 kreditai.<br />";
echo "Gold VIP Kaina: 1 - įspėjimas 5 kreditai.<br />";
echo '<br /><br /><a href="page.php?q=vip&psl=">[<u>Paslėpti</u>]</a><br /><br />';
}
if ($row['Warn'] < 1) echo '<i>Žaidėjas neturi įspėjimų.</i>';
elseif ($kreditai >= $kaina) echo '<a href="page.php?q=vip&psl=&veiksm=isp&zaid='. $id .'">Nuimti '. $row['Vardas'] .' įspėjimą</a>';
 else echo'Nepakanka kreditų.'; 

 if ($row['Vip']==0) $kaina=35;
elseif ($row['Vip']==1) $kaina=33;
elseif ($row['Vip']==2) $kaina=31;
elseif ($row['Vip']==3) $kaina=25;
 
 echo '</p>
<h3>Block`o nuemimas</h3>
<p>Gavus Block`a Jūs nebetenkate galimybės žaisti serveryje už tai kad prasižengėte taisyklėms.<br /> Kaina: <b>'.$kaina.' kreditai(-as)</b>.<a href="page.php?q=vip&psl=paaiskinimas3">[<u><blink>VIP`ams PIGIAU</blink>!</u>]</a><br/><br/>';
if($psl == 'paaiskinimas3') {
echo "<br /><br />Bronze VIP Kaina: 33 kreditai.<br />";
echo "Silver VIP Kaina: 31 kreditas.<br />";
echo "Gold VIP Kaina: 25 kreditai.<br />";
echo '<br /><br /><a href="page.php?q=vip&psl=">[<u>Paslėpti</u>]</a><br /><br />';
}
if (!$row['Banned']==1) echo '<i>Jums nėra uždrausta žaisti serveryje.</i>';
elseif ($kreditai >= $kaina) echo '<a href="page.php?q=vip&psl=&veiksm=drpas">Nuimti draudimą (Priežastis: '. $row['BannedReason'] .')</a>';
else echo 'Nepakanka kreditų.';
?></p>

<h3>Kalėjimo nuėmimas</h3>
<p>Nusižengus taisyklei administracija Jus įkalina į kalėjimą. </b> Kaina: <b>1 kreditas = 20 minučių</b>.<br/><br/> Įspėjimas Kreditai apvalinami iki Sveikų skaičių... Pvz= 0.05 bus 1.<br/><br/><?php

	if ($row['KalejimoLaikas'] == 0) echo '<i>Žaidėjas nėra kalėjime.</i>';
	else{
		$rez = mysql_query('SELECT * FROM profiliai WHERE id='. $_SESSION['Logged'] .'');
		$row = mysql_fetch_array($rez);
			$min = $row['KalejimoLaikas'];
			$kaina = ceil($min * 0.05);
			if ($kaina > $kreditai) echo '<i>Nepakanka kreditų išleisti '. $row['Vardas'] .' iš kalėjimo</i> ';
			else echo '<a href="page.php?q=vip&veiksm=kljmlaik&psl=&zaid='. $_SESSION['Logged'] .'">Nuimti '. $row['Vardas'] .' kalėjimo laiką ('. $min .'min, '. $kaina .' kr.)</a> ';
	
}
?></p>
</center>
<?php	
}
}
else header('Location: page.php?q=home');
?>