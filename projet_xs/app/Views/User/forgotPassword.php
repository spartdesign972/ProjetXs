<?php $this->layout('layout', ['title' => 'Mot de passe oublié']) ?>
<?php $this->start('main_content') ?>

    <?php if(empty($successText)) : ?>

        <form class="form-horizontal" method='post'>
        <fieldset>

            <!-- Form Name -->
            <legend>Mot de passe oublié ?</legend>

            <?php if(!empty($errorsText)) : ?>
                <div class="alert alert-danger"><?= $errorsText ?></div>
            <?php endif; ?>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Email</label>  
                <div class="col-md-4">
                    <input id="email" name="email" type="text" placeholder="votre@email.fr" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-4">
                    <button id="" name="" class="btn btn-primary">Envoyer</button>
                </div>
            </div>

        </fieldset>
        </form>

    <?php else : ?>
        <div class="alert alert-success"><?= $successText ?></div>
    <?php endif; ?>

<?php $this->stop('main_content') ?>
