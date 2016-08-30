define('js/theme', [
    'jquery',
    'domReady!'
], function ($) {
        $('input[type=file]').change(function () {
            var val = $(this).val().toLowerCase();
            var regex = new RegExp("(.*?)\.(gif|jpg|jpeg|png)$");
            if (!(regex.test(val))) {
                 $(this).val('');
                $('.pcontent').html('');
                $('#image_url').after('<p class="pcontent"><label for="image_url" generated="true" class="mage-error" id="image_url-error">Allow image type: jpg, jpeg, gif, png</label></p>')
            }
        });
    $('#add_category_button').css('display','none');
});

