<!-- home.php - pradinis vartotojų panelės puslapis -->

<?php

function ReturnText($dec) {
	if (strval($dec) == 1) return 'Taip';
	else return 'Ne';
}

function VIPLevel($lev) {
	if (strval($lev) == 0) return 'Paprastas žaidėjas';
	if (strval($lev) == 1) return 'Bronze V.I.P.';
	if (strval($lev) == 2) return 'Silver V.I.P.';
	else return 'GOLD V.I.P.';
}

function FuelType($typ) {
	if (strval($typ) == 1) return 'Benzinas';
	elseif (strval($typ) == 2) return 'Dyzelis';
	else return 'Dujos';
}
function GetVehicleName($model) {
	switch ($model) {
		case 400: $string = 'Landstalker'; break;
		case 401: $string = 'Bravura'; break;
		case 402: $string = 'Buffalo'; break;
		case 403: $string = 'Linerunner'; break;
		case 404: $string = 'Perennial'; break;
		case 405: $string = 'Sentinel'; break;
		case 406: $string = 'Dumper'; break;
		case 407: $string = 'Firetruck'; break;
		case 408: $string = 'Trashmaster'; break;
		case 409: $string = 'Stretch'; break;
		case 410: $string = 'Manana'; break;
		case 411: $string = 'Infernus'; break;
		case 412: $string = 'Voodoo'; break;
		case 413: $string = 'Pony'; break;
		case 414: $string = 'Mule'; break;
		case 415: $string = 'Cheetah'; break;
		case 416: $string = 'Ambulance'; break;
		case 417: $string = 'Leviathan'; break;
		case 418: $string = 'Moonbeam'; break;
		case 419: $string = 'Esperanto'; break;
		case 420: $string = 'Taxi'; break;
		case 421: $string = 'Washington'; break;
		case 422: $string = 'Bobcat'; break;
		case 423: $string = 'Mr Whoopee'; break;
		case 424: $string = 'BF Injection'; break;
		case 425: $string = 'Hunter'; break;
		case 426: $string = 'Premier'; break;
		case 427: $string = 'Enforcer'; break;
		case 428: $string = 'Securicar'; break;
		case 429: $string = 'Banshee'; break;
		case 430: $string = 'Predator'; break;
		case 431: $string = 'Bus'; break;
		case 432: $string = 'Rhino'; break;
		case 433: $string = 'Barracks'; break;
		case 434: $string = 'Hotknife'; break;
		case 435: $string = 'Trailer'; break;
		case 436: $string = 'Previon'; break;
		case 437: $string = 'Coach'; break;
		case 438: $string = 'Cabbie'; break;
		case 439: $string = 'Stallion'; break;
		case 440: $string = 'Rumpo'; break;
		case 441: $string = 'RC Bandit'; break;
		case 442: $string = 'Romero'; break;
		case 443: $string = 'Packer'; break;
		case 444: $string = 'Monster'; break;
		case 445: $string = 'Admiral'; break;
		case 446: $string = 'Squalo'; break;
		case 447: $string = 'Seasparrow'; break;
		case 448: $string = 'Pizzaboy'; break;
		case 449: $string = 'Tram'; break;
		case 450: $string = 'Trailer'; break;
		case 451: $string = 'Turismo'; break;
		case 452: $string = 'Speeder'; break;
		case 453: $string = 'Reefer'; break;
		case 454: $string = 'Tropic'; break;
		case 455: $string = 'Flatbed'; break;
		case 456: $string = 'Yankee'; break;
		case 457: $string = 'Caddy'; break;
        case 458: $string = 'Solair'; break;
        case 459: $string = 'Berkley\'s RC Van'; break;
        case 460: $string = 'Skimmer'; break;
        case 461: $string = 'PCJ-600'; break;
        case 462: $string = 'Faggio'; break;
        case 463: $string = 'Freeway'; break;
        case 464: $string = 'RC Baron'; break;
        case 465: $string = 'RC Raider'; break;
        case 466: $string = 'Glendale'; break;
        case 467: $string = 'Oceanic'; break;
        case 468: $string = 'Sanchez'; break;
        case 469: $string = 'Sparrow'; break;
        case 470: $string = 'Patriot'; break;
        case 471: $string = 'Quad'; break;
        case 472: $string = 'Coastguard'; break;
        case 473: $string = 'Dinghy'; break;
        case 474: $string = 'Hermes'; break;
		case 475: $string = 'Sabre'; break;
		case 476: $string = 'Rustler'; break;
		case 477: $string = 'ZR-350'; break;
		case 478: $string = 'Walton'; break;
		case 479: $string = 'Regina'; break;
		case 480: $string = 'Comet'; break;
		case 481: $string = 'BMX'; break;
		case 482: $string = 'Burrito'; break;
		case 483: $string = 'Camper'; break;
		case 484: $string = 'Marquis'; break;
		case 485: $string = 'Baggage'; break;
		case 486: $string = 'Dozer'; break;
		case 487: $string = 'Maverick'; break;
		case 488: $string = 'News Chopper'; break;
		case 489: $string = 'Rancher'; break;
		case 490: $string = 'FBI Rancher'; break;
		case 491: $string = 'Virgo'; break;
		case 492: $string = 'Greenwood'; break;
		case 493: $string = 'Jetmax'; break;
		case 494: $string = 'Hotring'; break;
		case 495: $string = 'Sandking'; break;
		case 496: $string = 'Blista Compact'; break;
		case 497: $string = 'Police Maverick'; break;
		case 498: $string = 'Boxville'; break;
		case 499: $string = 'Benson'; break;
		case 500: $string = 'Mesa'; break;
		case 501: $string = 'RC Goblin'; break;
		case 502: $string = 'Hotring Racer'; break;
		case 503: $string = 'Hotring Racer'; break;
		case 504: $string = 'Bloodring Banger'; break;
		case 505: $string = 'Rancher'; break;
		case 506: $string = 'Super GT'; break;
		case 507: $string = 'Elegant'; break;
		case 508: $string = 'Journey'; break;
		case 509: $string = 'Bike'; break;
		case 510: $string = 'Mountain Bike'; break;
		case 511: $string = 'Beagle'; break;
		case 512: $string = 'Cropdust'; break;
		case 513: $string = 'Stunt'; break;
		case 514: $string = 'Tanker'; break;
		case 515: $string = 'RoadTrain'; break;
		case 516: $string = 'Nebula'; break;
		case 517: $string = 'Majestic'; break;
		case 518: $string = 'Buccaneer'; break;
		case 519: $string = 'Shamal'; break;
		case 520: $string = 'Hydra'; break;
		case 521: $string = 'FCR-900'; break;
		case 522: $string = 'NRG-500'; break;
		case 523: $string = 'HPV1000'; break;
		case 524: $string = 'Cement Truck'; break;
		case 525: $string = 'Tow Truck'; break;
		case 526: $string = 'Fortune'; break;
		case 527: $string = 'Cadrona'; break;
		case 528: $string = 'FBI Truck'; break;
		case 529: $string = 'Willard'; break;
		case 530: $string = 'Forklift'; break;
		case 531: $string = 'Tractor'; break;
		case 532: $string = 'Combine'; break;
		case 533: $string = 'Feltzer'; break;
		case 534: $string = 'Remington'; break;
		case 535: $string = 'Slamvan'; break;
		case 536: $string = 'Blade'; break;
		case 537: $string = 'Freight'; break;
		case 538: $string = 'Streak'; break;
		case 539: $string = 'Vortex'; break;
		case 540: $string = 'Vincent'; break;
		case 541: $string = 'Bullet'; break;
		case 542: $string = 'Clover'; break;
		case 543: $string = 'Sadler'; break;
		case 544: $string = 'Firetruck'; break;
		case 545: $string = 'Hustler'; break;
		case 546: $string = 'Intruder'; break;
		case 547: $string = 'Primo'; break;
		case 548: $string = 'Cargobob'; break;
		case 549: $string = 'Tampa'; break;
		case 550: $string = 'Sunrise'; break;
		case 551: $string = 'Merit'; break;
		case 552: $string = 'Utility Truck'; break;
		case 553: $string = 'Nevada'; break;
		case 554: $string = 'Yosemite'; break;
		case 555: $string = 'Windsor'; break;
		case 556: $string = 'Monster'; break;
		case 557: $string = 'Monster'; break;
		case 558: $string = 'Uranus'; break;
		case 559: $string = 'Jester'; break;
		case 560: $string = 'Sultan'; break;
		case 561: $string = 'Stratum'; break;
		case 562: $string = 'Elegy'; break;
		case 563: $string = 'Raindance'; break;
		case 564: $string = 'RCTiger'; break;
		case 565: $string = 'Flash'; break;
		case 566: $string = 'Tahoma'; break;
		case 567: $string = 'Savanna'; break;
		case 568: $string = 'Bandito'; break;
		case 569: $string = 'Freight'; break;
		case 570: $string = 'Trailer'; break;
		case 571: $string = 'Kart'; break;
		case 572: $string = 'Mover'; break;
		case 573: $string = 'Dune'; break;
		case 574: $string = 'Sweeper'; break;
		case 575: $string = 'Broadway'; break;
		case 576: $string = 'Tornado'; break;
		case 577: $string = 'AT-400'; break;
		case 578: $string = 'DFT-30'; break;
		case 579: $string = 'Huntley'; break;
		case 580: $string = 'Stafford'; break;
		case 581: $string = 'BF-400'; break;
		case 582: $string = 'Newsvan'; break;
		case 583: $string = 'Tug'; break;
		case 584: $string = 'Trailer'; break;
		case 585: $string = 'Emperor'; break;
		case 586: $string = 'Wayfarer'; break;
		case 587: $string = 'Euros'; break;
		case 588: $string = 'Hotdog'; break;
		case 589: $string = 'Club'; break;
		case 590: $string = 'Trailer'; break;
		case 591: $string = 'Trailer'; break;
		case 592: $string = 'Andromada'; break;
		case 593: $string = 'Dodo'; break;
		case 594: $string = 'RC Cam'; break;
		case 595: $string = 'Launch'; break;
		case 596: $string = 'Police Car (LSPD)'; break;
		case 597: $string = 'Police Car (SFPD)'; break;
		case 598: $string = 'Police Car (LVPD)'; break;
		case 599: $string = 'Police Ranger'; break;
		case 600: $string = 'Picador'; break;
		case 601: $string = 'S.W.A.T. Van'; break;
		case 602: $string = 'Alpha'; break;
		case 603: $string = 'Phoenix'; break;
		case 604: $string = 'Glendale'; break;
	    case 605: $string = 'Sadler'; break;
	    case 606: $string = 'Luggage Trailer'; break;
	    case 607: $string = 'Luggage Trailer'; break;
	    case 608: $string = 'Stair Trailer'; break;
	    case 609: $string = 'Boxville'; break;
	    case 610: $string = 'Farm Plow'; break;
	    case 611: $string = 'Utility Trailer'; break;
		default : $string = 'Nera'; break;
	}
	return $string;
}

