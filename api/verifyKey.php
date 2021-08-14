<?php
require_once('cors.php');
require_once('core.php');

$key = file_get_contents("php://input");

$conn = new Db();
$done = $conn->verifyKeys($key);

if($done['status']) {
    http_response_code(200);
    echo json_encode($done);
}
else {
    http_response_code(400);
    echo json_encode("The Key provided is invalid!");
}
?>