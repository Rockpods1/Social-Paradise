<?php
include "Header.php";
$Configuration = mysql_fetch_object($Configuration = mysql_query("SELECT * FROM Configuration"));
if ($Configuration->Register == "true") {

if (!$User) {
$UsernameIs = mysql_real_escape_string(strip_tags(stripslashes($_GET['UsernameIs'])));
echo '
<table>
	<tr>
		<td style="width:700px;">
			<div id="LargeText">
			Sign up for Social-Paradise for free.
			</div>
				<form action="" method="POST">
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td style="padding-right:75px;">
								<b>Username
							</td>
							<td>
								<input type="text" name="_Username" value="'.$UsernameIs.'" />
							</td>
						</tr>
						<tr>
							<td style="padding-right:75px;">
								<b>Password
							</td>
							<td>
								<input type="password" name="_Password" />
							</td>
						</tr>
						<tr>
							<td style="padding-right:75px;">
								<b>Confirm Password
							</td>
							<td>
								<input type="password" name="_ConfirmPassword" />
							</td>
						</tr>
					<tr>
						<td style="padding-right:75px;">
							<b>Email
						</td>
						<td>
							<input type="text" name="_Email" />
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="_Submit" value="Register">
						</td>
					</tr>
				</table>
			</form>
';
$Username = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Username'])));
$Password = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Password'])));
$ConfirmPassword = mysql_real_escape_string(strip_tags(stripslashes($_POST['_ConfirmPassword'])));
$Email = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Email'])));
$Submit = mysql_real_escape_string(strip_tags(stripslashes($_POST['_Submit'])));
$ref = mysql_real_escape_string(strip_tags(stripslashes($_GET['ref'])));
					function is_alphanumeric($username)
					{
						return (bool)preg_match("/^([a-zA-Z0-9])+$/i", $username);
						 
					}
					
if ($Submit) {
$Username = filter($Username);
if (!$Username||!$Password||!$ConfirmPassword) {
echo "<b>Please fill in all required fields.</b>";
}
else {
$userExist = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
$userExist = mysql_num_rows($userExist);
$userExist1 = mysql_query("SELECT * FROM Users WHERE OriginalName='$Username'");
$userExist1 = mysql_num_rows($userExist1);
if ($userExist > 0) {
echo "<div id='Error'>That username already exists.</div>";
}
elseif ($userExist1 > 0) {
echo "<div id='Error'>That username already exists.</div>";
}
else {
if ($ConfirmPassword != $Password) {
echo "<div id='Error'>Your password and confirm password does not match.</div>";
}
else {
if (strlen($Username) >= 15) {
echo "<div id='Error'>Your username is above fifteen (15) characters!</div>";
}
elseif (strlen($Username) < 3) {
echo "<div id='Error'>Your username is under three (3) characters!</div>";
}
elseif (!is_alphanumeric($Username)) {
echo "<div id='Error'>Only A-Z and 1-9 is allowed, or there is profanity in your username.</div>";
}
else {

	if ($ref) {
	
		$getRef = mysql_query("SELECT * FROM Users WHERE ID='$ref'");
		$gR = mysql_fetch_object($getRef);
		$RefExist = mysql_num_rows($getRef);
		
			if ($RefExist == 0) {
			
				//dont do anything lol
			
			}
			else {
			
				//if ($_SERVER['PHP_SELF'] == $gR->IP) {
				
					//dont do anything lol
				
				//}
				//else {
					$userExist = mysql_query("SELECT * FROM Users WHERE Username='$Username'");
					$userExist = mysql_fetch_object($userExist);
					mysql_query("UPDATE Users SET SuccessReferrer=SuccessReferrer + 1 WHERE ID='$ref'");
					mysql_query("INSERT INTO Referrals (ReferredID, UserID) VALUES('$ref','$userExist->ID')");
				
				//}
			
			}

	}

$_ENCRYPT = hash('sha512',$Password);
$IP = $_SERVER['REMOTE_ADDR'];
mysql_query("INSERT INTO Users (Username, Password, Email, IP) VALUES('$Username','$_ENCRYPT','$Email','$IP')");
$_SESSION['Username']=$Username;
$_SESSION['Password']=$_ENCRYPT;
header("Location: index.php");
}
}
}
}
}

}
echo "
</td>
<td>
<div id='Login'><center>
					<div id='Msg'>Already have an account?</div>
					<br />
					<a href='../'>Login here.</a>
					<br /><br />
				</div>
				<br />
				<br />
				<div id='Login'><center>
				<div id='Msg'>About Us</div>
				Social-Paradise is a massive virtual online community to connect users aged 10-16 to create items and make games.
				<br />
				<br />
				You can learn more <a href='../About/'><b>Here</b></a>.
				</div>
</td>
</tr>
</table>
";
}
else {
echo "<b>Register has been temporarily disabled.</b>";
}

include "Footer.php";
