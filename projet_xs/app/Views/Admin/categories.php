<?php $this->layout('layoutAdmin', ['title' => 'Catégories']) ?>
<?php $this->start('main_content') ?>

	<br>
	<div class="clearfix">
		<a href="<?=$this->url('admin_add_category');?>" class="btn btn-default pull-left">Ajouter une catégorie</a>
	</div>
    
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Image</th>
				<th>Libellé</th>
				<th>Référence</th>
				<th>Nom</th>
				<th>Description</th>
				<th>Prix</th>
				<th>TVA</th>
			</tr>
		</thead>

		<tbody id="categoriesAjax">
		</tbody>
	</table>
<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
	<script>
		// Chargement des catégories
		function loadCategories() {

			$.getJSON('<?= $this->url('admin_categories') ?>?json=true', function(categories){
				if(categories.length == 0){
					$('#categoriesAjax').html('<tr><td class="danger text-danger text-center">Aucune catégorie...</td></tr>');
				}
				else{
					var resHTML = '';
					$.each(categories, function(index, value) {
						resHTML+= '<tr>';
						resHTML+= '<td>'+value.id+'</td>';
                        resHTML+= '<td></td>';
						resHTML+= '<td><img height="50" class="thumbnail" src="<?= $this->assetUrl('img/custom') ?>/'+value.view+'" alt=""></td>';
						resHTML+= '<td>'+value.category+'</td>';
						resHTML+= '<td>'+value.category_reference+'</td>';
						resHTML+= '<td>'+value.name+'</td>';
						resHTML+= '<td>'+value.description+'</td>';
						resHTML+= '<td>'+value.price+'</td>';
						resHTML+= '<td>'+value.tax+'</td>';
						resHTML+= '<td><a href="<?= $this->url('admin_delete_category') ?>" class="deleteCategory" data-id="'+value.id+'">Supprimer</a></td>';
						resHTML+= '</tr>';
						
					});
					$('#categoriesAjax').html(resHTML);
				}
			});
		}

		loadCategories();

        $(function(){

			// Supprimer une catégorie
            $('body').on('click', 'a.deleteCategory', function(e){
                e.preventDefault();

				var $deleteCategory = $(this);
                swal({
                    title: "Effacer cet catégorie",
                    text: "Voulez-vous continuer ?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                    }, function () {
                        setTimeout(function () {
                            $.ajax({
                                method: 'post',
                                url: $deleteCategory.attr('href'),
                                data: {category_id: $deleteCategory.data('id')},
                                dataType: 'json',
                                success: function(result){
                                    swal('', result.message, result.status);
                                    loadCategories();
                                }
                            });
                        }, 1000);
                });
            });

        });

	</script>
<?php $this->stop('script') ?>
