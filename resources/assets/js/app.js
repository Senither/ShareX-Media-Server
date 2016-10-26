
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function() {
    $("button.btn-display-token").on('click', function () {
        const input = $("input.token");

        if (input.attr('type') == 'password') {
            $(this).html('Hide Token');
            return input.attr('type', 'text');
        }
        
        $(this).html('Display Token');
        input.attr('type', 'password');
    });
});