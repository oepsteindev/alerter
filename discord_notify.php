<?php


function notify($price, $msg) {


//=======================================================================================================
// Create new webhook in your Discord channel settings and copy&paste URL
//=======================================================================================================

$webhookurl = "https://discord.com/api/webhooks/863040037176475668/xQXKN_i-AMFJYvQ2uEYIu1UbgRuOZV87xu3DJamb6_sX7Ysi3K0mVfuu1x-cJx1wm99E";

//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));
// $price = isset($_POST['price']) ? $_POST['price'] : '';

$json_data = json_encode([
    // Message
    "content" => "@everyone {$msg}",
    
    // Username
    "username" => "R2",

    // Avatar URL.
    // Uncoment to replace image set in webhook
    //"avatar_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=512",

    // Text-to-speech
    "tts" => false,

    // File upload
    // "file" => "",

    // Embeds Array
    // "embeds" => [
    //     [
    //         // Embed Title
    //         "title" => "PHP - Send message to Discord (embeds) via Webhook " ,

    //         // Embed Type
    //         "type" => "rich",

    //         // Embed Description
    //         "description" => "Description will be here, someday, you can mention users here also by calling userID <@12341234123412341>",

    //         // URL of title link
    //         "url" => "https://gist.github.com/Mo45/cb0813cb8a6ebcd6524f6a36d4f8862c",

    //         // Timestamp of embed must be formatted as ISO8601
    //         "timestamp" => $timestamp,

    //         // Embed left border color in HEX
    //         "color" => hexdec( "3366ff" ),

    //         // Footer
    //         "footer" => [
    //             "text" => "GitHub.com/Mo45",
    //             "icon_url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=375"
    //         ],

    //         // Image to send
    //         "image" => [
    //             "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=600"
    //         ],

    //         // Thumbnail
    //         //"thumbnail" => [
    //         //    "url" => "https://ru.gravatar.com/userimage/28503754/1168e2bddca84fec2a63addb348c571d.jpg?size=400"
    //         //],

    //         // Author
    //         "author" => [
    //             "name" => "krasin.space",
    //             "url" => "https://krasin.space/"
    //         ],

    //         // Additional Fields array
    //         "fields" => [
    //             // Field 1
    //             [
    //                 "name" => "Field #1 Name",
    //                 "value" => "Field #1 Value",
    //                 "inline" => false
    //             ],
    //             // Field 2
    //             [
    //                 "name" => "Field #2 Name",
    //                 "value" => "Field #2 Value",
    //                 "inline" => true
    //             ]
    //             // Etc..
    //         ]
    //     ]
    // ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $webhookurl );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close( $ch );

mail( '6313382513@txt.att.net', '', 'Testing: '. $msg );
mail( '6313382513@mms.att.net', '', 'Testing Address2: '. $msg );

}

function textme($msg) {

//$recipient = $_GET['pnumber'];
$recipient = 16313382513;
$_GET['carrier'] = 'att';

switch($_GET['carrier']){

case "verizon":

$recipient .= "@vtext.com";

break;

case "att":

$recipient .= "@txt.att.net";

break;

case "tmobile":

$recipient .= "@tmomail.net";

break;

}

$body = "This SMS message was sent with PHP. {$msg}";

$header = "From: sms@oepsteina2hosted.com";

mail($recipient,"",$body,$header);
}