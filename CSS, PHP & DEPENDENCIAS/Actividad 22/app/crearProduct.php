<?php
session_start();

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
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

$brands = json_decode($response, true);
$brands = isset($brands['data']) ? $brands['data'] : [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $features = $_POST['features'];
    $brand_id = $_POST['brand'];
    $image = $_FILES['image'];

    $data = [
        'name' => $nombre,
        'slug' => $slug,
        'description' => $description,
        'features' => $features,
        'brand_id' => $brand_id
    ];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'data' => json_encode($data),
            'image' => new CURLFile($image['tmp_name'], $image['type'], $image['name'])
        ),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: multipart/form-data'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response, true);

    if (isset($result['success']) && $result['success']) {
        header("Location: Home.php?success=Producto creado");
    } else {
        header("Location: Home.php?error=No se pudo crear el producto");
    }
}
