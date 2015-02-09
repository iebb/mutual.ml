<?
	include 'config.php';
	$fl = realpath($ck);
	$id=isset($_GET['id'])?$_GET['id']:0;
	$strLoginData = 'username=' . $u . '&password=' . $p . '&autologin=on&login=login';
	$ch           = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://osu.ppy.sh/forum/ucp.php?mode=login");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $strLoginData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fl);
	curl_exec($ch);
	curl_setopt($ch, CURLOPT_URL, "http://osu.ppy.sh/u/$id");
	curl_setopt($ch, CURLOPT_COOKIEFILE, $fl);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fl);
	$datalines = curl_exec($ch);
	if (strstr($datalines,"Mutual")){die("We are already Mutual friends!");}
	
	$h=preg_match_all("/var localUserCheck = \"(.*?)\"/",$datalines,$matches);
	$luc=$matches[1][0];
	if (!strstr($datalines,"profile-username")){die("User not found?");}
	
	if (strstr($datalines,"<i class=\"icon-minus-sign\"></i> Friend</a>")){
	
		curl_setopt($ch, CURLOPT_URL, "http://osu.ppy.sh/u/$id?a=remove&localUserCheck=$luc");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strLoginData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $fl);
		$datalines = curl_exec($ch);
		
		$file = fopen($fr,"a+");
		fwrite($file,date('Y-m-d H:i:s')." Revoked ".$id."\n");
		fclose($file);
		die("Revoked.");
	}
	//print_r($luc);
	$strLoginData = 'localUserCheck='.$luc.'&add='.$id.'&submit=Submit';
	curl_setopt($ch, CURLOPT_URL, "http://osu.ppy.sh/forum/ucp.php?i=zebra&mode=friends");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $strLoginData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fl);
	$datalines = curl_exec($ch);
	
	
	preg_match('/name="sid" value="([0-9a-f]*)"/',$datalines,$matches);
	$sid=$matches[1];
	preg_match('/name="add" value="(.*?)"/',$datalines,$matches);
	$add=$matches[1];
	preg_match('/name="user_id" value="([0-9]*)"/',$datalines,$matches);
	$uid=$matches[1];
	preg_match('/friends&amp;&amp;confirm_key=(.*?)"/',$datalines,$matches);
	$cky=$matches[1];
	
	
	$strLoginData = 'sid='.$sid.'&mode=friends&submit=1&sess='.$sid.'&add='.$add.'&user_id='.$uid.'&confirm=Yes';
	curl_setopt($ch, CURLOPT_URL, "https://osu.ppy.sh/forum/ucp.php?i=zebra&mode=friends&&confirm_key=$cky");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $strLoginData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fl);
	
	$datalines = curl_exec($ch);
	
	
	curl_setopt($ch, CURLOPT_URL, "http://osu.ppy.sh/u/$id");
	curl_setopt($ch, CURLOPT_COOKIEFILE, $fl);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fl);
	$datalines = curl_exec($ch);
	
	if (strstr($datalines,"You have too many friends!")){
		die("I have too many friends!");
	}elseif (strstr($datalines,"<i class=\"icon-minus-sign\"></i> Friend</a>")){
		curl_setopt($ch, CURLOPT_URL, "http://osu.ppy.sh/u/$id?a=remove&localUserCheck=$luc");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/99.99 (compatible; MSIE 99.99; Windows XP 99.99)");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $strLoginData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $fl);
		$datalines = curl_exec($ch);
		die("I'm not your friend!");
	}else{
		die("What happened?");
	}
	$file = fopen($fr,"a+");
		fwrite($file,date('Y-m-d H:i:s')." Added ".$id."\n");
	fclose($file);
	curl_close($ch);
	die("We are mutual friend now!");
	
	
	
?>