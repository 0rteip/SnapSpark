<?php 
function sendEmail($reciver, $sender, $type) {
    $from = "snapsparkapp@gmail.com"; /*You need to insert your mail*/
    $subject = getMailObj($type);
    $message = getMailText($sender, $type);
    $headers = ["From" => $from];
    mail($reciver, $subject, $message, $headers);
}

function getMailText($sender, $type) {
    $init = $sender;
    switch ($type) {
        case 'send': return $init . " ti ha inviato un messaggio";
        case 'removeMessage': return $init . " ha eliminato un messaggio";
        case 'Follow': return  $init . " ha iniziato a seguirti";
        case 'Unfollow': return $init . " ha smesso di seguirti";
        case 'New' : return "Ciao, benvenuto nella nostra famiglia!";
    }
}

function getMailObj($type) {
    switch ($type) {
        case 'send': return "Nuovo messaggio!";
        case 'removeMessage': return "Eliminazione Messaggio";
        case 'Follow': return "Nuovo follower!";
        case 'Unfollow': return "Unfollow";
        case 'New' : return "Benvenuto su SnapSpark!";
    }
}