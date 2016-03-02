<?php
//for login 
openlog("myScriptLog", LOG_PID | LOG_PERROR, LOG_LOCAL0);
//include firbase jwt library
require_once('vendor/autoload.php');
use \Firebase\JWT\JWT;


//public key of appmanager(default wso2cabon servers public key)
$publicKey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCUp/oV1vWc8/TkQSiAvTousMzO
M4asB2iltr2QKozni5aVFu818MpOLZIr8LMnTzWllJvvaA5RAAdpbECb+48FjbBe
0hseUdN5HpwvnH/DW8ZccGvk53I6Orq7hLCv1ZHtuOCokghz/ATrhyPq+QktMfXn
RS4HrKGJTzxaCcU7OQIDAQAB
-----END PUBLIC KEY-----
";

$headers =  getallheaders();
//Read jwt token from http header X-JWT-Assertion;
$encodedJwtToken = $headers['X-JWT-Assertion'];
echo "<b>encoded jwt token recevied from appamanger</b><br>";
echo $encodedJwtToken."<p>";

//decode the token with signature verification.
$decodedJwtToken = JWT::decode($encodedJwtToken, $publicKey, array('RS256'));
echo "<b>decoded jwt token payload :</b>"."<br>";

foreach($decodedJwtToken as $key=>$val){
  echo $key . ': ' . $val . '<p>';
}

?>