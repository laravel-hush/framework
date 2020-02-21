$(document).ready(function () {
    $('.profile-button').click(function () {
        var menu = $('.user-menu');
        if (menu.is(':visible')) {
            menu.hide();
        } else {
            menu.show();
        }
    });

    functions.initialize();
    functions.initializeDeleter();
    functions.initializeSubmitter();
});
