<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
                    <a class="nav-link" aria-current="page" href="index.php">Accueil</a>
                    <a class="nav-link active" href="recap.php">Récapitulatif</a>
                    <a class="nav-link disabled" href="#">
                        <?php
                        if (is_array($_SESSION['products'])) {
                            $count = count($_SESSION['products']);
                            if ($count > 1) {
                                echo $count . " produits";
                            } else {
                                echo $count . " produit";
                            }
                        } else {
                            echo "0 produit";
                        } ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <?php
    if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        echo '<div class="container text-center mt-5">',
        "<p>Aucun produit en session...</p>",
        '</div>';
    } else {
        echo '<div class="container">',
        '<table class="table table-dark table-striped-columns table-hover mt-5">',
        '<thead class="table-light text-center">',
        "<tr>",
        "<th>#</th>",
        "<th>Nom</th>",
        "<th>Prix</th>",
        "<th>Quantité</th>",
        "<th>Total</th>",
        "<th>Action</th>",
        "</tr>",
        "</thead>",
        '<tbody class="text-center">';

        function moinsBtn()
        {
        }

        function plusBtn()
        {
        }

        $totalGeneral = 0;
        foreach ($_SESSION['products'] as $index => $product) {

            echo "<tr>",
            "<td>" . $index . "</td>",
            "<td>" . $product['name'] . "</td>",
            "<td>" . number_format($product['price'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
            "<td>" . '<input type="button" name="moins" value="-" class="btn btn-outline-danger" onclick="' . moinsBtn() . '"> ' . $product['qtt'] . ' <input type="button" name="plus" value="+" class="btn btn-outline-success" onclick="' . plusBtn() . '">' . "</td>",
            "<td>" . number_format($product['total'], 2, ",", "&nbsp;") . "&nbsp;€</td>",
            "<td>" . '<form action="traitement.php" method="post"><input type="submit" name="delete" class="btn btn-danger" value="Supprimer">' . "</form></td>",
            "</tr>";
            $totalGeneral += $product['total'];
        }
        echo "<tr>",
        "<td colspan=4>Total général : </td>",
        "<td><strong>" . number_format($totalGeneral, 2, ",", "&nbsp;") . "&nbsp;€</strong></td>",
        "<td>" . '<form action="traitement.php" method="post"><input type="submit" name="deleteAll" class="btn btn-danger" value="Supprimer tout les produits">' . "</form></td>",
        "</tr>";
        echo "</tbody>",
        "</table>",
        "</div>";
    } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>