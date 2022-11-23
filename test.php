<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_PORT => "80",
    CURLOPT_URL => "localhost/api/addressbook?=",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"id\":\"1\",\"name\":\"asdfasdf\",\"openingHours\":\"public/public/\",\"telephone\":\"\",\"country\":\"public/\",\"locality\":\"\",\"region\":\"\",\"code\":\"\",\"streetAddress\":\"\"}",
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json"
    ],
  ]);
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  
  curl_close($curl);
  echo 'create ';
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
  echo '<hr>';

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_PORT => "80",
  CURLOPT_URL => "localhost/api/addressbook",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => "{\"id\":\"1\",\"name\":\"asdfasdf\",\"openingHours\":\"public/public/\",\"telephone\":\"\",\"country\":\"public/\",\"locality\":\"\",\"region\":\"\",\"code\":\"\",\"streetAddress\":\"\"}",
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
echo 'update ';
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
echo '<hr>';


$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_PORT => "80",
  CURLOPT_URL => "localhost/api/addressbook",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

echo 'read ';
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
echo '<hr>';

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_PORT => "80",
  CURLOPT_URL => "localhost/api/addressbook",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "DELETE",
  CURLOPT_POSTFIELDS => "{\"id\":1}",
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
echo 'delete ';
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
echo '<hr>';