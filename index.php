<?php
 $challenge = $_REQUEST['hub_challenge'];
  $verify_token = $_REQUEST['hub_verify_token'];

  if ($verify_token === 'nteezy') {
  echo $challenge;
  }
  //Token of app
 $row = "EAACOsds2GjIBAHZB3ZCZCaoBmP8vPP1X1erZBXdoKWHAiz8sUafo6nFgo2dbGtBCGfGUv8Om4ExUeHeSsdZBszZCZAR9KBQtS6daquA6s9eg7xkx630WHJAcqj8lsYJVLEYFFf4el9hldZBaXa5jvizunwkolaiZBJPjT8otXXR3CzwZDZD";


 $input = json_decode(file_get_contents('php://input'), true);

 print_r($input);
//Receive user
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
 //User's message
 $message = $input['entry'][0]['messaging'][0]['message']['text'];



//Where the bot will send message
 $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$row;


 $ch = curl_init($url);

//Answer to the message adds 1
if($message)
{
	if ($message=="best girl group"){
		 $jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message":{
				"text":"momoland!"
			  }
		 }';
	}elseif(strpos($message,"ioi") !== false){
		$jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message":{
				"text":"Not to forget I.O.I of coz!!! Sejeongggieeeee"
			  }
		 }';
	}elseif(strpos($message,"ade") !== false){
		$jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message":{
				"attachment":{
					"type":"template",
					"payload":{
						"template_type":"generic",
						"elements":[
						  {
							"title":"Haeyoung",
							"item_url":"http://www.kpopmap.com/ade-kpop-profile/",
							"image_url":"https://pbs.twimg.com/media/CkB7HgYUgAAjY0i.jpg",
							"subtitle":"Haeyoung is one of the most well-known members of A.De",
							"buttons":[
							  {
								"type":"web_url",
								"url":"http://www.kpopmap.com/ade-kpop-profile/",
								"title":"View A.De Profile"
							  }            
							]
						  }
						]
					  }
				}
			 }
		 }';
	}elseif(strpos($message,"rachel") !== false){
		$jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message":{
				"text":"Are you talking about Rachel Oun??? She is like my ideal type!! Omgggg"
			  }
		 }';
	}elseif(strpos($message,"momoland") !== false){
		$jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message":{
				"text":"Well, I can tell you Momoland is one of the most promising rookies for 2016!"
			  }
		 }';
	} else {
		$jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message":{
				"text":"Give me a group name and i will tell you what i think about them"
			  }
		 }';
	}
};

// "text":"'.$message. ' 1' .'"

 $json_enc = $jsonData;

 curl_setopt($ch, CURLOPT_POST, 1);

 curl_setopt($ch, CURLOPT_POSTFIELDS, $json_enc);

 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  

 if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
 }