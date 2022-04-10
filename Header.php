<?php

include "Global.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml"> 
	<head>
		<title>Social-Paradise</title>
		<link rel="stylesheet" href="http://social-paradise.net/Base/Style/Main.css">
		<link rel="stylesheet" href="../Base/Themes/Default/default.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../Base/Themes/Pascal/pascal.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../Base/Themes/Orman/orman.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../Base/Style/Nivo.css" type="text/css" media="screen" />
		<!--<script type="text/javascript" src="http://social-paradise.net/snowstorm.js"></script>-->
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="http://www.tumuski.com/library/Nibbler/Nibbler.js"></script>
		<script>
		$(document).ready(function(){
		$('.redirect').click(function(){
		window.location = $(this).attr('redirect');
		});
		});
		</script>
	</head>
	<body>
		<div align='center'>
			<div id='Header'>
				<table cellspacing='0' cellpadding='0' width='1100'>
					<tr>
						<td width='200'>
							<img src='http://social-paradise.net/Imagess/SPNewLogo.png'  height='40'>
						</td>
						<td>
							<table cellspacing='0' cellpadding='0'>
								<tr>
									<td>
										<a href='http://social-paradise.net/'>Home</a>
									</td>
									<td>
										<a href='http://social-paradise.net/users/'>Users</a>
									</td>
									<td>
										<a href='http://social-paradise.net/Shop/'>Shop</a>
									</td>
									<td>
										<a href='http://social-paradise.net/UserShop/'>User Shop</a>
									</td>
									<td>
										<a href='http://social-paradise.net/Groups/'>Groups</a>
									</td>
									<td>
										<a href='http://social-paradise.net/Forum/'>Forum</a>
									</td>
									<td>
										<a href='http://social-paradise.net/upgrades.php'>Upgrades</a>
									</td>
									<?php
									
										if ($User) {
										
									//	echo "
									//<td>
									//	<a href='http://social-paradise.net/TradeSystem'>Trade</a>
								//	</td>
								//		";
										
										}
									
									?>
									<?php
									
										if ($myU->PowerAdmin == "true") {
										
											echo "
									<td>
										<a href='../Admin/?tab=configuration'>Admin</a>
									</td>
											";
										
										}
										
									if ($User) {
									
										echo "
									<td style='padding-left:35px;'>
										<a href='http://social-paradise.net/user.php?ID=$myU->ID'>$User</a>
									</td>
									<td>
										<a href='#'><font color='#2E9412'>$Bux Bux</font></a>
									</td>
									<td>
										<a href='http://social-paradise.net/Logout.php'>Logout</a>
									</td>
										";
									
									}
									else {
									
										echo "
									<td style='padding-left:35px;'>
										<a href='http://social-paradise.net/Login.php'>Login</a>
									</td>
									<td>
										<a href='http://social-paradise.net/register.php'>Register</a>
									</td>
										";
									
									}
									?>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
	<?php  if ($User) { echo "<center>
		<div id='SubBar'>
		<table cellspacing='0' cellpadding='0'>
			<tr>
				<td>
					<a href='/My/Account/'>Account</a>
				</td>
				<td>
					<a href='http://social-paradise.net/user.php?ID=$myU->ID'>Public Profile</a>
				</td>
				<td>
					<a href='/My/Character/'>Character</a>
				</td>
				<td>
					<a href='/Wall/'>Wall</a>
				</td>
				<td>
					<a href='http://social-paradise.net/My/FRs/'>Friend Requests ($FriendsPending)</a>
				</td>
				<td>
					<a href='http://social-paradise.net/Inbox/'>Inbox ($PMs)</a>
				</td>
				<td>
					<a href='http://social-paradise.net/ItemLogs.php?view=all'>Purchase History</a>
				</td>
			</tr>
		</table>
		</div>
		"; }
		?>
	<center>


			<!--End Top Bar-->
			<!--Begin Announcement Bar-->
			<?php if (!empty($gB->Text)) { echo "
			<center>
			<div id='Alert'>
				<center>".nl2br($gB->Text)."</center>
				";
				$kkk = 30*6;
				$extratime = 86400*$kkk;
				$premiumtime = time() + $extratime;
				//echo $premiumtime;
				echo "
			</div>
			
			</center>
			";
			}

	$getAllGroups = mysql_query("SELECT * FROM Groups");
	
	while ($gAG = mysql_fetch_object($getAllGroups)) {
	
		$getAllMembers = mysql_query("SELECT * FROM GroupMembers WHERE GroupID='$gAG->ID'");
		$gA = mysql_num_rows($getAllMembers);
		
		mysql_query("UPDATE Groups SET GroupMembers='$gA' WHERE ID='$gAG->ID'");
	
	}

?>
<?php
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
$NumOnline = mysql_num_rows($NumOnline = mysql_query("SELECT * FROM Users WHERE $now < expireTime"));
if ($NumR > 0) {

	$SayP = "<font color='red'><b>Unmoderated Profanity Reports ($NumR)</b></font>";

}
else {

	$SayP = "Unmoderated Profanity Reports ($NumR)";

}

if ($NumPending > 0) {

	$SayNP = "<font color='red'><b>Unmoderated User Items ($NumPending)</b></font>";

}
else {

	$SayNP = "Unmoderated User Items ($NumPending)";

}
if ($myU->PowerAdmin == "true") {
$NumWaiting = mysql_num_rows($NumWaiting = mysql_query("SELECT * FROM ItemDrafts"));
if ($NumWaiting > 0) {

	$SayNW = "<font color='red'><b>Unmoderated Store Items ($NumWaiting)</b></font>";

}
else {

	$SayNW = "Unmoderated Store Items ($NumWaiting)";

}
}
$getPending1 = mysql_query("SELECT * FROM GroupsPending ORDER BY ID");
$NumPending1 = mysql_num_rows($getPending1);
$getPending2 = mysql_query("SELECT * FROM GroupsLogo");
$NumPending2 = mysql_num_rows($getPending2);

if ($NumPending1 > 0) {

	$SayNP1 = "<font color='red'><b><a href='http://social-paradise.net/ModerateGroups.php'>Unmoderated Groups ($NumPending1)</a></b></font>";

}
else {

	$SayNP1 = "<a href='http://social-paradise.net/ModerateGroups.php'>Unmoderated Groups ($NumPending1)</a>";

}

if ($NumPending2 > 0) {

	$SayNP2 = "<font color='red'><b><a href='http://social-paradise.net/ModerateLogos.php'>Unmoderated Group Logos ($NumPending2)</a></b></font>";

}

else {

	$SayNP2 = "<a href='http://social-paradise.net/ModerateLogos.php'>Unmoderated Group Logos ($NumPending2)</a>";

}
if ($myU->PowerAdmin == "true") {
$AllShow = $NumR + $NumPending + $NumWaiting + $NumPending1 + $NumPending2;
}
else {
$AllShow = $NumR + $NumPending + $NumWaiting + $NumPending1 + $NumPending2;
}
if ($NumPending > 0||$NumR > 0||$NumWaiting > 0||$NumPending1 > 0) {
$KShow = "<font color='red'><b>Show Quick Admin <b>&uarr; ($AllShow)</b></font>";
}
else {
$KShow = "Show Quick Admin <b>&uarr; ($AllShow)";
}


echo "
<script type='text/javascript'>
$(document).ready(function(){
    $('#quickAdmin_hide').hide();
    $('#quick_admin').hide();
		$('#quickAdmin_show').click(function(){
	    $('#quick_admin').delay(500).slideDown();
		$('#quickAdmin_hide').delay(1000).slideDown();
		$('#quickAdmin_show').slideUp();
		});
		$('#quickAdmin_hide').click(function(){
	    $('#quick_admin').delay(500).slideUp();
		$('#quickAdmin_hide').slideUp();
		$('#quickAdmin_show').delay(1000).slideDown();
		});
  });
</script>
";
echo "
<div id='quickAdmin_show' style='position:fixed;bottom:0px;right:250px;background:#eee;padding:5px;border:1px solid #aaa; cursor:pointer;'>
$KShow</b>
</div>
<div id='quickAdmin_hide' style='position:fixed;bottom:110px;right:250px;background:#eee;padding:5px;border:1px solid #aaa;cursor:pointer;'>
Hide Quick Admin <b>&darr;</b>
</div>
<div id='quick_admin' style='position:fixed;bottom:0px;right:250px;background:#eee;padding:5px;border:1px solid #aaa;'>
<div align='left'>
";


if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
echo "
<a href='http://social-paradise.net/Reports.php'>$SayP</a>
<br />
";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true"||$myU->PowerImageModerator == "true") {
echo "<a href='http://social-paradise.net/ItemModeration.php'>$SayNP</a>
<br />
";
}
if ($myU->PowerAdmin == "true") {
echo "<a href='http://social-paradise.net/ItemRelease.php'>$SayNW</a><br />";
}
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
echo "
$SayNP1
<br />
$SayNP2
<br />
<a href='http://social-paradise.net/online.php'><b>Online Users (".$NumOnline.") </b></a>
<br />
</div>
";
}
}
echo "</div></div>";
if ($myU->Premium == 1) {

	echo "
	<style>
		body {
		background:url(http://social-paradise.net/Images/PremiumBG.png);
		background-repeat:no-repeat;
		background-attachment:fixed;
		background-position:center top; 
		background-size:cover;
		height:100%;
		}
	</style>
	";

}
?>
			<!--End Announcement Bar-->
			
			<!--Begin Main Container-->
				<center>
					<div id="Container"><div align='left'>