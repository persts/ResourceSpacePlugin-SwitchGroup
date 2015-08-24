<?php
include '../../../include/db.php';
include '../../../include/authenticate.php'; 
include '../../../include/general.php';

global $username, $baseurl;
$lvUser = sql_query('select usergroup, switch_group_usergroups from user where username="'. $username .'"' );
$lvGroup = sql_query('select ref from usergroup where name="'. getvalescaped("group","0") .'"'); 

$lvSuccess = false;
if(!empty($lvGroup[0]['ref'])) {
	if(!(strpos($lvUser[0]['switch_group_usergroups'], getvalescaped("group","0")) === false)) {
		sql_query('update user set usergroup='.$lvGroup[0]['ref'].' where username="'. $username .'"');
		$lvSuccess = true;
	}
}
include '../../../include/header.php';
if($lvSuccess) {	
?>

<div>
You have successfully switched to group: <?php echo getvalescaped("group","0"); ?><br/><br/>Refreshing page in 3 seconds...
</div>
<script>
	setTimeout(function(){
		document.location.href = "<?php echo $baseurl; ?>";
	}, 3000);
</script>

<?php		
	}
	else {
?>

<div>
Sorry...Group [ <?php echo getvalescaped("group","0"); ?> ] is not a valid user group or you do not have access to it.
</div>

<?php
	}
include '../../../include/footer.php';
