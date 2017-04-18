<?php $this->layout('layoutAdmin', ['title' => 'Détails du message de contact']) ?>
<?php $this->start('main_content') ?>

    <h2>Détails du message de contact</h2>
    
    <div class="panel panel-default">
        <div class="panel-body">
            <p><strong>Date du message : </strong><?= $contact['date'] ?></p>
            <p><strong>Nom de l'expéditeur : </strong><?= $contact['name'] ?></p>
            <p><strong>Email de l'expéditeur : </strong><?= $contact['email'] ?></p>
            <br>
            <p><strong>Sujet : </strong><?= $contact['subject'] ?></p>
            <p>
                <strong>Message : </strong>
                <br>
                <?= $contact['message'] ?>
            </p>
        </div>
    </div>


<?php $this->stop('main_content') ?>
