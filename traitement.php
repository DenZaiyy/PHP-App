<?php
session_start();

$message = '';

if (isset($_POST['submit'])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

    if ($name && $price && $qtt) {
        $product = [
            "name" => $name,
            "price" => $price,
            "qtt" => $qtt,
            "total" => $price * $qtt
        ];

        $_SESSION['products'][] = $product;
        $message = "Bravo";
        header('Location:index.php');
    } else {
        header('Location:index.php');
        $message = "Une erreur est survenue";
    }
}

if (isset($_POST['deleteAll'])) {
    session_destroy();
    $message = "Tout les produits ont été supprimés";
}


if (isset($_POST['delete'])) {
    unset($_SESSION['products']);
    header('Location:recap.php');
}

// header('Location:index.php');
