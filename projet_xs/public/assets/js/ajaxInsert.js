$(function() { // équivalent $(document).ready(function(){
  // Pour l'ajout d'un article
  $('#subscribe_form').on('submit', function(el) {
    el.preventDefault(); // On bloque l'action par défaut
    var $form = $('#subscribe_form');
    var formdata = (window.FormData) ? new FormData($form[0]) : null;
    var data = (formdata !== null) ? formdata : $form.serialize();
    $.ajax({
      url: $form.attr('action'),
      method: $form.attr('method'),
      contentType: false, // obligatoire pour de l'upload
      processData: false, // obligatoire pour de l'upload
      dataType: 'json', // selon le retour attendu
      data: data,
      success: function(resultat) {
        switch (resultat.status) {
          case 'success':
            $('#result').html('<div class="alert alert-success">'+resultat.message+'</div>');
            $('#image_preview').remove().fadeOut(1600);
            $form.after("<div style='height: 150px'></div>")
            $form.remove();
            break;

          case 'error':
            $('#result').html('<div class="alert alert-danger">'+resultat.message+'</div>');
            break;
        }        
      }
    });  
  });
});
