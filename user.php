<?php
include "Header.php";
$ID = mysql_real_escape_string(strip_tags(stripslashes($_GET['ID'])));
if (!$ID) {
echo 'Please include an ID!';
}
else {
	$gU = mysql_fetch_object($getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'"));
	$UserExist = mysql_num_rows($getUser = mysql_query("SELECT * FROM Users WHERE ID='".$ID."'"));
	if ($UserExist == "0") {
	
		echo "<b>This user does not exist.</b>";
		exit;
	
	}
				$checkBan = mysql_query("SELECT * FROM IPBans WHERE IP='$gU->IP'");
				$Ban = mysql_num_rows($checkBan);
if ($gU->Premium == 1) {

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
if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {

	if ($Ban > 0) {
	
		echo "
	<center>
	<div id='cA' style='width:90%;'>
		<b>This user is IP banned forever. "; if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") { echo "<a href='../user.php?ID=$ID&IP=Revert'>(revert)</a>"; } echo "</b>
	</div>
	<br />
		";
	$IP = mysql_real_escape_string(strip_tags(stripslashes($_GET['IP'])));
	if ($IP == "Revert") {
	mysql_query("DELETE FROM IPBans WHERE IP='$gU->IP'");
	header("Location: user.php?ID=$ID");
	}
	}

}

	if ($gU->Ban == "1") {
	echo "
	<center>
	<div id='cA' style='width:90%;'>
		<b>This user is banned. "; if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") {

		echo "<a href='../BanUser.php?ID=$ID&Unban=True'>(revert)</a>"; } echo "</b>
	</div>
	";
	if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
			echo "
			<br />
			<div id='aB' style='width:75%;'>
			<center>
			<table width='50%'>
				<tr>
					<td>
						<b style='font-size:20px;'>";
								if ($gU->BanLength == "0") {
								
									echo "Reminder/Warning";
								
								}
								if ($gU->BanLength == "1") {
								
									echo "Banned for 1 Day";
								
								}
								if ($gU->BanLength == "3") {
								
									echo "Banned for 3 Days";
								
								}
								if ($gU->BanLength == "7") {
								
									echo "Banned for 7 Days";
								
								}
								if ($gU->BanLength == "14") {
								
									echo "Banned for 14 Days";
								
								}
								if ($gU->BanLength == "forever") {
								
									echo "Account Deleted";
								
								}
			echo "</b>
						<center><table width='500'><tr><td align='left'>
								<div id='HeadText'>
								";

								
								if ($gU->BanLength != "forever") {
								$TimeUp = date("F j, Y g:iA","".$gU->BanTime."");
								}
								
								echo "
							</div>
							</td>
							</tr>
							<tr>
							<td align='left'>
								<font style='font-size:12px;'>
								Reason: <b>".$gU->BanType."</b>
								<br /><br />
								Our staff has found your account in violation of our terms. We have such rights to suspend your account if you do not abide by our rules.
								</font>
								<br />
								<br />
								<center>
								<div id='aB' style='border-radius:5px;width:600px;'>
									<center>
									";
									if ($gU->BanContent) {
									echo "
									<div style='background:white;padding:7px;border:1px solid #ccc;width:97%;text-align:left;'>
									 <b>Bad Content:</b> <i>".$gU->BanContent."</i>
									 <br />
									 <font style='font-size:9px;'>The following text in italics is offensive text you have typed that is not approved by our staff.</font>
									</div>
									";
									}
									echo "
									</center>
									<br />
									<b>Moderator Note:</b> $gU->BanDescription
								</div>
							</td></tr></table></div>
						</td>
				</tr>
			</table></div>
<br />
			";
			}
			
	}
	else {
	if ($User) {
	
		if ($myU->ID != $ID) {
		
			mysql_query("UPDATE Users SET pviews=pviews + 1 WHERE ID='".$ID."'");
		
		
					$CheckIfFriend = mysql_query("SELECT * FROM FRs WHERE SenderID='".$myU->ID."' AND ReceiveID='".$ID."'");
					
					$Check_A = mysql_num_rows($CheckIfFriend);
					
					$CheckIfFriendd = mysql_query("SELECT * FROM FRs WHERE SenderID='".$ID."' AND ReceiveID='".$myU->ID."'");
					
					$Check_B = mysql_num_rows($CheckIfFriendd);
					
					$SendFR = mysql_real_escape_string(strip_tags(stripslashes($_GET['SendFR'])));
					$Close = mysql_real_escape_string(strip_tags(stripslashes($_POST['Close'])));
					
					if ($SendFR == "send") {
					
					if ($Check_A >= "1" || $Check_B >= "1") {
					
						echo "
					<div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<div id='aB' style='width:300px;border:2px solid #aaa;border-radius:5px;'>
							<font id='HeadText'>
								<b>Hang on there buckaroo</b>
							</font>
							<br />
							<form action='' method='POST'>
								It seems like you are already friends with this user, or there is an active friend request.
								<br /><br />
								<input type='submit' name='Close' value='Close' id='SpecialInput'>
							</form>
						</div>
					</div>
						";
					

						
						}
						else {
						
							mysql_query("INSERT INTO FRs (SenderID, ReceiveID, Active) VALUES ('".$myU->ID."','".$ID."','0')");
							
							echo "
					<div style='background-image:url(/Imagess/menuhover.png);width:100%;height:100%;top:0;left:0;position:fixed;'><center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<div style='background:#ccc;border:1px solid gray;width:500px;padding:8px;text-align:left;'>
							<font id='HeadText'>
								Success
							</font>
							<br />
							<form action='' method='POST'>
								You have successfully sent a friend request to ".$gU->Username."!
								<br />
								<input type='submit' name='Close' value='Close'>
							</form>
						</div>
					</div>
							";
							
						
						}
						
					if ($Close) {
					
						header("Location: user.php?ID=$ID");
					
					}
					
					}
					
					}
	
	}
	echo "
	<table width='95%'>
		<tr>
			<td width='50%' valign='top'>
				<div id='ProfileText'>
				".$gU->Username."
				</div>
				<div id='Gradient1'>
				";
				if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
				if (!empty($gU->OriginalName)) {
				echo "<center><font color='blue' style='font-size:7pt;'><b>User's original name was ".$gU->OriginalName."</b></font> <a href='?ID=$ID&moderation=revertname' style='font-size:7pt;'>[Revert]</a>";
				}
				}
				echo "
					<center>
					";
					if ($now < $gU->expireTime) {
					$Status = "Online";
					$Color = "green";
					}
					else {
					$Status = "Offline";
					$Color = "red";
					}
					
					echo "
					<div>
					<img src='http://social-paradise.net/Avatar.php?ID=$gU->ID'>
					</div>
					<font color='$Color'>$Status</font>
					
					";
					//check if user is still in main group
					
					
					if (!empty($gU->MainGroupID)) {
						$checkUser = mysql_query("SELECT * FROM GroupMembers WHERE GroupID='$gU->MainGroupID' AND UserID='$ID'");
						
						$numMember = mysql_num_rows($checkUser);
						
						if ($numMember == 0) {
						
							mysql_query("UPDATE Users SET MainGroupID='' WHERE ID='$ID'");
							header("Location: user.php?ID=$ID");
						
						}
					$getMain = mysql_query("SELECT * FROM Groups WHERE ID='$gU->MainGroupID'");
					$gM = mysql_fetch_object($getMain);
					echo "
					<br />
					<b style='font-size:8pt;'>Main Group:</b>
					<br />
					<div style='height:50px;width:50px;'>
					<a href='../Groups/Group.php?ID=$gM->ID'><img src='http://social-paradise.net/Groups/GL/".$gM->Logo."' width='50' height='50'>
					
					</div>
					<b><font style='font-size:11px;'>".$gM->Name."</font></a></b>
					";
					}
					echo "
					<br />
					";
					if ($gU->Description) { echo "
					<div style='width:90%;padding:5px;overflow-y:auto;max-height:100px;background:white;border-radius:5px;border:1px solid #CCC;'>
					".nl2br($gU->Description)."
					</div>
					"; }
					echo "
					<div style='padding-top:5px;padding-bottom:5px;'>
					";
					if ($User) {
					
						echo "<a href='SendMessage.php?ID=$ID'><b>Send Message</b></a> &nbsp; &nbsp; &nbsp; <a href='Donate.php?ID=$ID'><b>Send Donation</b></a>";
						
						echo " &nbsp; &nbsp; &nbsp; <a href='?ID=$ID&SendFR=send'><b>Send Friend Request</b></a>";
					
					}
					echo "
					</div>
					</div>
				<br />
				<div id='ProfileText'><div align='left'>
					Statistics
					</div>
				</div>
				<div id='Gradient1'>
					<table width='100%'>
						<tr>
							<td width='40%'>
								<b>Profile Views:</b>
							</td>
							<td>
								".number_format($gU->pviews)."
							</td>
						</tr>
						<tr>
							<td width='40%'>
								<b>Forum Posts:</b>
							</td>
							<td>
								";
								$Threads = mysql_num_rows($Threads = mysql_query("SELECT * FROM Threads WHERE PosterID='$ID'"));
								$Replies = mysql_num_rows($Replies = mysql_query("SELECT * FROM Replies WHERE PosterID='$ID'"));
								$Posts123 = $Threads + $Replies;
								echo "
								".number_format($Posts123)."
							</td>
						</tr>
						<tr>
							<td width='40%'>
								<b>Friends:</b>
							</td>
							<td>
								";
								$NumFriends = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
								$NumFriends = mysql_num_rows($NumFriends);
								echo "
								$NumFriends
							</td>
						</tr>
						<tr>
							<td width='40%'>
								<b>Wall Posts:</b>
							</td>
							<td>
								";
								$NumberWallPosts = mysql_num_rows($NumberWallPosts = mysql_query("SELECT * FROM Wall WHERE PosterID='".$ID."'"));
								echo "
								".$NumberWallPosts."
							</td>
						</tr>
						<tr>
							<td width='40%'>
								<b>Status/Last Seen:</b>
							</td>
							<td>
								";
								if (!$gU->expireTime) {
								$SS = "Error";
								}
								else {
								if ($now < $gU->expireTime) {
								$SS = "<font color='green'>Online</font>";
								}
								else {
								$SS = date("F j, Y g:iA", $gU->expireTime);
								}
								}
								
								echo "
								$SS
							</td>
						</tr>
					</table>
				</div>
				<br />
				<div id='ProfileText'><div align='left'>
					Badges</div>
				</div>
				<div id='Gradient1'>
					
					";
					$numBadges = mysql_num_rows($Badges = mysql_query("SELECT * FROM Badges WHERE UserID='$ID'"));
					
					if ($numBadges > 0) {
					
						echo "<center><table><tr>";
						$Badges = mysql_query("SELECT * FROM Badges WHERE UserID='$ID' ORDER BY ID");
						$badge = 0;
						while ($Row = mysql_fetch_object($Badges)) {
							$badge++;
							echo "
							<td width='100'><center>
								<img src='/Badgess/".$Row->Position.".png' height='64' width='64'>
								<br />
								<b>".$Row->Position."</b>
							</td>
							";
							if ($badge >= 4) {
							echo "</tr><tr>";
							$badge = 0;
							}
						
						}
						echo "</tr></table>";
					
					}
					
					echo "
					
				</div>
			</td>
			<td width='50%' valign='top'>
				<div id='ProfileText'>
					Wall
				</div>
				<div style='overflow-y:auto;max-height:150px;' id='Gradient1'>
					";
					$getWall = mysql_query("SELECT * FROM Wall WHERE PosterID='".$ID."' ORDER BY ID DESC");
					while ($gW = mysql_fetch_object($getWall)) {
					
						echo "
						<table width='99%' id='WallPost'>
							<tr>
								<td>
									<font style='font-size:10px;float:right;'>
									";
									
									$k = date("m-d-y g:i:A", "$gW->time");
									echo "
									$k
									</font>
									<a href='../user.php?ID=".$ID."'><b>".$gU->Username."</b></a>: ".$gW->Body."
																		";
									if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") {
									
										echo "
										<br />
										<font style='font-size:8pt;'>
											<a href='user.php?ID=$ID&wall=scrub&wallid=".$gW->ID."'><font color='blue'><b>Scrub</b></font></a> | 
											<a href='user.php?ID=$ID&wall=delete&wallid=".$gW->ID."'><font color='blue'><b>Delete</b></font></a>
										</font>
										";
									
									}
									echo "
								</td>
							</tr>
						</table>
						 <DIV STYLE='PADDING-TOP:5PX;'></DIV>
						";
					
					}
					if ($myU->PowerMegaModerator == "true"||$myU->PowerAdmin == "true") {
					
						$wall = mysql_real_escape_string(strip_tags(stripslashes($_GET['wall'])));
						$wallid = mysql_real_escape_string(strip_tags(stripslashes($_GET['wallid'])));
						
						if ($wall == "scrub") {
						
							mysql_query("UPDATE Wall SET Body='[ Content Deleted ]' WHERE ID='".$wallid."'");
							header("Location: user.php?ID=$ID");
						
						}
						elseif ($wall == "delete") {
						
							mysql_query("DELETE FROM Wall WHERE ID='$wallid'");
							header("Location: user.php?ID=$ID");
							
						}
					}
					echo "
				</div>
				";

					
					$Setting = array(
						"PerPag1e" => 8
					);
					$Page1 = mysql_real_escape_string(strip_tags(stripslashes($_GET['FRPage'])));
					if ($Page1 < 1) { $Page1=1; }
					if (!is_numeric($Page1)) { $Page1=1; }
					$Minimum1 = ($Page1 - 1) * $Setting["PerPag1e"];
					$allusers1 = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
					$num1 = mysql_num_rows($allusers1);
					$getFRs = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1' LIMIT {$Minimum1},  ". $Setting["PerPag1e"]);
					$RFriends = mysql_query("SELECT * FROM FRs WHERE ReceiveID='$ID' AND Active='1'");
					$NumFriends = mysql_num_rows($getFRs);
					$KFriends = mysql_num_rows($RFriends);
					echo "
				<br />
				<div id='ProfileText'>
					Friends (".$KFriends.")
				</div>
				<div id='Gradient1'>
				<center>
					";
					echo "<table><tr>";
					
					if ($NumFriends == 0) {
					
						echo "<b>This user has added no friends yet.</b>";
					
					}
						$friends = 0;
						while ($gF = mysql_fetch_object($getFRs)) {
						$friends++;
						$getFriend = mysql_query("SELECT * FROM Users WHERE ID='".$gF -> SenderID."'");
						$gFF = mysql_fetch_object($getFriend);
					echo "
					<td align='center' width='100'>
						<div style='height:100px;width:100px;overflow-y:hidden;'>
						<a href='../user.php?ID=".$gFF->ID."' style='color:black;font-weight:bold;'>
						<img src='http://social-paradise.net/Avatar.php?ID=".$gFF->ID."'>
						</div>
						".$gFF -> Username."
						</a>
					</td>
					";
					if ($friends >= 4) {
					
						echo "</tr><tr>";
						$friends = 0;
					
					}
					}
					
					echo "</tr></table>";
						$amount=ceil($num1 / $Setting["PerPag1e"]);
						if ($Page1 > 1) {
						echo '<a href="user.php?ID='.$ID.'&FRPage='.($Page1-1).'">Prev</a> - ';
						}
						echo ''.$Page1.'/'.(ceil($num1 / $Setting["PerPag1e"]));
						if ($Page1 < ($amount)) {
						echo ' - <a href="user.php?ID='.$ID.'&FRPage='.($Page1+1).'">Next</a>';
						}
					$NumInGroups1 = mysql_query("SELECT * FROM GroupMembers WHERE UserID='$ID'");
					$NumInGroups = mysql_num_rows($NumInGroups1);
					
					echo "
					</div>
				</center>
				<br />
				<div id='ProfileText'>
					Groups (".$NumInGroups.")
				</div>
				<div id='Gradient1'>
				<center>
				<table><tr>
					";
					$groups = 0;
					while ($gG = mysql_fetch_object($NumInGroups1)) {
					$groups++;
					$getGroupK = mysql_query("SELECT * FROM Groups WHERE ID='$gG->GroupID'");
					$gK = mysql_fetch_object($getGroupK);
					
						echo "
						<td width='100' valign='top'>
						<center>
						<a href='../Groups/Group.php?ID=".$gK->ID."'>
						<div style='width:50px;height:50px;padding:5px;border:1px solid #ddd;'>
						<img src='http://social-paradise.net/Groups/GL/".$gK->Logo."' height='50' width='50'>
						</div>
						<b>".$gK->Name."</b>
						</a>
						</td>
						";
						if ($groups >= 4) {
						
							echo "</tr><tr>";
							$groups = 0;
						
						}
					
					}
					echo "
					</tr></table>
					</center>
				</div>
			</td>
		</tr>
	</table>
	";
