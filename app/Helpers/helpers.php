<?php 
if (! function_exists('get_token_sms')){
    function get_token_sms(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://RestfulSms.com/api/Token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
	"UserApiKey":"'. env('UserApiKey_sms') .'",
	"SecretKey":"' . env('SecretKey_sms') . '"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        $response = json_decode($response);
        curl_close($curl);
        if ($response->IsSuccessful == false){
            return false;
        }
return  $response->TokenKey;

    }
}
if (! function_exists("sendMessage")){
    function sendMessage(string $text,int $phone){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://RestfulSms.com/api/MessageSend',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
  "Messages":["' . $text . '"],
  "MobileNumbers": ["'. $phone .'"],
  "LineNumber": "' . env('LineNumber_sms') . '",
  "SendDateTime": "",
  "CanContinueInCaseOfError": "false"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-sms-ir-secure-token: ' . get_token_sms()
            ),
        ));

        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
        if (!isset($response->IsSuccessful)){
            return false;
        }
        if (!$response->IsSuccessful){
            return false;
        }
        return true;
    }
}
if (! function_exists("sendCode")){
    function sendCode(int $code,int $phone,int $theme){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://RestfulSms.com/api/UltraFastSend',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
 "ParameterArray":[
{ "Parameter": "code","ParameterValue": "'.$code.'"}
],
"Mobile":"'.$phone.'",
"TemplateId":"'.$theme.'"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'x-sms-ir-secure-token: ' . get_token_sms()
            ),
        ));

        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
//        dd($response);
        if (!isset($response->IsSuccessful)){
            return false;
        }
        if (!$response->IsSuccessful){
            return false;
        }
        return true;
    }
}
