/* Miestelio gyvenimo (MGRP) JavaScript dokumentas 0.1.1 beta
   Sukūrė Ellis (skype: elygaxx), kuris skirtas GTA-MP projektui */
   
function externalLinks() {
 if (!document.getElementsByTagName) return;
 var anchors = document.getElementsByTagName("a");
 for (var i=0; i<anchors.length; i++) {
   var anchor = anchors[i];
   if (anchor.getAttribute("href") && 
       anchor.getAttribute("rel") == "external")
     anchor.target = "_blank";
 }
}
window.onload = externalLinks;

function ValidateField(field,alertext)
{
	with (field)
	{
		var length = value.length;
		
		if (length > 20 || length < 4)
		{
			alert(alertext);
			return false;
		}
		else
			return true;
	}
}

function validate_email(field,alerttxt)
{
	with (field)
	{
		var apos=value.indexOf("@");
  		var dotpos=value.lastIndexOf(".");
  		if (apos<1||dotpos-apos<2)
    		{alert(alerttxt);return false;}
  		else {return true;}
  	}
}

function comparetwostrings(field,field2,alertext)
{
	var str1;
	var str2
	
	with (field)
		str = value;
		
	with (field2)
		str2 = value;
		
	if (str == str2)
		return true;
	else
	{
		alert(alertext);
		return false;
	}
}

function ValidateLoginForm(thisform)
{
	with (thisform)
	{
		if (ValidateField(User, "Įrašytas vardas yra per trumpas arba per ilgas!") == false)
		{User.focus();return false;}
			
		if (ValidateField(Password, "Įrašytas slaptažodis yra per trumpas arba per ilgas!") == false)
		{Password.focus();return false;}
			
		return true;
	}
}

function ValidateNewPassForm(thisform)
{
	with (thisform)
	{
		if (ValidateField(oldpass, "Įrašytas senas slaptažodis yra per trumpas arba per ilgas!") == false)
		{oldpass.focus();return false;}
			
		if (ValidateField(newpass, "Įrašytas naujas slaptažodis yra per trumpas arba per ilgas!") == false)
		{newpass.focus();return false;}
			
		if (comparetwostrings(newpass,newpass2,"Įrašyti nauji slaptažodžiai nesutampa!") == false)
		{newpass2.focus();return false;}
			
		return true;
	}
}

function checkform(form)
{
  if (form.pgmg.value == "") {
    alert( "PowerGame ir Metagame laukelis tuščias." );
    form.pgmg.focus();
    return false ;
  }
  if (form.dmrktt.value == "") {
    alert( "DeathMatch, Revenge Kill ir Spawn Kill laukelis tuščias." );
    form.dmrktt.focus();
    return false ;
  }
  if (form.carcrashrp.value == "") {
    alert( "Avarijos laukelis tuščias. Nepamirškite, kad reikia naudoti /me ir /do komandas." );
    form.carcrashrp.focus();
    return false ;
  }
   if (form.carscrash.value == "") {
    alert( "Antrosios avarijos laukelis tuščias. Nepamirškite, kad reikia naudoti /me ir /do komandas." );
    form.carcrashrp.focus();
    return false ;
  }
  
  return true ;
}

function confirmPost()
{
var agree=confirm("Ar tikrai norite įspėti vartotoją?");
if (agree)
return true;
else
return false;
}

function confirmUnban()
{
var agree=confirm("Ar tikrai norite atblokuoti vartotoją?");
if (agree)
return true;
else
return false;
}

function confirmUnlock()
{
var agree=confirm("Ar tikrai norite atrakinti šią sąskaitą?");
if (agree)
return true;
else
return false;
}

function confirmUnwarn()
{
var agree=confirm("Ar tikrai norite nuimti įspėjimą šiam vartotojui?");
if (agree)
return true;
else
return false;
}

function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Rodyti";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Suskleisti";
	}
}