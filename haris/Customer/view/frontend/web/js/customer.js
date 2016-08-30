require([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function($, modal) {
    /*var login_text = $('#block-customer-login-heading').text();
    var new_user_text_text = $('#block-new-customer-heading').text();*/
    $(document.body).on('click', '.authorization-link a', function(e) {
        var url = $(this).attr('href');
        var data_post = $(this).attr('data-post');
        $('#block-customer-login-heading').text('');
        $('#block-customer-login-heading').text(' Customer Login ');
        $('#block-new-customer-heading').text('');
        $('#block-new-customer-heading').text(' New Customers ');
        if (data_post == undefined) {
            var options = {
                modalClass: 'modal-system-messages ui-popup-message',
                type: 'popup',
                responsive: true,
                innerScroll: true,
                title: '',
                buttons: []
            };
            $('.block-authentication').modal(options, $('.block-authentication')).modal('openModal');

            e.preventDefault();
            return false;
        }
    });
});
