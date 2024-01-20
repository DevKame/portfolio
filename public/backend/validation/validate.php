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

    // CASE FOR GET-REQUEST
    //TODO: REMOVE CASE FOR GET REQUEST BC I DONT THINK ILL USED GET´S
    if($_SERVER["REQUEST_METHOD"] === "GET")
    {
        header("Content-Type: text/plain");
    }
    // CASE FOR POST-REQUEST. EVERY REQUEST HAS A "task"-PROPERTY, THAT
    // DETERMINES WHICH ACTION TO INVOKE
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $req = json_decode(file_get_contents("php://input"));
        $res = [];
        $res["success"] = false;
        switch($req->task)
        {
            case "test":
                $res["success"] = true;
                $res["content"] = "Test Response";
            break;
            //DATA FROM <FirstForm>
            case "msg_validate_userdata":
                $res["task"] = $req->task;
                $res["validation_result"] = checkUserEntries($req->lastname, $req->firstname, $req->email);
                if($res["validation_result"]["invalid_entries"] === 0) {
                    $res["success"] = true;
                }
            break;
            //DATA FROM <SecondForm>
            case "msg_validate_userdesc":
                $res["task"] = $req->task;
                $res["validation_result"] = checkUserDesc($req->desc);
                if($res["validation_result"]["desc_valid"]) {
                    $res["success"] = true;
                }
            break;
        }

        $res = json_encode($res);
    }
}

function checkUserDesc($desc) {
    $result = [];
    $result["desc_valid"] = true;
    $pattern = "/[A-Za-z0-9.,+\-]$/";
    $matches = preg_match_all($pattern, $desc);
    if($matches === 0) {
        $result["desc_valid"] = false;
    }
    if(strlen($desc) < 5 || strlen($desc) > 512) {
        $result["desc_valid"] = false;
    }
    return $result;
}
// INVOKED BY TASK "msg_validate_userdata"
// CHECKS, IF LAST-/FIRSTNAME AND EMAIL ENTRIES ARE VALID
// RETURNS THE RESULT TO DISPLAY IN FRONTEND WHAT TO CORRECT
function checkUserEntries($ln, $fn, $em) {
    $result = [];
    $result["lastname_valid"] = true;
    $result["firstname_valid"] = true;
    $result["email_valid"] = true;
    $result["invalid_entries"] = 0;
    $pattern = "/[a-zA-Z]{3,30}$/";
    $matches = preg_match_all($pattern, $ln);
    if($matches < 1) {
        $result["invalid_entries"]++;
        $result["lastname_valid"] = false;
    }
    $matches = preg_match_all($pattern, $fn);
    if($matches < 1) {
        $result["invalid_entries"]++;
        $result["firstname_valid"] = false;
    }
    
    if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
        $result["invalid_entries"]++;
        $result["email_valid"] = false;
    }

    return $result;
}


echo $res;