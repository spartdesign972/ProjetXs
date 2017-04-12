<?php $this->layout('layout', ['title' => 'Laissez un message'])?>
<?php $this->start('main_content')?>

<div class="container">
<h1>Votre Panier</h1>
	<br>
<form method="post" action="<?=$this->url(cart_creationPanier) ?>">
<table class="table table-striped">
<thead>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>
</thead>
<tbody>
<?php
if (creationPanier()) {
    $nbArticles = count($_SESSION['panier']['libelleProduit']);
    if ($nbArticles <= 0) {
        echo "<tr><td>Votre panier est vide </ td></tr>";
    } else {
        for ($i = 0; $i < $nbArticles; $i++) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]) . "</ td>";
            echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"" . htmlspecialchars($_SESSION['panier']['qteProduit'][$i]) . "\"/></td>";
            echo "<td>" . htmlspecialchars($_SESSION['panier']['prixProduit'][$i]) . "</td>";
            echo "<td><a href=\"" . htmlspecialchars("panier.php?action=suppression&l=" . rawurlencode($_SESSION['panier']['libelleProduit'][$i])) . "\">XX</a></td>";
            echo "</tr>";
        }

        echo "<tr><td colspan=\"2\"> </td>";
        echo "<td colspan=\"2\">";
        echo "Total : " . MontantGlobal();
        echo "</td></tr>";

        echo "<tr><td colspan=\"4\">";
        echo "<input type=\"submit\" value=\"Rafraichir\"/>";
        echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";

        echo "</td></tr>";
    }
}
?>
</tbody>
</table>
</form>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>

<?php $this->stop('footer')?>