echo "
<div id='ProfileText'>
Inventory
</div>
<div id='Gradient1'><center><table><tr><a name='OwnedItems'></a>
";
					$counter = 0;
						$Setting = array(
							"PerPage1" => 8
						);
						$Item = mysql_real_escape_string(strip_tags(stripslashes($_GET['Item'])));
						if ($Item < 1) { $Item=1; }
						if (!is_numeric($Item)) { $Item=1; }
						$Minimum1 = ($Item - 1) * $Setting["PerPage1"];
						//query
						$allusers1 = mysql_query("SELECT * FROM Inventory WHERE UserID='".$ID."'");
						$num1 = mysql_num_rows($allusers1);
					$getOwnedItems = mysql_query("SELECT * FROM Inventory WHERE UserID='".$ID."' ORDER BY ID DESC LIMIT {$Minimum1},  ". $Setting["PerPage1"]);
						while ($gO = mysql_fetch_object($getOwnedItems)) {
						
							
						
							$getFromStore = mysql_query("SELECT * FROM Items WHERE File='".$gO->File."'");
							
							$if_store = mysql_num_rows($getFromStore);
							
							if ($if_store == "1") {
							
								$store = 1;
								
								$gF = mysql_fetch_object($getFromStore);
							
							}
							else {
							
								$store = 0;
								$getFromStore = mysql_query("SELECT * FROM UserStore WHERE File='".$gO->File."'");
								$gF = mysql_fetch_object($getFromStore);
								$DeleteItem = mysql_num_rows($getFromStore);
								
							}
							
								if ($DeleteItem == "0") {
								mysql_query("DELETE FROM Inventory WHERE ID='".$gO->ID."'");
								}
															
								$getCreator = mysql_query("SELECT * FROM Users WHERE ID='".$gF->CreatorID."'");
								$gC = mysql_fetch_object($getCreator);
								
								if ($if_store == 1) {
								
									$Link = "/Store/Item.php?ID=".$gF->ID."";
								
								}
								else {
								
									$Link = "/Store/UserItem.php?ID=".$gF->ID."";
								
								}
							$counter++;
							echo "
							<td style='font-size:11px;' align='left' width='100' valign='top'><a href='".$Link."' border='0' style='color:black;'>
								<div style='border:1px solid #ddd;border-radius:5px;padding:5px;'>
									";
									if ($gF->saletype == "limited") {
									echo "
										
										<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(http://social-paradise.net/Store/Dir/".$gF->File.");'>
										
										<div style='width: 100px; height: 200px; z-index: 3;  background-image: url(/Imagess/LimitedWatermark.png);'>
										"; if ($gO->SerialNum != "0") { echo "<center><font style='color:#253138;font-weight:bold;'>#".$gO->SerialNum."/".$gF->numbersales."</font></font>"; }
										echo "</div></div>
									";
									}
									else {
										echo "<img src='http://social-paradise.net/Store/Dir/".$gF->File."' width='100' height='200'>";
									}
									echo "
								</div>
								<b>".$gF->Name."</b></a>
								<br />
								<font style='font-size:10px;'>Creator: <a href='/user.php?ID=".$gF->CreatorID."'>".$gC->Username."</a>
								<br />
								";
								if ($gF->sell == "yes") {
								if ($gF->saletype == "limited" && $gF->numberstock == "0") {
								 echo "
								<font color='green'><b>Was Bux: ".$gF->Price."</b></font>
								";
								}
								else {
								 echo "
								<font color='green'><b>Bux: ".$gF->Price."</b></font>
								";
								}
								}
								echo "
								
							</td>
							";
							
							if ($counter >= 8) {
							
								echo "</tr><tr>";
								
								$counter = 0;
							
							}
							
							
						
						}
									echo "</tr></table><center>";
									$amount=ceil($num1 / $Setting["PerPage1"]);
									if ($Item > 1) {
									echo '<a href="user.php?ID='.$ID.'&Item='.($Item-1).'#OwnedItems">Prev</a> - ';
									}
									echo 'Page '.$Item.'/'.(ceil($num1 / $Setting["PerPage1"]));
									if ($Item < ($amount)) {
									echo ' - <a href="user.php?ID='.$ID.'&Item='.($Item+1).'#OwnedItems">Next</a>';
									}
echo "
</div>
";
	if ($myU->PowerAdmin == "true"||$myU->PowerMegaModerator == "true") {
	
		echo "
		<br />
		<center><div  style='width:90%;'>
			<a href='user.php?ID=$ID&moderation=scrubname'><b>Scrub Name</b></a>
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='user.php?ID=$ID&moderation=scrubdescription'><b>Scrub Description</b></a>
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='BanUser.php?ID=$ID'><b>Ban User</b></a>
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='ViewOtherAccounts.php?ID=$ID'><b>View Other Accounts</b></a>
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='user.php?ID=$ID&moderation=ipban'><b>IP Ban</b></a>
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='iplogs.php?ID=$ID'><b>IP Logs</b></a>
			";
			if ($myU->Username == "Isaac"||$myU->Username == "Ellernate"||$myU->Username == "Niko") {
			
				echo "
			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='user.php?ID=$ID&moderation=fireuser'><b>Fire User</b></a>
				";
			
			}
			echo "
		</div>
		</center>
		";
		$moderation = mysql_real_escape_string(strip_tags(stripslashes($_GET['moderation'])));
		
			if ($moderation == "scrubdescription") {
			
				mysql_query("UPDATE Users SET Description='[ Content Deleted ]' WHERE ID='$ID'");
				header("Location: user.php?ID=$ID");
			
			}
			
			if ($myU->Username == "Isaac"||$myU->Username == "Ellernate"||$myU->Username == "Niko") {
			
				if ($moderation == "fireuser") {
				
					mysql_query("UPDATE Users SET PowerImageModerator='false' WHERE ID='$ID'");
					mysql_query("UPDATE Users SET PowerForumModerator='false' WHERE ID='$ID'");
					mysql_query("UPDATE Users SET PowerArtist='false' WHERE ID='$ID'");
					mysql_query("UPDATE Users SET PowerMegaModerator='false' WHERE ID='$ID'");
					mysql_query("UPDATE Users SET PowerAdmin='false' WHERE ID='$ID'");
					
					//badges
					
					mysql_query("DELETE FROM Badges WHERE Position='Image Moderator' AND UserID='$ID'");
					mysql_query("DELETE FROM Badges WHERE Position='Forum Moderator' AND UserID='$ID'");
					mysql_query("DELETE FROM Badges WHERE Position='Artist' AND UserID='$ID'");
					mysql_query("DELETE FROM Badges WHERE Position='Mega Moderator' AND UserID='$ID'");
					mysql_query("DELETE FROM Badges WHERE Position='Administrator' AND UserID='$ID'");
					
					header("Location: user.php?ID=$ID");
				
				}
			
			}
			
			if ($moderation == "scrubname") {
				mysql_query("UPDATE Users SET OriginalName='$gU->Username' WHERE ID='$ID'");
				mysql_query("UPDATE Users SET Username='[ Content Deleted $ID ]' WHERE ID='$ID'");
				header("Location: user.php?ID=$ID");
			
			}
			
			if ($moderation == "revertname") {
				mysql_query("UPDATE Users SET Username='$gU->OriginalName' WHERE ID='$ID'");
				mysql_query("UPDATE Users SET OriginalName='' WHERE ID='$ID'");
				header("Location: user.php?ID=$ID");
			
			}
			
			if ($moderation == "ipban") {
			

				if ($Ban == 0) {
				
					mysql_query("INSERT INTO IPBans (IP) VALUES('".$gU->IP."')");
					mysql_query("INSERT INTO Logs (UserID, Message, Page) VALUES('".$myU->ID."','IP Banned $gU->Username','".$_SERVER['PHP_SELF']."')");
					header("Location: user.php?ID=$ID");
				
				}
				header("Location: user.php?ID=$ID");
			
			}
	
	}

}
if ($gU->Premium == 1) {
//echo "<style>body { background-image:url(../PremiumStripeBG.png); }</style>";

}
echo "</div>";
}
include "Footer.php";
?>