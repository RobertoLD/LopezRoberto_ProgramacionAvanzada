<?php

if (isset($_POST["accion"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $authController = new AuthController();
    $authController->login($email, $password);
}

class AuthController {
    public function login($email, $password) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login?email=' . urlencode($email) . '&password=' . urlencode($password),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('email' => $email, 'password' => $password),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        
        if (isset($response->data) && is_object($response->data)) {
            $_SESSION['user_data'] = $response->data;
            header("Location: ./Home.html");
        } else {
            header("Location: ./login.html");
        }
    }
}
