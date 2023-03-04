<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary of products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body class="bg-dark text-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid text-light">
            <a class="navbar-brand" href="#">Product</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link active" aria-current="page" href="recap.php">Summary</a>
                    <a class="nav-link" href="admin.php">Admin</a>
                    <a class="nav-link disabled position-absolute end-0 mx-2" href="">
                        <i class="bi bi-cart"></i>
                        <?php
                        //Vérifie si il y as un produit ajouter ou que ce n'est pas vide afin d'afficher le nombres de produit en mode "panier"
                        if (isset($_SESSION['products']) || !empty($_SESSION['products'])) {
                            if (is_array($_SESSION['products'])) {
                                $count = count($_SESSION['products']);
                                if ($count > 1) {
                                    echo $count . " products";
                                } else {
                                    echo $count . " product";
                                }
                            }
                        } else {
                            echo "0 product";
                        }
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <?php
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        echo '<div class="container text-center mt-5">',
        "<strong>No products in session...</strong>",
        '</div>';
    } else {
        echo '<div class="container">',
        '<table class="table table-dark table-striped-columns table-hover mt-5">',
        '<thead class="table-light text-center">',
        "<tr>",
        "<th>#</th>",
        "<th>Name</th>",
        "<th>Price</th>",
        "<th>Quantity</th>",
        "<th>Total</th>",
        "<th>Action</th>",
        "</tr>",
        "</thead>",
        '<tbody class="text-center">';

        $totalGeneral = 0;
        foreach ($_SESSION['products'] as $index => $product) { //Parcours le tableau de mes produits stocker en session
            echo "<tr>",
            "<td><strong>" . $index . "</strong></td>",
            "<td><a href='product.php?id=" . $product["product_id"] . "' class='link-danger'>" . $product['name'] . "</a></td>", //Récupération du nom
            "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>", //Récupération du prix
            "<td>" . '<a href="traitement.php?action=decreaseQuantity&id=' . $index . '" class="btn btn-outline-danger">-</a> ' . $product['qtt'] . ' <a href="traitement.php?action=increaseQuantity&id=' . $index . '" class="btn btn-outline-success">+</a>' . "</td>", //Récupération de la quantité
            "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>", //Calcule du total
            '<td><a href="traitement.php?action=deleteItem&id=' . $index . '" class="btn btn-outline-danger">Delete</a></td>', //Boutton permettant de supprimer un item du tableau se basans par l'id de la ligne du tableau
            "</tr>";
            $totalGeneral += $product['total'];
        }
        echo "<tr>",
        "<td colspan=4>Total price : </td>",
        "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>", //Affichage du prix total du panier
        "<td>" . '<a href="traitement.php?action=removeAll" class="btn btn-danger">Delete all products</a>' . "</td>", //Boutton pour supprimer tout les produits
        "</tr>";
        echo "</tbody>",
        "</table>",
        "</div>";
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>