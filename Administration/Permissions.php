<?php
	include "../Global.php";
	
	if (!$User) {
	
		include "../403.shtml";
		exit;
	
	}
	
	if ($myU->PowerAdmin != "true") {
	
		include "../403.shtml";
		exit;
	
	}