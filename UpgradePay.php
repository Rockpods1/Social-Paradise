<?php
	include "Header.php";
	$ID = SecurePost($_GET['ID']);
header("Location: http://social-paradise.net/Memberships/UpgradePay.php?ID=$ID");