<?php

if(isset($_POST["accion"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $authController = new AuthController();
    $authController($email, $password)
}

public class AuthController(){
    public function login($email, $password){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login?email=robertoall_20%40alu.uabcs.mx&password=123456815',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('email' => 'robertoall_20@alu.uabcs.mx','password' => '123456815'),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response;

        $response=json_decode($response);

        if(isset($response->message))

        header("Location: ../Home.html")
    }
}


