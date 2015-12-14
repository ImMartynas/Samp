<?php

//Serverio nustatymai
$serverIP = 'srv.justhost.lt';
$serverPort = '8011';


//Ði klasë skirta parodyti serverio informacijà

class QueryServer
{
private $szServerIP;
private $iPort;
private $rSocketID;

private $bStatus;

function __construct( $szServerIP, $iPort )
{
$this->szServerIP = $this->VerifyAddress( $szServerIP );
$this->iPort = $iPort;

if (empty( $this->szServerIP ) || !is_numeric( $iPort )) {
throw new QueryServerException( 'IP adresas arba portas yra ávestas blogai.' );
}

$this->rSocketID = @fsockopen( 'udp://' . $this->szServerIP, $iPort, $iErrorNo, $szErrorStr, 5 );
if (!$this->rSocketID) {
throw new QueryServerException( 'Neina prisijungti prie serverio: ' . $szErrorStr );
}

socket_set_timeout( $this->rSocketID, 0, 500000 );
$this->bStatus = true;
}

function VerifyAddress( $szServerIP )
{
if (ip2long( $szServerIP ) !== false &&
long2ip( ip2long( $szServerIP ) ) == $szServerIP ) {
return $szServerIP;
}

$szAddress = gethostbyname( $szServerIP );
if ($szAddress == $szServerIP) {
return "";
}

return $szAddress;
}

function SendPacket( $cPacket )
{
$szPacket = 'SAMP';
$aIpChunks = explode( '.', $this->szServerIP );

foreach( $aIpChunks as $szChunk ) {
$szPacket .= chr( $szChunk );
}

$szPacket .= chr( $this->iPort & 0xFF );
$szPacket .= chr( $this->iPort >> 8 & 0xFF );
$szPacket .= $cPacket;

return fwrite( $this->rSocketID, $szPacket, strlen( $szPacket ) );
}

function GetPacket( $iBytes )
{
$iResponse = fread( $this->rSocketID, $iBytes );
if ($iResponse === false) {
throw new QueryServerException( 'Prisijungimas á ' . $this->szServerIP . ' nepavyko arba buvo atmestas.' );
}

$iLength = ord( $iResponse );
if ($iLength > 0)
return fread( $this->rSocketID, $iLength );

return "";
}

function Close( )
{
if ($this->rSocketID !== false) {
fclose( $this->rSocketID );
}
}

function toInteger( $szData )
{
$iInteger = 0;

$iInteger += ( ord( @$szData[ 0 ] ) );
$iInteger += ( ord( @$szData[ 1 ] ) << 8 );
$iInteger += ( ord( @$szData[ 2 ] ) << 16 );
$iInteger += ( ord( @$szData[ 3 ] ) << 24 );

if( $iInteger >= 4294967294 )
$iInteger -= 4294967296;

return $iInteger;
}


function GetInfo( )
{
if ($this->SendPacket('i') === false) {
throw new QueryServerException( 'Prisijungimas á ' . $this->szServerIP . ' nepavyko arba buvo atmestas.' );
}

$szFirstData = fread( $this->rSocketID, 4 );
if (empty( $szFirstData ) || $szFirstData != 'SAMP') {
throw new QueryServerException( 'Serveris ' . $this->szServerIP . ' nëra SA-MP.' );
}

fread( $this->rSocketID, 7 );

return array (
'Password' => ord( fread( $this->rSocketID, 1 ) ),
'Players' => $this->toInteger( fread( $this->rSocketID, 2 ) ),
'MaxPlayers' => $this->toInteger( fread( $this->rSocketID, 2 ) ),
'Hostname' => $this->GetPacket( 4 ),
'Gamemode' => $this->GetPacket( 4 ),
'Map' => $this->GetPacket( 4 )
);
}

function GetRules( )
{
if ($this->SendPacket('r') === false) {
throw new QueryServerException( 'Connection to ' . $this->szServerIP . ' failed or has dropped.' );
}

// Pop the first 11 bytes from the response;
fread( $this->rSocketID, 11 );

$iRuleCount = ord( fread( $this->rSocketID, 2 ) );
$aReturnArray = array( );

for( $i = 0; $i < $iRuleCount; $i ++ ) {
$szRuleName = $this->GetPacket( 1 );
$aReturnArray[ $szRuleName ] = $this->GetPacket( 1 );
}

return $aReturnArray;
}

function GetPlayers( )
{
if ($this->SendPacket('c') === false) {
throw new QueryServerException( 'Prisijungimas á ' . $this->szServerIP . ' nepavyko arba buvo atmestas.' );
}

// Again, pop the first eleven bytes send;
fread( $this->rSocketID, 11 );

$iPlayerCount = ord( fread( $this->rSocketID, 2 ) );
$aReturnArray = array( );

for( $i = 0; $i < $iPlayerCount; $i ++ )
{
$aReturnArray[ ] = array (
'Nickname' => $this->GetPacket( 1 ),
'Score' => $this->toInteger( fread( $this->rSocketID, 4 ) )
);
}

return $aReturnArray;
}

function GetDetailedPlayers( )
{
if ($this->SendPacket('d') === false) {
throw new QueryServerException( 'Prisijungimas á ' . $this->szServerIP . ' nepavyko arba buvo atmestas.' );
}

fread( $this->rSocketID, 11 );

$iPlayerCount = ord( fread( $this->rSocketID, 2 ) );
$aReturnArray = array( );

for( $i = 0; $i < $iPlayerCount; $i ++ ) {
$aReturnArray[ ] = array(
'PlayerID' => $this->toInteger( fread( $this->rSocketID, 1 ) ),
'Nickname' => $this->GetPacket( 1 ),
'Score' => $this->toInteger( fread( $this->rSocketID, 4 ) ),
'Ping' => $this->toInteger( fread( $this->rSocketID, 4 ) )
);
}

return $aReturnArray;
}

function RCON($rcon, $command)
{
echo 'Password '.$rcon.' with '.$command;
if ($this->SendPacket('x '.$rcon.' '.$command) === false) {
throw new QueryServerException( 'Prisijungimas á ' . $this->szServerIP . ' nepavyko arba buvo atmestas.' );
}

// Pop the first 11 bytes from the response;
$aReturnArray = fread( $this->rSocketID, 11 );

echo fread( $this->rSocketID, 11 );

return $aReturnArray;
}

}

class QueryServerException extends Exception
{

private $szMessage;

function __construct( $szMessage )
{
$this->szMessage = $szMessage;
}

function toString( )
{
return $this->szMessage;
}
}
//Klasës pabaiga, iðvedimas
try
{
$rQuery = new QueryServer( $serverIP, $serverPort );

$aInformation = $rQuery->GetInfo( );
$aServerRules = $rQuery->GetRules( );
$aBasicPlayer = $rQuery->GetPlayers( );
$aTotalPlayers = $rQuery->GetDetailedPlayers( );


$rQuery->Close( );
}
catch (QueryServerException $pError)
{
$aInformation['Players'] = "Informacija neuþkrauta";
$aInformation['MaxPlayers'] = "200";
}
?>