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

    $('input[type="checkbox"]').click(()=>{
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
});
