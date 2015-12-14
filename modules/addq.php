<?php

// Patikrinam ar vartotojas turi tam tikras teises lankytis šiame puslapyje
if ($_SESSION['Logged'] > 0 &&$_SESSION['Admin'] > 1) {
	// Jei yra nurodytas veiksmas
	if (isset($_GET['action'])) {
		if ($_GET['action']=='del') {
			if (isset($_GET['id'])) {
				mysql_query('DELETE FROM rpquiz WHERE id='. $_GET['id']);
				header('Location: /addq');
			}
		}
		elseif ($_GET['action']=='edit') {
			if (isset($_GET['id'])) {
				if (isset($_POST['quest'])) {
					mysql_query('UPDATE rpquiz SET question=\''. $_POST['quest'] .'\',answer1=\''. $_POST['answer1'] .'\',answer2=\''. $_POST['answer2'] .'\',answer3=\''. $_POST['answer3'] .'\',correct='. $_POST['ta'] .' WHERE id='. $_GET['id']);
					header('Location: /addq');
				}
				else {
					$result = mysql_query('SELECT question,answer1,answer2,answer3,correct FROM rpquiz WHERE id='. $_GET['id']);
					
					if ($row = mysql_fetch_array($result)) {
						echo '<br />
							
<form method="post" action="/addq?action=edit&id='. $_GET['id'] .'">
<div style="text-align:center;font-size:24px;font-weight:bold">Redaguoti testo klausimą</div><br />

<table align="center">
	<tr>
		<td>Klausimas:</td>
		<td><input name="quest" type="text" value="'. $row['question'] .'" maxlength="99" /></td>
	</tr>
	<tr>
		<td>Atsakymas1:</td>
		<td><input name="answer1" type="text" value="'. $row['answer1'] .'" maxlength="49"></td>
	</tr>
	<tr>
		<td>Atsakymas2:</td>
		<td><input name="answer2" type="text" value="'. $row['answer2'] .'" maxlength="49"></td>
	</tr>
	<tr>
		<td>Atsakymas3:</td>
		<td><input name="answer3" type="text" value="'. $row['answer3'] .'" maxlength="49"></td>
	</tr>
	<tr>
		<td>Teisingas ats:</td>
		<td><select name="ta"><option value="'. $row['correct'] .'">'. $row['correct'] .'</option>';
						for ($i=1;$i<=3;$i++) {
							if ($i==$row['correct']) continue;
							else echo '<option value="'. $i .'">'. $i .'</option>';
						}
						echo '</select>
		</td>
	</tr>
</table>

<div style="text-align:center">
	<input name="esub" type="submit" value="Pateikti" /> 
	<input name="" type="reset" value="I&scaron;valyti" />
</div>

</form>';
					}
					else echo '<div class=\"errorbox\">Klaida</div>';
				}
			}
		}
	}
	else {
		if (isset($_POST['quest'])) {
			mysql_query('INSERT INTO rpquiz (question,answer1,answer2,answer3,correct) VALUES (\''. $_POST['quest'] .'\',\''. $_POST['answer1'] .'\',\''. $_POST['answer2'] .'\',\''. $_POST['answer3'] .'\','. $_POST['ta'] .')');
			header('Location: /addq');
		}
		else {
			echo '<br />
			
<form action="/addq" method="post">

<div style="text-align:center;font-size:24px;font-weight:bold">Pridėti klausimų į testą</div><br />

<div style="text-align:center">

<table class="centered">
	<tr>
		<td>Klausimas:</td>
		<td><input name="quest" type="text" maxlength="99" /></td>
	</tr>
	<tr>
		<td>Atsakymas1:</td>
		<td><input name="answer1" type="text" maxlength="49"></td>
	</tr>
	<tr>
		<td>Atsakymas2:</td>
		<td><input name="answer2" type="text" maxlength="49"></td>
	</tr>
	<tr>
		<td>Atsakymas3:</td>
		<td><input name="answer3" type="text" maxlength="49"></td>
	</tr>
	<tr>
		<td>Teisingas ats:</td>
		<td><select name="ta"><option value="1">1</option><option value="2">2</option><option value="2">3</option></select></td>
	</tr>
</table>

</div>

<div style="text-align:center">
	<input type="submit" value="Pateikti" /> 
	<input type="reset" value="I&scaron;valyti" />
</div>

</form><br />

<table style="width:100%;border:2px solid #184577;background-color:#d9e2ec">
	<tr>
		<th style="background-color:#184577;color:#d9e2ec">Klausimas</th>
		<th style="background-color:#184577;color:#d9e2ec">1 atsakymas</th>
		<th style="background-color:#184577;color:#d9e2ec">2 atsakymas</th>
		<th style="background-color:#184577;color:#d9e2ec">3 atsakymas</th>
		<th style="background-color:#184577;color:#d9e2ec">T.ats</th>
		<th style="background-color:#184577;color:#d9e2ec">Veiksmas</th>
	</tr>';
			
			$result = mysql_query('SELECT * FROM rpquiz');
			$bright = false;
			
			while ($row = mysql_fetch_array($result)) {
				if ($bright) {
					echo '<tr style="background-color:#ecf0f4">';
					$bright = false;
				}
				else {
					echo '<tr>';
					$bright = true;
				}
				echo '<td>'. $row['question'] .'</td><td>'. $row['answer1'] .'</td><td>'. $row['answer2'] .'</td><td>'. $row['answer3'] .'</td><td style="text-align:center">'. $row['correct'] .'</td><td>•<a href="page.php?q=addq&action=del&id='. $row['id'] .'">Trinti</a><br />•<a href="/addq?action=edit&id='. $row['id'] .'">Redaguoti</a></td></tr>';
			}
			echo "</table>";
		}
	}
}
else header('Location: /home');

?>