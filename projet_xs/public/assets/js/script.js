// Suppression AJAX
function ajax_delete(selector, title) {

    $('body').on('click', selector, function(e) {
        e.preventDefault();

        var $deleteButton = $(this);
        swal({
            title: title,
            text: "Voulez-vous continuer ?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function() {
            setTimeout(function() {
                $.ajax({
                    method: 'post',
                    url: $deleteButton.attr('href'),
                    data: { id: $deleteButton.data('id') },
                    dataType: 'json',
                    success: function(result) {
                        swal({
                            title: '',
                            text: result.message,
                            type: result.status
                        }, function() {
                            location.reload();
                        });
                    }
                });
            }, 1000);
        });
    });
}

// Modification AJAX
function ajax_change(selector, url) {

    $('body').on('change', selector, function(e) {
        e.preventDefault();

        var $changeOption = $(this);

        $.ajax({
            method: 'post',
            url: url,
            data: { id: $changeOption.data('id'), option: $changeOption.find(':selected').val() },
            dataType: 'json',
            success: function(result) {
                switch (result.status) {
                    case 'error':
                        swal({
                            title: '',
                            text: result.message,
                            type: result.status
                        }, function() {
                            location.reload();
                        });
                        break;

                    case 'success':
                        $changeOption.parent().addClass('has-success has-feedback');
                        break;
                }
            }
        });
    });
}

// Envoi un mail au client
function mail_order() {
    $('.mailOrder').click(function(e) {

        e.preventDefault();

        var $this = $(this);

        swal({
            title: "Commande",
            text: "Voulez-vous envoyer un mail au client ?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function() {
            setTimeout(function() {
                $.ajax({
                    method: 'post',
                    url: $this.attr('href'),
                    data: { user_id: $this.data('id') },
                    dataType: 'json',
                    success: function(result) {
                        swal('', result.message, result.status);
                    }
                });
            }, 1000);
        });
    });

}

// Rendre public ou privé
function change_public(url){

    $('input[name=publicDesign]').change(function(e){
        e.preventDefault();

        var $this = $(this);
        var text = ($this.prop('checked') == true) ? "Votre design est désormais public" : "Votre design est désormais privé";

        $.ajax({
            method: 'post',
            url: url,
            data: {design_id: $this.data('id'), status: $this.data('value')},
            dataType: 'json',
            success: function(result){
                swal({
                    title:'', 
                    text: text,
                    type: 'info'
                }, function() {
                    location.reload();
                });
            }
        });

    })
}
