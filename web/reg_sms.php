<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=K2a6fJ5jl4u9YhXzZrxGdcDTivQV1kUmCtbe3nqpPyIA8gFBNO94eDvGOQUg0c2KdpfXyHiVrmPbut63&sender_id=FSTSMS&message=".urlencode('

 Dear XYZ Store,
-Deliver
IDSTR3C199345086

>Mothers Choice Unpolished Toor Dal
-Rs.65 / 500 GM
-1 x 500 GM
Rs.65,

at
Gaurav Singh
House no 3814 1st Floor Sector 3
8447572565

Payment;
Rs.115 (Include Delivery Charges)
Mode : cash_on_delivery
Status : Collect at Delivery')."&language=english&route=p&numbers=".urlencode('9654259953'),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>
