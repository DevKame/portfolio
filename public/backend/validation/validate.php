<?php

$res = "empty";

$req = json_decode(file_get_contents("php://input"));
$res = [];
$res["success"] = false;
switch($req->task)
{
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
