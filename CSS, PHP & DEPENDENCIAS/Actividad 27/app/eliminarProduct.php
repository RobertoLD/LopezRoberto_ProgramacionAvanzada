<form action="eliminarProduct.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
</form>

<?php
if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = bin2hex(random_bytes(32));
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
}
