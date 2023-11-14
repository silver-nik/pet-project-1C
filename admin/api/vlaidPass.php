<?php

    session_start();

    $config = parse_ini_file('config.conf', true);

    $_POST = json_decode(file_get_contents('php://input'), true);

    $dta = $config['database']['dta'];
    $pwd = $_POST['pwd'];

    $pwd_peppered = hash_hmac("sha256", $pwd, $dta);

   
    if(password_verify($pwd_peppered, $pwd)) {
        echo json_encode(array(
            "message" => "ok"
        ));
    } else {
        http_response_code(401);
        echo json_encode(array(
            "message" => "401"
        ));
    }
                            

?>