<?php

function HookSwitch_groupAllToptoolbaradder() {
	global $username, $baseurl_short;
	$lvResults=sql_query('select usergroup, switch_group_usergroups from user where username="'. $username .'"' );
	if(!empty($lvResults[0]['switch_group_usergroups'])) 
	{
?>
	<script type="text/javascript">
<?php
	echo 'var lvGroups = JSON.parse(\''. json_encode(explode(',', $lvResults[0]['switch_group_usergroups'])) .'\');';
	$lvResults=sql_query('select name from usergroup where ref='. $lvResults[0]['usergroup']);
	echo 'var lvCurrentGroup = "'. $lvResults[0]['name']. '";';
	echo 'var lvBaseUrl = "'. $baseurl_short. '";';
?>
		jQuery(document).ready(function(){
			var lvColor = jQuery(jQuery('#HeaderNav2 a')[0]).css('color');
			jQuery('#HeaderNav2 ul').append('<li><span style="color:'+lvColor+'">Select Group:</span> <select id="SwitchGroup"></select></li>');
			jQuery.each(lvGroups, function(theIndex, theValue){
				if(theValue == lvCurrentGroup)
					jQuery('#SwitchGroup').append('<option selected=true>'+theValue+'</option>');
				else
					jQuery('#SwitchGroup').append('<option>'+theValue+'</option>');
			});
		});
		jQuery(document).on('change', '#SwitchGroup', function(){
			document.location.href = lvBaseUrl + 'plugins/switch_group/pages/switch_group.php?group='+ jQuery(this).find(':selected')[0].value
		});
	</script>
<?php
	}
}
