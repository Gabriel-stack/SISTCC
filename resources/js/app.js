require('./bootstrap');

$(document).ready(function(){
    $('.pass').on('click', function() {
        var $password = $(this.parentNode).find('input');
        if ($password.attr('type') === 'password') {
            $password.attr('type', 'text');
            $(this).html('<i class="bi bi-eye"></i>');
        } else {
            $password.attr('type', 'password');
            $(this).html('<i class="bi bi-eye-slash"></i>');
        }
    });
});