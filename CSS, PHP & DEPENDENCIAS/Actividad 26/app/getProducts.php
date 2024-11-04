<?php
class ProductController {
    public function getProducts() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $products = json_decode($response, true);

        if (isset($products['data'])) {
            return $products['data'];
        } else {
            return [];
        }
    }
}

header('Content-Type: application/json');
$productController = new ProductController();
echo json_encode($productController->getProducts());
