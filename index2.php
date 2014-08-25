<div class='blue-box' style='max-width:30%;'>
	<?php
		
		echo $username;
		//build user rows
		// See if record Exist, if not, build a record or move to next section
		$getData = mysql_query("SELECT $clmUsrName FROM $tbName WHERE $clmUsrName = '$username' AND $selectTime");
		if(mysql_num_rows($getData) == '0'){
			$status = $lang['NO'];
			mysql_query("INSERT INTO $tbName($clmDate,$clmUsrName,$clmStatus) VALUES('$date','$username','$status')");
		} else {}
	?>
	<hr />
	<?php
		if($cannotLogin){echo "<div class='cannot-login'>" . $lang['CANNOT_LOGIN'] . "</div>";}
		else {
			$getStatus = mysql_query("SELECT $clmStatus FROM $tbName WHERE $clmUsrName = '$username' AND $selectTime");
			while($showStatus = mysql_fetch_array($getStatus)){
				$statusNow = $showStatus[$clmStatus];
				if($statusNow == $lang['YES']){$loggedIn = true;} else {$loggedIn = false;}
			}
	?>
		<form name="login" method="post" action="logme.php">
			<input type="hidden" name="username" value="<?php echo $username; ?>" />
			<input type="hidden" name="statusNow" value="<?php if($loggedIn){echo $lang['YES'];}else{echo $lang['NO'];} ?>" />
			<input type="submit" name="submitLog" value = "<?php if($loggedIn){echo $lang['CHECK_OUT'];} else if(!$loggedIn){echo $lang['CHECK_IN'];} ?>" />
		</form>
	<?php
		}
	?>
</div>