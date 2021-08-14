<?php
require_once('cors.php');
require_once('core.php');

$keyvalue = file_get_contents("php://input");
echo $keyvalue;
$conn = new Db();
$done = $conn->verifyKeys($keyvalue);
// var_dump($done);

if($done['status']) {
    http_response_code(200);
    echo json_encode($done);
}
else {
    http_response_code(400);
    echo json_encode(array("error"=>"The Key provided is invalid!"));
}
?>