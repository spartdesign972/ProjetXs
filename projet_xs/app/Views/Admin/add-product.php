<?php $this->layout('layoutAdmin', ['title' => 'Ajouter un produit']) ?>

<?php $this->start('main_content') ?>

        <br>
        <form id="addProductForm" class="form-horizontal" method='post'>
        <fieldset>

            <!-- Form Name -->
            <legend>Ajouter un produit</legend>
            <div id="result"></div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="category">Catégories</label>
                <div class="col-md-4">
                    <select id="category" name="category_id" class="form-control">
                        <option value="" selected disabled>-- Sélectionnez --</option>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="reference">Référence</label>  
                <div class="col-md-4">
                    <input id="reference" name="reference" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="size">Taille</label>  
                <div class="col-md-4">
                    <input id="size" name="size" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="color">Couleur</label>  
                <div class="col-md-4">
                    <input id="color" name="color" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="note">Notes</label>
                <div class="col-md-4">                     
                    <textarea class="form-control" id="note" name="note"></textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-4">
                    <button class="btn btn-primary">Ajouter</button>
                </div>
            </div>

        </fieldset>
        </form>
<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
    <script>
        $(function() {

            // Ajout d'un produit
            $('form#addProductForm').submit(function(e){
                e.preventDefault();

                var $form = $('form#addProductForm');

                $.ajax({
                    method: $form.attr('method'),
                    url: '<?= $this->url('admin_add_product') ?>',
                    data: $form.serialize(),
                    dataType: 'json',

                    success: function(data) {
                        switch(data['status']) {
                            case 'error':
                                $('#result').html('<div class="alert alert-danger">'+data['message']+'</div>');
                                break;

                            case 'success':
                                swal('', data['message'], 'success');
                                $form[0].reset();
                                break;
                        }
                    }
                });
            });

        })
    </script>
<?php $this->stop('script') ?>
