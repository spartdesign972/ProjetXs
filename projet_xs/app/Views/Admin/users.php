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
				<th>Rôle</th>
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
						resHTML+= '<td><select class="btn btn-mini roleChange" data-id="'+value.id+'"'+(value.id == <?= $w_user['id'] ?> ? ' disabled' : '')+'>';
						resHTML+= '<option value="admin"'+(value.role == 'admin' ? ' selected' : '')+'>Administrateur</option>';
						resHTML+= '<option value="user"'+(value.role == 'user' ? ' selected' : '')+'>Utilisateur</option>'
						resHTML+= '</select></td>';
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

				var $deleteUser = $(this);
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
                                url: $deleteUser.attr('href'),
                                data: {user_id: $deleteUser.data('id')},
                                dataType: 'json',
                                success: function(result){
                                    swal('', result.message, result.status);
                                    loadUsers();
                                }
                            });
                        }, 1000);
                });
            });

			// Modifier un rôle
            $('body').on('change', 'select.roleChange', function(e){
                e.preventDefault();

				var $roleChange = $(this);

				$.ajax({
					method: 'post',
					url: '<?= $this->url('admin_change_role') ?>',
					data: {user_id: $roleChange.data('id'), user_role: $roleChange.find(':selected').val()},
					dataType: 'json',
					success: function(result){
						if(result.status == 'error') {
							swal('', result.message, result.status);
							loadUsers();
						}
					}
				});
            });

        });

	</script>
<?php $this->stop('script') ?>
