if ($(document).width > 1300) {

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

} else {

    $('#sidebar-toggle').click(function () {
        $('.left-side').addClass('toggled');
        $('.right-side').addClass('toggled');
        $('#topbar').addClass('toggled');
    });

    $(document).mouseup(function (event) {
        $('.left-side').removeClass('toggled');
        $('.right-side').removeClass('toggled');
        $('#topbar').removeClass('toggled');
    });

}
