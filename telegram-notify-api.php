<?php

foreach ($_POST as $key => $value) {
 //echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
 $mesg.= "Field ".htmlspecialchars($key)." = ".htmlspecialchars($value)."\n";
}

$message=urlencode($mesg);

if($message !="") {
	
	sendtelegrammesg();

	header('Content-Type: text/html; charset=utf-8');
	$res = notify_message($message);
	echo "<center>ส่งข้อความเรียบร้อยแล้ว</center>";

} else {
		echo "<center>Error: กรุณากรอกข้อมูลให้ครบถ้วน</center>";
}


function sendtelegrammesg() {
	
	function notify_message($message){
		
		$TOKEN_KEY = "710115669:AAF0dApYdrZ88XPDtdUeEkgYsOOEwZHdWnQ";
		$CHATID = "-1001252072628";
	
		$ch = curl_init();

		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Set the url
		curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot$TOKEN_KEY/sendMessage?chat_id=$CHATID&text=$message");
		
		// Execute
		$result = curl_exec($ch);

		// Closing
		curl_close($ch);

		// แปลงข้อมูลที่รับมาในรูป json มาเป็น array จะได้ใช้ง่าย ๆ
		//$DATA = json_decode($result, true);
		
		$res = json_decode($result);
		
		//dump ข้อมูลออกมาดู
		//print_r($res);

		return $res;

	}

}

?>
