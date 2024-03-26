<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Produit</title>
</head>
<body>
    <h2>Ajouter un Produit</h2>
    <form action="" method="post" id="productForm">
        <label for="label">Nom:</label><br>
        <input type="text" id="label" name="label"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <label for="price">Prix:</label><br>
        <input type="text" id="price" name="price"><br><br>
        <button type="submit">Ajouter le Produit</button> 
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['label']) && isset($_POST['description']) && isset($_POST['price'])) {
                $label = $_POST['label'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $url = 'http://localhost:8080/TPrestAPI-1.0-SNAPSHOT/rest/products';
                $data = array(
                    'label' => $label,
                    'description' => $description,
                    'price' => $price
                );
                $json_data = json_encode($data);
                $options = array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => 'Content-Type: application/json',
                        'content' => $json_data
                    )
                );
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                if ($result === FALSE) {
                    echo "Erreur lors de l'ajout du produit";
                } else {
                    echo "Produit ajouté avec succès !";
                    header('Location: get_product.php');
                }
            } else {
                    echo "Toutes les données du produit sont requises pour ajouter un nouveau produit.";
            }
        }
    ?>

</body>
</html>
