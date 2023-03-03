<?php
require './db-functions.php';

$products = findAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>PDO - Items of BDD</title>
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
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                    <a class="nav-link" href="recap.php">Récapitulatif</a>
                    <a class="nav-link" href="admin.php">Admin</a>
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
        <h2 class="text-center">List of products</h2>
        <table class="table table-dark table-striped-columns table-hover mt-5">
            <thead class="table-light text-center">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                foreach ($products as $value) {
                    echo "<tr>",
                    "<td><a href='product.php?id=" . $value["id"] . "' class='link-danger'>" . $value["name"] . "</a></td>",
                    "<td>" . substr($value["description"], 0, 50) . "...</td>",
                    "<td>" . number_format($value["price"], 2, ",", "&nbsp;") . " €</td>",
                    '<td><a href="traitement.php?action=addToCart&id=' . $value["id"] . '" class="btn btn-danger">Add to cart</a></td>',
                    "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>