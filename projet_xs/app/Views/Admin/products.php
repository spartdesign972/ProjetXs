<?php $this->layout('layoutAdmin', ['title' => 'Produits']) ?>
<?php $this->start('main_content') ?>

	<br>
	<div class="clearfix">
		<a href="<?=$this->url('admin_add_product');?>" class="btn btn-default pull-left">Ajouter un produit</a>
	</div>

    <div class="result"></div>
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Référence</th>
				<th>Taille</th>
				<th>Couleur</th>
				<th>Catégorie</th>
				<th>Notes</th>
				<!--<th>Rôle</th>-->
			</tr>
		</thead>

		<tbody id="productsAjax">
		</tbody>
	</table>
<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
	<script>
		// Chargement des produits
		function loadProducts() {

			$.getJSON('<?= $this->url('admin_products') ?>?json=true', function(products){
				if(products.length == 0){
					$('#productsAjax').html('<tr><td class="danger text-danger text-center">Aucun produit...</td></tr>');
				}
				else{
					var resHTML = '';
					$.each(products, function(index, value) {
						resHTML+= '<tr>';
						resHTML+= '<td>'+value.id+'</td>';
						resHTML+= '<td>'+value.reference+'</td>';
						resHTML+= '<td>'+value.size+'</td>';
						resHTML+= '<td>'+value.color+'</td>';
						resHTML+= '<td>'+value.name+'</td>';
						resHTML+= '<td>'+value.note+'</td>';
						// resHTML+= '<td><a href="<?= $this->url('admin_showadmin') ?>/product-details/'+value.id+'">Visualiser</a></td>';
						resHTML+= '<td><a href="<?= $this->url('admin_showadmin') ?>/edit-product/'+value.id+'">Modifier</a></td>';
						resHTML+= '<td><a href="<?= $this->url('admin_delete_product') ?>" class="deleteProduct" data-id="'+value.id+'">Supprimer</a></td>';
						resHTML+= '</tr>';
						
					});
					$('#productsAjax').html(resHTML);
				}
			});
		}

		loadProducts();

        $(function(){

			// Supprimer un produit
            $('body').on('click', 'a.deleteProduct', function(e){
                e.preventDefault();

				var $deleteProduct = $(this);
                swal({
                    title: "Effacer ce produit",
                    text: "Voulez-vous continuer ?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                    }, function () {
                        setTimeout(function () {
                            $.ajax({
                                method: 'post',
                                url: $deleteProduct.attr('href'),
                                data: {prod_id: $deleteProduct.data('id')},
                                dataType: 'json',
                                success: function(result){
                                    swal('', result.message, result.status);
                                    loadProducts();
                                }
                            });
                        }, 1000);
                });
            });


        });

	</script>
<?php $this->stop('script') ?>
