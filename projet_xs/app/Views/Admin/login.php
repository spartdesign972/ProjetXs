<?php $this->layout('layoutAdmin', ['title' => 'Connexion']) ?>

<?php $this->start('main_content') ?>

        <br>

        <form class="form-horizontal" method='post'>
        <fieldset>

        <!-- Form Name -->
        <legend>Formulaire de connexion</legend>
        <?php if(!empty($errorsText)) : ?>
            <div class="alert alert-danger"><?= $errorsText ?></div>
        <?php endif ?>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="login">Identifiant (email ou pseudo)</label>  
                <div class="col-md-4">
                    <input id="login" name="login" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Mot de passe</label>  
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-4">
                    <button class="btn btn-primary">Connexion</button>
                </div>
            </div>

        </fieldset>
        </form>
<?php $this->stop('main_content') ?>
