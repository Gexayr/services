$(document).ready(function () {

    $('#addService, #editService').on('hidden.bs.modal', function () {
        $(this).find('input:not([type="hidden"])').val('');
        $(this).find('textarea').val('');
    });

    $('.edit-service').click((e)=> {
        let self = $(e.currentTarget);
        let id = self.data("id");

        $.ajax({
            type: "GET",
            url: `/services/${id}/edit`,
            data: {
                _tocken: $('input[name="_token"]').val(),
                id: id
            },
            dataType: 'json',
            success: function (response) {
                $('#editService').find('input[name="name"]').val(response.name);
                $('#editService').find('textarea[name="description"]').val(response.description);
                $('#editService').find('form').prop("action",`/services/${id}`);
            }
        });
    });

    $('.relations-checkbox[type="checkbox"]').click(()=>{
        let form = $('#setup-form');
        let formData = form.serializeArray();
        $.ajax({
            type: "POST",
            url: '/relations',
            data: formData,
            dataType: 'json',
            success: function(response) {

            }
        });
    });

    $('.checkbox-input[type="checkbox"]').click((e)=> {
        let self = $(e.currentTarget);
        let id = self.data('id');

        let checked = (self.is(':checked'));

        $.ajax({
            type: "GET",
            url: `/services/check`,
            data: {
                _tocken: $('input[name="_token"]').val(),
                id: id,
                checked: checked,
            },
            dataType: 'json',
            success: function (response) {
                if(checked){
                    $('.checkbox-input').prop("disabled", true);
                    $('.service-block .inactive').addClass("show");
                    $.each(response, function( index, value ) {
                        $('.checkbox-input[data-id=' + value + ']').prop("disabled", false);
                        $('.checkbox-input[data-id=' + value + ']').closest('.service-block').find('.inactive').removeClass("show");
                    });
                } else {
                    $('.checkbox-input').prop("disabled", false);
                    $('.service-block .inactive').removeClass("show");
                }
                $('.checkbox-input[data-id=' + id + ']').prop("disabled", false);
                $('.checkbox-input[data-id=' + id + ']').closest('.service-block').find('.inactive').removeClass("show");
            }
        });
    });
});
