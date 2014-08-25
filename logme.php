<?php

	include "links.php";

	
	if(isset($_POST['submitLog'])){
		$username = $_POST['username'];
		$statusNow = $_POST['statusNow'];
		
		// Get the values from table to use them laters
		$getSessionData = mysql_query("SELECT * FROM $tbName WHERE $clmUsrName = '$username' AND $selectTime");
		while($showSessionData = mysql_fetch_array($getSessionData)){
			$checkMorIn = $showSessionData['morChkIn'];
			$checkMorOut = $showSessionData['morChkOut'];
			$checkEveIn = $showSessionData['eveChkIn'];
			$checkEveOut = $showSessionData['eveChkOut'];
			
		}
		
		switch($statusNow){
			//If not logged In, lets login
			case $lang['NO']:
				if($checkMorIn == '00:00:00'){$canCheckMorIn = true;}else {$canCheckMorIn = false;}
				if($checkEveIn == '00:00:00'){$canCheckEveIn = true;}else {$canCheckEveIn = false;}
				
				if($canCheckMorIn){
					if(time() > $morIn){
						// Can login morning
						mysql_query("UPDATE $tbName SET $clmStatus = '$yes',$morChkIn = CURTIME() WHERE $clmUsrName = '$username' AND $selectTime");
					} else {
						// Cannot login Morning
						header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=CANNOT_LOGIN&userTry=" . $username);
						return false;
					}
				} else if ($canCheckEveIn){
					if(time() > $eveIn){
						//Can login Evening
						mysql_query("UPDATE $tbName SET $clmStatus = '$yes',$eveChkIn = CURTIME() WHERE $clmUsrName = '$username' AND $selectTime");
					} else {
						// Cannot Login Evening
						header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=CANNOT_LOGIN&userTry=" . $username);
						return false;
					}
				} else {
					// Already Checked In ($canCheck_* is false here)
					header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=ALREADY_CHECKED_IN&userTry=" . $username);
					return false;
				}
			break;
			
			//If logged In, lets logout
			case $lang['YES']:
				if($checkMorOut == '00:00:00'){$canCheckMorOut = true;}else {$canCheckMorOut = false;}
				if($checkEveOut == '00:00:00'){$canCheckEveOut = true;}else {$canCheckEveOut = false;}
				
				if($canCheckMorOut){
					if(time() > $morOut){
						// Can check out of morning
						mysql_query("UPDATE $tbName SET $clmStatus = '$no',$morChkOut = CURTIME() WHERE $clmUsrName = '$username' AND $selectTime");
					} else {
						// Cannot Check Out of Morning
						header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=CANT_LOGOUT&userTry=" . $username);
						return false;
					}
				} else if ($canCheckEveOut){
					if(time() > $eveOut){
						// Can check out of evening
						mysql_query("UPDATE $tbName SET $clmStatus = '$no', $eveChkOut = CURTIME() WHERE $clmUsrName = '$username' AND $selectTime");
					} else {
						// Cannot check out of evening
						header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=CANT_LOGOUT&userTry=" . $username);
						return false;
					}
				} else {
					// You are already Checked Out ($canCheckOut_* is false)
					header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=ALREADY_CHECKED_OUT&userTry=" . $username . "&alreadycheckin=yes");
					return false;
				}
				
			break;
			default: echo "Logging Error"; break;
		}
		
		header("Location: " . $_SERVER['HTTP_REFERER']);
		
	}

?>