<?php $this->layout('layoutAdmin', ['title' => 'Commandes']) ?>
<?php $this->start('main_content') ?>

	<br>
    <div class="result"></div>
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Date</th>
				<th>Nom du client</th>
				<th>Prénom du client</th>
				<th>Etat</th>
			</tr>
		</thead>

		<tbody id="ordersAjax">
		</tbody>
	</table>
<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
	<script>
		// Chargement des commandes
		function loadOrders() {

			$.getJSON('<?= $this->url('admin_orders') ?>?json=true', function(orders){
				if(orders.length == 0){
					$('#ordersAjax').html('<tr><td class="danger text-danger text-center">Aucune commande...</td></tr>');
				}
				else{
					var resHTML = '';
					$.each(orders, function(index, value) {
						resHTML+= '<tr>';
						resHTML+= '<td>'+value.id+'</td>';
						resHTML+= '<td>'+value.date_create+'</td>';
						resHTML+= '<td>'+value.lastname+'</td>';
						resHTML+= '<td>'+value.firstname+'</td>';
						resHTML+= '<td><div class="form-group-sm"><select class=" form-control statusChange" data-id="'+value.id+'">';
						resHTML+= '<option value="en cours"'+(value.status == 'en cours' ? ' selected' : '')+'>En cours</option>';
						resHTML+= '<option value="pret"'+(value.status == 'pret' ? ' selected' : '')+'>Prête</option>'
						resHTML+= '<option value="livre"'+(value.status == 'livre' ? ' selected' : '')+'>Livrée</option>'
						resHTML+= '<option value="annule"'+(value.status == 'annule' ? ' selected' : '')+'>Annulée</option>'
						resHTML+= '</select></div></td>';
						// resHTML+= '<td><a href="<?= $this->url('admin_showadmin') ?>/order-details/'+value.id+'">Visualiser</a></td>';
						resHTML+= '<td><a href="<?= $this->url('admin_send_order') ?>" class="mailOrder" data-id="'+value.user_id+'">Envoyer</a></td>';
						resHTML+= '</tr>';
						
					});
					$('#ordersAjax').html(resHTML);
				}
			});
		}

		loadOrders();

        $(function(){

			// Modifier un état
            $('body').on('change', 'select.statusChange', function(e){
                e.preventDefault();

				var $statusChange = $(this);

				$.ajax({
					method: 'post',
					url: '<?= $this->url('admin_change_status') ?>',
					data: {order_id: $statusChange.data('id'), order_status: $statusChange.find(':selected').val()},
					dataType: 'json',
					success: function(result){
						switch (result.status) {
							case 'error':
								swal('', result.message, result.status);
								loadOrders();
								break;
							
							case 'success':
								$statusChange.parent().addClass('has-success has-feedback');
								break;
						}
					}
				});
            });

            // Envoi un mail
            $('.mailOrder').click(function(e){
                e.preventDefault();

                var $this = $(this);

                swal({
                    title: "Commande",
                    text: "Voulez-vous envoyer un mail au client ?",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                    }, function () {
                        setTimeout(function () {
                            $.ajax({
                                method: 'post',
                                url: $this.attr('href'),
                                data: {user_id: $this.data('id')},
                                dataType: 'json',
                                success: function(result){
                                    swal('', result.message, result.status);
                                }
                            });
                        }, 1000);
                });

            })

        });

	</script>
<?php $this->stop('script') ?>
