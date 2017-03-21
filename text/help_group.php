<?php
	$help_group = 
		"1) ..request [Nickname] [Pass]" . PHP_EOL . PHP_EOL . 
			"> A one time action used to register your group. Make sure to fill [Nickname] with something that can be used to identify your group easily such as your own group name. You also need to provide a NUMBERED [PASS] for your group, preferably something easy to type." . PHP_EOL . PHP_EOL . 
			"EX : ..request My Group Name 12345" . PHP_EOL . PHP_EOL .
		
		"2) ..info" . PHP_EOL . PHP_EOL . 
			"> Shows the callsign and pass information of your group based on the '..request' command." . PHP_EOL . PHP_EOL . 
			"EX : ..info" . PHP_EOL . PHP_EOL .
		
		"3) ..list" . PHP_EOL . PHP_EOL . 
			"> Shows all ping created by your group." . PHP_EOL . PHP_EOL .
			"EX : ..list" . PHP_EOL . PHP_EOL .

		"4) ..ping [Ping name] *[Additonal Message]" . PHP_EOL . PHP_EOL . 
			"> Initiate ping on the [Ping Name]. Every member linked to that [Ping Name] will be notified personally by me. You can also add additional messages after the ping name to provide better information for peoples linked to that ping" . PHP_EOL . PHP_EOL .
			"EX : ..ping MyPingName" . PHP_EOL . "..ping MyPingName We have something urgent to discuss" . PHP_EOL . PHP_EOL .
		
		"5) ..create [PingName] [PASS]" . "" . PHP_EOL . PHP_EOL . 
			"> Create a new ping for your group that your group member can use to link. For now you cannot create ping with space in it" . PHP_EOL . PHP_EOL . 
			"EX : ..create GroupNewPing 12345" . PHP_EOL . PHP_EOL . 
		
		"6) ..rename [OldPingName] [NewPingName]" . "" . PHP_EOL . PHP_EOL . 
			"> Changes an existing ping into a new name. You cannot have a duplicate name" . PHP_EOL . PHP_EOL . 
			"EX : ..rename GroupPing NewGroupPing" . PHP_EOL . PHP_EOL . 

		"7) ..delete [PingName] [PASS]" . "" . PHP_EOL . PHP_EOL . 
			"> Delete a ping from your group. All member linked to that ping will be automatically unlinked." . PHP_EOL . PHP_EOL . 
			"EX : ..delete GroupNewPing 12345" . PHP_EOL . PHP_EOL .
		
		"8) ..wholink [Ping Name]" . "" . PHP_EOL . PHP_EOL . 
			"> Shows all the member profile name linked to specific ping." . PHP_EOL . PHP_EOL . 
			"EX : ..wholink GroupNewPing" . PHP_EOL . PHP_EOL .
		
		"9) ..revoke [Pass]" . "" . PHP_EOL . PHP_EOL . 
			"> WARNING : Executing this command will delete ALL data associated with your group including linked members and group pings." . PHP_EOL . PHP_EOL . 
			"EX : ..revoke 12345" . PHP_EOL . PHP_EOL .
		
		"10) ..help" . "" . PHP_EOL . PHP_EOL . 
			"> Shows all the explanation for each command depending if request sent from group or personal chat." . PHP_EOL . PHP_EOL . 
			"EX : ..help" . PHP_EOL . PHP_EOL .

		"11) ..chgname [New Name]" . "" . PHP_EOL . PHP_EOL . 
			"> Changes group nickname into a new one." . PHP_EOL . PHP_EOL . 
			"EX : ..chgname Group New Name" . PHP_EOL . PHP_EOL .

		"12) ..chgpass [New Pass]" . "" . PHP_EOL . PHP_EOL . 
			"> Changes group password into a new one." . PHP_EOL . PHP_EOL . 
			"EX : ..chgpass 54321" . PHP_EOL
		 ; 
?>