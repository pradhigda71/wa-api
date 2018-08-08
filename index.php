<?php
error_reporting(1);
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $now = date('Y-m-d H:i:s');
    $length = 5;

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    $otp = $randomString;

    $params = array(
        "name" => $nama,
        "email" => $email,
        "telp" => $telp,
        "inputdtm" => $now,
        "otp" => $text
    );

    $ch = curl_init();
    
    $instance = ??? ;
    $token = ??? ;
    $text = 'Your key : '.$otp ;

    $data = [
        'phone' => $telp, // Receivers phone
        'body' => $text, // Message
    ];
    $json = json_encode($data); // Encode data to JSON */
    // URL for request POST /message

    $url = 'https://eu10.chat-api.com/$instance/message?token=$token';
    // Make a POST request

    $options = stream_context_create(['http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => $json
        ]
    ]);
    // Send a request
    $send_wa = file_get_contents($url, false, $options);

    if ($send_wa) {
        $insert = $DB->insertData("tabel", $params);
        if ($insert) {
            echo "<script>alert('Success');</script>";
        } else {
            echo "<script>alert('Error');</script>";
        }
    } else {
        echo "<script>alert('Error');</script>";
    }
}
