<?php

$res = "empty";
// MANAGES PREFLIGHT - REQUEST
// ONLY FOR DEVELOPMENT
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    exit();
}
// DEPENDING ON KIND OF REQUEST, PARTICULAR ACTIONS WILL BE INVOKED
else {
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");

    $host =     "localhost";
    $user =     "[...]";
    $pw =       "[...]";
    $db =       "[...]";

    // CASE FOR POST-REQUEST. EVERY REQUEST HAS A "task"-PROPERTY, THAT
    // DETERMINES WHICH ACTION TO INVOKE
        $req = json_decode(file_get_contents("php://input"));
        $res = [];
        $res["success"] = false;
        switch($req->task)
        {
            case "save_user_request":
                $res["content"] = "Test Response";
                $con = connect();
                $emailTimeoffsetEnough = emailTimeoffsetEnough($con, $req->email, $req->timestamp);
                if(!$emailTimeoffsetEnough) {
                    $res["reason"] = "wait-6";
                    break;
                }
                $res["success"] = true;
                saveRequest($con, $req);
                mysqli_close($con);
            break;
        }

        $res = json_encode($res);
}
function saveRequest($con, $req) {
    $query =
    "INSERT INTO kame_requests
    (
        request_lastname,
        request_firstname,
        request_desc,
        request_has_domain,
        request_has_db,
        request_self_deploy,
        request_data_policy_agreed,
        request_email,
        request_js_timestamp)
        VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "sssssssss", $req->lastname, $req->firstname, $req->desc, $req->hasdomain, $req->hasdb, $req->selfdeploy, $req->datapolicy, $req->email, $req->timestamp);
    mysqli_stmt_execute($stmt);
}

// CHECKS IF THE EMAIL ADRESS ALREADY SENT A REQUEST LESS THAN 6 HOURS AGO
// RETURNS TRUE IF NOT AND FALSE IF IT DID (IN THAT CASE NO REQUEST POSSIBLE)
function emailTimeoffsetEnough($con, $email, $stamp) {
    $result = true;
    $allEntries = [];
    $query =
    "SELECT request_email, request_js_timestamp
    FROM kame_requests
    WHERE request_email = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);
    $matches = mysqli_stmt_num_rows($stmt);
    if($matches !== 0) {

        mysqli_stmt_bind_result($stmt, $fMail, $fStamp);
        while(mysqli_stmt_fetch($stmt)) {
            $allEntries[] = [$fMail, $fStamp];
        }
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
    }
    // CHECK FOR EVERY TIMESTAMP IF IT WAS LESS THAN 6 HOURS AGO
    foreach($allEntries as $item)
    {
        if((((int)$stamp / 1000) / 3600) - (((int)$fStamp / 1000) / 3600) < 6)
        {
            $result = false;
        }
    }
    return $result;
}
function connect() {
    global $host, $user, $pw, $db;
    return mysqli_connect($host, $user, $pw, $db);
}


echo $res;
