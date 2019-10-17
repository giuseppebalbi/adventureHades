<?php

// Load composer
//require_once __DIR__ . '/vendor/autoload.php';
// Add you bot's API key and name
$bot_api_key  = '921851310:AAHGBNHdtGve5JlLWhkA1Wo2qTXHU6BcTKI';
$bot_username = 'AdventureHades_bot';
// Define all IDs of admin users in this array (leave as empty array if not used)
$admin_users = [
//    123,
];
// Define all paths for your custom commands in this array (leave as empty array if not used)
$commands_paths = [
    __DIR__ . '/Commands/',
];
// Enter your MySQL database credentials
// $mysql_credentials = [
//   'host'     => '89.46.111.68',
//     'user'     => 'Sql1228856',
//     'password' => '0218k30204',
//     'database' => 'Sql1228856_5',
// ];

$DB_ADDRESS="89.46.111.68";
$DB_USER="Sql1228856";
$DB_PASS="0218k30204";
$DB_NAME="Sql1228856_5";




$conn = new mysqli($DB_ADDRESS,$DB_USER,$DB_PASS,$DB_NAME);

//echo "Connected successfully";

$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

/*
$sql = "INSERT INTO user (first_name, last_name, username) VALUES ('" . $firstname . "','" . $lastname . "','" . $username. "')";
if (mysqli_query($conn, $sql)) {
	$ciao =  "New record created successfully";
} else {
	$ciao =  "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

*/

$text = trim($text);
$text = strtolower($text);



header("Content-Type: application/json");

$response = '';
if(strpos($text, "/start") === 0 || $text=="ciao")
{
	$response = "Ciao $firstname, benvenuto di nuovo!";
}
elseif($text=="domanda 1")
{
	$response = "risposta 1";
}
elseif($text=="domanda 2")
{
	$response = "risposta 2";
}
else
{
	$response = "Comando valido!";
}

$response .= $ciao;


$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
