<?php
$db = new mysqli("localhost", "root" , "" , "chat");
if ($db->connect_error){
die("Connection Failed: " . $db->connect_error);
}
$result = array();
$message = isset($_POST['message']) ? $_POST['message'] :null;
$name = isset($_POST['from']) ? $_POST['from'] :null;
if(!empty($message) && !empty($name)){
    $sql = "INSERT INTO `chat`(`message`, `from`) VALUES ('".$message."','".$name."')"; 
    $result['send_status'] = $db->query($sql);
}


// Print Messages
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$items = $db->query("SELECT * FROM chat WHERE id > ". $start);

while($row  =  $items->fetch_assoc()) {
    $result['items'][] = $row;
}


$db->close();
header('Acess-Control-Allow-Origin *');
header('Content-Type: application/json');
echo json_encode($result);
?>
