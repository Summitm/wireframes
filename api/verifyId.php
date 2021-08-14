<?php
    require_once('cors.php');
    require_once('core.php');

    $payload = file_get_contents("php://input");
    echo $payload;


    $conn = new Db();
    $done = $conn->verifyIds($payload);

    if($done['staus']) {
        http_response_code(200);
        echo json_encode($done);
    }
    else{
        http_response_code(400);
        echo json_encode("Error: Invalid ID!");
    }
    // echo "hello";
?>