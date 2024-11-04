<form action="detalles.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
</form>

<?php
session_start();
require_once 'AuthController.php';
if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = bin2hex(random_bytes(32));

$authController = new AuthController();

if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];
    $productDetails = $authController->getProductDetails($slug);
} else {
    header("Location: Home.php");
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1><?= htmlspecialchars($productDetails->title) ?></h1>
    <img src="<?= htmlspecialchars($productDetails->image) ?>" alt="<?= htmlspecialchars($productDetails->title) ?>" class="img-fluid">
    
    <h3>Brand: <?= htmlspecialchars($productDetails->brand) ?></h3>
    <h4>Categorías:</h4>
    <ul>
        <?php foreach ($productDetails->categories as $category): ?>
            <li><?= htmlspecialchars($category) ?></li>
        <?php endforeach; ?>
    </ul>
    <h4>Etiquetas:</h4>
    <ul>
        <?php foreach ($productDetails->tags as $tag): ?>
            <li><?= htmlspecialchars($tag) ?></li>
        <?php endforeach; ?>
    </ul>
    <p><?= htmlspecialchars($productDetails->description) ?></p>
    <a href="Home.php" class="btn btn-secondary">Volver</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
