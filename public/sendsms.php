<?php
function generate_OTP($user_mobile) {

    //for testing purpose
    // return 123456;
    /*
     * Use sms gatewayhub for sms api
     * maintain the format
     * urlencode the message to be sent
     * 50 trial on one account
     */

    // create curl resource
    $ch = curl_init();

    //6 digit random generated OTP
    $my_otp = mt_rand(100000,1000000);
    $message = urlencode("Your OTP is " . $my_otp);

    //user mobile number
    $mobile_number  = "91";
    //$mobile_number .= "9819519671";
    $mobile_number .= $user_mobile;

    //api key
    $api_key = "YOUR_API_KEY";
    //echo $message . "<br>";

    $base_url = "https://www.smsgatewayhub.com/api/mt/SendSMS?";
    $url_post = "APIKey={$api_key}&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number={$mobile_number}&text={$message}&route=13";
    $final_url = $base_url . $url_post;

    //echo $final_url;

    //set curl preferences
    curl_setopt_array($ch, array(
        CURLOPT_URL => $final_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
    ));

    //$output contains the output string
    $output = curl_exec($ch);

    //error if any
    $err = curl_error($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    if ($err) {
        //echo $err;
        return null;
    } else {
        //echo $output;
        return $my_otp;
    }

}

//function call returns otp / null
//$var = generate_OTP("9930218030");
//
//if ($var) {
//    echo $var;
//} else {
//    echo "Error";
//}

?>

<!--https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=rg7pTzwcQ02uUguRz67d3w&senderid=TESTIN&channel=2&DCS=0&flashsms=0&number=919819519671&text=test message&route=13-->
