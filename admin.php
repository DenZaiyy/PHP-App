<?php
require 'db-functions.php';
session_start();

$products = findAll();
?>

<!-- TODO: Définition superglobals / session / cookie -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body class="bg-dark text-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid text-light">
            <a class="navbar-brand" href="#">Produit</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Accueil</a>
                    <a class="nav-link" href="recap.php">Récapitulatif</a>
                    <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
                    <a class="nav-link disabled position-absolute end-0 mx-2" href="#">
                        <i class="bi bi-cart"></i>
                        <?php
                        //Vérifie si il y as un produit ajouter ou que ce n'est pas vide afin d'afficher le nombres de produit en mode "panier"
                        if (isset($_SESSION['products']) || !empty($_SESSION['products'])) {
                            if (is_array($_SESSION['products'])) {
                                $count = count($_SESSION['products']);
                                if ($count > 1) {
                                    echo $count . " produits";
                                } else {
                                    echo $count . " produit";
                                }
                            }
                        } else {
                            echo "0 produit";
                        }
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2 class="text-center">Ajouter un produit</h2>
        <form action="traitement.php?action=addProduct" method="post">
            <div class="row">
                <div class="col">
                    <label for="name" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="col">
                    <label for="desc" class="form-label">Description du produit</label>
                    <textarea name="desc" id="desc" class="form-control" style="resize: none; height: 38px; width: 650px;" required></textarea>
                </div>
                <div class="col">
                    <label for="price" class="form-label">Prix du produit</label>
                    <div class="input-group mb-3">
                        <input type="number" name="price" step="any" class="form-control form-control-sm" aria-label="Amount (to the nearest euros)" required>
                        <span class="input-group-text">€</span>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <input type="submit" name="submit" class="btn btn-secondary" value="Ajouter le produit">
            </div>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>