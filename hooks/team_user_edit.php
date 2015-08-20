<?php

// Add 'Enable auto login' check box
function HookSwitch_groupTeam_user_editAdditionaluserfields()
	{
	global $lang, $user;
	?>
	<div class="Question"><label><?php echo $lang["switch_group_usergroups"]?></label>
		<input name="switch_group_usergroups" type="text" class="stdwidth" value="<?php
			echo $user["switch_group_usergroups"]?>">
		<div class="clearerleft"> </div></div>
	<?php
	}

// Save auto login setting
function HookSwitch_groupTeam_user_editAftersaveuser()
	{
	global $ref;
	sql_query("update user set switch_group_usergroups='".getvalescaped("switch_group_usergroups","0")
			."' where ref='$ref'");
	}

?>