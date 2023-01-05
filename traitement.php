<?php
session_start();

$message = '';

//si il y a le mot action dans l'url
if (isset($_GET['action'])) {
    //switch entre différentes actions possibles
    switch ($_GET['action']) {
        case "ajouter":
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
            break;

        case "removeAll":
            unset($_SESSION['products']);
            header('Location:index.php');
            die(); //die() fonction native signifie qu'après l'action précédé on arrête l'execution du script
            break;
        case "deleteItem":
            //si j'ai le mot clé "id" dans l'URL et que j'ai un produit dans mon tableau qui correspond à cet id
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                // $produit = $_SESSION['products'][$_GET['id']];
                unset($_SESSION['products'][$_GET['id']]);
                header('Location:recap.php');
                die();
            }
            break;
        case "decreaseQuantity":
            $id = $_SESSION['products'][$_GET['id']];
            $quantityById = $id['qtt'];
            $base = $_SESSION['products'];
            echo "<pre>",
            var_dump($quantityById),
            "</pre>";
            /*
TODO: Faire en sorte que la valeur du decrement se met à jour dans le tableau  */
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                $quantityById = (--$quantityById);
                echo "<pre>",
                var_dump($quantityById),
                "</pre>";
                // header('Location:recap.php');
                die();
            }
            break;
        case "increaseQuantity":
            header('Location:recap.php');
            break;
    }
}
