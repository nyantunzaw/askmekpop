<?php
if (!empty($_REQUEST['hub_mode']) && $_REQUEST['hub_mode'] == 'subscribe' && $_REQUEST['hub_verify_token'] == "EAACOsds2GjIBAAsNeRHvd7pmWaVGdrPTKrlcRCpwHaXY4ZByiZC7RT2ZAUgSignn1l541HPKAZC5KCIpMQqchZAURNgQekuu0fyaBeDQUUkzIimw2WKSGBqNy65MnCRH7SNyoVvlTYwu5RRDnUrsW1MhHh9GHzKvBKgJRI3AaFQZDZD") {
    echo $_REQUEST['hub_challenge'];
} else {
    $data = json_decode(file_get_contents("php://input"), true);
    file_put_contents('fb.txt', print_r($data, true));
}

//file_put_contents("fb.txt", file_get_contents("php://input"));

echo "hello world2";

//$fb = file_get_contents("fb.txt");

//echo "<pre>";

//$fb=json_decode($fb);

//print_r($fb);