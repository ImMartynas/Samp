<?php
echo '<span style="font-size:24px;font-weight:bold;padding-left:18px">Administratorių sąrašas</span>
<div style="background-color:#c7eebd;border:1px solid #2f8c19;color:#2f8c19;padding:12px">
<span style="font-size:14px;font-weight:bold">Pagr. administratorius:</span><br />';
$result = mysql_query('SELECT id,Name FROM players WHERE Admin>3');
$row = mysql_fetch_array($result);
echo $row['Name'];
echo '<br /><br /><span style="font-size:14px;font-weight:bold">Super administratoriai:</span><br />';
$result = mysql_query('SELECT id,Name FROM players WHERE Admin=3');
while($row = mysql_fetch_array($result))
echo '' .$row['Name']. '<br />';
echo '<br /><span style="font-size:14px;font-weight:bold">Administratoriai:</span><br />';
$result = mysql_query('SELECT id,Name FROM players WHERE Admin=2');
while($row = mysql_fetch_array($result))
echo '' .$row['Name']. '<br />';
echo '<br /><span style="font-size:14px;font-weight:bold">Moderatoriai:</span><br />';
$result = mysql_query('SELECT id,Name FROM players WHERE Admin=1');
while($row = mysql_fetch_array($result))
echo '' .$row['Name']. '<br />';
echo '<br /><br /><span style="font-style:italic;font-size:10px;">Išviso: <b>' .mysql_num_rows(mysql_query('SELECT id FROM players WHERE Admin>0')). '</b></span>';
echo '<br /><br /><span style="font-size:14px;font-weight:bold">VVP administratoriai/tikrintojai:</span><br />';
$result = mysql_query('SELECT id,name FROM accounts WHERE Admin>0');
while($row = mysql_fetch_array($result))
echo '' .$row['name']. '<br />';
echo '<br /><br /><span style="font-style:italic;font-size:10px;">Išviso: <b>' .mysql_num_rows(mysql_query('SELECT id FROM accounts WHERE Admin>0')). '</b></span>';
echo '</div>';
?>