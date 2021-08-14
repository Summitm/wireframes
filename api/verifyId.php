<?php
    require_once('cors.php');
    require_once('core.php');
    
    // $payload = file_get_contents("php://input");
    $payload = $_POST['body'];
    echo $payload;

    $conn = new Db();
    $done = $conn->verifyIds($payload);

    if($done['status']) {
        http_response_code(200);
        echo json_encode($done);
    }
    else{
        http_response_code(400);
        echo json_encode(array("error"=>"Invalid ID!"));
    }
?>