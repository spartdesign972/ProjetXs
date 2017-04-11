<?php $this->layout('layoutAdmin', ['title' => 'Utilisateurs']) ?>
<?php $this->start('main_content') ?>

	<br>
    <div class="result"></div>
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Pseudo</th>
				<th>Email</th>
			</tr>
		</thead>

		<tbody id="usersAjax">
		</tbody>
	</table>
<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
	<script>
		// Chargement des utilisateurs
		function loadUsers() {

			$.getJSON('<?= $this->url('admin_users') ?>?json=true', function(users){
				if(users.length == 0){
					$('#usersAjax').html('<tr><td class="danger text-danger text-center">Aucun utilisateur...</td></tr>');
				}
				else{
					var resHTML = '';
					$.each(users, function(index, value) {
						resHTML+= '<tr>';
						resHTML+= '<td>'+value.id+'</td>';
						resHTML+= '<td>'+value.lastname+'</td>';
						resHTML+= '<td>'+value.firstname+'</td>';
						resHTML+= '<td>'+value.username+'</td>';
						resHTML+= '<td>'+value.email+'</td>';
						resHTML+= '<td><a href="<?= $this->url('admin_showadmin') ?>/user_details/'+value.id+'">Visualiser</a></td>';
						resHTML+= '<td><a href="<?= $this->url('admin_delete_user') ?>" class="deleteUser" data-id="'+value.id+'">Supprimer</a></td>';
						resHTML+= '</tr>';
					});
					$('#usersAjax').html(resHTML);
				}
			});
		}

		loadUsers();

        $(function(){

			// Supprimer un utilisateur
            $('body').on('click', 'a.deleteUser', function(e){
                e.preventDefault();

				var $this = $(this);
                swal({
                    title: "Effacer cet utilisateur",
                    text: "Voulez-vous continuer ?",
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
                                    loadUsers();
                                }
                            });
                        }, 1000);
                });
            });

        });

	</script>
<?php $this->stop('script') ?>
