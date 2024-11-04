<form action="editarProduct.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
</form>

<?php
session_start();
if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = bin2hex(random_bytes(32));
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $slug = $_POST['slug'];
    $nombre = $_POST['nombre'];
    $description = $_POST['description'];
    $features = $_POST['features'];

    $data = [
        'name' => $nombre,
        'slug' => $slug,
        'description' => $description,
        'features' => $features
    ];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . urlencode($slug),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response, true);

    if (isset($result['success']) && $result['success']) {
        header("Location: Home.php?success=Producto actualizado");
    } else {
        header("Location: Home.php?error=No se pudo actualizar el producto");
    }
}
}
