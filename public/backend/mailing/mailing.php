<?php

$res = "empty";
// MANAGES PREFLIGHT - REQUEST
// ONLY FOR DEVELOPMENT
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    exit();
}
// DEPENDING ON KIND OF REQUEST, PARTICULAR ACTIONS WILL BE INVOKED
else {
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header("Access-Control-Allow-Headers: Content-Type");
    $req = json_decode(file_get_contents("php://input"));
    $res = [];
    $res["success"] = false;
    switch($req->task)
    {
        case "mail-after-question":
            sendMail($req);
        break;
    }

    $res = json_encode($req);
}


function sendMail($req) {
    $receiver   = $req->email;
    $subject    = "Kamedin Webdesign";
    $msg        = "<h1>Your request was sent!</h1><br/><p>Dear $req->firstname, <br />your request was sent. Please have a little patience and youll get an answer shortly, not later than 7 days";
    $header     = "From: website-noReply@kamed.in\r\n";
    $header    .= "Reply-To: no-replying@please.com\r\n";
    $header    .= "MIME-Version:1.0\r\n";
    $header    .= "Content-Type:text/html;charset=utf-8\r\n";

    mail($receiver, $subject, $msg, $header);

    $receiver   = "eltru@gmx.de";
    $msg        = "<h1>Jemand hat über dein Formular eine Anfrage gestellt!</h1><br /><p>Schau im phpMyAdmin von IONOS rein";

    mail($receiver, $subject, $msg, $header);

}

echo $res;