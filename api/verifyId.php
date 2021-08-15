<?php
    require_once('cors.php');
    require_once('core.php');
    
    $payload = file_get_contents("php://input");
    $conn = new Db();
    $done = $conn->verifyIds($payload);

    if($done) {

        http_response_code(200);
        echo json_encode($done);

    }
    else{

        http_response_code(400);
        echo json_encode(array("error"=>"Invalid ID!"));
        
    }
?>