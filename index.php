<?php

 $challenge = $_REQUEST['hub_challenge'];
  $verify_token = $_REQUEST['hub_verify_token'];

  if ($verify_token === 'nteezy') {
  echo $challenge;
  }
  //Token of app
 $row = "EAACOsds2GjIBAHZB3ZCZCaoBmP8vPP1X1erZBXdoKWHAiz8sUafo6nFgo2dbGtBCGfGUv8Om4ExUeHeSsdZBszZCZAR9KBQtS6daquA6s9eg7xkx630WHJAcqj8lsYJVLEYFFf4el9hldZBaXa5jvizunwkolaiZBJPjT8otXXR3CzwZDZD";

 //Getting base host name (website's URL)
 	$hostname = getenv('HTTP_HOST');
 
 //Database Connection
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_error) {
    echo "Connection failed";
}

// Parsing the input
 $input = json_decode(file_get_contents('php://input'), true);

 print_r($input);
//Receive user
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
 //User's message
 $message = $input['entry'][0]['messaging'][0]['message']['text'];



//Where the bot will send message
 $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$row;
 $thread_settings = 'https://graph.facebook.com/v2.6/me/thread_settings?access_token='.$row;

 $ch = curl_init($url);
 $ch_thread = curl_init($thread_settings);

//Answer to the message adds 1
if($message)
{
	if ($message=="test"){
		$sql = "SELECT * FROM girl_groups where group_name='a.de'";
		$result = $conn->query($sql);
		
		
		 $jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message":{
				"text":"';
		if ($result->num_rows > 0) {		
				while($row = $result->fetch_assoc()) {
					$jsonData.="test";
				}
				
		}
		$jsonData.='"';
		$jsonData.='}
			}';
	}elseif($message=="web" ){
		$jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message": {
				"attachment":{
					"payload":{
						"elements":[{
							"buttons": [{
								"title":"View it now",
								"type":"web_url",
								"url":"http://askmekpop.herokuapp.com/game",
								"webview_height_ratio":"compact"
							}],
							"image_url": "http://askmekpop.herokuapp.com/images/nteezy.png",
							"item_url": "http://askmekpop.herokuapp.com/game",
							"subtitle":"You can try to move around",
							"title":"Play a cool game!"
						}],
						"template_type":"generic"
					},
					"type":"template"
				}
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
	}elseif(strpos($message," ade ") !== false || $message=="ade" ){
		
		// A.DE
		
		$sql = "SELECT * FROM girl_groups where group_name='a.de'";
		$result = $conn->query($sql);
		
		$counter_ade = 0;
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
					';
					
			if ($result->num_rows > 0) {		
				while($row = $result->fetch_assoc()) {
					++$counter_ade;
					$jsonData .= '{
					';
					$jsonData .= '"title":"'.$row["member_name"].'",
					';
					$jsonData .= '"item_url":"'.$hostname.$row["image_link"].'",
					';
					$jsonData .= '"image_url":"'.$hostname.$row["image_link"].'"
					';
					if ($counter_ade < $result->num_rows+1){
						$jsonData .= '},
						';
					}else{
						$jsonData .= '}
						';
					}
										
				}
			}else{
				$jsonData .= '{
					';
				$jsonData .= '"title":"Can\'t find info for A.DE T_T"
				';
				$jsonData .= '}
						';
			}				
			$jsonData .='
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
		// Momoland
		
		$sql = "SELECT * FROM girl_groups where group_name='Momoland'";
		$result = $conn->query($sql);
		
		$counter = 0;
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
					';
					
			if ($result->num_rows > 0) {		
				while($row = $result->fetch_assoc()) {
					++$counter;
					$jsonData .= '{
					';
					$jsonData .= '"title":"'.$row["member_name"].'",
					';
					$jsonData .= '"item_url":"'.$hostname.$row["image_link"].'",
					';
					$jsonData .= '"image_url":"'.$hostname.$row["image_link"].'"
					';
					if ($counter < $result->num_rows+1){
						$jsonData .= '},
						';
					}else{
						$jsonData .= '}
						';
					}
										
				}
			}else{
				$jsonData .= '{
					';
				$jsonData .= '"title":"Can\'t find info for Momoland T_T"
				';
				$jsonData .= '}
						';
			}				
			$jsonData .='
						]
					}
				}
			}
	  }';
	} else {
		$jsonData = '{
			"recipient":{
				"id":"'.$sender.'"
			  }, 
			"message":{
				"text":"Give me a group name and i will tell you about its members"
			  }
		 }';
	}
};

// "text":"'.$message. ' 1' .'"

 $json_enc = $jsonData;
 
 $json_menu = '{
	 "setting_type" : "call_to_actions",
	  "thread_state" : "existing_thread",
	  "call_to_actions":[
    {
      "type":"postback",
      "title":"Help",
      "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_HELP"
    },
    {
      "type":"postback",
      "title":"Start a New Order",
      "payload":"DEVELOPER_DEFINED_PAYLOAD_FOR_START_ORDER"
    },
    {
      "type":"web_url",
      "title":"Checkout",
      "url":"http://petersapparel.parseapp.com/checkout",
      "webview_height_ratio": "full",
      "messenger_extensions": true
    },
    {
      "type":"web_url",
      "title":"View Website",
      "url":"http://petersapparel.parseapp.com/"
    }
  ]
  }';

 curl_setopt($ch, CURLOPT_POST, 1);
 
  curl_setopt($ch_thread, CURLOPT_POST, $json_menu);

 curl_setopt($ch, CURLOPT_POSTFIELDS, $json_enc);

 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  

 if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
 }
 
/*
$sql = "SELECT * FROM girl_groups";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "No: " . $row["id"]. " - Group Name: " . $row["group_name"]. " - Member Name: " . $row["member_name"]. "<br>";
    }
} else {
    echo "0 results";
}
*/
$conn->close();
