<?php
$url = 'http://localhost:8080/TPrestAPI-1.0-SNAPSHOT/rest/products';
$result = file_get_contents($url);
if ($result === FALSE) {
    echo "Erreur lors de la requête GET";
} else {
    $products = json_decode($result);
    if (!empty($products)) {
        echo "<h2>Liste des Produits</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nom</th><th>Prix</th><th>Description</th><th>Actions</th></tr>";
        foreach ($products as $product) {
            echo "<tr>";
            echo "<td>" . $product->id . "</td>";
            echo "<td>" . $product->label . "</td>";
            echo "<td>" . $product->price . "</td>";
            echo "<td>" . $product->description . "</td>";
            echo "<td>";
            echo "<a href='put_product_form.php?id=" . $product->id . "'>Modifier</a>";
            echo " | ";
            echo "<a href='delete_product.php?id=" . $product->id . "'>Supprimer</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</br>";
        echo "<a href='add_product_form.php'>Ajoutez un nouveau produit</a>";
    } else {
        echo "Aucun produit trouvé.";  
    }
}
?>
