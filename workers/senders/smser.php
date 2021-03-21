
<?php

$return=array();


if (isset($_POST['message'])) {

$agent= 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36';
    
$message = urlencode($_POST['message']);
$number = urlencode($_POST['number']);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.smsgateway.center/SMSApi/rest/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'userId=eschoolz&password=eSchoolz%402020&senderId=ESCHLZ&sendMethod=simpleMsg&msgType=text&msg='.$message.'&mobile='.$number.'&dltEntityId=1001116872130043348&duplicateCheck=true&format=json',
  CURLOPT_HTTPHEADER => array(
    'apiKey: 8628730368688933050',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: SERVERID=webC1'
  ),
));

$return['data'] = curl_exec($curl);

curl_close($curl);
    
}

echo json_encode($return);

?>
