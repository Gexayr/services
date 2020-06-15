require('./bootstrap');

$(document).ready(function () {
    // $('.add-record').click((e)=>{
    //     let self = $(e.currentTarget);
    //     $('#wallet_id').val(self.data('id'));
    // });
    $('#addService').on('hidden.bs.modal', function () {
        $(this).find('input:not([type="hidden"])').val('');
        $(this).find('textarea').val('');
    });
});