if ($_SESSION['Logged'] > 0) {
	
	$rezz = mysql_query('SELECT id,Vardas,Xp,Admin,Pinigai,BankoSaskaita,Telefonas,Numeris,Kreditai,MTeises,Teises,GinkluL,Isvaizda,Resp,Warn,Vip,Banned,Ieskomumas,NamoTalonas FROM profiliai WHERE id='.$_SESSION['Logged']);
			$row = mysql_fetch_array($rezz);
			echo '
			
<table style="width:100%">
	<tr>
		<td style="width:50%;vertical-align:top">
			<span style="font-size:24px;font-weight:bold;padding-left:18px">'. $row['Vardas'] .'</span> 
			<br /><br />
			<div style="background-color:#f3eacd;border:1px solid #a28522;color:#a28522;padding:12px">Žaidėjo patirtis:<b> '. $row['Xp'] .'</b> XP.<br />
			';
			
			if ($row['Admin']>0) echo 'Administratoriaus lygis: <b>'. $row['Admin'] .'</b><br />
			';
			
			echo 'Grynieji pinigai: <b>'. $row['Pinigai'] .' </b>Lt<br />Banko Saskaita: '; 
			if ($row['BankoSaskaita']==0) echo '<i> Neturi </i><br />';
			else {
			echo '<i> Turi </i><br />';
			$rez = mysql_query('SELECT * FROM saskaitos WHERE id='.$row['BankoSaskaita']);
			$roww = mysql_fetch_array($rez);
			echo 'Pinigai Saskaitoje: <b>'. $roww['Suma'] .'</b> Lt<br />
			';
			}
			
			echo 'Telefono numeris: ';
			if ($row['Telefonas']==0) { echo '<i> Neturi telefono.</i><br />';}
			
			elseif ($row['Telefonas']==1) { echo ' <b>'. $row['Numeris'] .'</b><br />';}
			
echo '</div><br />	';		
			echo'
			<div style="background-color:#f3eacd;border:1px solid #a28522;color:#a28522;padding:12px">
VIP lygis: <b><i>'. VIPLevel($row['Vip']).'</b></i><br />
Turi įspėjimų: <b>'.$row['Warn'].'</b>.<br />
UžBlokuotas: <b><i>'. ReturnText($row['Banned']).'</i></b>.<br />
Ieškomumo lygis: <b>'.$row['Ieskomumas'].'</b>.<br />
Namo talonas: <b>'. ReturnText($row['NamoTalonas']).'</b>.<br />
Turimi kreditai: <b>'. $row['Kreditai'] .'</b>. <br />
Pagarbos taškai: <b>'.$row['Resp'].'</b>. <br />
</div><br />


<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">
<span style="font-size:14px;font-weight:bold">Licenzijos:</span><br /><br />
Motociklo teisės: <b><i>'. ReturnText($row['MTeises']) .'</i></b><br />
Mašinos teisės: <b><i>'. ReturnText($row['Teises']) .'</i></b><br />
Ginklo teisės: <b><i>'. ReturnText($row['GinkluL']) .'</i></b><br />
</div>';

			/*if ($row['Direktorius']>=1) {
				echo '<br /><div style="background-color:#bfcada;border:1px solid #3e536f;color:#3e536f;padding:12px">
<span style="font-size:14px;font-weight:bold">Frakcijos informacija:</span><br />
Pavadinimas: '. $newrow['name'] .'<br />
Rangas: '. $newrow['rank'. $row['FRank']] .
'</div>';
			}*/
			
			$newresult = mysql_query('SELECT ID,Savininkas,Uzrakintas,sPinigai,Kaina FROM namai WHERE Savininkas=\''. $row['Vardas'] .'\'');{
			
			if ($newrow = mysql_fetch_array($newresult)) {
							$house = 1;
				echo '
<br /><div style="background-color:#dec1a9;border:1px solid #a25618;color:#a25618;padding:12px">
<span style="font-size:14px;font-weight:bold">N.turtas: Namas(-ai)</span><br /><br />
<b>1</b>)Namo numeris: <b>'.$newrow['ID'].'</b>.<br /><br />Kaina: <b>'. $newrow['Kaina'].'</b> Lt. <br />Pinigai namie: <b>'. $newrow['sPinigai'].'</b> Lt.<br /> Užrakinta: <b>'.ReturnText($newrow['Uzrakintas']) .'</b><br />
';
			}
			while ($newrow = mysql_fetch_array($newresult)) {
					$house++;
					echo '<br /><br /><b>'. $house .'</b>) Namo numeris: <b>'.$newrow['ID'].'</b>.<br /><br />Kaina: <b>'. $newrow['Kaina'].'</b> Lt. <br />Pinigai namie: <b>'. $newrow['sPinigai'].'</b> Lt.<br /> Užrakinta: <b>'.ReturnText($newrow['Uzrakintas']) .'</b><br />';
					
					} echo '</div>';
				}
			
			$newresult = mysql_query('SELECT Pavadinimas,Kaina,Moka,Pinigai,Darbuotojai FROM bizniai WHERE Nupirktas=1 AND Savininkas=\''. $row['Vardas'] .'\'');{
			
			while ($newrow = mysql_fetch_array($newresult)) {
				echo '
<br /><div style="background-color:#d1dcdc;border:1px solid #135e5f;color:#135e5f;padding:12px;">
<span style="font-size:14px;font-weight:bold">Verslas: "'. $newrow['Pavadinimas'] .'"</span><br /><br />
Sukaupta: <b>'. $newrow['Pinigai'] .'</b> Lt.<br />
Vertė: <b>'. $newrow['Kaina'] .'</b> Lt.<br />
Mokestis: <b>'.$newrow['Mokestis'].'</b> Lt/val.<br />
Moka: <b>'. $newrow['Moka'] .'</b> Lt/val.<br />
Dirba: <b>'. $newrow['Darbuotojai'] .'</b> žmonės(-ių).
</div>';
			}
		}	
			
			$newresult = mysql_query('SELECT name,fondas,nariai FROM gaujos WHERE leader=\''. $row['id'] .'\'');{
			
			while ($newrow = mysql_fetch_array($newresult)) {
				echo '
			<br /><div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">
<span style="font-size:14px;font-weight:bold">Gauja: "'. $newrow['name'] .'"</span><br /><br />
Fonde: <b>'. $newrow['fondas'] .'</b> Lt.<br />
Turi narių: <b>'. $newrow['nariai'] .'</b> Nariai(-ių).<br />

</div>';
			}
		}

			$newresult = mysql_query('SELECT * FROM transportas WHERE Owner=\''. $row['Vardas'] .'\'');{
			
			while ($newrow = mysql_fetch_array($newresult)) {
				echo '
<br /><div style="background-color:#e5d2d9;border:1px solid #784255;color:#784255;padding:12px">
<span style="font-size:14px;font-weight:bold">Transportas: "'. GetVehicleName($newrow['Model']) .'"</span><br /><br />

<table>
	<tr>
		<td style="color:#784255;width:60%">Numeriai: <b>'. $newrow['Plate'] .'</b></td>
		<td style="color:#784255">Rida: <b>'. $newrow['Kilometrai'] .'</b> km. <b>'. $newrow['Metrai'] .'</b> m.</td>
	</tr>
	<tr>
		<td style="color:#784255">Kuro Tipas: <b>'. FuelType($newrow['FuelT']) .'<b></td>
		<td style="color:#784255">Likę Kuro: <b>'. $newrow['Fuel'] .'</b> L.</td>
	</tr>
	<td style="color:#784255">Signalizacija: <b>'. ReturnText($newrow['Alarm']) .'<b></td>
</table>

</div>';
			}
		}
			echo '
		</td>
		<td style="width:50%;text-align:center">
			<img src="images/skins/big/'. $row['Isvaizda'] .'.png" /><br />
			<a href="page.php?q=changeskin&id='. $row['id'] .'&action=changeskin">Keisti išvaizdą?</a>
		</td>
	</tr>
