<?php
session_start();
include_once 'AuthController.php';

$authController = new AuthController();
$products = $authController->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 19 - Actualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .offcanvas-start {
            background-color: #343a40;
        }
        .offcanvas .nav-link {
            color: #ffffff;
        }
        .offcanvas .nav-link.active {
            background-color: #007bff;
        }
        .offcanvas .nav-link:hover {
            background-color: #495057;
        }
        .card-img-top {
            width: 100%;
            height: 225px;
            object-fit: cover;
        }
        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            lll
        </button>
        <a class="navbar-brand ms-3" href="#">Navbar scroll</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Link
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Link</a></li>
                        <li><a class="dropdown-item" href="#">Link</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            <div class="dropdown ms-3 d-flex align-items-center">
                <img src="Monster_Hunter_Logo.png" alt="Profile Image" class="profile-img me-2">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    mdo
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Salir</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Encargos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Opciones</a>
            </li>
        </ul>
    </div>
</div>

<main class="container mt-4">
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($_GET['success']) ?>
        </div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Artículos</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            Añadir producto
        </button>
    </div>

    <div class="row">
        <?php if ($products && count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <img src="<?= htmlspecialchars($product->image) ?>" class="card-img-top" alt="<?= htmlspecialchars($product->title) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product->title) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($product->description) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="detalles.php?slug=<?= htmlspecialchars($product->slug) ?>" class="btn btn-primary">Detalles</a>
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="<?= htmlspecialchars($product->slug) ?>">Editar</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal" data-id="<?= htmlspecialchars($product->slug) ?>">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay artículos disponibles.</p>
        <?php endif; ?>
    </div>
</main>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Añadir producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="crearProduct.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="features" class="form-label">Características</label>
                        <textarea class="form-control" id="features" name="features" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear producto</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="editarProduct.php" method="POST">
                    <input type="hidden" id="edit-product-id" name="slug">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit-name" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-features" class="form-label">Características</label>
                        <textarea class="form-control" id="edit-features" name="features" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Eliminar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que quieres eliminar este producto?
            </div>
            <div class="modal-footer">
                <form id="deleteProductForm" action="eliminarProduct.php" method="POST">
                    <input type="hidden" id="delete-product-id" name="slug">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const editProductModal = document.getElementById("editProductModal");
    editProductModal.addEventListener("show.bs.modal", function(event) {
        const button = event.relatedTarget;
        const productId = button.getAttribute("data-id");
        const productName = button.closest(".card").querySelector(".card-title").textContent;
        const productDescription = button.closest(".card").querySelector(".card-text").textContent;
        document.getElementById("edit-product-id").value = productId;
        document.getElementById("edit-name").value = productName;
        document.getElementById("edit-description").value = productDescription;
    });

    const deleteProductModal = document.getElementById("deleteProductModal");
    deleteProductModal.addEventListener("show.bs.modal", function(event) {
        const button = event.relatedTarget;
        const productId = button.getAttribute("data-id");
        document.getElementById("delete-product-id").value = productId;
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
