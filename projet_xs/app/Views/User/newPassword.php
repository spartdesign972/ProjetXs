<?php $this->layout('layout', ['title' => 'Mon nouveau mot de passe']) ?>
<?php $this->start('main_content') ?>

<div class="container">
    <?php if(empty($successText)) : ?>
        <br>
        <form class="form-horizontal jumbotron" method='post'>
        <fieldset>

            <!-- Form Name -->
            <legend>Mon nouveau mot de passe</legend>

            <?php if(!empty($errorsText)) : ?>
                <div class="alert alert-danger"><?= $errorsText ?></div>
            <?php endif; ?>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="new">Nouveau mot de passe</label>  
                <div class="col-md-4">
                    <input id="new" name="new" type="password" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="confirm">Confirmation du mot de passe</label>  
                <div class="col-md-4">
                    <input id="confirm" name="confirm" type="password" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-4">
                    <button id="" name="" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>

        </fieldset>
        </form>

    <?php else : ?>
        <div class="alert alert-success"><?= $successText ?></div>
    <?php endif; ?>
</div>
<?php $this->stop('main_content') ?>
