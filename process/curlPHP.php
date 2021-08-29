<?php
if(isset($_POST['submit'])){
    
     //$username = html_entity_decode($_POST['username'], ENT_QUOTES);
   //echo $name;
    $respCap= $_POST['g-recaptcha-response'];
    // $respCap = html_entity_decode($_POST['recatchaCheck'], ENT_QUOTES);
    //$respCap = $_POST['g-recaptcha'];
  
  // include "curlPHP.php";
  
  //echo $respCap;
  
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('secret' => '6Leb7CEcAAAAANhcw2eTsupPTemVPK0yY8r_q8HK','response' => $respCap ,'remoteip' => ''),
));

$response = curl_exec($curl);

//echo curl_errno($curl);

if (curl_errno($curl) > 0){
    curl_close($curl);
    echo "Curl Error " . curl_errno($curl);
    die();
}
else{
    curl_close($curl);
}



echo $response;
$resp = json_decode($response);


if ($resp->success == true){
include "validation.php";
//echo "asd";
}
else {
echo "<br><br>Error Captcha";
header("Location: ../users/error.php?error=1");

}
}

?>