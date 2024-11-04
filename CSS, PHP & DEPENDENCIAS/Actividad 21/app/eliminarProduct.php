<?php
include_once 'AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $slug = $_POST['slug'];
    $authController = new AuthController();
    $result = $authController->deleteProduct($slug);

    if ($result) {
        header("Location: home.php?success=Producto eliminado correctamente");
    } else {
        header("Location: home.php?error=Error al eliminar el producto");
    }
    exit();
}
