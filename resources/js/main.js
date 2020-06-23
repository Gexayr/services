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

    $('.relations-checkbox[type="checkbox"]').click((e)=>{
        let self = $(e.currentTarget);
        let row = self.data('row');
        let col = self.data('col');

        let checked = (self.is(':checked'));
        if(checked) {
            var action = 'added';
            $(`.relations-checkbox[data-col="${row}"][data-row="${col}"]`).prop('checked', true);
        } else {
            var action = 'removed';
            $(`.relations-checkbox[data-col="${row}"][data-row="${col}"]`).prop('checked', false);
        }


        let form = $('#setup-form');
        let formData = form.serializeArray();
        $.ajax({
            type: "POST",
            url: '/relations',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === "OK") {
                    $("#setup-form").prepend(
                        '<div class="alert alert-success" role="alert">\n' +
                        '    Service ' + action +' successfully!\n' +
                        '</div>'
                    );
                } else {
                    $("#setup-form").prepend(
                        '<div class="alert alert-danger" role="alert">\n' +
                        '    Something went wrong!\n' +
                        '</div>'
                    );
                }
                setTimeout(() => {
                    $('.alert').remove();
                }, 2000);
            }
        });
    });

    $('.checkbox-input[type="checkbox"]').click((e)=> {
        let self = $(e.currentTarget);
        let id = self.data('id');
        let checked = (self.is(':checked'));

        let formData = [];
        $('.justify-content input[type="checkbox"]:checked').each(function (index, item) {
            formData.push({name: 'items[]', value: $(item).data('id')});
        });

        formData.push({name: 'id', value: id});
        formData.push({name: 'checked', value: checked});

        $.ajax({
            type: "GET",
            url: `/services/check`,
            data: formData,
            dataType: 'json',
            success: function (response) {
                $('.checkbox-input').prop("disabled", false);
                $('.service-block .inactive').removeClass("show");
                $.each(response, ( index, item ) => {
                    if(!$('.checkbox-input[data-id=' + item + ']').is(':checked')) {
                        $('.checkbox-input[data-id=' + item + ']').prop("disabled", true);
                        $('.checkbox-input[data-id=' + item + ']').closest('.service-block').find('.inactive').addClass("show");
                    }
                });
            }
        });
    });
});
