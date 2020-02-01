$('#sidebar-toggle').click(function () {
    if ($('.left-side').hasClass('toggled')) {
        $('.left-side').removeClass('toggled');
        $('.right-side').removeClass('toggled');
        $('#topbar').removeClass('toggled');
    } else {
        $('.left-side').addClass('toggled');
        $('.right-side').addClass('toggled');
        $('#topbar').addClass('toggled');
    }
});