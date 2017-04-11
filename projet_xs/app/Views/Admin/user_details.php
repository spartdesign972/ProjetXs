<?php $this->layout('layoutAdmin', ['title' => 'Détails de l\'utilisateur']) ?>
<?php $this->start('main_content') ?>

	<br>
    <h2><?= $user['firstname'].' '.$user['lastname'] ?></h2>

    <p><strong>Pseudo : </strong><?= $user['username'] ?></p>
    <p><strong>Email : </strong><?= $user['email'] ?></p>
    <p><strong>Type : </strong><?= $user['role'] ?></p>
    <p><strong>Adresse : </strong><?= $user['street'].' '.$user['zipcode'].' '.$user['city'].' '.$user['country'] ?></p>
    <p><strong>Avatar : </strong><img src="<?= $user['avatar'] ?>" alt="avatar_<?= $user['username'] ?>"></p>
<?php $this->stop('main_content') ?>
