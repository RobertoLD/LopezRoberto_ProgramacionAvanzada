<?php
class ProductController {
    public function getProducts() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);
        
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        
        if (isset($data['data'])) {
            echo json_encode($data['data']);
        } else {
            echo json_encode([]);
        }
    }
}

$controller = new ProductController();
$controller->getProducts();