</table>';
	
	echo '
	<br /><center>--------------------------------------------------------</center>
	
	<br />';
	
		//VARTOTOJO INFORMACIJA
	$rzmem = mysql_query('SELECT COUNT(id) FROM nariai');
	$rowmem = mysql_fetch_array($rzmem);
	$rzchar = mysql_query('SELECT COUNT(id) FROM profiliai');
	$rowchar = mysql_fetch_array($rzchar);
	$rzpend = mysql_query('SELECT COUNT(admname) FROM bans');
	$rowpend = mysql_fetch_array($rzpend);
	echo '
	<br/><br/>
	<center>
	<div style="background:#bfcada url(template/images/stats.png) no-repeat right;border:1px solid #3e536f;color:#3e536f;padding:12px;text-align:left;width:80%"><span style="font-size:14px;font-weight:bold">Statistika:</span><br /><span style="font-size:9px;font-weight:bold">Jūsų turimi VVP įspėjimai: ' .$rowem['ucpwarns']. ' | Prisijungusių žmonių prie VVP: '.users_online(users).' | Prisijungusių anketų tikrintojų: '.users_online(adm).'<br />Išviso vartotojų: ' .$rowmem['COUNT(id)']. ' | Išviso veikėjų: ' .$rowchar['COUNT(id)']. ' | Išviso draudimų žaisti: ' .$rowpend['COUNT(admname)']. '<br /><br />';

	$adminresult = mysql_query('SELECT Vardas,Priimti,Atmesti FROM reportai ORDER BY Priimti+Atmesti DESC LIMIT 1');
	
	

	echo'
	Aktyviausias administratorius - '. $adminresult['Vardas'] .'. Priimti reportai: '. $adminresult['Priimti'] .', atmesti reportai: '. $adminresult['Atmesti'] .'<br />
	Pasyviausias administratorius - ';

	$adminresult = mysql_query('SELECT Vardas,Priimti,Atmesti FROM reportai ORDER BY Priimti+Atmesti ASC LIMIT 1');
	
	if ($admmas = mysql_fetch_array($adminresult))
	{
		$adminresult = mysql_query('SELECT Vardas FROM profiliai WHERE id='. $_SESSION['Logged']);
		$vard = mysql_fetch_array($adminresult);
	}
	else
	{
		$vard['Vardas'] = 'Nerasta';
		$admmas['Priimti'] = 0;
		$admmas['Atmesti'] = 0;
	}

	echo $vard['Vardas'] .'. Priimti reportai: '. $admmas['Priimti'] . ', atmesti reportai: '. $admmas['Atmesti'];

	mysql_free_result($adminresult);
	unset($adminresult,$admmas,$vard);

	$aktresult = mysql_query('SELECT Vardas,Xp FROM profiliai ORDER BY Xp DESC LIMIT 1');
	
	if (!($aktmas = mysql_fetch_array($aktresult)))
	{
		$aktmas['Vardas'] = 'Nerasta';
		$aktmas['Xp'] = 0;
	}

	echo '
	<br /><br />Aktyviausias žaidėjas yra '. $aktmas['Vardas'] .', kuris pražaidė '. $aktmas['Xp'] .'h.';

	mysql_free_result($aktresult);
	unset($aktresult,$aktmas);

	echo '</span>
	<br /><br />
	<center><input type="button" class="mygtukas" onclick="window.location=\'page.php?q=online\'" value="Peržiūrėti, kas dabar prisijungę!" /></center></div>
	</div>
	</center>';
	
}
else
{
echo '<div class="top">
      <div class="top_bg">
	  
        <!-- scrollable -->		
                  <div class="scrollable">
                    <div class="items">
                      <div class="item">
                        <div class="header1"></div>
                      </div>
                      <!-- item -->
                      <div class="item">
                        <div class="header2"></div>
                      </div>
                      <!-- item -->
                      <div class="item">
                        <div class="header3"></div>
                      </div>
                      <!-- item -->
                      <div class="item">
                        <div class="header4"></div>
                      </div>
					  
					   <!-- item -->
                      <div class="item">
                        <div class="header5"></div>
                      </div>
					  					  
					   <!-- item -->
                      <div class="item">
                        <div class="header6"></div>
                      </div>
					  
                    </div>
                    <!-- items -->
                  </div>
				</div>  
			  
                <div style="clear: both"></div>
	  
	  </div>';	
	// Vartotojas yra neprisijungęs
	
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
echo 'Naujienų nėra.';
} else {
$getnews=mysql_query('SELECT data,autorius,pavadinimas,naujiena FROM naujienos ORDER BY data DESC LIMIT 1');
$newsres = mysql_fetch_array($getnews);
echo '<b>Naujausia</b><br />Pavadinimas: "<font style="text-transform:uppercase;"><b>'. $newsres['pavadinimas'] .'</b>"</font><br />
pagal <b>'.$newsres['autorius'].'</b>, '.$newsres['data'].'<br /><br />
'.$newsres['naujiena'].'<br /><br /><br /><b>Taipat kitos naujienos:</b><br />';

$allq=mysql_query('SELECT id,pavadinimas FROM naujienos ORDER BY data');
while ($allr=mysql_fetch_array($allq)){
echo ' &#187; <a href="/news?read='.$allr['id'].'" alt="Skaityti"><font color="black">'.$allr['pavadinimas'].'</font></a><br />';
}
}
}

echo '</td></tr></table>';


}

?>