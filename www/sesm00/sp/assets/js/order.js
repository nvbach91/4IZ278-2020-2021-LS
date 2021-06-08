jQuery(document).ready(function($) {
    $('body').on('click', '.js-card-option', function() {
        $(this).find('.js-card-input').prop('checked', true);
    });
});