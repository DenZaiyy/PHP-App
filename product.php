<?php
require './db-functions.php';
$id = $_GET['id'];
filter_var($id, FILTER_VALIDATE_INT);
$product = findOneById($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="bg-dark text-light">
    <div class="container mt-5">
        <div class="card text-dark">
            <div class="card-header">
                Product infos
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $product['name']; ?></h5>
                <p class="card-text"><?= $product['description']; ?></p>
                <p class="card-text"><strong><?= number_format($product["price"], 2, ",", "&nbsp;") ?> €</strong></p>
                <a href="index.php" class="btn btn-primary">Back to home</a>
                <a href="traitement.php?action=addToCart&id=<?= $product['id'] ?>" class="btn btn-danger">Add to cart</a>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>