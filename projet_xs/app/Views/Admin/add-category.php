<?php $this->layout('layoutAdmin', ['title' => 'Ajouter un article']) ?>

<?php $this->start('main_content') ?>

        <br>
        <form id="addCategoryForm" class="form-horizontal" action='<?=$this->url('admin_add_category');?>' method='post' enctype="multipart/form-data">
        <fieldset>

            <!-- Form Name -->
            <legend>Ajouter une catégorie</legend>
            <div id="result"></div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="category">Libellé</label>  
                <div class="col-md-4">
                    <input id="category" name="category" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="category_reference">Référence</label>  
                <div class="col-md-4">
                    <input id="category_reference" name="category_reference" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="name">Nom</label>  
                <div class="col-md-4">
                    <input id="name" name="name" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="description">Description</label>
                <div class="col-md-4">                     
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="price">Prix</label>  
                <div class="col-md-4">
                    <input id="price" name="price" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="tax">TVA</label>  
                <div class="col-md-4">
                    <input id="tax" name="tax" type="text" placeholder="" class="form-control input-md">
                    
                </div>
            </div>

            <!-- File Button --> 
            <div class="form-group">
            <label class="col-md-4 control-label" for="view">Image</label>
                <div class="col-md-4">
                    <input id="view" name="view" class="input-file" type="file" accept="image/*">
                </div>
            </div>

            <!-- Image Preview --> 
            <div class="form-group" style="margin-bottom: 0;">
                <div id="image_preview" class="col-lg-10 col-lg-offset-2">
                    <div class="thumbnail hidden">
                        <img src="http://placehold.it/5" alt="">
                        <div class="caption">
                            <h4></h4>
                            <p></p>
                            <p><button type="button" class="btn btn-default btn-danger">Annuler</button></p>
                        </div>
                    </div>
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

            // A chaque sélection de fichier
            $('form#addCategoryForm').find('input[name=view]').on('change', function (e) {
                var files = $(this)[0].files;
        
                if (files.length > 0) {
                    // On part du principe qu'il n'y qu'un seul fichier
                    // étant donné que l'on a pas renseigné l'attribut "multiple"
                    var file = files[0],
                        $image_preview = $('#image_preview');
        
                    // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
                    $image_preview.find('.thumbnail').removeClass('hidden');
                    $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
                    $image_preview.find('h4').html(file.name);
                    $image_preview.find('.caption p:first').html(file.size +' bytes');
                }
            });
        
            // Bouton "Annuler" pour vider le champ d'upload
            $('#image_preview').find('button[type="button"]').on('click', function (e) {
                e.preventDefault();
        
                $('form#addCategoryForm').find('input[name="view"]').val('');
                $('#image_preview').find('.thumbnail').addClass('hidden');
            });
            
            // Ajout de catégorie
            $('form#addCategoryForm').submit(function(e){
                e.preventDefault();

                var $form = $('form#addCategoryForm');
                var formdata = (window.FormData) ? new FormData($form[0]) : null;
                var data = (formdata !== null) ? formdata : $form.serialize();

                $.ajax({
                    method: $form.attr('method'),
                    contentType: false, // obligatoire pour de l'upload
                    processData: false, // obligatoire pour de l'upload
                    url: $form.attr('action'),
                    data: data,
                    dataType: 'json',

                    success: function(data) {
                        switch(data['status']) {
                            case 'error':
                                $('#result').html('<div class="alert alert-danger">'+data['message']+'</div>');
                                break;

                            case 'success':
                                swal('', data['message'], 'success');
                                // $('#result').html('<div class="alert alert-success">'+data['message']+'</div>');
                                $form[0].reset();
                                $('#image_preview').find('button[type="button"]').click();
                                break;
                        }
                    }
                });
            });

        })
    </script>
<?php $this->stop('script') ?>
