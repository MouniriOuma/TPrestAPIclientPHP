<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
</head>
<body>
    <h2>Update Product</h2>
    <?php
    if (isset($_GET['id'])) {
        $product_id = $_GET['id'];
        $url = 'http://localhost:8080/TPrestAPI-1.0-SNAPSHOT/rest/products/' . $product_id;
        $product_details = file_get_contents($url);

        if ($product_details !== FALSE) {
            $product = json_decode($product_details, true);
            if ($product) {
                ?>
                <form action="" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    <label for="id">ID:</label><br>
                    <input type="text" id="id" name="id" value="<?php echo htmlspecialchars($product['id']); ?>" readonly><br>
                    <label for="label">Name:</label><br>
                    <input type="text" id="label" name="label" value="<?php echo htmlspecialchars($product['label']); ?>"><br>
                    <label for="description">Description:</label><br>
                    <textarea id="description" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea><br>
                    <label for="price">Price:</label><br>
                    <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>"><br><br>
                    <button type="submit">Update Produit</button> 
                </form>
                <?php
            } else {
                echo "Erreur lors de la récupération des détails du produit.";
            }
        } else {
            echo "Erreur lors de la communication avec l'API REST.";
        }
    } else {
        echo "ID du produit non spécifié.";
    }
    ?>

    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['label']) && isset($_POST['description']) && isset($_POST['price'])) {
        $id = $_POST['id'];
        $label = $_POST['label'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $url = 'http://localhost:8080/TPrestAPI-1.0-SNAPSHOT/rest/products/' . $id;
        $data = array(
            'id' => $id,
            'label' => $label,
            'description' => $description,
            'price' => $price
        );
        $json_data = json_encode($data);
        $options = array(
            'http' => array(
                'method' => 'PUT',
                'header' => 'Content-Type: application/json',
                'content' => $json_data
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            echo "Erreur lors de la mise à jour du produit";
        } else {
            echo "Produit mis à jour avec succès !";
            header('Location: get_product.php'); 
        }
    } else {
        echo "Toutes les données du produit sont requises pour effectuer la mise à jour.";
    }
}
?>
</body>
</html>
