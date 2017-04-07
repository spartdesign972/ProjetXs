$(function() { // équivalent $(document).ready(function(){
  // Pour l'ajout d'un article
  $('#subscribe_form').on('submit', function(el) {
    el.preventDefault(); // On bloque l'action par défaut
    var $form = $(this);
    var formdata = (window.FormData) ? new FormData($form[0]) : null;
    var data = (formdata !== null) ? formdata : $form.serialize();
    $.ajax({
      url: $form.attr('action'),
      type: $form.attr('method'),
      contentType: false, // obligatoire pour de l'upload
      processData: false, // obligatoire pour de l'upload
      dataType: 'json', // selon le retour attendu
      data: data,
      success: function(resultat) {
        alert("ok l'ajax passe");
        $('#result').html(resultat);
        $('#image_preview').remove().fadeOut(1600);
        $form[0].reset();
      }
    });
  });
});
