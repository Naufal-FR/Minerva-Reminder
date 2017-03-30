<?php
	$group_array_help = array(
		") menu" . PHP_EOL . PHP_EOL . 
			"> Shows the menu for interacting with me, only in mobile version" . PHP_EOL . PHP_EOL . 
			"EX : menu" . PHP_EOL . PHP_EOL,

		") @[Mention name] *[Additonal Message]" . PHP_EOL . PHP_EOL . 
			"> Every member subscribed to specific [MentionName] will be notified personally by me. You can add additional messages after the mention name to provide better information subscribed peoples" . PHP_EOL . PHP_EOL .
			"EX : @MyMentionName" . PHP_EOL . "@MyMentionName Something urgent happen" . PHP_EOL . PHP_EOL,

		") ..request [Nickname] [Pass]" . PHP_EOL . PHP_EOL . 
			"> A one time action used to register your group. Make sure to fill [Nickname] with something that can be used to identify your group easily such as your own group name. You also need to provide a [PASS] for your group, preferably something easy to type." . PHP_EOL . PHP_EOL . 
			"EX : ..request My Group Name 123abc" . PHP_EOL . PHP_EOL,

		") ..info" . PHP_EOL . PHP_EOL . 
			"> Shows the group name and pass information of your group." . PHP_EOL . PHP_EOL . 
			"EX : ..info" . PHP_EOL . PHP_EOL,

		") ..list" . PHP_EOL . PHP_EOL . 
			"> Shows all mention created by your group." . PHP_EOL . PHP_EOL .
			"EX : ..list" . PHP_EOL . PHP_EOL,
		
		") ..create [MentionName] [PASS]" . "" . PHP_EOL . PHP_EOL . 
			"> Create a new mention for group that your group member can use to subs. You cannot create mention with space in it" . PHP_EOL . PHP_EOL . 
			"EX : ..create GroupNewMention 12345" . PHP_EOL . PHP_EOL,
		
		") ..rename [OldMentionName] [NewMentionName] [PASS]" . "" . PHP_EOL . PHP_EOL . 
			"> Changes an existing mention name. You cannot have a duplicate name" . PHP_EOL . PHP_EOL . 
			"EX : ..rename GroupMention NewGroupMention 12345" . PHP_EOL . PHP_EOL,

		") ..delete [MentionName] [PASS]" . "" . PHP_EOL . PHP_EOL . 
			"> Delete a mention from your group. All member subscribed to that mention will be automatically unsubscribed." . PHP_EOL . PHP_EOL . 
			"EX : ..delete GroupNewMention 12345" . PHP_EOL . PHP_EOL,
		
		") ..whosubs [MentionName]" . "" . PHP_EOL . PHP_EOL . 
			"> Shows all member profile name subcribed to specific mention." . PHP_EOL . PHP_EOL . 
			"EX : ..wholink GroupNewMention" . PHP_EOL . PHP_EOL,
		
		") ..revoke [Pass]" . "" . PHP_EOL . PHP_EOL . 
			"> WARNING : This command will delete ALL data associated with your group including subscribed members and group mentions." . PHP_EOL . PHP_EOL . 
			"EX : ..revoke 12345" . PHP_EOL . PHP_EOL,
		
		") ..help OR ..helpPC" . "" . PHP_EOL . PHP_EOL . 
			"> Shows all the explanation of each command." . PHP_EOL . PHP_EOL . 
			"EX : ..helpPC" . PHP_EOL . PHP_EOL,

		") ..chgname [New Name] [PASS]" . "" . PHP_EOL . PHP_EOL . 
			"> Changes group nickname into a new one." . PHP_EOL . PHP_EOL . 
			"EX : ..chgname Group New Name 12345" . PHP_EOL . PHP_EOL,

		") ..chgpass [NewPass]" . "" . PHP_EOL . PHP_EOL . 
			"> Changes group password into a new one." . PHP_EOL . PHP_EOL . 
			"EX : ..chgpass 54321" . PHP_EOL
	);
?>